import { Component } from '@angular/core';
import { MENU_ITEMS } from './admin-menu';

@Component({
  selector: 'ngx-admin-admin',
  template: `
  <ngx-admin-layout>
  <router-outlet></router-outlet>
</ngx-admin-layout>
  `,
})
export class AdminComponent {
  menu = MENU_ITEMS;
}
