import {Component, OnInit, ViewChild} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
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
} from "../../../@core/data/user.model";
import {Entitie, Field} from "../../../@core/data/data.model";
import {ManagerService} from "../../../@core/data/manager.service";

@Component({
    selector: 'ngx-generator',
    templateUrl: './generator.component.html',
    styleUrls: ['./generator.component.scss']
})
export class GeneratorComponent implements OnInit {

    @ViewChild('list') listCompenent: any;
    @ViewChild('form') formComponent: any;
    process: any;
    mainEntity: any;
    mainCreateAction:Action = new Action();
    mainList: any;
    varti:any;

    constructor(private router: Router, private _activatedRoute: ActivatedRoute, private manager: ManagerService) {
    }

    ngOnInit() {
        this._activatedRoute.queryParams.subscribe(
            params => console.log('queryParams', this.getProcess(params['processId'])));

    }

    getProcess(process) {
        this.manager.getSingleProcess(process).subscribe(process => this.init(process));
    }

    init(process) {
        this.process = process;
        console.log(this.process)
        this.setMainEntity();
        $(".formWarp").switchClass( "showElement", "hideElement", 50);
        $(".listWarp").addClass(   "col-md-12" );   $(".listWarp").removeClass( "col-md-0");
        $(".formWarp").addClass(   "col-md-0" );   $(".formWarp").removeClass( "col-md-12");
        $(".listWarp").switchClass( "hideElement", "showElement", 1000);

    }

    setMainEntity() {

        for (let act of this.process[0].actions) {

            if (typeof act.actionIsmainLevel != 'undefined') {
                for (let ent of this.process[0].gestEntity) {
                    if (ent.entityId == act.actionEntity.entityId && act.actionType == 1) {
                        this.mainEntity = ent;
                        this.mainCreateAction = act;
                        console.log("main act", act)
                        for (let lst of this.process[0].list) {
                            if (lst.listEntityName == ent.entityId) {
                                this.mainList = lst;
                            }
                        }
                    }
                }
            }
        }

        this.listCompenent.initList(this.mainList, this.mainEntity, this.process[0].steps,this.mainCreateAction,this.process);
        this.formComponent.initAction(this.mainCreateAction, this.process.steps);

    }


    createAction(){
        this.formComponent.initAction(this.mainCreateAction, this.process.steps);
        $(".listWarp").switchClass( "showElement", "hideElement", 50);
        $(".listWarp").addClass(   "col-md-0" );   $(".listWarp").removeClass( "col-md-12");
        $(".formWarp").addClass(   "col-md-12" );   $(".formWarp").removeClass( "col-md-0");
        $(".formWarp").switchClass( "hideElement", "showElement", 1000);

    }

    refrechView() {

        $(".formWarp").switchClass( "showElement", "hideElement", 50);
        $(".listWarp").addClass(   "col-md-12" );   $(".listWarp").removeClass( "col-md-0");
        $(".formWarp").addClass(   "col-md-0" );   $(".formWarp").removeClass( "col-md-12");
        $(".listWarp").switchClass( "hideElement", "showElement", 1000);


        this.listCompenent.refrechListData();

    }

    doAction(actionData) {
        $(".listWarp").switchClass( "showElement", "hideElement", 50);
        $(".listWarp").addClass(   "col-md-0" );   $(".listWarp").removeClass( "col-md-12");
        $(".formWarp").addClass(   "col-md-12" );   $(".formWarp").removeClass( "col-md-0");
        $(".formWarp").switchClass( "hideElement", "showElement", 1000);
        var acts: any;
        for (let act of this.process[0].actions) {
            if (act.actionId == actionData[0].actionId) {
                acts = act;
            }
        } 

        if (acts.actionType == 3) {
            this.formComponent.initAction(acts, this.process.steps, actionData[1]);
        }else if(acts.actionType == 4) {
            var param = {};
            param.data = actionData[1];
            param.action  = act;
            this.manager.deleteEntityData(param).subscribe(result => this.refrechView());
        }

    }

}
