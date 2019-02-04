import {Component} from '@angular/core';
import {MENU_ITEMS} from './pages-menu';
import {ManagerService} from './../@core/data/manager.service';
import {NbMenuItem} from '@nebular/theme';


@Component({
    selector: 'ngx-pages',
    template: `
        <ngx-front-layout>
            <nb-menu [items]="menu"></nb-menu>
            <router-outlet></router-outlet>
        </ngx-front-layout>
    `,
})

export class PagesComponent {
    constructor(private menuService: ManagerService) {
        this.menuService.getMenu().subscribe(menu => this.setMenu(menu));
    }

    menu: NbMenuItem[] = [];

    setMenu(menu) {
        for (let mn of menu) {
            var men = [];
            men.icone = mn.icone;
            men.title = mn.title;
            if (typeof mn.children != 'undefined') {
                if (mn.children.length > 0) {
                    men.children = this.menuLoop(mn.children);
                }
            }
            this.menu.push(men);
        }
        console.log(this.menu);

    }

    menuLoop(menu) {
        var mens = [];
        for (let mn of menu) {
            var men = []
            men.icone = mn.icone;
            men.title = mn.title;
            men.link = mn.link;
            men.queryParams = mn.query_params;
            if (typeof mn.children != 'undefined') {
                if (mn.children.length > 0) {
                    men.children = this.menuLoop(mn.children);
                }
            }
            mens.push(men);
        }
        return mens;
    }


}
