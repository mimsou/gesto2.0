import {Directive, HostListener } from '@angular/core';

@Directive({
    selector: '[stop-click]'
})
export class StopClickDirective {

    constructor() {
    }

@HostListener('click', ["$event"]) public  onClick(event: any): void {
        event.stopPropagation();
    }
}
