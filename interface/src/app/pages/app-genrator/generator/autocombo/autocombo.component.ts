import {Component, EventEmitter, OnInit, Output, Input, ViewChild, KeyValueDiffers, DoCheck} from '@angular/core';
import {Select2OptionData } from 'ng-select2';
import {ManagerService} from "../../../../@core/data/manager.service";
import { Observable } from 'rxjs';
import { delay } from 'rxjs/operators';

@Component({
    selector: 'ngx-autocombo',
    templateUrl: './autocombo.component.html',
    styleUrls: ['./autocombo.component.scss']
})


export class AutocomboComponent implements OnInit   {

    @Input() value: any;
    @Input() valueObject: any;
    @Input() readonly: any;
    @Output() valueChange = new EventEmitter();
    @Output() valueObjectChange = new EventEmitter();
    @Input() entity: any;
    @ViewChild('combos') combos: any;


    options:any;
    fieldName: string = '';
    dd: any = "";
    public data: Array<Select2OptionData> = [];

    constructor(private manager: ManagerService ) {


    }



    ngOnInit() {
        var param = {};
        param.entity = this.entity;
        this.manager.comoboGetData(param).subscribe(combo => this.initCombo(combo));
    }

    initCombo(combo) {

        this.data = combo.data;
        if(combo.data.length < 2){
            var param = {}
            param.value = combo.data[0].id
            this.setValue(param);
            this.combos.value = combo.data[0].id;
        }else{
            var param = {}
            param.value = ""
            this.setValue(param);
            this.combos.value = "";
        }

    }

    setValue($event) {

        this.combos.value =  $event.value;
        this.value = $event.value;
        console.log(this.value);
        this.valueObjectChange.emit($event);
        this.valueChange.emit(this.value);
    }

}
