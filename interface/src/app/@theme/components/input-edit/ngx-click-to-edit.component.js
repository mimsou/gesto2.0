import {Component, EventEmitter, Input, Output} from '@angular/core';


var NgxClickToEditComponent = (function () {

    function NgxClickToEditComponent() {
        this.field = 'field';
        this.unit = '';
        this.full = false;
        this.hideTrigger = false;
        this.type = 'string';
        this.show = false;
        this.value = '';
        this.valueChange  = new EventEmitter();
        this.onSave = new EventEmitter();
        this.iseditable = true;

    }

    Object.defineProperty(NgxClickToEditComponent.prototype, "theValue", {
        set: function (value) {
            this.value = value;
            this.original = this.value;
        },
        enumerable: true,
        configurable: true
    });

    NgxClickToEditComponent.prototype.ngAfterViewInit = function () {
        if (typeof this.value === 'string') {
            this.type = 'string';
        }
        if (typeof this.value === 'number') {
            this.type = 'number';
        }
    };
    NgxClickToEditComponent.prototype.makeEditable = function (field) {
        if (this.iseditable === true) {
            if (this.hideTrigger === true) {
                this.show = true;
            }
            if (this.full === false && field === 'trigger') {
                this.show = true;
            }
            else if (this.full === true) {
                this.show = true;
            }
        }
    };
    NgxClickToEditComponent.prototype.cancelEditable = function () {
        this.show = false;
        this.value = this.original;
    };
    NgxClickToEditComponent.prototype.onKey = function (event) {
        if (event.key === 'Enter') {
            this.callSave();
        }
        if (event.key === 'Escape') {
            this.cancelEditable();
        }
    };
    NgxClickToEditComponent.prototype.callSave = function () {
        this.onSave.emit({field: this.field, value: this.value});
        this.show = false;
    };
    NgxClickToEditComponent.decorators = [
        {
            type: Component, args: [{
                selector: 'input-edit',
                templateUrl: "./ngx-click-to-edit.component.html",
                styleUrls: ["./ngx-click-to-edit.component.css"]
            },]
        },
    ];
    /** @nocollapse */
    NgxClickToEditComponent.ctorParameters = function () {
        return [];
    };
    NgxClickToEditComponent.propDecorators = {
        'min': [{type: Input, args: ['min',]},],
        'max': [{type: Input, args: ['max',]},],
        'field': [{type: Input, args: ['field',]},],
        'unit': [{type: Input, args: ['unit',]},],
        'full': [{type: Input, args: ['full',]},],
        'hideTrigger': [{type: Input, args: ['hideTrigger',]},],
        'type': [{type: Input, args: ['type',]},],
        'theValue': [{type: Input, args: ['value',]},],
        'onSave': [{type: Output},],
        'iseditable': [{type: Input, args: ['iseditable',]},],
        'valueChange': [{type: Output},],

    };
    return NgxClickToEditComponent;
}());
export {NgxClickToEditComponent};
//# sourceMappingURL=ngx-click-to-edit.component.js.map