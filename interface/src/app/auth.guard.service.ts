import { Injectable } from '@angular/core';
import {
  CanActivate, Router,
  ActivatedRouteSnapshot,
  RouterStateSnapshot,
  CanActivateChild,
  NavigationExtras,
  CanLoad, Route
} from '@angular/router';

import { NbAuthService } from '@nebular/auth';
import { observable } from 'rxjs';

@Injectable()
export class AuthGuard implements CanActivate, CanActivateChild, CanLoad {

  constructor(private router: Router, private authService: NbAuthService) {

  }

  isauth: boolean = false;
  baseurl: any = "http://localhost:4200/";

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
    let url: string = state.url;
    console.log(this.authService.getToken());
    return this.authService.isAuthenticated(); 
  }

  canActivateChild(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
    return this.canActivate(route, state);
  }

  canLoad(route: Route) {

    return this.authService.isAuthenticated();
  }

  logout(){
    this.authService.logout('email');
    localStorage.removeItem('auth_app_token');
    this.router.navigate(['auth/login']);
  }


}
