import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ThemeModule } from '../@theme/theme.module';
import { AdminRoutingModule } from './admin-routing.module';
import { ManagerComponent } from './manager/manager.component';
import { AdminComponent } from './admin.component';
import { AuthGuard } from '../auth.guard.service';
import {AuthGuardAdmin} from "../@core/data/auth.guard.admin.service";
import { CallbackdirDirective } from '../callbackdir.directive';
import { ExpressionComponent } from './manager/expression/expression.component';




const ADMIN_COMPONENTS = [
  AdminComponent,
  ManagerComponent,

];

const DIRECTIVE_DEC = [
    CallbackdirDirective
]

@NgModule({
  imports: [
    AdminRoutingModule,
    CommonModule,
    ThemeModule,
  ],
  declarations: [...ADMIN_COMPONENTS,...DIRECTIVE_DEC, ExpressionComponent],
  providers:[
    AuthGuard,AuthGuardAdmin
  ]
})
export class adminModule { }
 