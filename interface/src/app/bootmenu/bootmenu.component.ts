import {Component, OnDestroy, OnInit} from '@angular/core';
import {
    NbMediaBreakpoint,
    NbMediaBreakpointsService,
    NbMenuItem,
    NbMenuService,
    NbSidebarService,
    NbThemeService,
} from '@nebular/theme';

import{Router} from "@angular/router";
import {delay, takeWhile, withLatestFrom} from "rxjs/operators";
import {StateService} from "../@core/data/state.service";
import {ModulestateService} from "../@core/data/modulestate.service";
import {ManagerService} from "../@core/data/manager.service";

@Component({
  selector: 'ngx-bootmenu',
  templateUrl: './bootmenu.component.html',
  styleUrls: ['./bootmenu.component.scss']
})
export class BootmenuComponent implements OnInit,OnDestroy {



    layout: any = {};
    sidebar: any = {};
    modules:any = [];

    private alive = true;

    currentTheme: string;

    constructor(protected stateService: StateService,
                protected menuService: NbMenuService,
                protected themeService: NbThemeService,
                protected bpService: NbMediaBreakpointsService,
                protected sidebarService: NbSidebarService , private modulestate : ModulestateService,private managerservice : ManagerService,private router:Router) {
        this.stateService.onLayoutState()
            .pipe(takeWhile(() => this.alive))
            .subscribe((layout: string) => this.layout = layout);

        this.stateService.onSidebarState()
            .pipe(takeWhile(() => this.alive))
            .subscribe((sidebar: string) => {
                this.sidebar = sidebar;
            });

        const isBp = this.bpService.getByName('is');
        this.menuService.onItemSelect()
            .pipe(
                takeWhile(() => this.alive),
                withLatestFrom(this.themeService.onMediaQueryChange()),
                delay(20),
            )
            .subscribe(([item, [bpFrom, bpTo]]: [any, [NbMediaBreakpoint, NbMediaBreakpoint]]) => {

                if (bpTo.width <= isBp.width) {
                    this.sidebarService.collapse('menu-sidebar');
                }
            });

        this.themeService.getJsTheme()
            .pipe(takeWhile(() => this.alive))
            .subscribe(theme => {
                this.currentTheme = theme.name;
            });
    }

    ngOnDestroy() {
        this.alive = false;
    }

     ngOnInit(){
         this.managerservice.getAllModule().subscribe(modules => this.modules = modules)
     }

    GotoModule(module){
       this.modulestate.setModule(module.moduleId);
        this.router.navigate(['page/']);
    }

}
