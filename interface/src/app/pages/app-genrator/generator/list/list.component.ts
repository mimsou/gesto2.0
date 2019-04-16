import {Component, EventEmitter, Input, OnInit, Output, ViewChild} from '@angular/core';
import {ManagerService} from "../../../../@core/data/manager.service";
import {
    GestAccessPath,
    GestMenu,
    GestRole,
    User,
    Action,
    Process,
    Step,
    List,
    Dim
} from "../../../../@core/data/user.model";

@Component({
    selector: 'ngx-list',
    templateUrl: './list.component.html',
    styleUrls: ['./list.component.scss']
})
export class ListComponent implements OnInit { 

    @ViewChild('dimention') DimComponent: any;
    listTtile: string = "Loading...";
    step: any;
    createAction: Action = null;
    entity: any;
    list: any;
    listData: any;
    dimfilter: any;
    field: any = Array();
    process:any;
    user:any;
    @Output() fireAction: EventEmitter<any> = new EventEmitter();
    @Output() fireCretateAction: EventEmitter<any> = new EventEmitter();

    constructor(private manager: ManagerService) {
    }

    ngOnInit() {

    }

    initList(list, entity, step, createAct, process,user) {
         this.user = user;
        this.createAction = createAct;
        this.field = [];
        this.step = step;
        this.entity = entity;
        this.list = list;
        this.listTtile = list.listName;
        this.process = process;
        this.getListfield();
        this.dimfilter=[];
        this.DimComponent.initDimention(process);
        this.refrechListData();

    }

    hasAccess(role) {
        var userRole = this.user.roles;
        for (let rl of role) {
            for (let rls of userRole) {
                if (rls == rl.roleLibelle.toUpperCase()) {
                    return true;
                }
            }
        }
        return false;
    }

    getListfield() {
        for (let fld of this.list.field) {
            if (fld.fieldEntity.entityId == this.entity.entityId) {
                console.log(fld)
                this.field.push(fld);
            }
        }
    }

    getStepAction(entityData) {
        var stepid = entityData[0][this.entity.entityStepperField];
        for (let stp of this.step) {
            if (stp.stepId == stepid) {
                var acts = [];
                for (let act of  stp.action) {
                    if(this.actionInProcess(act.actionId)){
                        if (act.actionType !== 1) {
                            if(this.hasAccess(act.role)){
                                acts.push(act)
                            }
                        }
                    }
                    ;
                }

            }
        }
        return acts;
    }

    actionInProcess(actId){
        var exist = false;
        console.log(this.process )
        for(let act of this.process[0].actions){
            if(act.actionId == actId){exist = true;}
        }
        return exist;
    }


    getStepActionCount(entityData) {
        var count = 0;

        if( typeof entityData[0] !== "undefined" ){
            var stepid = entityData[0][this.entity.entityStepperField];
        }else{
            var stepid = entityData[this.entity.entityStepperField];
        }


        for (let stp of this.step) {
            if (stp.stepId == stepid) {
                for (let act of  stp.action) {
                    if (act.actionType !== 1) {
                        count++;
                    }
                    ;
                }
            }
        }

        return count;

    }

    refrechListData(filter) {

        var param = new Object();
        console.log(this.dimfilter);
        param.id = this.list.listId;
        param.dimfilter =  this.dimfilter;
        this.manager.getDatalist(param).subscribe(list =>this.setData(list) );

    }

    setData(list){
        for(let lst of list){
            var arr = new Array();
            for(let fls of this.field){
                if(fls.fieldNature == 0){
                    if(typeof lst[fls.fieldEntityName] == 'undefined' ||  lst[fls.fieldEntityName] == "" ){
                        lst[fls.fieldEntityName] = "-";
                    }
                }else if(fls.fieldNature == 1){
                    if(typeof  lst[0][fls.fieldEntityName] == 'undefined'){
                        lst[fls.fieldEntityName] = "-";
                    }else{
                        lst[fls.fieldEntityName] =  lst[0][fls.fieldEntityName][fls.fieldTargetEntityId.entityDisplayfield];
                    }
                }
            }
        }

        this.listData = list;

    }

    setDemFilter($event) {
        this.dimfilter = $event;
        console.log("dimset", this.dimfilter)
        this.refrechListData();
    }

    doAction(action, data) {
        this.fireAction.emit([action, data, this.dimfilter]);
    }

    doCreateAction($event) {
        this.fireCretateAction.emit(this.dimfilter);
    }

    isStepperField(fld){
        if( this.entity.entityStepperField == fld.fieldEntityName ){
            return true;
        }else{
            return false;
        }
    }

}
