import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { NgxClickToEditComponent } from './ngx-click-to-edit.component';

var NgxClickToEditModule = (function () {
    function NgxClickToEditModule() {
    }
    NgxClickToEditModule.forRoot = function () {
        return {
            ngModule: NgxClickToEditModule
        };
    };
    NgxClickToEditModule.decorators = [
        { type: NgModule, args: [{
                    declarations: [
                        NgxClickToEditComponent
                    ],
                    imports: [
                        CommonModule,
                        FormsModule
                    ],
                    exports: [
                        NgxClickToEditComponent
                    ],
                    entryComponents: [
                        NgxClickToEditComponent
                    ]
                },] },
    ];
    /** @nocollapse */
    NgxClickToEditModule.ctorParameters = function () { return []; };
    return NgxClickToEditModule;
}());
export { NgxClickToEditModule };
//# sourceMappingURL=ngx-click-to-edit.module.js.map