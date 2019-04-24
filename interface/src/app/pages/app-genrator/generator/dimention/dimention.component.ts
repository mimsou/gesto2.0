import {Component, EventEmitter, OnInit, Output} from '@angular/core';

@Component({
    selector: 'ngx-dimention',
    templateUrl: './dimention.component.html',
    styleUrls: ['./dimention.component.scss']
})

export class DimentionComponent implements OnInit {

    constructor() {
    }

    @Output() filterChange: EventEmitter<any> = new EventEmitter();
    entityDim: any;
    fieldDim: any;
    @Output() dimData:any = new Array();
    entityDimData: any = new Array();
    fieldDimData: any = new Array();
    datePickerConfig: any = {};

    ngOnInit() {
        this.entityDimData = new Array();
        this.fieldDimData = new Array();
    }

    goToSearch($event){

        var arr = new Object();
        arr.ent = this.entityDimData;
        arr.fld = this.fieldDimData;
        this.dimData = arr;
        this.filterChange.emit(arr);

    }

    initDimention(process) {
        this.entityDimData = new Array();
        this.fieldDimData = new Array();
        this.entityDim = process[0].gestEntityDimention;
        this.fieldDim =  process[0].gestFieldDimention;

        for(let entDim of this.entityDim) {
            var dimobs = new Object();
            dimobs.data = "";
            dimobs.param = entDim;
            this.entityDimData.push(dimobs);
        }



        for (let fldDim of this.fieldDim) {
            var dimobs = new Object();
            dimobs.data = "";
            dimobs.param = fldDim;
            this.fieldDimData.push(dimobs);
        }

        this.goToSearch();


    }

}
