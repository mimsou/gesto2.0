import {Component, OnInit, ViewChild,OnDestroy} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {NbAuthJWTToken, NbAuthService} from '@nebular/auth';
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
import {MessageService} from '../../../message.service'
import {takeUntil} from "rxjs/internal/operators";
import {NgxSmartModalService} from 'ngx-smart-modal';
import {Subject} from "rxjs/Rx";

@Component({
    selector: 'ngx-generator',
    templateUrl: './generator.component.html',
    styleUrls: ['./generator.component.scss']
})
export class GeneratorComponent implements OnInit,OnDestroy {

    @ViewChild('list') listCompenent: any;
    @ViewChild('form') formComponent: any;
    @ViewChild('print') printComponent: any;

    process: any;
    ngUnsubscribe = new Subject();
    mainEntity: any;
    mainCreateAction: Action = new Action();
    mainList: any;
    user: any;
    varti: any;
    displaymode:string;

    constructor(private router: Router, private _activatedRoute: ActivatedRoute, private manager: ManagerService, private authService: NbAuthService,private msgService: MessageService, private NgxSmartModalServices: NgxSmartModalService) {
        this.authService.onTokenChange()
            .subscribe((token: NbAuthJWTToken) => {
                if (token.isValid()) {
                    this.user = token.getPayload();
                }
            });
        this.initializeMessgae();
    }

    ngOnDestroy() {
        this.ngUnsubscribe.next();
        this.ngUnsubscribe.complete();
    }

    initializeMessgae() {
        this
            .msgService
            .getMessages()
            .pipe(takeUntil(this.ngUnsubscribe))
            .subscribe((message) => {
                this.getResp(message);
            });
    }

    getResp(resp) {
        this.NgxSmartModalServices.resetModalData('messageModal');
        this.NgxSmartModalServices.setModalData(resp, 'messageModal');
        this.NgxSmartModalServices.open('messageModal');
    }

    ngOnInit() {
        this._activatedRoute.queryParams.subscribe(
            params =>   this.getProcess(params['processId']));

    }

    getProcess(process) {
        this.manager.getSingleProcess(process).subscribe(process => this.init(process));
    }

    init(process) {
        this.process = process;

        this.setMainEntity();
        $(".formWarp").switchClass("showElement", "hideElement", 50);
        $(".printWarp").switchClass("showElement", "hideElement", 50);
        $(".listWarp").addClass("col-md-12");
        $(".listWarp").removeClass("col-md-0");
        $(".formWarp").addClass("col-md-0");
        $(".formWarp").removeClass("col-md-12");
        $(".printWarp").addClass("col-md-0");
        $(".printWarp").removeClass("col-md-12");
        $(".listWarp").switchClass("hideElement", "showElement", 1000);





    }

    setMainEntity() {

        for (let act of this.process[0].actions) {

            if (typeof act.actionIsmainLevel != 'undefined') {

                for (let ent of this.process[0].gestEntity) {

                    if (ent.entityId == act.actionEntity.entityId && act.actionType == 1) {
                        this.mainEntity = ent;

                        if (this.hasAccess(act.role)) {
                            this.mainCreateAction = act;
                        } else {
                            this.mainCreateAction = null;
                        }

                        for (let lst of this.process[0].list) {

                            if (lst.listEntityName == ent.entityId) {
                                this.mainList = lst;
                            }
                        }
                    }
                }
            }
        }

        this.listCompenent.initList(this.mainList, this.mainEntity, this.process[0].steps, this.mainCreateAction, this.process, this.user);


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

    createAction(dim) {

        this.formComponent.initAction(this.mainCreateAction, this.process.steps,null,dim);
        $(".listWarp").switchClass("showElement", "hideElement", 50);
        $(".listWarp").addClass("col-md-0");
        $(".listWarp").removeClass("col-md-12");
        $(".formWarp").addClass("col-md-12");
        $(".formWarp").removeClass("col-md-0");
        $(".formWarp").switchClass("hideElement", "showElement", 1000);
        this.displaymode = "f";

    }





    refrechView() {

        if(  this.displaymode == "f"){

        $(".formWarp").switchClass("showElement", "hideElement", 50);
        $(".listWarp").addClass("col-md-12");
        $(".listWarp").removeClass("col-md-0");
        $(".formWarp").addClass("col-md-0");
        $(".formWarp").removeClass("col-md-12");
        $(".listWarp").switchClass("hideElement", "showElement", 1000);

        }else if(this.displaymode == "p" || this.displaymode == "r"){


            $(".printWarp").switchClass("showElement", "hideElement", 50);
            $(".listWarp").addClass("col-md-12");
            $(".listWarp").removeClass("col-md-0");
            $(".printWarp").addClass("col-md-0");
            $(".printWarp").removeClass("col-md-12");
            $(".listWarp").switchClass("hideElement", "showElement", 1000);



        }



        this.listCompenent.refrechListData();

    }

    doAction(actionData) {

        if( actionData[3] != "r"){

        var acts: any;

        for (let act of this.process[0].actions) {
            if (act.actionId == actionData[0].actionId) {
                acts = act;
            }
        }

        if (acts.actionType == 5) {

            this.displaymode = "p";

            $(".listWarp").switchClass("showElement", "hideElement", 50);
            $(".listWarp").addClass("col-md-0");
            $(".listWarp").removeClass("col-md-12");
            $(".printWarp").addClass("col-md-12");
            $(".printWarp").removeClass("col-md-0");
            $(".printWarp").switchClass("hideElement", "showElement", 1000);

            this.printComponent.initAction(acts, this.process.steps, actionData[1],actionData[2],"p");

        }else{

            this.displaymode = "f";
            $(".listWarp").switchClass("showElement", "hideElement", 50);
            $(".listWarp").addClass("col-md-0");
            $(".listWarp").removeClass("col-md-12");
            $(".formWarp").addClass("col-md-12");
            $(".formWarp").removeClass("col-md-0"); 
            $(".formWarp").switchClass("hideElement", "showElement", 1000);


            if (acts.actionType == 3) {
                this.formComponent.initAction(acts, this.process.steps, actionData[1],actionData[2]);
            } else if (acts.actionType == 4) {
                var param = {};
                param.data = actionData[1];
                param.action = acts;
                this.manager.deleteEntityData(param).subscribe(result => this.refrechView());
            }
        }

        }else   if( actionData[3] != "a"){

            var lsts: any;

            for (let lst of this.process[0].list) {
                if (lst.listId == actionData[0].listId) {
                    lsts = lst;
                }
            }

            this.displaymode = "r";
            $(".listWarp").switchClass("showElement", "hideElement", 50);
            $(".listWarp").addClass("col-md-0");
            $(".listWarp").removeClass("col-md-12");
            $(".printWarp").addClass("col-md-12");
            $(".printWarp").removeClass("col-md-0");
            $(".printWarp").switchClass("hideElement", "showElement", 1000);

            this.printComponent.initAction(lsts, this.process.steps, actionData[1],actionData[2],"r");

        }


    }


}
