import {Injectable} from '@angular/core';
import {
    CanActivate, Router,
    ActivatedRouteSnapshot,
    RouterStateSnapshot,
    CanActivateChild,
    CanLoad, Route
} from '@angular/router';

import {ManagerService} from "./manager.service";
import {NbAuthService } from '@nebular/auth';

import {take, map, catchError} from "rxjs/internal/operators";
import { of } from 'rxjs';

@Injectable()
export class AuthGuardAdmin implements CanActivate, CanActivateChild, CanLoad {

    constructor(private router: Router, private authService: NbAuthService, private manager: ManagerService) {

    }

    isauth: boolean = false;
    baseurl: any = "http://localhost:4200/";

    canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {

        let url: string = state.url;

        let obsValue = undefined

        this.authService.onTokenChange().pipe(take(1)).
            subscribe((token) => {
                    obsValue  = token.getPayload();
            })



           return this.getAdminAccesGrant(obsValue.roles,this.authService.isAuthenticated());


    }

     getAdminAccesGrant(role,isAuthenticated){

      let param = {};

      param.role = role;

      return  this.manager.isadmin(param).pipe(

        map(data => {

          console.log("yesf",data );

          if (data === true && isAuthenticated) {

            return true;

          }

          return false;

        }),

        catchError(() => {
          return of(false);
        }),

      );

    }

    canActivateChild(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
        return this.canActivate(route, state);
    }

    canLoad(route: Route) {
        return this.authService.isAuthenticated();
    }

    logout() {
        this.authService.logout('email');
        localStorage.removeItem('auth_app_token');
        this.router.navigate(['auth/login']);
    }


}
