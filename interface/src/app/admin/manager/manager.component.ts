import {Component, HostListener, OnInit, OnDestroy, AfterViewInit, ViewChild, TemplateRef} from '@angular/core';
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
import * as ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {NgxSmartModalService} from 'ngx-smart-modal';
import {Subject} from "rxjs/Rx";
import {MessageService} from '../../message.service'
import {ModulestateService} from "../../@core/data/modulestate.service";


import {Observable, Subject} from "rxjs/Rx";
import {E} from "@angular/core/src/render3";
import {takeUntil} from "rxjs/internal/operators";


@Component({
    selector: 'ngx-manager',
    templateUrl: './manager.component.html',
    styleUrls: ['./manager.component.scss']
})
export class ManagerComponent implements OnInit, AfterViewInit, OnDestroy {

    @ViewChild('addmenu') cardrev: OneInputFormComponent;
    @ViewChild('flipuser') flipusers: any;
    @ViewChild('fliplist') fliplist: any;
    @ViewChild('flipdim') flipdim: any;
    @ViewChild('flipaction') flipaction: any;
    @ViewChild('revealpage') revealpages: any;
    @ViewChild('entits') public entits: any;
    @ViewChild('updateexpressionag') updateExpressionsag: any;
    @ViewChild('updateexpressions') updateExpressionss: any;
    @ViewChild('edh') edh: any;
    @ViewChild('edm') edm: any;
    @ViewChild('edf') edf: any;
    @ViewChild('viewTab') viewTab: any;
    @ViewChild('dataTab') dataTab: any;
    @ViewChild('entityTab') entityTab: any;
    @ViewChild('renderView') renderView: any;
    @ViewChild('#edfs') edfs: any;
    @ViewChild('#edfsv') edfsv: any;


    jsPlumbInstance;
    ngUnsubscribe = new Subject();
    ngUnsubscribea = new Subject();
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
    dataSelectedEntity: Entitie = new Entitie();
    process: any = [];
    selectedSteps: Step = [];
    selectedActions: Action = [];
    selectedEntityDimention: Entitie = [];
    EntityDimention: Array<Entitie> = [];
    FieldDimention: Array<Field> = [];
    selectedFieldDimention: Entitie = [];
    selectedList = List;
    selectedProcess: Process = [];
    selectedField: Field = [];
    selectedFieldAg: Field = [];
    selectedAcreg: any = [];
    selectedListreg: any = [];
    hideActionType: boolean = false;
    paramPanel = "";
    subStepSelection: Array<Step> = [];
    expressionOutput: string;
    expression: any;
    allFieldOption: any;
    expValu: any;
    expValuAg: any;
    expValuAcreg: any;
    dataRole: any;
    valueRole: any;
    fieldForm: any = new Object();
    agField: any = [];
    acregForm: any = new Object();
    listregForm: any = new Object();
    expValuListreg: any;
    selectFrom: any = [];
    stepform: any = "";
    accessData: any;
    entDepart: any;
    entArrive: any;
    joins: any;
    paramexp: any = 0;
    className: any = "";
    newatribute: any = new Object();
    module: any;
    conConfig: any = {};
    connections: any = [];
    query: any = {};
    selectedCon: any = {}
    displayDataHead: any = {}
    displayDataContent: any = {}
    displayVarContent: any;
    viewReportConfig: any = [];
    selectedViewSection: any = [];
    valhtml = "eeeeeeeee";
    htmlval = '';
    containeSelectorWidth: any = 1;
    editViewInit = {};
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
    enteteEditor: any;
    millieuEditor: any;
    basdepageEditor: any;
    selectedQuery: any = {};
    htmlvalv:any = '';
    TableViewFieldType:any = '';
    selectedViewSectionExpression = "";


    tokerolen: any;

    constructor(private authService: NbAuthService, private menuService: ManagerService, private userService: UserService, private fb: FormBuilder, private msgService: MessageService, private selectedMdule: ModulestateService, private NgxSmartModalServices: NgxSmartModalService) {
        this.initializeMessgae();
        this.initializeSelectedModule();

    }


    @HostListener('document:keydown.escape', ['$event']) onKeydownHandler(event: KeyboardEvent) {

        console.log("codes");

        this.loadMenu(true);
        this.loadLink(true);
        this.loadRole(true);
        this.loadUser("");
        this.loadController("");
        this.loadProcess();
        this.resetParam();
        this.paramPanel = "";
        this.connectEntity();
        this.loadSchema();


    }

    resetParam() {
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
        this.selectedAcreg = [];
        this.selectedFieldAg = [];
        this.selectedrolelib = "";
        this.editable = true;
        this.paramPanel = "";
        this.selectFrom = [];
        this.selectedViewSection = [];
        //this.selectedrole = "";
    }

    ngOnDestroy() {
        this.ngUnsubscribe.next();
        this.ngUnsubscribe.complete();

        this.ngUnsubscribea.next();
        this.ngUnsubscribea.complete();
    }

    ngAfterViewInit() {
        this.jsPlumbInstance = jsPlumb.getInstance(this.userService);

    }


    ngOnInit() {


        this.enteteEditor = ClassicEditor;
        this.millieuEditor = ClassicEditor;
        this.basdepageEditor = ClassicEditor;


        this.selectedProcess = new Process();
        this.selectedSteps = new Step();


        var pages = new PagesRoutingModule();
        this.menuService.RootUpdate(pages.getRoutes()).subscribe(menu => this.doNthing());
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
        this.getAllconnection(false);

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
            actionFromStep: [''],
            actionDissociateSubEntity: [''],
            actionDissociateSubbtnName: [''],
            actionSubentityNextStepOndissociation: ['']
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

        this.loadSchema();

        this.editViewInit = {
            plugins: 'table image imagetools link fullscreen autoresize',
            init_instance_callback: function (editor) {

                editor.on('change', function (e) {

                    var quoterx = /\[([^\]]+)]/g;

                    var resqt = new Array();

                    var ranword = "&°-*¤-@731955^";

                    var m;

                    var i = 0;

                    var tt = editor.getContent()
                    var ttt = tt
                    do {
                        i++;
                        m = quoterx.exec(tt);

                        if (m) {
                            ttt = ttt.replace(m[0], this.buidTableFromTagName(m[1]));
                        }
                    } while (m && i < 5000);

                    this.viewReportConfig[this.selectedList.listId].htmlvalv = ttt;

                }.bind(this))
            }.bind(this)

        };

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

    initializeSelectedModule() {
        this
            .selectedMdule
            .getModule()
            .pipe(takeUntil(this.ngUnsubscribea))
            .subscribe((modules) => {
                this.setModule(modules);
            });
    }

    setModule(modules) {
        this.module = modules;
        //this.resetParam()
        this.loadRole(true)
        this.loadMenu(true)
        this.loadProcess()
        this.loadLink(true)
        this.loadSchema()
        this.getAllconnection(false)

    }

    onRoleOptionClick($event) {
        $event.stopPropagation();
    }

    refrechRelationalEntity($event) {
        if ($event) {
            $event.stopPropagation();
        }
        this.menuService.refrechRelationalEntity().subscribe(field => this.loadSchema());
    }

    stopClick($event, elm) {
        console.log("editor", elm)
        $event.stopPropagation();
    }


    stopClickEditor($event, elm) {
        console.log("editor", $event)
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

    submitPrintDetail() {


        var param = {};
        param.process = this.selectedProcess;
        param.action = this.copyObj(this.selectedActions);
        param.action.actionEntity = this.selectedProcess.gestEntity[0].entityId;
        param.action.actionSubEntity = this.selectedActions.actionSubEntity.entityId;
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
        menu.module = this.module;
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
        role.module = this.module;
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
            roles.roleGroup = rol.roleGroup;
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
            if (user.rols) {
                userd.role = this.rolefromObject(user.rols);
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
        if (typeof this.module != 'undefined') {
            if (load) {
                this.menuService.RoleAll(this.module).subscribe(role => this.setRoleOption(role));
            } else {
                this.menuService.RoleAll(this.module).subscribe(role => this.doNthing());
            }
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

            var obj = new Object();
            obj.id = rl.roleId;
            obj.text = rl.roleLibelle;
            arr.push(obj);
        }


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
        if (typeof this.module != 'undefined') {
            if (load) {
                this.menuService.MenuAll(this.module).subscribe(menu => this.menus = this.menufromObject(menu))
            } else {
                this.menuService.MenuAll(this.module).subscribe(menu => this.doNthing())
            }
        }
    }

    loadLink(load) {
        if (typeof this.module != 'undefined') {
            if (load) {
                this.menuService.LinkAll(this.module).subscribe(link => this.link = this.menufromObject(link));
            } else {
                this.menuService.LinkAll(this.module).subscribe(menu => this.doNthing())
            }
        }

    }

    loadMenuLink(load) {
        this.loadMenu(load);
        this.loadLink(load);
    }
    ;

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
        let id = this.selectedMdule.getModuleValue();
        this.menuService.getSchema(id).subscribe(schema => this.buildShema(schema));
    }


    buildShema(schema) {


        this.entities = schema["table"];

        this.relations = schema["relation"];

        var arrvar = new Array();
        for (let ent of this.entities) {
            for (let fld of ent.fields) {
                var objvar = new Object();
                objvar.variableId = fld.fieldId;
                objvar.name = ent.entityEntity + "_" + fld.fieldEntityName;
                arrvar.push(objvar);
            }
        }

        this.allFieldOption = arrvar;

        if (typeof this.selectedEntity != "undefined") {
            for (let ent of this.entities) {
                if (ent.entityId == this.selectedEntity.entityId) {
                    this.selectedEntity = ent
                }
            }

            this.agField = this.getAgField(this.selectedEntity.fields);
        }

        setTimeout(function () {
            this.connectEntity()
        }.bind(this), 300);


    }


    dataOnSelectedEntity($event) {

        var id = $event.target.selectedOptions[0].value;

        if (id == 0) {
            this.dataSelectedEntity = new Entitie();
        }

        for (let entitie of this.entities) {
            if (id == entitie.entityId) {
                this.dataSelectedEntity = entitie;
            }
        }

        var param = {}

        param.entity = this.dataSelectedEntity;

        this.menuService.getAccessData(param).subscribe(data => this.getDataCallback(data));

    }

    dataRefrechData() {

        var param = {}

        param.entity = this.dataSelectedEntity;

        this.menuService.getAccessData(param).subscribe(data => this.getDataCallback(data));

    }

    getDataCallback(data) {
        this.accessData = data
    }

    garantAccess($event) {

        var mode = $event.target.selectedOptions[0].value;

        if (!this.isEmpty(this.dataSelectedEntity)) {
            var param = {}
            param.entity = this.dataSelectedEntity
            param.mode = mode
            param.role = this.selectedrole
            this.menuService.updateAccessData(param).subscribe(data => this.doNthing());
        }


    }

    roleDataAccess(data, $event) {

        $event.stopPropagation();

        if (this.selectedrole !== "") {
            var param = {}
            param.entity = this.dataSelectedEntity
            param.role = this.selectedrole
            param.data = data[this.dataSelectedEntity.entityKey]

            this.menuService.updateRoleAccessData(param).subscribe(data => this.dataRefrechData());
        }

    }

    roleInRoleData(role) {
        for (let dat of role) {
            if (parseInt(dat.roleId) == parseInt(this.selectedrole)) {
                return true;
            }
        }

        return false;
    }


    isEmpty(obj) {
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop))
                return false;
        }

        return JSON.stringify(obj) === JSON.stringify({});
    }


    getDataAccessField(entity) {
        var flds = [];

        if (!this.isEmpty(entity)) {
            for (let fld of entity.fields) {
                if (fld.fieldEntityName == entity.entityKey) {
                    flds[0] = fld;
                }

                if (fld.fieldEntityName == entity.entityDisplayfield) {
                    flds[1] = fld;
                }
            }
        }

        return flds;
    }


    onSelectEntity(entity) {


        if (this.paramPanel != "action") {
            this.paramPanel = 'entity';
        }

        if (Object.entries(this.selectedProcess).length === 0) {

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

        if (typeof this.selectedEntity !== "undefined") {
            this.agField = this.getAgField(this.selectedEntity.fields);
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

    doNthing() {
        return true;
    }
    ;


    connectEntity() {

        this.jsPlumbInstance.reset();

        for (let ent of this.entities) {
            this.jsPlumbInstance.draggable("ent_" + ent.entityId, {
                stop: function (event) {
                    var poselm = {};
                    poselm.id = $(event.el).attr("id").substring(4);
                    poselm.pos = event.pos;
                    ent.entityPos = parseInt(poselm.pos["1"] - 5) + "," + parseInt(poselm.pos[0] - 5);
                    this.menuService.entityPos(poselm.pos, poselm.id).subscribe(schema => this.doNthing());
                }.bind(this)
            })
        }


        for (let rel of this.relations) {

            var source = 'field_' + rel.relationEntitie.entityId + "_" + rel.relationKey;

            var target = 'field_' + rel.relationsTable.entityId + "_" + rel.relationsTable.entityKey;

            let src = document.getElementById(source);

            let tar = document.getElementById(target);

            if (tar !== null && src !== null) {
                this.jsPlumbInstance.connect({
                    connector: ['Bezier', {stub: [212, 67], cornerRadius: 1, alwaysRespectStubs: true}],
                    source: source,
                    target: target,
                    anchor: ['Right', 'Left'],
                    paintStyle: {stroke: '#456', strokeWidth: 0.7},
                    endpointStyle: {radius: 10},
                    overlays: [
                        ['Label', {label: "x", location: 0, cssClass: 'connectingConnectorLabel'}]
                    ],
                });
            }

        }


        this.jsPlumbInstance.repaintEverything(true);


        this.jsPlumbInstance.setContainer("plumbcontainer");


    }

    onAddProcess(val) {
        if (this.selectedArborecence.length != 0) {
            var process = {};
            process.processEntity = this.selectedEntity;
            process.processName = val;
            process.module = this.module
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
        if (typeof this.module != 'undefined') {
            var param = {}
            param.module = this.module;
            this.menuService.getProcess(param).subscribe(process => this.refrechSelectedProcess(process));
        }

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
        this.selectFrom = [];
        this.setStepForm(process);
        this.getJoin(false, false);
    }

    setStepForm(process) {
        for (let prs of this.process) {
            if (prs.gestEntity[0].entityId == process.gestEntity[0].entityId && prs.processId !== process.processId) {
                for (let step of prs.steps) {
                    var stp = new Object();
                    stp.stepId = step.stepId;
                    stp.stepName = prs.processDesignation + "_" + step.stepName;
                    this.selectFrom.push(stp);
                }
            }
        }
        return [];
    }

    addStepFromProcess($event) {
        $event.stopPropagation();
        var param = {};
        param.process = this.selectedProcess;
        param.step = this.stepform;
        this.menuService.addRemoveStepFromProcee(param).subscribe(step => this.loadProcess());
    }

    removeStepFromProcess(step, $event) {
        $event.stopPropagation();
        var param = {};
        param.process = this.selectedProcess;
        param.step = step;
        this.menuService.addRemoveStepFromProcee(param).subscribe(step => this.loadProcess());
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

        this.paramPanel = 'view';


        if (this.selectedSteps.length == 0) {

            this.EntityList = [];

            this.selectedList = list;

            for (let ent of this.selectedProcess.gestEntity) {
                if (list.listEntityName == ent.entityId) {
                    this.EntityList.push(ent);
                }
            }

            if (list.listType == 2) {
                this.entityTab.active = false;
                this.dataTab.active = false;
                this.viewTab.active = true;
                this.intiViewConfig();
            }


        } else {

            var listExist = false

            for (let lst of this.selectedSteps.list) {
                if (lst.listId == list.listId) {
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

    expandParam() {
        $(".mainWarp").switchClass("showElement", "hideElement", 50);
        $(".mainWarp").addClass("col-md-0");
        $(".mainWarp").removeClass("col-md-10");
        $(".paramWarp").addClass("col-md-12");
        $(".paramWarp").removeClass("col-md-2");
        this.paramexp = 1;

    }


    collapsParam() {

        $(".mainWarp").addClass("col-md-10");
        $(".mainWarp").removeClass("col-md-0");
        $(".paramWarp").addClass("col-md-2");
        $(".paramWarp").removeClass("col-md-12");
        $(".mainWarp").switchClass("hideElement", "showElement", 1000);
        this.paramexp = 0;
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

        console.log(this.selectedActions);


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
                    if (fld.updateRequire == 1) {
                        return true;
                    } else {
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
                    if (typeof fld.updateExpression !== 'undefined') {
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

    newFieldAg() {
        this.selectedFieldAg = [];
        this.fieldForm.fieldAlias = "";
        this.fieldForm.fieldName = "";
        this.fieldForm.fieldType = 0;
        this.expValuAg = "";
    }

    deleteAgField(field, $event) {
        $event.stopPropagation();
        this.menuService.deleteAgField(field).subscribe(field => this.refrechAgField());

    }

    setExpressionAg(field, $event) {

        $event.stopPropagation();

        if (typeof field.fieldExpression !== 'undefined') {
            var exp = JSON.parse(field.fieldExpression);
            this.expValuAg = exp.expression;
        } else {
            this.expValuAg = "";
        }

        this.fieldForm.fieldAlias = field.fieldEntityName;
        this.fieldForm.fieldName = field.fieldInterfaceName;
        this.fieldForm.fieldType = field.fieldType;

        this.selectedFieldAg = field;

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

    getAgField(flds) {
        if (typeof flds != 'undefined') {
            var arr = new Array();
            for (let fld of flds) {
                if (fld.fieldNature == 2) {
                    arr.push(fld);
                }
            }
            return arr;
        }
    }

    copyObj(obj) {
        return JSON.parse(JSON.stringify(obj));
    }

    updateFieldAgExp($event) {
        var param = {};
        param.entity = this.selectedEntity;
        param.form = this.fieldForm;
        param.fieldAg = this.selectedFieldAg;
        param.exp = $event;
        this.menuService.updateFieldExpAg(param).subscribe(field => this.refrechAgField());
    }

    refrechAgField() {
        this.loadProcess();
        this.loadSchema();
        this.newFieldAg();

    }


    newAcreg() {
        this.selectedAcreg = [];
        this.acregForm.acregName = "";
        this.acregForm.acregAlias = "";
        this.acregForm.acregErrormessage = "";
        this.expValuAcreg = "";
    }

    deleteAcreg(acreg, $event) {
        $event.stopPropagation();
        this.menuService.deleteAcreg(acreg).subscribe(field => this.refrechAcreg());
    }

    setExpressionAcreg(acreg, $event) {

        $event.stopPropagation();

        if (typeof acreg.acregExpression !== 'undefined') {
            var exp = JSON.parse(acreg.acregExpression);
            this.expValuAcreg = exp.expression;
        } else {
            this.expValuAcreg = "";
        }

        this.acregForm.acregName = acreg.acregName;
        this.acregForm.acregAlias = acreg.acregAlias;
        this.acregForm.acregErrormessage = acreg.acregErrormessage;

        this.selectedAcreg = acreg;

    }

    updateAcregExp($event) {
        var param = {};
        param.action = this.selectedActions;
        param.acreg = this.selectedAcreg;
        param.form = this.acregForm;
        param.exp = $event;
        this.menuService.updateAcregAg(param).subscribe(field => this.refrechAcreg());
    }

    refrechAcreg() {
        this.loadProcess();
        this.newAcreg();
    }


    newListreg() {
        this.selectedListreg = [];
        this.listregForm.listregName = "";
        this.listregForm.listregAlias = "";
        this.expValuListreg = "";
    }

    deleteListreg(acreg, $event) {
        $event.stopPropagation();
        this.menuService.deleteListreg(acreg).subscribe(field => this.refrechListreg());
    }

    setExpressionListreg(listreg, $event) {


        $event.stopPropagation();

        if (typeof listreg.listregExpression !== 'undefined') {
            var exp = JSON.parse(listreg.listregExpression);
            this.expValuListreg = exp.expression;
        } else {
            this.expValuListreg = "";
        }

        this.listregForm.listregName = listreg.listregName;
        this.listregForm.listregAlias = listreg.listregAlias;

        this.selectedListreg = listreg;

    }

    updateListregExp($event) {
        var param = {};
        param.list = this.selectedList;
        param.listreg = this.selectedListreg;
        param.form = this.listregForm;
        param.exp = $event;
        this.menuService.updateListregAg(param).subscribe(field => this.refrechListreg());
    }

    refrechListreg() {
        this.loadProcess();
        this.newListreg();
    }

    getJoin($event, entite) {

        if ($event) {
            var ent = $event.target.selectedOptions[0].value;


            if (entite == 'd') {
                this.entDepart = ent;
            } else if (entite == 'a') {
                this.entArrive = ent;
            }
        }

        this.joins = new Array();

        if (this.entDepart && this.entArrive) {

            var param = {}
            param.entDepart = this.entDepart
            param.entArrive = this.entArrive
            param.process = this.selectedProcess

            this.menuService.getJoinData(param).subscribe(joins => this.populateJoinList(joins));

        }

    }

    setJoin(join, joins) {
        var param = {}
        param.join = join
        param.joins = joins
        this.menuService.setJoin(param).subscribe(joins => this.getJoin(false, false));

    }

    populateJoinList(joins) {
        this.joins = joins;
    }


    addEntity($event) {
        $event.stopPropagation();
        var param = {};
        param.className = this.className
        this.menuService.addEntity(param).subscribe(resp => this.getRespAndReloadSchema(resp));
    }


    RemoveField(fld, $event) {


        var param = {}
        param.entity = this.selectedEntity;
        param.field = fld;
        $event.stopPropagation();
        this.menuService.removeEntityField(param).subscribe(resp => this.getRespAndReloadSchema(resp));


    }


    SaveField($event) {


        var param = {}
        param.entity = this.selectedEntity;
        param.field = this.newatribute;
        $event.stopPropagation();
        this.menuService.addEntityField(param).subscribe(resp => this.getRespAndReloadSchema(resp));


    }

    getRespAndReloadSchema(resp) {
        this.NgxSmartModalServices.resetModalData('messageModal');
        this.NgxSmartModalServices.setModalData(resp, 'messageModal')
        this.NgxSmartModalServices.open('messageModal');
        this.refrechRelationalEntity(null);
    }


    getResp(resp) {
        this.NgxSmartModalServices.resetModalData('messageModal');
        this.NgxSmartModalServices.setModalData(resp, 'messageModal');
        this.NgxSmartModalServices.open('messageModal');
    }


    addentityToModule(entity, $event) {

        $event.stopPropagation();
        var param = {}
        param.entity = entity;
        param.module = this.selectedMdule.getModuleValue();
        this.menuService.addEntityToModule(param).subscribe(resp => this.loadSchema());
    }

    addConnectionDialog($event) {
        $event.stopPropagation();
        this.NgxSmartModalServices.open('addConnectionModal');

    }

    addConnectionConfig($event) {
        this.conConfig.module = this.selectedMdule.getModuleValue();
        this.menuService.saveConnectionConfig(this.conConfig).subscribe(resp => this.getAllconnection(true));
    }

    getAllconnection(closemodal) {
        if (closemodal) {
            this.NgxSmartModalServices.close('addConnectionModal');
        }
        var id = this.selectedMdule.getModuleValue();
        this.menuService.getAllConnections(id).subscribe(connections => this.connections = connections);
    }

    deleteConnections(connection, $event) {
        $event.stopPropagation();

        this.menuService.deleteConnection(connection).subscribe(resp => this.getAllconnection(true));
    }


    deleteQuery(query, $event) {
        $event.stopPropagation();
        this.menuService.deleteQuery(query).subscribe(resp => this.getAllconnection(true));
    }

    addQueryDialog(connection, $event) {
        $event.stopPropagation();
        this.selectedCon = connection;
        this.NgxSmartModalServices.open('addQueryModal');
    }

    addQuery($event) {
        this.query.connection = this.selectedCon;
        this.menuService.saveQuery(this.query).subscribe(resp => this.getAllconnection(false));
    }

    updateQuery($event) {
        this.menuService.saveQuery(this.selectedQuery).subscribe(resp => this.getAllconnection(false));
    }

    getQueryResult(query, $event) {
        $event.stopPropagation();
        this.menuService.getQueryResult(query).subscribe(resp => this.displayQueryResult(resp));
    }

    displayQueryResult(resp) {
        this.displayDataHead = resp.head;
        this.displayDataContent = resp.data;
        this.NgxSmartModalServices.open('displayDataModal');
    }



    dvar(vars, vars1, vars2, vars3, vars4, vars5, vars6, vars7, vars8, vars9, vars10, vars11) {

        this.displayVarContent = "";
        this.displayVarContent += JSON.stringify(vars, undefined, 4);
        this.displayVarContent += '\n';
        this.displayVarContent += '\n';
        this.displayVarContent += '\n';

        if (vars1) {
            this.displayVarContent += JSON.stringify(vars1, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars2) {
            this.displayVarContent += JSON.stringify(vars2, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars3) {
            this.displayVarContent += JSON.stringify(vars3, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars4) {
            this.displayVarContent += JSON.stringify(vars4, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars5) {
            this.displayVarContent += JSON.stringify(vars5, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars6) {
            this.displayVarContent += JSON.stringify(vars6, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars7) {
            this.displayVarContent += JSON.stringify(vars7, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars8) {
            this.displayVarContent += JSON.stringify(vars8, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars9) {
            this.displayVarContent += JSON.stringify(vars9, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars5) {
            this.displayVarContent += JSON.stringify(vars4, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars10) {
            this.displayVarContent += JSON.stringify(vars10, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }


        if (vars11) {
            this.displayVarContent += JSON.stringify(vars11, undefined, 4);
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
            this.displayVarContent += '\n';
        }

        this.NgxSmartModalServices.open('displayVarsModal');
    }


    selectQuery(query, $event) {
        $event.stopPropagation();
        this.paramPanel = "query"
        this.selectedQuery = query;
    }

    regenerateEntity(ent, $event) {
        $event.stopPropagation();
        this.menuService.regenerateEntity(ent).subscribe(resp => this.getRespAndReloadSchema(resp));
    }

    saveListe() {

        if (this.selectedList.listeName !== "") {
            this.selectedList.listReportConfig = JSON.stringify(this.viewReportConfig[this.selectedList.listId]);
            this.menuService.upsateList(this.selectedList).subscribe(list => this.loadProcess());
        }

    }

    intiViewConfig() {

        if (this.selectedList.listReportConfig) {
            this.viewReportConfig[this.selectedList.listId] = JSON.parse(this.selectedList.listReportConfig)
        } else if (this.viewReportConfig[this.selectedList.listId] == null) {
            this.viewReportConfig[this.selectedList.listId] = {};
            this.viewReportConfig[this.selectedList.listId].sections = [];
        }

        $(".containerselector").click(function () {
            console.log("ddddfff");
        })


    }


    refrechViewField() {

        var param = {};
        param.viewConfig = this.selectedViewSection;
        param.onResult = true;
        this.menuService.refrechViewField(param).subscribe(viewHeadData => this.loadViewTableHead(viewHeadData));

    }

    onAddSection(val) {

        var section = {}
        section.title = val;
        this.viewReportConfig[this.selectedList.listId].sections.push(section);

    }

    selectSection(section) {
        this.paramPanel = "viewsection";
        this.selectedViewSection = section;
    }

    loadViewTableHead(viewHeadData) {

        var viewHeads = [];

        for (let vh of viewHeadData.head) {
            var viewHead = {};
            viewHead.fieldName = vh;
            viewHead.fieldInterfaceName = ""
            viewHeads.push(viewHead)
        }

        this.selectedViewSection.viewHead = viewHeads;

    }

    saveViewConfig() {

        this.selectedViewSection.tag = this.selectedViewSection.title.replace(" ", "_");
        console.log("expp",this.selectedViewSectionExpression);
        this.selectedViewSection.Expression = this.selectedViewSectionExpression;
        this.selectedList.listReportConfig = JSON.stringify(this.viewReportConfig[this.selectedList.listId]);
        this.dvar(this.selectedList);
        this.menuService.upsateList(this.selectedList).subscribe(list => this.loadProcess());

    }

    addViewConfigCustomField(){
        console.log(this.selectedViewSection)
    }


    buidTableFromTagName(tagName) {


        var section = {};

        let i = 0;

        for (let confSection of this.viewReportConfig[this.selectedList.listId].sections) {
            if (confSection.tag == tagName) {
                i++;
                section = confSection;
            }
        }

          var headLength = 0

        if (i > 0) {

            var viewHead = section.viewHead;

            if(viewHead.length > 1){


            var sainitisequery  = section.query.replace(/(\r\n|\n|\r)/gm, "");
            console.log("saint",sainitisequery)
            var jsonvar = new Array(sainitisequery,section.title);
            var html = '<table   id='+"'"+ JSON.stringify(jsonvar) +"'"+' name="'+section.title+'"   class="table table-bordered">';
            html += '<thead>';
            html += '<tr>';
            for (let vh of viewHead) {
                headLength++
                html += '<td>' + vh.fieldInterfaceName + '</td>';
            }
            html += '</tr>';
            html += '</thead>';
            html += '<body>';
            html += '</body>';
            html += '<tr>';
            html += '<td colspan="' + viewHead.length + '">'
            html += section.query
            html += '</td>'
            html += '</tr>';
            html += '</table>';

            var DomTable = new DOMParser().parseFromString(html, "text/html").firstChild;

            $(DomTable).find("tbody").replaceWith('<tbody><tr><td colspan="'+headLength+'">'+section.query+'</td></tr></tbody>');

            return $(DomTable).html();

            }else{

              var sainitisequery  = section.query.replace(/(\r\n|\n|\r)/gm, "");
                var jsonvar = new Array(sainitisequery,section.title);
                return   '<span id='+"'"+ JSON.stringify(jsonvar)+ "'"+' name="'+section.title+'" class="queryspan" >'+viewHead[0].fieldInterfaceName+'</span>'

            }



        } else {
            return "[" + tagName + "]";
        }
    }

    setSelectorContainerwidth(num) {
        this.containeSelectorWidth = num;
    }

    addContainerView() {
        this.viewReportConfig[this.selectedList.listId].htmlval += '<div class="col-md-' + this.containeSelectorWidth + ' viewcontourhighliter"   >+</div>'
    }

    trygerDeselecttion(elm) {

        this[elm] = [];

        if (elm == "selectedProcess") {
            this.allAction = [];
            this.allList = [];
            this.selectedList = []
            this.EntityList = [];
            this.selectedActions = [];
            this.EntityAction = [];
            this.selectedViewSection = []
            this.paramPanel = ""
            this.resetParam()
        }

        if (elm == "selectedList") {
            this.EntityList = [];
        }

        if (elm == "selectedActions") {
            this.EntityAction = [];
        }

    }

    getSubentityStep(){

        var stps = [];
        for(let prs of this.process){

             if(prs.gestEntity[0].entityId ==  this.actionform.actionSubEntity){
                 for(let stp of prs.steps){
                     stps.push(this.copyObj(stp))
                 }
             }

        }

      return stps;

    }


}




