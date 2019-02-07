import { NgModule } from '@angular/core';

import{ AuthGuard } from '../auth.guard.service';


import { PagesComponent } from './pages.component';
import { PagesRoutingModule } from './pages-routing.module';
import { ThemeModule } from '../@theme/theme.module';
import { FoundComponent } from './miscellaneous/found/found.component';
import { NotFoundComponent } from './miscellaneous/not-found/not-found.component';
import { GeneratorComponent } from './app-genrator/generator/generator.component';
import { ListComponent } from './app-genrator/generator/list/list.component';
import { FormComponent } from './app-genrator/generator/form/form.component';
import { AutocomboComponent } from './app-genrator/generator/autocombo/autocombo.component';
import { DimentionComponent } from './app-genrator/generator/dimention/dimention.component';
import { StepPipe } from './app-genrator/generator/step.pipe';


const PAGES_COMPONENTS = [
  PagesComponent,
    FoundComponent,
    NotFoundComponent
];

@NgModule({
  imports: [
    PagesRoutingModule,
    ThemeModule,
  ],
  declarations: [
    ...PAGES_COMPONENTS,
    GeneratorComponent,
    ListComponent,
    FormComponent,
    AutocomboComponent,
    DimentionComponent,
    StepPipe,
  ],
  providers:[
    AuthGuard
  ]
})
export class PagesModule {
}
