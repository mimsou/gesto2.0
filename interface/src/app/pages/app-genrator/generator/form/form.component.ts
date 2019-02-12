import {Component, EventEmitter, OnInit, Output, Input, ViewChild} from '@angular/core';
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
    selector: 'ngx-form',
    templateUrl: './form.component.html',
    styleUrls: ['./form.component.scss']
})
export class FormComponent implements OnInit {

    listMainentityform: string = "Loading main Form .. ";
    listSubEntityform: string = "Loading Sub Form .. ";
    label: string = "label";
    action: Action = new Action();
    entity: any;
    subentity: any;
    subprocess: any;
    subfieldSearch: any;
    steps: any;
    field: any = [];
    subfield: any = [];
    actionData: any = {};
    actionsubData: any = {};
    actionsubdatacollection: any = [];
    datePickerConfig: any = {};
    subforMode: string = 'add';
    dimfilter: any;
    subforModeChoix: string = "";
    choiceData: any;
    choiceDataValidate: any = [];

    @ViewChild('dimentionchoice') DimComponentChoice: any;

    @Output() refrechMainView: EventEmitter<any> = new EventEmitter();

    constructor(private manager: ManagerService) {
    }

    ngOnInit() {

    }

    initAction(action, steps, data, user) {

        if (typeof data !== 'undefined' && data !== null) {
            var param = {};
            param.action = action;
            param.id = data[0][action.actionEntity.entityKey];
            this.manager.getDatalistAction(param).subscribe(data => this.populateform(data));
        }

        this.subforMode = 'add';
        this.field = [];
        this.subfield = [];
        this.actionData = {};
        this.actionsubData = {};
        this.actionsubdatacollection = [];
        this.action = action;
        this.steps = steps;
        if (this.action.actionIsmainLevel == 1) {
            this.setActionfield();
            this.listMainentityform = this.action.actionEntity.entityInterfaceName;
            this.entity = this.action.actionEntity;
        } else {
            this.entity = this.action.actionEntity;
            this.setActionSubField();
            this.subentity = this.action.actionSubEntity;
        }

        if (this.action.actionLevelDepth == 2) {
            if (typeof this.action.actionSubEntity == 'undefined') {
                this.manager.getSingleProcess(this.action.actionSubProcess.processId).subscribe(process => this.setActionSubFieldSearch(process));

            } else {
                this.setActionSubField();
                this.subentity = this.action.actionSubEntity;
            }
        }

    }

    ChoiceMode() {
        this.subforModeChoix = 'validate'
    }


    validateChoice() {

        this.choiceDataValidate = new Array();

        for (let dat of this.choiceData) {
            if (dat["choix"] == true) {
                this.choiceDataValidate.push(dat);
            }
        }

        this.subforModeChoix = 'choice'
    }

    GetDataChoiceCount() {
        return this.choiceDataValidate.length;
    }

    setDemFilter($event) {
        this.dimfilter = $event;
    }

    setActionSubFieldSearch(process) {
        this.subprocess = process;
        this.subentity = this.subprocess[0].gestEntity;
        this.setActionSubFieldChoice();
        this.DimComponentChoice.initDimention(this.subprocess);
        this.subforModeChoix = "choice";
    }

    getDatachoice() {

        var param = new Object();
        console.log("acttt", this.action)
        param.id = this.subprocess[0].list[0].listId;
        param.dimfilter = this.dimfilter;
        param.step = this.action.actionFromStep;
        this.manager.getDatalist(param).subscribe(list => this.choiceData = list);

    }

    setActionfield() {
        for (let vfld of this.action.viewField) {
            if (this.action.actionEntity.entityId == vfld.fieldEntity.entityId) {
                var isEditble = true;
                var isExpression = false;
                for (let ufld of  this.action.updateField) {
                    if (ufld.updateFieldId.fieldId == vfld.fieldId) {
                        vfld.require = ufld.updateRequire;
                        isEditble = false;
                        if (typeof ufld.updateExpression !== "undefined") {
                            console.log("yes");
                            isExpression = true;
                        }
                    }
                }


                vfld.isEditeble = (isEditble || isExpression);
                if (isExpression) {
                    this.actionData[vfld.fieldEntityName] = '-gen-';
                } else {
                    this.actionData[vfld.fieldEntityName] = "";
                }

                this.field.push(vfld);
            }
        }
    }

    setActionSubFieldChoice() {
        for (let fld of  this.subprocess[0].list[0].field) {
            if (fld.fieldEntity.entityId == this.subentity[0].entityId) {
                this.subfield.push(fld);
            }
        }
    }

    setActionSubField() {
        for (let vfld of this.action.viewField) {
            if (this.action.actionSubEntity.entityId == vfld.fieldEntity.entityId) {
                var isEditble = true;
                var isExpression = false;
                for (let ufld of  this.action.updateField) {
                    if (ufld.updateFieldId.fieldId == vfld.fieldId) {
                        vfld.require = ufld.updateRequire;
                        isEditble = false
                        if (ufld.updateExpression !== "") {
                            isExpression = true
                        }
                    }

                }
                vfld.isEditeble = isEditble;
                vfld.isExpression = isExpression;

                this.actionsubData[vfld.fieldEntityName] = new Array();
                this.subfield.push(vfld);
            }
        }
    }

    addSubEntityData() {
        var entitySub = {}
        var error = false;
        for (let fld of this.subfield) {
            if (this.validationField(fld, this.actionsubData[fld.fieldEntityName])) {
                fld.error = false;
                if (fld.fieldNature != 1) {
                    entitySub[fld.fieldEntityName] = this.actionsubData[fld.fieldEntityName];
                } else {
                    entitySub[fld.fieldEntityName] = this.actionsubData[fld.fieldEntityName];
                }
            } else {
                error = true;
                fld.error = true;
            }
        }
        if (!error) {
            this.actionsubdatacollection.push(entitySub);
        }
    }

    validationField(conf, data) {
        console.log("ddd", conf, data);
        if (conf.fieldNature == 1) {
            if (((data !== "" || data !== null) && conf.require == 1)) {
                console.log("yes");
                return true;
            } else {
                console.log("no");
                return false;
            }
        } else {

        }
    }

    updateSubEntityData() {
        this.subforMode = 'add';
        var ar = new Array()
        for (let fld of this.subfield) {
            if (fld.fieldNature == 1) {
                ar[fld.fieldEntityName] = new Object();
                ar[fld.fieldEntityName].value = "";
            } else {
                ar[fld.fieldEntityName] = "";
            }
        }

        this.actionsubData = ar;
    }

    onUpdateSubEntiy(SubData) {
        this.subforMode = 'update';
        this.actionsubData = SubData;
    }

    doAction() {

        var param = {};
        param.action = this.action;
        param.data = this.actionData;
        param.entity = this.entity;

        if (typeof this.action.actionSubEntity != 'undefined') {
            param.subentity = this.subentity;
            param.subdata = this.actionsubdatacollection;
        } else {
            param.subdata = this.choiceDataValidate;
            param.subprocess = this.subprocess;
        }

        this.manager.doAction(param).subscribe(action => this.refrechMainView.emit(action));
    }

    switchView() {
        this.refrechMainView.emit();
    }

    populateform(data) {

        //console.log("actdata",data["entityData"][0]);
        this.actionData[this.entity.entityKey] = data["entityData"][0][this.entity.entityKey];

        for (let fld of this.field) {
            if (fld.fieldNature !== 1) {
                this.actionData[fld.fieldEntityName] = data["entityData"][0][fld.fieldEntityName];
            } else {
                this.actionData[fld.fieldEntityName] = new Object();
                if (typeof data["entityData"][0][0][fld.fieldEntityName] != 'undefined') {
                    this.actionData[fld.fieldEntityName].value = data["entityData"][0][0][fld.fieldEntityName][fld.fieldTargetEntityId.entityKey];
                }
            }
        }

        if (this.action.actionLevelDepth == 2 || this.action.actionIsmainLevel == 0) {

            for (let dat of data["subEntityData"]) {

                var subdat = new Object();

                subdat[this.subentity.entityKey] = dat[0][this.subentity.entityKey];

                for (let fld of this.subfield) {
                    if (fld.fieldNature !== 1) {
                        subdat[fld.fieldEntityName] = dat[0][fld.fieldEntityName];
                    } else {

                        subdat[fld.fieldEntityName] = new Object();
                        subdat[fld.fieldEntityName].data = new Object();
                        subdat[fld.fieldEntityName].data[0] = new Object();
                        subdat[fld.fieldEntityName].data[0].id = dat[0][fld.fieldEntityName][fld.fieldTargetEntityId.entityKey];
                        subdat[fld.fieldEntityName].data[0].text = dat[0][fld.fieldEntityName][fld.fieldTargetEntityId.entityDisplayfield];
                    }
                }

                this.actionsubdatacollection.push(subdat);

            }

        }


    }

    GetEntityUpdateFieldCount() {
        var count = 0;
        for (let ufld of this.action.updateField) {
            if (this.action.actionEntity.entityId == ufld.updateFieldId.fieldEntity.entityId) {
                count++;
            }
        }
        return count;
    }

    GetSubEntityUpdateFieldCount() {
        var count = 0;
        for (let ufld of this.action.updateField) {

            if (this.action.actionSubEntity.entityId == ufld.updateFieldId.fieldEntity.entityId) {
                count++;
            }
        }
        return count;
    }

}
