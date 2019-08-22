import {Component, Input, OnInit} from '@angular/core';

import {NbMenuService, NbSidebarService} from '@nebular/theme';
import {UserService} from '../../../@core/data/users.service';
import {AnalyticsService} from '../../../@core/utils/analytics.service';
import {LayoutService} from '../../../@core/data/layout.service';
import {AuthGuard} from '../../../@core/data/auth.guard.service';
import {Router} from '@angular/router';
import {ModulestateService} from "../../../@core/data/modulestate.service";
import {ManagerService} from "../../../@core/data/manager.service";
import {NgxSmartModalService} from 'ngx-smart-modal';
import {NbAuthService } from '@nebular/auth';
import {take} from "rxjs/internal/operators";

@Component({
    selector: 'ngx-header',
    styleUrls: ['./header.component.scss'],
    templateUrl: './header.component.html',
})
export class HeaderComponent implements OnInit {

    @Input() position = 'normal';

    user: any={};
    admin: any = false;
    front: any = false;
    moudleName: any;
    modules: any = [];
    modulesInp: any = {};
    moduleDesignation: any = "";

    userMenu = [{title: 'Profile', link: '/pages/dashboard'}, {title: 'Log out'}];

    constructor(private sidebarService: NbSidebarService,
                private menuService: NbMenuService,
                private userService: UserService,
                private analyticsService: AnalyticsService,
                private layoutService: LayoutService,
                private authguard: AuthGuard,
                private router: Router,
                private ngxSmartModalService: NgxSmartModalService,
                private  ManagerService: ManagerService,
                private moduleService: ModulestateService,
                private authService: NbAuthService) {
        this.getCurrentModule()
    }

    ngOnInit() {

        this.getAllModule()

        let obsValue;

        this.authService.onTokenChange().pipe(take(1)).
        subscribe((token) => {
            obsValue  = token.getPayload();
        })

        this.user.name = obsValue.username

        let root = this.router.url.split('/');

        if (root[1] == 'pages') {
            this.front = true;

        } else if (root[1] == 'admin') {
            this.admin = true;
        } else {
            this.front = false;
            this.admin = false;
        }

    }

    setModule($event) {
        if (this.modules != "Selectioner un module")
            this.moduleService.setModule($event.target.selectedOptions[0].value);
    }

    stopClick($event) {
        $event.stopPropagation();
    }

    AddModuleDialog($event) {
        $event.stopPropagation();
        this.ngxSmartModalService.open('moduleModal');
    }

    toggleSidebar(): boolean {
        this.sidebarService.toggle(true, 'menu-sidebar');
        this.layoutService.changeLayoutSize();
        return false;
    }

    logout() {
        this.authguard.logout();
    }

    toggleSettings(): boolean {
        this.sidebarService.toggle(false, 'settings-sidebar');
        return false;
    }

    goToHome() {
        this.menuService.navigateHome();
    }

    startSearch() {
        this.analyticsService.trackEvent('startSearch');
    }

    addModule() {
        var param = {}
        param = this.modulesInp;
        this.ManagerService.addModule(param).subscribe(resp => this.getAllModule());
    }

    getCurrentModule() {
        this.ManagerService.getAllModule().subscribe(resp => this.setModuleDesignation(resp));
    }

    setModuleDesignation(modules) {
        for (let mod of modules) {
            if (mod.moduleId == this.moduleService.getModuleValue()) {
                 this.moduleDesignation = mod.moduleLibelle;
            }
        }
    }

    getAllModule() {
        this.ManagerService.getAllModule().subscribe(modules => this.populateModule(modules));

    }

    populateModule(modules) {
        this.modules = modules
        console.log(modules)
    }


}
