import {Component, AfterViewInit, Input, Output, EventEmitter} from '@angular/core';

@Component({
    selector: 'input-edit',
    templateUrl: './edit-input.component.html',
    styleUrls: ['./edit-input.component.scss']
})
export class EditInputComponent implements AfterViewInit {

    @Input() min: number;
    @Input() max: number;
    @Input() field: string;
    @Input() unit: string;
    @Input() full: boolean;
    @Input() hideTrigger: boolean;
    @Input() label: string;
    @Input() type: string;
    show: boolean;
    @Input()value: any;
    @Input() iseditable: boolean;
    @Output() valueChange = new EventEmitter();
    @Input() theValue: string;
    @Output() onSave = new EventEmitter();

    private original = "";

    ngAfterViewInit(): void {
        if (typeof this.value === 'string') {
            this.type = 'string';
        }
        if (typeof this.value === 'number') {
            this.type = 'number';
        }
        console.log("lab",this.label);
    };

    makeEditable(field: string): void {
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

    cancelEditable(): void {
        this.show = false;
        this.value = this.original;
    };

    onKey(event: KeyboardEvent): void {
        if (event.key === 'Enter') {
            this.callSave();
        }
        if (event.key === 'Escape') {
            this.cancelEditable();
        }
    };

    callSave(): void {
        this.onSave.emit({field: this.field, value: this.value});
        this.show = false;
    };

    constructor() {
    }


}
