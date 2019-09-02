/**
 * @license
 * Copyright Akveo. All Rights Reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 */
import { APP_BASE_HREF } from '@angular/common';
import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule } from '@angular/core';
import {HTTP_INTERCEPTORS, HttpClientModule} from '@angular/common/http';
import { CoreModule } from './@core/core.module';
import {NbPasswordAuthStrategy, NbAuthModule, NbAuthJWTToken, NbAuthService, NbAuthJWTInterceptor} from '@nebular/auth';

import{ AuthGuard } from './auth.guard.service';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { ThemeModule } from './@theme/theme.module';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { StopClickDirective } from './stop-click.directive';
import { NbLoginComponent } from './pages/login/login.component';
import { NbAlertModule, NbButtonModule, NbCardModule, NbCheckboxModule, NbInputModule, NbLayoutModule, } from '@nebular/theme';
import { NgxSmartModalService } from 'ngx-smart-modal';
import {Dialog, DialogTemplateComponent} from './dialog.template/dialog.template.component';
import { AppHttpInterceptor } from './http.interceptor'
import  { MessageService } from './message.service';
import { BootmenuComponent } from './bootmenu/bootmenu.component'
import {ModulestateService} from "./@core/data/modulestate.service";


@NgModule({ 
  declarations: [AppComponent,StopClickDirective,NbLoginComponent, DialogTemplateComponent, BootmenuComponent],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    HttpClientModule,
    AppRoutingModule,
      NbAlertModule,

    NgbModule.forRoot(),
    ThemeModule.forRoot(),
    CoreModule.forRoot(),
    NbAuthModule.forRoot({
      strategies: [
        NbPasswordAuthStrategy.setup({
          name: 'email',
          token: {
            class: NbAuthJWTToken,
            key: 'token',
          },

          baseEndpoint: 'http://10.0.26.199/AFRREST/web/api/',
           login: {
             endpoint: 'login_check',
             method: 'post',
           },
           logout: {  endpoint: '', method: null, redirect: { success: '/', failure: '/' } }
           ,
           register: {
             endpoint: 'user/',
             method: 'post',
           },
        }),
      ],
      forms: {},

    }),
  ],
  bootstrap: [AppComponent], 
  providers: [
    { provide: APP_BASE_HREF, useValue: '/' },
      { provide: HTTP_INTERCEPTORS, useClass: NbAuthJWTInterceptor, multi: true},
      { provide: HTTP_INTERCEPTORS, useClass: AppHttpInterceptor, multi: true},
      NgxSmartModalService,
    AuthGuard, NbAuthService ,MessageService,ModulestateService
  ],
})
export class AppModule {
}
