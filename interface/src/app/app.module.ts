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



@NgModule({
  declarations: [AppComponent,StopClickDirective,NbLoginComponent],
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

          baseEndpoint: 'http://127.0.0.1/AGL/web/api/',
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
    AuthGuard, NbAuthService ,
  ],
})
export class AppModule {
}
