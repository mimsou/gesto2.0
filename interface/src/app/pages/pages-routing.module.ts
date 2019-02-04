import {RouterModule, Routes} from '@angular/router';
import {NgModule} from '@angular/core';

import {AuthGuard} from '../@core/data/auth.guard.service';

import {PagesComponent} from './pages.component';
import {NotFoundComponent} from './miscellaneous/not-found/not-found.component';
import {FoundComponent} from './miscellaneous/found/found.component';
import {GeneratorComponent} from './app-genrator/generator/generator.component';


const routes: Routes = [{
    path: '',
    component: PagesComponent,
    children: [{
        path: 'app-generator',
        children: [{
            path: 'app',
            component: GeneratorComponent,
            canActivate: [AuthGuard]
        }]
    }
     , {
        path: '',
        redirectTo: 'mouvements/entre',
        pathMatch: 'full',
    }, {
        path: '**',
        component: NotFoundComponent,
    }],
}];

@NgModule({
    imports: [RouterModule.forChild(routes)],
    exports: [RouterModule],
})
export class PagesRoutingModule {

    getRoutes() {
        return routes;
    }
}


