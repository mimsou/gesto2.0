/**
 * ngx-click-to-edit - 
 * @version v0.0.7
 * @author gijs.sijpesteijn
 * @link https://github.com/sijpesteijn/ngx-click-to-edit#readme
 * @license MIT
 */
(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory(require("@angular/core"), require("@angular/common"), require("@angular/forms"));
	else if(typeof define === 'function' && define.amd)
		define(["@angular/core", "@angular/common", "@angular/forms"], factory);
	else if(typeof exports === 'object')
		exports["ngxClickToEdit"] = factory(require("@angular/core"), require("@angular/common"), require("@angular/forms"));
	else
		root["ngxClickToEdit"] = factory(root["ng"]["core"], root["ng"]["common"], root["ng"]["forms"]);
})(this, function(__WEBPACK_EXTERNAL_MODULE_1__, __WEBPACK_EXTERNAL_MODULE_4__, __WEBPACK_EXTERNAL_MODULE_5__) {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
Object.defineProperty(exports, "__esModule", { value: true });
var core_1 = __webpack_require__(1);
var NgxClickToEditComponent = (function () {
    function NgxClickToEditComponent() {
        this.field = 'field';
        this.unit = '';
        this.full = false;
        this.hideTrigger = false;
        this.type = 'string';
        this.show = false;
        this.value = '';
        this.onSave = new core_1.EventEmitter();
        this.iseditable: boolean;
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
        if (this.hideTrigger === true) {
            this.show = true;
        }
        if (this.full === false && field === 'trigger') {
            this.show = true;
        }
        else if (this.full === true) {
            this.show = true;
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
        this.onSave.emit({ field: this.field, value: this.value });
        this.show = false;
    };
    __decorate([
        core_1.Input('min'),
        __metadata("design:type", Number)
    ], NgxClickToEditComponent.prototype, "min", void 0);
    __decorate([
        core_1.Input('max'),
        __metadata("design:type", Number)
    ], NgxClickToEditComponent.prototype, "max", void 0);
    __decorate([
        core_1.Input('field'),
        __metadata("design:type", String)
    ], NgxClickToEditComponent.prototype, "field", void 0);
    __decorate([
        core_1.Input('unit'),
        __metadata("design:type", String)
    ], NgxClickToEditComponent.prototype, "unit", void 0);
    __decorate([
        core_1.Input('full'),
        __metadata("design:type", Boolean)
    ], NgxClickToEditComponent.prototype, "full", void 0);
    __decorate([
        core_1.Input('hideTrigger'),
        __metadata("design:type", Boolean)
    ], NgxClickToEditComponent.prototype, "hideTrigger", void 0);
    __decorate([
        core_1.Input('type'),
        __metadata("design:type", String)
    ], NgxClickToEditComponent.prototype, "type", void 0);
    __decorate([
        core_1.Input('value'),
        __metadata("design:type", String),
        __metadata("design:paramtypes", [String])
    ], NgxClickToEditComponent.prototype, "theValue", null);
    __decorate([
        core_1.Output(),
        __metadata("design:type", core_1.EventEmitter)
    ], NgxClickToEditComponent.prototype, "onSave", void 0);
    NgxClickToEditComponent = __decorate([
        core_1.Component({
            selector: 'input-edit',
            templateUrl: "./ngx-click-to-edit.component.html",
            styleUrls: ["./ngx-click-to-edit.component.css"]
        })
    ], NgxClickToEditComponent);
    return NgxClickToEditComponent;
}());
exports.NgxClickToEditComponent = NgxClickToEditComponent;


/***/ }),
/* 1 */
/***/ (function(module, exports) {

module.exports = __WEBPACK_EXTERNAL_MODULE_1__;

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

function __export(m) {
    for (var p in m) if (!exports.hasOwnProperty(p)) exports[p] = m[p];
}
Object.defineProperty(exports, "__esModule", { value: true });
__export(__webpack_require__(0));
__export(__webpack_require__(3));


/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
Object.defineProperty(exports, "__esModule", { value: true });
var core_1 = __webpack_require__(1);
var common_1 = __webpack_require__(4);
var forms_1 = __webpack_require__(5);
var ngx_click_to_edit_component_1 = __webpack_require__(0);
var NgxClickToEditModule = (function () {
    function NgxClickToEditModule() {
    }
    NgxClickToEditModule_1 = NgxClickToEditModule;
    NgxClickToEditModule.forRoot = function () {
        return {
            ngModule: NgxClickToEditModule_1
        };
    };
    NgxClickToEditModule = NgxClickToEditModule_1 = __decorate([
        core_1.NgModule({
            declarations: [
                ngx_click_to_edit_component_1.NgxClickToEditComponent
            ],
            imports: [
                common_1.CommonModule,
                forms_1.FormsModule
            ],
            exports: [
                ngx_click_to_edit_component_1.NgxClickToEditComponent
            ],
            entryComponents: [
                ngx_click_to_edit_component_1.NgxClickToEditComponent
            ]
        })
    ], NgxClickToEditModule);
    return NgxClickToEditModule;
    var NgxClickToEditModule_1;
}());
exports.NgxClickToEditModule = NgxClickToEditModule;


/***/ }),
/* 4 */
/***/ (function(module, exports) {

module.exports = __WEBPACK_EXTERNAL_MODULE_4__;

/***/ }),
/* 5 */
/***/ (function(module, exports) {

module.exports = __WEBPACK_EXTERNAL_MODULE_5__;

/***/ })
/******/ ]);
});
//# sourceMappingURL=ngx-click-to-edit.js.map