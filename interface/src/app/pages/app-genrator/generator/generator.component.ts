import {Component, OnInit, ViewChild} from '@angular/core';
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
    mainCreateAction: Action = new Action();
    mainList: any;
    user: any;
    varti: any;

    constructor(private router: Router, private _activatedRoute: ActivatedRoute, private manager: ManagerService, private authService: NbAuthService) {
        this.authService.onTokenChange()
            .subscribe((token: NbAuthJWTToken) => {
                if (token.isValid()) {
                    this.user = token.getPayload();
                }
            });
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
        $(".formWarp").switchClass("showElement", "hideElement", 50);
        $(".listWarp").addClass("col-md-12");
        $(".listWarp").removeClass("col-md-0");
        $(".formWarp").addClass("col-md-0");
        $(".formWarp").removeClass("col-md-12");
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
        console.log(this.user);
        this.listCompenent.initList(this.mainList, this.mainEntity, this.process[0].steps, this.mainCreateAction, this.process, this.user);
        //this.formComponent.initAction(this.mainCreateAction, this.process.steps,null,this.user);

    }

    hasAccess(role) {
        var userRole = this.user.roles;
        for (let rl of role) {
            for (let rls of userRole) {
                console.log("rl",rls,rl.roleLibelle)
                if (rls == rl.roleLibelle.toUpperCase()) {
                    return true;
                }
            }
        }
        return false;
    }

    createAction() {
        this.formComponent.initAction(this.mainCreateAction, this.process.steps);
        $(".listWarp").switchClass("showElement", "hideElement", 50);
        $(".listWarp").addClass("col-md-0");
        $(".listWarp").removeClass("col-md-12");
        $(".formWarp").addClass("col-md-12");
        $(".formWarp").removeClass("col-md-0");
        $(".formWarp").switchClass("hideElement", "showElement", 1000);

    }

    refrechView() {

        $(".formWarp").switchClass("showElement", "hideElement", 50);
        $(".listWarp").addClass("col-md-12");
        $(".listWarp").removeClass("col-md-0");
        $(".formWarp").addClass("col-md-0");
        $(".formWarp").removeClass("col-md-12");
        $(".listWarp").switchClass("hideElement", "showElement", 1000);


        this.listCompenent.refrechListData();

    }

    doAction(actionData) {
        $(".listWarp").switchClass("showElement", "hideElement", 50);
        $(".listWarp").addClass("col-md-0");
        $(".listWarp").removeClass("col-md-12");
        $(".formWarp").addClass("col-md-12");
        $(".formWarp").removeClass("col-md-0");
        $(".formWarp").switchClass("hideElement", "showElement", 1000);
        var acts: any;
        for (let act of this.process[0].actions) {
            if (act.actionId == actionData[0].actionId) {
                acts = act;
            }
        }

        if (acts.actionType == 3) {
            this.formComponent.initAction(acts, this.process.steps, actionData[1]);
        } else if (acts.actionType == 4) {
            var param = {};
            param.data = actionData[1];
            param.action = act;
            this.manager.deleteEntityData(param).subscribe(result => this.refrechView());
        }

    }

}
