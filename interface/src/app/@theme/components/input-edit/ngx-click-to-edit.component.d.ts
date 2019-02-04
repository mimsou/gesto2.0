import { AfterViewInit } from '@angular/core';
export declare class NgxClickToEditComponent implements AfterViewInit {
    min: number;
    max: number;
    field: string;
    unit: string;
    full: boolean;
    hideTrigger: boolean;
    type: string;
    show: boolean;
    value: any;
    iseditable: boolean;
    theValue: string;
    private original;
    private onSave;
    ngAfterViewInit(): void;
    makeEditable(field: string): void;
    cancelEditable(): void;
    onKey(event: KeyboardEvent): void;
    callSave(): void;
}
