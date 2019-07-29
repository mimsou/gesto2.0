import {Component, OnDestroy, OnInit} from '@angular/core';
import {MENU_ITEMS} from './pages-menu';
import {ManagerService} from './../@core/data/manager.service';
import {NbMenuItem} from '@nebular/theme';
import {ModulestateService} from "../@core/data/modulestate.service";


@Component({
    selector: 'ngx-pages',
    template: `
        <ngx-front-layout>
            <nb-menu [items]="menu"></nb-menu>
            <router-outlet></router-outlet>
        </ngx-front-layout>
    `,
})

export class PagesComponent implements OnInit {

    module:any;

    constructor(private menuService: ManagerService, private modulestateService: ModulestateService) {

    }

    ngOnInit() {
        this.module = this.modulestateService.getModuleValue();
        this.getMenu();
    }

    getMenu(currentModule) {
        this.menuService.getMenu(this.module).subscribe(menu => this.setMenu(menu));
    }

    menu: NbMenuItem[] = [];

    setMenu(menu) {
        console.log("menui", this.module)
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
