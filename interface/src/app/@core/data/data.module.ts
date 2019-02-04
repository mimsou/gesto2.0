import {NgModule, ModuleWithProviders} from '@angular/core';
import {CommonModule} from '@angular/common';



import { UserService } from './users.service';
import {PlayerService} from './player.service';
import { StateService } from './state.service';
import{ManagerService} from './manager.service';
import{ ApiLink } from './api.link';


import {LayoutService} from './layout.service';
import {AuthGuard} from './auth.guard.service'

const SERVICES = [
    UserService,
    PlayerService,
    LayoutService,
    StateService,
    AuthGuard,
    ManagerService,
    ApiLink
];

@NgModule({
    imports: [
        CommonModule,
    ],
    providers: [
        ...SERVICES,
    ],
})
export class DataModule {
    static forRoot(): ModuleWithProviders {
        return <ModuleWithProviders>{
            ngModule: DataModule,
            providers: [
                ...SERVICES,
            ],
        };
    }
}
