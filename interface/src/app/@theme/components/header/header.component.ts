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

@Component({
    selector: 'ngx-header',
    styleUrls: ['./header.component.scss'],
    templateUrl: './header.component.html',
})
export class HeaderComponent implements OnInit {

    @Input() position = 'normal';

    user: any;
    admin: any = false;
    front: any = false;
    moudleName:any;
    modules:any = [];
    modulesInp:any = {};

    userMenu = [{title: 'Profile', link: '/pages/dashboard'}, {title: 'Log out'}];

    constructor(private sidebarService: NbSidebarService,
                private menuService: NbMenuService,
                private userService: UserService,
                private analyticsService: AnalyticsService,
                private layoutService: LayoutService,
                private authguard: AuthGuard,
                private router: Router,
                private ngxSmartModalService: NgxSmartModalService,
                private  ManagerService:ManagerService,
                private moduleService:ModulestateService) {
    }

    ngOnInit() {

        this.getAllModule()

        this.userService.getUsers()
            .subscribe((users: any) => this.user = users.nick);



        let root = this.router.url.split('/');

        if ( root[1] == 'pages') {
            this.front = true;

        } else if ( root[1] == 'admin') {
            console.log('ddd')
            this.admin = true;
        } else {
            this.front = false;
            this.admin = false;
        }

    }

    setModule($event){
        if( this.modules != "Selectioner un module")
       this.moduleService.setModule($event.target.selectedOptions[0].value);
    }

    stopClick($event){
        $event.stopPropagation();
    }

    AddModuleDialog($event){
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

    addModule(){
        var param = {}
        param = this.modulesInp;
        this.ManagerService.addModule(param).subscribe(resp =>  this.getAllModule());
    }

    getAllModule(){
        this.ManagerService.getAllModule().subscribe(modules => this.populateModule(modules) );

    }

    populateModule(modules){
        this.modules = modules
        console.log(modules)
    }




}
