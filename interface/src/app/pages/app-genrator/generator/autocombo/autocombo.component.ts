import {Component, EventEmitter, OnInit, Output, Input} from '@angular/core';
import {Select2OptionData} from 'ng-select2';
import {ManagerService} from "../../../../@core/data/manager.service";

@Component({
    selector: 'ngx-autocombo',
    templateUrl: './autocombo.component.html',
    styleUrls: ['./autocombo.component.scss']
})


export class AutocomboComponent implements OnInit {

    @Input() value: any;
    @Input() valueObject: any;
    @Input() readonly: any;
    @Output() valueChange = new EventEmitter();
    @Output() valueObjectChange = new EventEmitter();
    @Input() entity: any;
    fieldName: string = '';
    dd: any = "";
    public data: Array<Select2OptionData> = [];

    constructor(private manager: ManagerService) {

    }

    ngOnInit() {
        var param = {};
        param.entity = this.entity;
        this.manager.comoboGetData(param).subscribe(combo => this.initCombo(combo));
    }

    initCombo(combo) {
        this.data = combo.data;
    }

    setValue($event) {
        this.value = $event.value;
        this.valueChange.emit($event.value);
        this.valueObjectChange.emit($event);

    }

}
