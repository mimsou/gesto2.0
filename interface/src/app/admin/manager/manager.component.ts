import {Component, HostListener, OnInit, AfterViewInit, ViewChild} from '@angular/core';
import {NbAuthService, NbAuthJWTToken} from '@nebular/auth';
import {ManagerService} from "../../@core/data/manager.service";
import {UserService} from "../../@core/data/user.service";
import {OneInputFormComponent} from "../../@theme/components/one-input-form/one-input-form.component";
import {GestAccessPath, GestMenu, GestRole, User, Action, Process, Step, List, Dim} from "../../@core/data/user.model";
import {DndDropEvent} from "ngx-drag-drop";
import {PagesRoutingModule} from '../../pages/pages-routing.module'
import {Validators, FormBuilder, FormGroup, FormControl} from '@angular/forms';
import {Entitie, Field} from "../../@core/data/data.model";
import {jsPlumb} from 'jsplumb';
import * as $ from 'jquery';
import {Observable, Subject} from "rxjs/Rx";


@Component({
    selector: 'ngx-manager',
    templateUrl: './manager.component.html',
    styleUrls: ['./manager.component.scss']
})
export class ManagerComponent implements OnInit, AfterViewInit {

    @ViewChild('addmenu') cardrev: OneInputFormComponent;
    @ViewChild('flipuser') flipusers: any;
    @ViewChild('fliplist') fliplist: any;
    @ViewChild('flipdim') flipdim: any;
    @ViewChild('flipaction') flipaction: any;
    @ViewChild('revealpage') revealpages: any;
    @ViewChild('entits') public entits: any;
    @ViewChild('updateexpression') updateExpressions: any;
    @ViewChild('updateexpressions') updateExpressionss: any;


    jsPlumbInstance;

    menus: Array<GestMenu> = [];
    link: Array<GestMenu> = [];
    roles: Array<GestRole> = [];
    users: Array<User> = [];
    aps: Array<GestAccessPath> = [];
    userform: User = new User();
    userformcontrole: any;
    actionformcontrole: any;
    listformcontrole: any;
    settingFormControl: any;
    dimformcontrole: any;
    entities: Array<Entitie> = [];
    relations: any;
    SecandPasword: string = "";
    selectedrole: string = "";
    selectedrolelib: string = ""
    editable = true;
    isposset = false;
    selectedArborecence = [];
    selectedEntity: any;
    process: any = new Process();
    selectedSteps: Step = [];
    selectedActions: Action = [];
    selectedEntityDimention: Entitie = [];
    EntityDimention: Array<Entitie> = [];
    FieldDimention: Array<Field> = [];
    selectedFieldDimention: Entitie = [];
    selectedList = List;
    selectedProcess: Process = [];
    selectedField: Field = [];
    hideActionType: boolean = false;
    paramPanel = "";
    subStepSelection: Array<Step> = [];
    expressionOutput: string;
    expression: any;
    allFieldOption: any;
    expValu: any;
    dataRole: any;
    valueRole: any;


    menuplaceholder: string = "Ajouter un menu";
    utilisateurplaceholder: string = "Chercher un utilisateur";
    roleplaceholder: string = "Ajouter un role";
    pprocessplaceholder: string = "Ajouter un process";
    userActions: Array<Action> = [];
    actionform: Action = new Action();
    listform: List = new List();
    dimform: Dim = new Dim();
    allAction: Array<Action> = [];
    allList: Array<List> = [];
    EntityAction: Array<Entitie> = [];
    EntityList: Array<Entitie> = [];


    tokerolen: any;

    constructor(private authService: NbAuthService, private menuService: ManagerService, private userService: UserService, private fb: FormBuilder) {

    }

    @HostListener('document:click', ['$event']) clickedOutside($event) {
        this.loadMenu(true);
        this.loadLink(true);
        this.loadRole(true);
        this.loadUser("");
        this.loadController("");
        this.loadProcess();
        //this.selectedrole = "";
        this.selectedProcess = [];
        this.selectedSteps = []
        this.flipaction.flipped = false;
        this.fliplist.flipped = false;
        this.flipdim.flipped = false;
        this.selectedActions = [];
        this.selectedArborecence = Array();
        this.selectedList = [];
        this.allAction = [];
        this.allList = [];
        this.EntityAction = [];
        this.EntityList = [];
        this.EntityDimention = [];
        this.selectedEntityDimention = [];
        this.FieldDimention = [];
        this.selectedFieldDimention = [];
        this.selectedField = [];
        this.selectedrolelib = "";
        this.editable = true;
        this.paramPanel = "";
        this.connectEntity();


    }

    ngAfterViewInit() {
        this.jsPlumbInstance = jsPlumb.getInstance(this.userService);
        this.loadSchema();
    }

    ngOnInit() {

        this.selectedProcess = new Process();
        this.selectedSteps = new Step();


        var pages = new PagesRoutingModule();
        this.menuService.RootUpdate(pages.getRoutes()).subscribe(menu => console.log("ok root"));
        this.loadController("");

        /*Update route in backend*/
        this.authService.onTokenChange()
            .subscribe((token: NbAuthJWTToken) => {
                if (token.isValid()) {
                    this.tokerolen = JSON.stringify(token.getPayload());
                }
            });

        this.loadMenu(true);
        this.loadLink(true);
        this.loadRole(true);
        this.loadUser("");
        this.flipusers.showToggleButton = false;
        this.fliplist.showToggleButton = false;
        this.flipdim.showToggleButton = false;
        this.flipaction.showToggleButton = false;
        //this.revealpages.showToggleButton = false;


        this.actionformcontrole = this.fb.group({
            actionName: ['', Validators.required],
            actionType: [''],
            actionIsmainLevel: [''],
            actionLevelDepth: [''],
            actionExistingSubEntity: [''],
            actionAddSubEntity: [''],
            actionEntityName: [''],
            actionSubProcess: [''],
            actionNextStep: [''],
            actionFromStep: ['']
        });

        this.listformcontrole = this.fb.group({
            listName: ['', Validators.required],
        });

        this.dimformcontrole = this.fb.group({});

        this.settingFormControl = this.fb.group({});

        this.userformcontrole = this.fb.group({
            username: ['', Validators.required],
            userpasword: ['', Validators.compose([Validators.required])],
            useremail: ['', Validators.required],
            secandpass: ['', Validators.compose([Validators.required, this.isSame])],
        });


    }

    onRoleOptionClick($event) {
        $event.stopPropagation();
    }

    refrechRelationalEntity($event) {
        $event.stopPropagation();
        this.menuService.refrechRelationalEntity().subscribe(field => this.loadSchema());
    }

    stopClick($event) {
        $event.stopPropagation();
    }

    isSame(input: FormControl) {

        if (!input.root.controls || !input.root) {
            return null;
        }

        const issame = (input.root.controls.userpasword.value == input.root.controls.secandpass.value);
        return issame ? null : {needsExclamation: true};
    }

    onSubmitUserDetails() {
        this.userService.addUser(this.userform).subscribe(user => this.loadUser(""));
    }

    onSubmitField() {
        this.menuService.updateField(this.selectedField).subscribe(field => this.loadSchema());
    }

    onSubmitEntity() {
        this.menuService.updateEntity(this.selectedEntity).subscribe(entity => this.loadSchema());
    }


    onSubmitActionDetails() {
        var param = {};
        this.actionform.actionEntity = this.selectedProcess.gestEntity[0].entityId;
        param.process = this.selectedProcess;
        param.action = this.actionform;
        this.menuService.addAction(param).subscribe(action => this.loadProcess());

    }

    onSubmitListDetails() {
        var param = {};
        param.process = this.selectedProcess;
        param.list = this.listform;
        if (this.listform.listEntityName !== "") {
            this.menuService.addList(param).subscribe(list => this.loadProcess());
        }
    }

    onSubmitDimDetails() {
        var param = {};
        param.process = this.selectedProcess;
        param.dim = this.dimform;
        if (this.dimform.entityId !== "" || this.dimform.fieldId !== "") {
            this.menuService.addDim(param).subscribe(list => this.loadProcess());
        }
    }


    onSearchUser(val) {
        this.loadUser(val);
    }

    ToggleSelectedRole(role, $event) {
        $event.preventDefault();
        $event.stopPropagation();
        this.selectedrole = role.roleId;
        this.valueRole = role.roleId;
        this.editable = false;
        this.selectedrolelib = role.roleLibelle;
        this.userService.linkedUser(role.roleId).subscribe(user => this.users = this.userfromObject(user));
    }

    selectedroleInRoles(role) {
        for (let rl of role) {
            if (rl.roleId == this.selectedrole) {
                return true;
            }
        }
        return false;
    }

    linkRoleUser($event) {
        $event.stopPropagation();
    }

    onAddMenu(val) {

        var menu: GestMenu = new GestMenu();
        menu.menuTag = 'parent';
        menu.menuLibelle = val;
        this.menuService.MenuCreate(menu).subscribe(menu => this.loadMenu(true));

    }

    ToggleSelectUser(user, $event) {
        $event.stopPropagation();
        if (this.selectedrole != "") {
            if (!this.roleInUserRole(user.role)) {
                this.menuService.RoleAddUser(user.id, this.selectedrole).subscribe(menu => this.userService.linkedUser(this.selectedrole).subscribe(user => this.users = this.userfromObject(user)));
            } else {
                this.menuService.RoleRemoveUser(user.id, this.selectedrole).subscribe(menu => this.userService.linkedUser(this.selectedrole).subscribe(user => this.users = this.userfromObject(user)));
            }
        }
    }

    ToggleSelectLink(link, $event) {
        $event.stopPropagation();
        if (this.selectedrole != "") {
            if (!this.roleInLinkRole(link.role)) {
                this.menuService.RoleAddLink(link.menuId, this.selectedrole).subscribe(menu => this.loadMenuLink(true));
            } else {
                this.menuService.RoleRemoveLink(link.menuId, this.selectedrole).subscribe(menu => this.loadMenuLink(true));
            }
        }

    }


    ToggleSelectStep(step, $event) {
        $event.stopPropagation();
        if (this.selectedrole != "") {
            if (!this.selectedroleInRoles(step.role)) {
                this.menuService.RoleAddStep(step.stepId, this.selectedrole).subscribe(step => this.loadProcess());
            } else {
                this.menuService.RoleRemoveStep(step.stepId, this.selectedrole).subscribe(step => this.loadProcess());
            }
        }

    }

    ToggleSelectAction(action, $event) {
        $event.stopPropagation();
        if (this.selectedrole != "") {
            if (!this.selectedroleInRoles(action.role)) {
                this.menuService.RoleAddAction(action.actionId, this.selectedrole).subscribe(step => this.loadProcess());
            } else {
                this.menuService.RoleRemoveAction(action.actionId, this.selectedrole).subscribe(step => this.loadProcess());
            }
        }

    }

    ToggleSelectList(list, $event) {
        $event.stopPropagation();
        if (this.selectedrole != "") {
            if (!this.selectedroleInRoles(list.role)) {
                this.menuService.RoleAddList(list.listId, this.selectedrole).subscribe(step => this.loadProcess());
            } else {
                this.menuService.RoleRemoveList(list.listId, this.selectedrole).subscribe(step => this.loadProcess());
            }
        }

    }


    ToggleSelectAp(ap, $event) {
        $event.stopPropagation();
        if (this.selectedrole != "") {
            if (!this.roleInLinkRole(ap.role)) {
                this.menuService.RoleAddAp(ap.apId, this.selectedrole).subscribe(ap => this.loadController());
            } else {
                this.menuService.RoleRemoveAp(ap.apId, this.selectedrole).subscribe(ap => this.loadController());
            }
        }

    }

    onAddRole(val) {
        var role: GestRole = new GestRole();
        role.roleLibelle = val;
        this.menuService.RoleCreate(role).subscribe(role => this.loadRole(true));
    }

    deleteRole(role) {
        this.menuService.RoleDelete(role).subscribe(role => this.loadRole(true));
    }

    saveRole(role) {
        this.menuService.RoleUpdate(role).subscribe(role => this.loadRole(true));
    }

    onAddUser($event) {
        this.flipusers.flipped = true;
    }

    deleteUser(user) {
        this.userService.deleteUser(user.id).subscribe(user => this.loadUser(""));
    }

    deleteMenu(menus) {

        var menu: GestMenu = new GestMenu();
        this.menuService.MenuDelete(menus).subscribe(menu => this.loadMenuLink(true));


    }

    saveMenu(menu) {
        this.menuService.MenuUpdate(menu).subscribe(menu => this.loadMenu(true));
    }

    menufromObject(menu) {

        var menuss = [];
        for (let men of menu) {
            var menus: GestMenu = new GestMenu()
            menus.menuId = men.menuId;
            menus.menuParent = men.menuParent;
            menus.menuInterface = men.menuInterface;
            menus.menuTag = men.menuTag;
            menus.menuLibelle = men.menuLibelle;
            if (men.link) {
                menus.link = this.menufromObject(men.link);
            }

            if (men.role) {
                menus.role = this.rolefromObject(men.role);
            }

            menuss.push(menus)
        }

        return menuss;
    }

    roleInUserRole(roles) {

        for (let role of roles) {

            if (role.roleId === this.selectedrole) {
                return true;
            }

        }

        return false;
    }


    roleInLinkRole(roles) {

        for (let role of roles) {

            if (role.roleId === this.selectedrole) {
                return true;
            }

        }
        return false;
    }


    rolefromObject(role) {

        var roless = [];
        for (let rol of role) {
            var roles: GestRole = new GestRole()
            roles.roleId = rol.roleId;
            roles.roleLibelle = rol.roleLibelle;
            roless.push(roles)
        }

        return roless;
    }

    userfromObject(users) {

        var userss = [];
        for (let user of users) {
            var userd: User = new User()
            userd.id = user.id;
            userd.UserName = user.username;
            userd.UserEmail = user.email;
            userd.USerRoles = user.roles;
            if (user.role) {
                userd.role = this.rolefromObject(user.role);
            }
            userss.push(userd)
        }

        return userss;
    }


    apfromObject(apss) {

        var apsss = [];
        for (let ap of apss) {
            var rpd: GestAccessPath = new GestAccessPath()
            rpd.apId = ap.apId;
            rpd.apController = ap.apController;
            rpd.apLibelle = ap.apLibelle;
            if (ap.role) {
                rpd.role = this.rolefromObject(ap.role);
            }
            apsss.push(rpd)
        }
        return apsss;
    }


    onDragged(item: any, list: any[]) {
        const index = list.indexOf(item);
        list.splice(index, 1);
    }


    onDropLinkList(event: DndDropEvent, list: any[]) {

        this.menuService.MenuUnlink(event.data.menuId).subscribe(menu => this.loadMenuLink());


        let index = event.index;

        if (typeof index === "undefined") {
            index = list.length;
        }

        list.splice(index, 0, event.data);


    }

    onDropMenuList(event, list, menu) {

        this.menuService.MenuLink(menu.menuId, event.data.menuId).subscribe(menu => this.loadMenuLink());

        let index = event.index;

        if (typeof index === "undefined") {
            index = list.length;
        }

        list.splice(index, 0, event.data);


    }

    loadRole(load) {
        if (load) {
            this.menuService.RoleAll().subscribe(role => this.setRoleOption(role));
        } else {
            this.menuService.RoleAll().subscribe(role => console.log("no load"));
        }
    }

    setRoleOption(role) {
        this.roles = this.rolefromObject(role)
        var arr = new Array();
        var obj = new Object();
        obj.id = "";
        obj.text = "";
        arr.push(obj);
        for (let rl of role) {
            console.log("dtrole", rl);
            var obj = new Object();
            obj.id = rl.roleId;
            obj.text = rl.roleLibelle;
            arr.push(obj);
        }
        console.log("role", arr)

        this.dataRole = arr;
    }

    setRoleValue($event) {
        for (let rl of  this.roles) {
            if (rl.roleId == $event.value) {
                this.selectedrole = rl.roleId;
            }
        }
    }

    loadMenu(load) {
        if (load) {
            this.menuService.MenuAll().subscribe(menu => this.menus = this.menufromObject(menu))
        } else {
            this.menuService.MenuAll().subscribe(menu => console.log("no load"))
        }
    }

    loadLink(load) {
        if (load) {
            this.menuService.LinkAll().subscribe(link => this.link = this.menufromObject(link));
        } else {
            this.menuService.LinkAll().subscribe(menu => console.log("no load"))
        }
    }

    loadMenuLink(load) {
        this.loadMenu(load);
        this.loadLink(load);
    };

    loadUser(val) {
        if (val !== "") {
            this.userService.searchUser(val).subscribe(user => this.users = this.userfromObject(user));
            this.flipusers.flipped = false;
        } else {
            this.userService.allUser().subscribe(user => this.users = this.userfromObject(user));
            this.flipusers.flipped = false;
        }
    }

    loadController() {
        this.menuService.allController().subscribe(ap => this.aps = this.apfromObject(ap));
    }

    loadSchema() {
        this.menuService.getSchema().subscribe(schema => this.buildShema(schema));
    }

    buildShema(schema) {

        this.entities = schema["table"];

        this.relations = schema["relation"];

        var arrvar = new Array();
        for (let ent of this.entities) {
            for (let fld of ent.fields) {
                var objvar = new Object();
                objvar.variableId = fld.fieldId;
                objvar.name = ent.entityEntity+"_"+fld.fieldEntityName;
                arrvar.push(objvar);
            }
        }

        this.allFieldOption = arrvar;

        this.connectEntity();

    }


    onSelectEntity(entity, $event) {


        if ($event) {
            $event.stopPropagation();
        }

        if (this.paramPanel != "action") {
            this.paramPanel = 'entity';
        }

        if (this.selectedProcess.length == 0 || !$event) {
            this.selectedEntity = null;
            this.selectedArborecence = Array();
            if (this.selectedArborecence.length == 0) {
                this.selectedEntity = entity;
                this.setArborcence(entity);
            }
        } else {


            if (this.flipaction.flipped == true || this.paramPanel == "action") {
                this.actionform.actionSubEntity = entity.entityId;
            }

            if (this.fliplist.flipped == true) {
                this.listform.listEntityName = entity.entityId;
            }
        }

        if (this.flipdim.flipped == true && this.dimform.type == 1) {
            this.dimform.entityId = entity.entityId;
        }

    }

    setArborcence(entity) {
        this.selectedArborecence.push(entity);
        for (let rel of this.relations) {
            if (rel.relationsTable.entityId == entity.entityId) {
                this.setArborcence(rel.relationEntitie);
            }
        }
    }


    exist(id, objs, search) {

        for (let obj of objs) {
            if (obj[search] == id) {
                return true;
            }
        }
        return false;
    }


    highlightloopaction(id, entFromProcess) {

        for (let rel of this.relations) {
            if (rel.relationsTable.entityId == id) {

                var exist = false
                for (let entpr of entFromProcess) {
                    if (entpr.entityId == rel.relationsTable.entityId) {
                        exist = true;
                    }
                }

                if (exist) {
                    this.EntityAction.push(rel.relationEntitie);
                }

            }
        }


    }


    highlightlooplist(id, entFromProcess) {

        for (let rel of this.relations) {
            if (rel.relationsTable.entityId == id) {

                var exist = false
                for (let entpr of entFromProcess) {
                    if (entpr.entityId == rel.relationsTable.entityId) {
                        exist = true;
                    }
                }

                if (exist) {
                    this.EntityList.push(rel.relationEntitie);
                }

                this.highlightlooplist(rel.relationEntitie.entityId, entFromProcess);

            }
        }


    }


    connectEntity() {


        for (let ent of this.entities) {
            this.jsPlumbInstance.draggable("ent_" + ent.entityId, {
                stop: function (event) {
                    var poselm = {};
                    poselm.id = $(event.el).attr("id").substring(4);
                    poselm.pos = event.pos;
                    ent.entityPos = parseInt(poselm.pos["1"] - 5) + "," + parseInt(poselm.pos[0] - 5);
                    this.menuService.entityPos(poselm.pos, poselm.id).subscribe(schema => console.log("pos ok"));
                }.bind(this)
            })

        }

        this.jsPlumbInstance.deleteEveryConnection();


        for (let rel of this.relations) {
            var source = 'field_' + rel.relationEntitie.entityId + "_" + rel.relationKey;
            var target = 'field_' + rel.relationsTable.entityId + "_" + rel.relationsTable.entityKey;
            this.jsPlumbInstance.connect({
                connector: ['Bezier', {stub: [212, 67], cornerRadius: 1, alwaysRespectStubs: true}],
                source: source,
                target: target,
                anchor: ['Right', 'Left'],
                paintStyle: {stroke: '#456', strokeWidth: 0.7},
                overlays: [
                    ['Label', {label: "x", location: 0, cssClass: 'connectingConnectorLabel'}]
                ],
            });

        }


        this.jsPlumbInstance.setContainer("plumbcontainer");

    }

    onAddProcess(val) {
        if (this.selectedArborecence.length != 0) {
            var process = {};
            process.processEntity = this.selectedEntity;
            process.processName = val;
            this.menuService.AddProcess(process).subscribe(process => this.loadProcess());
        }
    }

    onAddStep(val) {
        var step = {};
        step.process = this.selectedProcess;
        step.name = val;
        this.menuService.AddSteps(step).subscribe(process => this.loadProcess());
    }

    loadProcess() {
        this.menuService.getProcess().subscribe(process => this.refrechSelectedProcess(process));

    }

    deleteProcess(id, $event) {
        $event.stopPropagation();
        this.menuService.ProcessDelete(id).subscribe(process => this.deleteProcessCallback()());
    }

    deleteProcessCallback() {
        this.selectedProcess = [];
        this.allList = [];
        this.allAction = [];
        this.loadProcess()
    }

    selectProcess(process, $event) {
        $event.stopPropagation();
        this.selectedActions = [];
        this.selectedList = [];
        this.selectedSteps = [];
        this.EntityAction = [];
        this.EntityList = [];
        this.actionform = new Action();
        this.hideActionType = false;
        this.onSelectEntity(process.gestEntity[0]);
        this.selectedProcess = process;
        this.allAction = process.actions;
        this.allList = process.list;
        this.EntityDimention = process.gestEntityDimention;
        this.FieldDimention = process.gestFieldDimention;
        this.paramPanel = 'process';
    }

    selectStep(step, $event) {
        $event.stopPropagation();
        this.paramPanel = 'step';
        this.selectedActions = [];
        this.selectedList = [];
        this.EntityAction = [];
        this.EntityList = [];
        this.selectedSteps = step;
    }

    deleteStep(id, $event) {
        $event.stopPropagation();
        this.menuService.StepDelete(id).subscribe(step => this.loadProcess());
    }


    onAddAction($event) {
        $event.stopPropagation();
        if (typeof this.selectedProcess.processId != 'undefined') {
            this.EntityAction = [];
            this.selectedActions = [];
            this.actionform = new Action();
            this.paramPanel = "action"
            //this.flipaction.flipped = true;
        }
    }

    onAddList($event) {
        $event.stopPropagation();
        if (typeof this.selectedProcess.processId != 'undefined') {
            this.fliplist.flipped = true;
        }
    }

    onAddDim($event) {
        $event.stopPropagation();
        if (typeof this.selectedProcess.processId != 'undefined') {
            this.flipdim.flipped = true;
        }
    }


    actionInStep(action) {

        if (typeof this.selectedSteps.action !== "undefined") {

            for (let actions of this.selectedSteps.action) {
                if (actions.actionId == action) {
                    return true;
                }
            }
            return false;
        } else {
            return false;
        }
    }

    listInStep(list) {

        if (typeof this.selectedSteps.list !== "undefined") {

            for (let lst of this.selectedSteps.list) {
                if (lst.listId == list) {
                    return true;
                }
            }
            return false;
        } else {
            return false;
        }
    }


    selectList(list, $event) {

        $event.stopPropagation();
        this.paramPanel = 'list';
        if (this.selectedSteps.length == 0) {

            this.EntityList = [];

            this.selectedList = list;

            for (let ent of this.selectedProcess.gestEntity) {
                if (list.listEntityName == ent.entityId) {
                    this.EntityList.push(ent);
                }
            }


        } else {

            var listExist = false
            for (let lst of this.selectedSteps.list) {
                if (lst.actionId == list.actionId) {
                    listExist = true;
                }
            }

            if (!listExist) {
                var param = {};
                param.list = list;
                param.step = this.selectedSteps;
                this.menuService.AddListToStep(param).subscribe(list => this.loadProcess());
            } else {
                var param = {};
                param.list = list;
                param.step = this.selectedSteps;
                this.menuService.removeListFromStep(param).subscribe(list => this.loadProcess());
            }

        }


    }

    deleteView(id, $event) {
        $event.stopPropagation();
        this.menuService.listDelete(id).subscribe(View => this.loadProcess());
    }

    deleteAction(id, $event) {
        $event.stopPropagation();
        this.menuService.ActionDelete(id).subscribe(Action => this.loadProcess());
    }

    deleteFldDim(id, type, $event,) {
        $event.stopPropagation();
        var param = {}
        param.process = this.selectedProcess.processId;
        param.type = type;
        param.id = id;
        this.menuService.DimentionDelete(param).subscribe(dim => this.loadProcess());
    }

    selectAction(action, $event) {

        $event.stopPropagation();
        this.paramPanel = 'action';
        if (this.selectedSteps.length == 0) {

            this.EntityAction = [];

            this.selectedActions = action;

            var mainEnityId = this.selectedProcess.gestEntity[0].entityId;

            if (action.actionLevelDepth == 2) {
                if (typeof  action.actionSubEntity !== 'undefined') {
                    for (let rel of this.relations) {
                        if ((rel.relationsTable.entityId == mainEnityId) && (rel.relationEntitie.entityId == action.actionSubEntity.entityId)) {
                            this.EntityAction.push(action.actionSubEntity);
                        }
                    }
                }
            }

            if (action.actionIsmainLevel == 1) {
                this.EntityAction.push(action.actionEntity);
            } else {
                console.log(action);
                this.EntityAction.push(action.actionSubEntity);
            }

            this.onUpdateAction(action);

        } else {

            var actionExist = false

            for (let act of this.selectedSteps.action) {
                if (act.actionId == action.actionId) {
                    actionExist = true;
                }
            }


            if (action.actionType != 1 && !actionExist) {
                var param = {};
                param.action = action;
                param.step = this.selectedSteps;
                this.menuService.AddActionToStep(param).subscribe(action => this.loadProcess());
            } else if (action.actionType != 1 && actionExist) {
                var param = {};
                param.action = action;
                param.step = this.selectedSteps;
                this.menuService.removeActionFromStep(param).subscribe(action => this.loadProcess());
            }

        }


    }

    onUpdateAction(act) {

        this.actionform = new Action();
        this.actionform = JSON.parse(JSON.stringify(act));
        if (typeof act.actionExistingSubEntity !== 'undefined') {
            if (act.actionExistingSubEntity !== 1) {
                this.actionform.actionSubEntity = this.copyObj(act.actionSubEntity.entityId);
            } else {
                this.actionform.actionSubProcess = this.copyObj(act.actionSubProcess.processId);
                ;
            }
        }

        if (typeof act.actionFromStep !== 'undefined') {
            if (typeof act.actionFromStep !== 'undefined') {
                this.actionform.actionFromStep = this.copyObj(act.actionFromStep.stepId);
            }
        }

        if (typeof act.actionNextStep !== 'undefined') {
            if (typeof act.actionNextStep !== 'undefined') {
                this.actionform.actionNextStep = this.copyObj(act.actionNextStep.stepId);
            }
        }


        if (act.actionType == 1) {
            this.hideActionType = true;
        } else {
            this.hideActionType = false;
        }

        //this.flipaction.flipped = true;
    }

    refrechSelectedProcess(process) {

        this.process = process
        this.fliplist.flipped = false;
        this.flipaction.flipped = false;
        this.flipdim.flipped = false;


        if (typeof this.selectedProcess.processId !== "undefined") {

            for (let pr of this.process) {


                if (this.selectedProcess.processId == pr.processId) {
                    this.selectedProcess = pr;
                    this.allAction = pr.actions;
                    this.allList = pr.list;
                    this.EntityDimention = pr.gestEntityDimention;
                    this.FieldDimention = pr.gestFieldDimention;
                }

                for (let stp of pr.steps) {

                    if (this.selectedSteps.stepId == stp.stepId) {
                        this.selectedSteps = stp;
                    }


                    for (let act of pr.actions) {
                        if (this.selectedActions.actionId == act.actionId) {
                            this.selectedActions = act;
                        }
                    }

                    for (let lst of pr.list) {
                        if (this.selectedList.listId == lst.listId) {
                            this.selectedList = lst;
                        }
                    }


                }


            }


        }

    }

    entityInEntityAction(entId) {

        for (let ent of this.EntityAction) {
            if (ent.entityId == entId) {
                return true;
            }
        }
        return false;
    }

    entityInEntityList(entId) {

        for (let ent of this.EntityList) {
            if (ent.entityId == entId) {
                return true;
            }
        }
        return false;
    }


    updateFieldInList(field) {
        var param = {};
        param.field = field;
        param.list = this.selectedList;
        param.mode = "upd";
        this.menuService.updateFieldInList(param).subscribe(field => this.loadProcess());
    }


    updateFieldInAction(field) {
        var param = {};
        param.field = field;
        param.action = this.selectedActions;
        this.menuService.updateFieldInAction(param).subscribe(field => this.loadProcess());
    }

    updateFieldRequireInAction(field) {
        var param = {};
        param.field = field;
        param.action = this.selectedActions;
        this.menuService.updateFieldRequire(param).subscribe(field => this.loadProcess());
    }

    updateFieldInActionExp($event) {
        console.log("ee", $event)
        var param = {};
        param.field = this.selectedField;
        param.action = this.selectedActions;
        param.exp = $event;
        param.mode = "exp";
        this.menuService.updateFieldInAction(param).subscribe(field => this.loadProcess());
    }

    viewFieldInAction(field) {
        var param = {};
        param.field = field;
        param.action = this.selectedActions;
        this.menuService.viewFieldInAction(param).subscribe(field => this.loadProcess());
    }


    fieldIsInList(field) {
        if (typeof this.selectedList.field != 'undefined') {
            for (let fld of this.selectedList.field) {
                if (field.fieldId == fld.fieldId) {
                    return true;
                }
            }
            return false;
        } else {
            return false;
        }

    }

    updateFieldIsInAction(field) {
        if (typeof this.selectedActions.updateField != 'undefined') {
            for (let fld of this.selectedActions.updateField) {
                if (field.fieldId == fld.updateFieldId.fieldId) {
                    return true;
                }
            }

            return false;
        } else {
            return false;
        }

    }

    updateFieldRequireIsInAction(field) {
        if (typeof this.selectedActions.updateField != 'undefined') {
            for (let fld of this.selectedActions.updateField) {
                if (field.fieldId == fld.updateFieldId.fieldId) {
                   if(fld.updateRequire==1){
                       return true;
                   }else{
                       return false;
                   }
                }
            }

            return false;
        } else {
            return false;
        }

    }

    viewFieldIsInAction(field) {
        if (typeof this.selectedActions.viewField != 'undefined') {
            for (let fld of this.selectedActions.viewField) {
                if (field.fieldId == fld.fieldId) {
                    return true;
                }
            }

            return false;
        } else {
            return false;
        }

    }

    setExpression(field, $event) {

        $event.stopPropagation();

        if (typeof this.selectedActions.updateField !== 'undefined') {
            var exps = "";
            for (let fld of this.selectedActions.updateField) {
                if (field.fieldId == fld.updateFieldId.fieldId) {
                   if(typeof fld.updateExpression !== 'undefined'){
                    var exp = JSON.parse(fld.updateExpression);
                    exps = exp.expression;
                   }
                }
            }
            this.expValu = exps;
        } else {
            this.expValu = "";
        }

        this.paramPanel = 'expression'

        this.selectedField = field;

    }


    selectEntityDimention(dim, $event) {
        $event.stopPropagation();
        this.paramPanel = 'entitydim';
        this.selectedEntityDimention = dim;
    }


    selectFieldDimention(dim, $event) {
        $event.stopPropagation();
        this.paramPanel = 'fielddim';
        this.selectedFieldDimention = dim;
    }

    resetDimentionSelection() {
        this.selectedFieldDimention = [];
        this.selectedEntityDimention = [];
    }


    onSelectField(field, $event) {
        $event.stopPropagation();
        this.paramPanel = 'field';
        this.selectedField = field;
        if (this.flipdim.flipped == true) {
            this.dimform.fieldId = field.fieldId;
        }
    }

    onSettingClick($event) {
        $event.stopPropagation();
    }

    SetStepSelection(step) {

        for (let pr of this.process) {
            if (pr.processId == step) {
                this.subStepSelection = pr.steps;
            }
        }

    }

    copyObj(obj) {
        return JSON.parse(JSON.stringify(obj));
    }
}




