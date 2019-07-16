import { NgModule } from '@angular/core';
import {Routes, RouterModule, ExtraOptions} from '@angular/router';
import { ManagerComponent } from './manager/manager.component';
import{ AuthGuard } from '../@core/data/auth.guard.service';
import { AdminComponent } from './admin.component';
import {AuthGuardAdmin} from "../@core/data/auth.guard.admin.service";


const routes: Routes = [{
  path: '',
  component: AdminComponent,
  children: [{
    path: 'manager',
    component: ManagerComponent,
    canActivate:[AuthGuardAdmin]
  }, {
    path: '',
    redirectTo: 'manager',
    pathMatch: 'full',
  }, {
    path: '**',
      redirectTo: 'manager',

  }],
}];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule { }
 