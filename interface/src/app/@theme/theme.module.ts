import {ModuleWithProviders, NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import { NgDragDropModule } from 'ng-drag-drop';
import { AngularFontAwesomeModule } from 'angular-font-awesome';
import { DndModule } from 'ngx-drag-drop';
import {DpDatePickerModule} from 'ng2-date-picker';
import { NgSelect2Module  } from 'ng-select2';
import { CKEditorModule } from '@ckeditor/ckeditor5-angular';
import { EditorModule } from '@tinymce/tinymce-angular';
import { NgxSmartModalModule } from 'ngx-smart-modal';



import {
    NbActionsModule,
    NbCardModule,
    NbLayoutModule,
    NbMenuModule,
    NbRouteTabsetModule,
    NbSearchModule,
    NbSidebarModule,
    NbTabsetModule,
    NbThemeModule,
    NbUserModule,
    NbCheckboxModule,
    NbPopoverModule,
    NbContextMenuModule,
    NbProgressBarModule,
    NbButtonModule,
    NbListModule,
    NbInputModule, NbStepperModule,NbAccordionModule
} from '@nebular/theme';



import {NbSecurityModule} from '@nebular/security';

import {
    FooterComponent,
    HeaderComponent,
    SearchInputComponent,
    ThemeSettingsComponent,
    SwitcherComponent,
    LayoutDirectionSwitcherComponent,
    ThemeSwitcherComponent,
    TinyMCEComponent,
    ThemeSwitcherListComponent,
    OneInputFormComponent,
} from './components';



import {
    CapitalizePipe,
    PluralPipe,
    RoundPipe,
    TimingPipe,
    NumberWithCommasPipe,
} from './pipes';
import {
    FrontLayoutComponent,
    AdminLayoutComponent
} from './layouts';
import {DEFAULT_THEME} from './styles/theme.default';
import {COSMIC_THEME} from './styles/theme.cosmic';
import {CORPORATE_THEME} from './styles/theme.corporate';
import { EditInputComponent } from './components/edit-input/edit-input.component';


const BASE_MODULES = [CommonModule, FormsModule, ReactiveFormsModule];

const NB_MODULES = [
    NbCardModule,
    NbLayoutModule,
    NbListModule,
    NbTabsetModule,
    NbRouteTabsetModule,
    NbMenuModule,
    NbUserModule,
    NbActionsModule,
    NbSearchModule,
    NbSidebarModule,
    NbCheckboxModule,
    NbPopoverModule,
    NbContextMenuModule,
    NgbModule,
    NbButtonModule,
    NbSecurityModule, // *nbIsGranted directive,
    NbProgressBarModule,
    NbInputModule,
    NgDragDropModule,
    AngularFontAwesomeModule,
    DndModule,
    NbStepperModule,
    DpDatePickerModule,
    NbAccordionModule,
    NgSelect2Module,
    CKEditorModule,
    EditorModule,
    NgxSmartModalModule
];

const COMPONENTS = [
    SwitcherComponent,
    LayoutDirectionSwitcherComponent,
    ThemeSwitcherComponent,
    ThemeSwitcherListComponent,
    HeaderComponent,
    FooterComponent,
    SearchInputComponent,
    ThemeSettingsComponent,
    TinyMCEComponent,
    FrontLayoutComponent,
    AdminLayoutComponent,
    OneInputFormComponent,
    EditInputComponent,

];

const ENTRY_COMPONENTS = [
    ThemeSwitcherListComponent,
];

const PIPES = [
    CapitalizePipe,
    PluralPipe,
    RoundPipe,
    TimingPipe,
    NumberWithCommasPipe,
];

const NB_THEME_PROVIDERS = [
    ...NbThemeModule.forRoot(
        {
            name: 'cosmic',
        },
        [DEFAULT_THEME, COSMIC_THEME, CORPORATE_THEME],
    ).providers,
    ...NbSidebarModule.forRoot().providers,
    ...NbMenuModule.forRoot().providers,
];

@NgModule({
    imports: [...BASE_MODULES, ...NB_MODULES],
    exports: [...BASE_MODULES, ...NB_MODULES, ...COMPONENTS, ...PIPES],
    declarations: [...COMPONENTS, ...PIPES, OneInputFormComponent, EditInputComponent],
    entryComponents: [...ENTRY_COMPONENTS],
})
export class ThemeModule {
    static forRoot(): ModuleWithProviders {
        return <ModuleWithProviders>{
            ngModule: ThemeModule,
            providers: [...NB_THEME_PROVIDERS],
        };
    }
}
