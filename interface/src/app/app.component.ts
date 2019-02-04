/**
 * @license
 * Copyright Akveo. All Rights Reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 */
import {Component, OnInit} from '@angular/core';
import {AnalyticsService} from './@core/utils/analytics.service';
import {NbThemeService, NbPopoverDirective} from '@nebular/theme';
import {NbAuthService} from '@nebular/auth'
import {Router} from '@angular/router';




@Component({
    selector: 'ngx-app',
    template: '<router-outlet></router-outlet>',
})
export class AppComponent implements OnInit {

  constructor(private analytics: AnalyticsService, private themeService: NbThemeService, private router: Router, private authService: NbAuthService) {

    this.authService.onAuthenticationChange().subscribe((isauth) => {
      if (!isauth) {
        this.router.navigate(['auth/login']);
      }
    });


    themeService.changeTheme("default");
  }

    ngOnInit(): void {
        this.analytics.trackPageViews();
    }

}
