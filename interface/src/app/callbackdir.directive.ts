import { Directive, OnDestroy, Input, AfterViewInit } from '@angular/core';

@Directive({
  selector: '[ngxCallbackdir]'
})
export class CallbackdirDirective implements AfterViewInit, OnDestroy {
    is_init:boolean = false;
    called:boolean = false;
    @Input('ngxCallbackdir') callback:()=>any;

    constructor() { }

    ngAfterViewInit():void{
        this.is_init = true;
    }

    ngOnDestroy():void {
        this.is_init = false;
        this.called = false;
    }

    @Input('callback-condition')
    set condition(value: any) {
        if (value==false || this.called) return;

        // in case callback-condition is set prior ngAfterViewInit is called
        if (!this.is_init) {
            setTimeout(()=>this.condition = value, 50);
            return;
        }

        if (this.callback) {
            this.callback();
            this.called = true;
        }
        else console.error("callback is null");

    }

}