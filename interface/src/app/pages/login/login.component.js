import { ChangeDetectionStrategy, ChangeDetectorRef, Component, Inject } from '@angular/core';
import { Router } from '@angular/router';
import { NB_AUTH_OPTIONS } from '@nebular/auth/auth.options';
import { getDeepFromObject } from '@nebular/auth/helpers';
import { NbAuthService } from '@nebular/auth/services/auth.service';

var NbLoginComponent = /** @class */ (function () {
    function NbLoginComponent(service, options, cd, router) {
        if (options === void 0) { options = {}; }
        this.service = service;
        this.options = options;
        this.cd = cd;
        this.router = router;
        this.redirectDelay = 0;
        this.showMessages = {};
        this.strategy = '';
        this.errors = [];
        this.messages = [];
        this.user = {};
        this.submitted = false;
        this.socialLinks = [];
        this.redirectDelay = this.getConfigValue('forms.login.redirectDelay');
        this.showMessages = this.getConfigValue('forms.login.showMessages');
        this.strategy = this.getConfigValue('forms.login.strategy');
        this.socialLinks = this.getConfigValue('forms.login.socialLinks');
    }

    NbLoginComponent.prototype.login = function () {
        var _this = this;
        this.errors = this.messages = [];
        this.submitted = true;
        this.service.authenticate(this.strategy, this.user).subscribe(function (result) {
            _this.submitted = false;
            if (result.isSuccess()) {
                _this.messages = result.getMessages();
            }
            else {
                _this.errors = result.getErrors();
            }
            var redirect = result.getRedirect();
            if (redirect) {
                setTimeout(function () {
                    return _this.router.navigateByUrl(redirect);
                }, _this.redirectDelay);
            }
            _this.cd.detectChanges();
        });
    };
    NbLoginComponent.prototype.getConfigValue = function (key) {
        return getDeepFromObject(this.options, key, null);
    };
    NbLoginComponent.decorators = [
        { type: Component, args: [{
                selector: 'nb-login',
                template: '<nb-auth-block>     <h2 class="title">Sign In</h2>     <small class="form-text sub-title">Hello! Sign in with your username or email</small>      <form (ngSubmit)="login()" #form="ngForm" autocomplete="nope">          <nb-alert *ngIf="showMessages.error && errors?.length && !submitted" outline="danger">             <div><strong>Oh snap!</strong></div>             <div *ngFor="let error of errors">{{ error }}</div>         </nb-alert>          <nb-alert *ngIf="showMessages.success && messages?.length && !submitted" outline="success">             <div><strong>Hooray!</strong></div>             <div *ngFor="let message of messages">{{ message }}</div>         </nb-alert>          <div class="form-group">             <label for="input-email" class="sr-only">Email address</label>             <input nbInput                    [(ngModel)]="user._username"                    #email="ngModel"                    name="email"                    id="input-email"                    placeholder="Login"                    autofocus                    fullWidth                    [status]="email.dirty ? (email.invalid  ? \'danger\' : \'success\') : \'\'"                    [required]="getConfigValue(\'forms.validation.email.required\')">             <small class="form-text error" *ngIf="email.invalid && email.touched && email.errors?.required">                 Email is required!             </small>             <small class="form-text error"                    *ngIf="email.invalid && email.touched && email.errors?.pattern">                 Email should be the real one!             </small>         </div>          <div class="form-group">             <label for="input-password" class="sr-only">Password</label>             <input nbInput                    [(ngModel)]="user._password"                    #password="ngModel"                    name="password"                    type="password"                    id="input-password"                    placeholder="Password"                    fullWidth                    [status]="password.dirty ? (password.invalid  ? \'danger\' : \'success\') : \'\'"                    [required]="getConfigValue(\'forms.validation.password.required\')"                    [minlength]="getConfigValue(\'forms.validation.password.minLength\')"                    [maxlength]="getConfigValue(\'forms.validation.password.maxLength\')">             <small class="form-text error" *ngIf="password.invalid && password.touched && password.errors?.required">                 Password is required!             </small>             <small                     class="form-text error"                     *ngIf="password.invalid && password.touched && (password.errors?.minlength || password.errors?.maxlength)">                 Password should contains                 from {{ getConfigValue(\'forms.validation.password.minLength\') }}                 to {{ getConfigValue(\'forms.validation.password.maxLength\') }}                 characters             </small>         </div>          <div class="form-group accept-group col-sm-12">             <nb-checkbox name="rememberMe" [(ngModel)]="user.rememberMe">Remember me</nb-checkbox>             <a class="forgot-password" routerLink="../request-password">Forgot Password?</a>         </div>          <button nbButton                 status="success"                 fullWidth                 [disabled]="submitted || !form.valid"                 [class.btn-pulse]="submitted">             Sign In         </button>     </form>      <div class="links">          <ng-container *ngIf="socialLinks && socialLinks.length > 0">             <small class="form-text">Or connect with:</small>              <div class="socials">                 <ng-container *ngFor="let socialLink of socialLinks">                     <a *ngIf="socialLink.link"                        [routerLink]="socialLink.link"                        [attr.target]="socialLink.target"                        [attr.class]="socialLink.icon"                        [class.with-icon]="socialLink.icon">{{ socialLink.title }}</a>                     <a *ngIf="socialLink.url"                        [attr.href]="socialLink.url"                        [attr.target]="socialLink.target"                        [attr.class]="socialLink.icon"                        [class.with-icon]="socialLink.icon">{{ socialLink.title }}</a>                 </ng-container>             </div>         </ng-container>          <small class="form-text">             Don\'t have an account? <a routerLink="../register"><strong>Sign Up</strong></a>         </small>     </div> </nb-auth-block>',
                changeDetection: ChangeDetectionStrategy.OnPush,
            },] },
    ];
    /** @nocollapse */
    NbLoginComponent.ctorParameters = function () { return [
        { type: NbAuthService, },
        { type: undefined, decorators: [{ type: Inject, args: [NB_AUTH_OPTIONS,] },] },
        { type: ChangeDetectorRef, },
        { type: Router, },
    ]; };
    return NbLoginComponent;
}());
export { NbLoginComponent };
//# sourceMappingURL=login.component.js.map