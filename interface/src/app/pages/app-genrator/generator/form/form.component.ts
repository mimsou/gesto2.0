﻿import { Component, EventEmitter, OnInit, Output, Input, ViewChild, KeyValueDiffers, DoCheck } from '@angular/core';
import { ManagerService } from "../../../../@core/data/manager.service";
import { DatePipe } from '@angular/common';
import { NgxSmartModalService } from 'ngx-smart-modal';
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
import { forEach } from "@angular/router/src/utils/collection";

@Component({
  selector: 'ngx-form',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.scss'],
  providers: [DatePipe]
})
export class FormComponent implements OnInit, DoCheck {

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
  choiceData: any = [];
  choiceDataValidate: any = [];
  dimFielter: any;
  FormMessage: string = "";
  genfield: any = [];
  firstData: any;
  differ;
  dissciationId: any = "";

  @ViewChild('dimentionchoice') DimComponentChoice: any;

  @Output() refrechMainView: EventEmitter<any> = new EventEmitter();

  constructor(private manager: ManagerService, private datePipe: DatePipe, differs: KeyValueDiffers, private NgxSmartModalServices: NgxSmartModalService) {
    this.differ = differs.find({}).create(null);
  }

  ngDoCheck() {

    var changes = this.differ.diff(this.actionData);
    if (changes) {
      for (let gfield of this.genfield) {
        for (let actfield of this.action.updateField) {
          if (gfield.fieldId == actfield.update_field_id) {

            var param = {};
            param.action = this.action;
            param.data = this.actionData;
            param.entity = this.entity;
            param.dimfilter = this.dimFielter;
            param.genfield = actfield;

            if (typeof this.action.actionSubEntity != 'undefined') {
              param.subentity = this.subentity;
              param.subdata = this.actionsubdatacollection;
            } else {
              param.subdata = this.choiceDataValidate;
              param.subprocess = this.subprocess;
            }

            this.manager.getGenField(param).subscribe((res: Response) => {
              this.setGenfield(res, actfield)
            });


          }
        }
      }
    }
  }

  triggerChange() {
    for (let gfield of this.genfield) {
      for (let actfield of this.action.updateField) {

        if (gfield.fieldId == actfield.update_field_id) {

          var param = {};
          param.action = this.action;
          param.data = this.actionData;
          param.entity = this.entity;
          param.dimfilter = this.dimFielter;
          param.genfield = actfield;

          if (typeof this.action.actionSubEntity != 'undefined') {
            param.subentity = this.subentity;
            param.subdata = this.actionsubdatacollection;
          } else {
            param.subdata = this.choiceDataValidate;
            param.subprocess = this.subprocess;
          }

          this.manager.getGenField(param).subscribe((res: Response) => {
            this.setGenfield(res, actfield)
          });


        }
      }
    }
  }

  setGenfield(res, actfield) {

    this.actionData[actfield.updateFieldId.fieldEntityName] = res;
  }

  ngOnInit() {

  }

  initAction(action, steps, data, dim) {

    this.dimFielter = dim;

    this.choiceData = [];

    this.choiceDataValidate = [];


    if (typeof data !== 'undefined' && data !== null) {
      var param = {};
      param.action = action;
      param.id = data[0][action.actionEntity.entityKey];
      this.manager.getDatalistAction(param).subscribe(data => this.populateform(data));
    }

    this.subforMode = 'add';
    this.field = [];
    this.subfield = [];
    this.genfield = [];

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
      console.log("act", this.action)
      if (typeof this.action.actionSubEntity == 'undefined') {
        this.manager.getSingleProcess(this.action.actionSubProcess.processId).subscribe(process => this.setActionSubFieldSearch(process));
      } else {
        this.setActionSubField();
        this.subentity = this.action.actionSubEntity;
      }
    }

    console.log("sub", this.subentity)

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

    param.id = this.subprocess[0].list[0].listId;
    param.dimfilter = this.dimfilter;
    param.step = this.action.actionFromStep;
    param.mode = "form";
    param.entity = this.entity;
    this.manager.getDatalist(param).subscribe(list => this.populateDataChoice(list));

  }

  populateDataChoice(list) {

    var result = Object.keys(list).map(function (key) {
      return list[key];
    });
    console.log(result)
    this.choiceData = result;
  }

  setActionfield() {

    for (let vfld of this.action.viewField) {

      if (this.action.actionEntity.entityId == vfld.fieldEntity.entityId) {

        var isEditble = true;
        var isExpression = false;

        for (let ufld of this.action.updateField) {
          if (ufld.updateFieldId.fieldId == vfld.fieldId) {
            vfld.require = ufld.updateRequire;
            isEditble = false;
            if (typeof ufld.updateExpression !== "undefined") {
              isExpression = true;
            }
          }
        }

        vfld.isEditeble = (isEditble || isExpression);

        if (isExpression) {
          this.genfield.push(vfld);
        } else {
          if (vfld.fieldNature == 1) {
            if (typeof this.actionData[vfld.fieldEntityName] == "undefined") {
              this.actionData[vfld.fieldEntityName] = "";
            }
          } else {
            this.actionData[vfld.fieldEntityName] = "";
          }
        }

        this.field.push(vfld);

      }
    }


    this.triggerChange();
  }

  setActionSubFieldChoice() {
    for (let fld of this.subprocess[0].list[0].field) {
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
        for (let ufld of this.action.updateField) {
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
      fld = this.validationRequireField(fld, this.actionsubData[fld.fieldEntityName]);

      if (fld.errormsg == "") {
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

      var param = {};
      param.action = this.action;
      param.data = this.actionData;
      param.entity = this.entity;
      param.dimfilter = this.dimFielter;
      param.firstData = this.firstData;
      param.subdatacollection = this.actionsubData;

      if (typeof this.action.actionSubEntity != 'undefined') {
        param.subentity = this.subentity;
        param.subdata = this.actionsubdatacollection;
      } else {
        param.subdata = this.choiceDataValidate;
        param.subprocess = this.subprocess;
      }

      this.manager.checksubentity(param).subscribe((res: Response) => {
        this.actionsubdatacollection.push(entitySub);
      })

    }
  }



  validationRequireField(conf, data) {
    var valid = false;
    if (conf.require !== 1) {
      if (conf.fieldNature == 1) {
        valid = true;
      } else {
        if (conf.fieldNature == 1) {
          if (typeof data.value !== 'undefined') {
            if (data.value !== "") {
              return this.validationTypeField(conf, data.value);
            } else {
              valid = true;
            }
          } else {
            valid = true;
          }
        } else {
          if (typeof data !== "object") {
            if (data !== "") {
              return this.validationTypeField(conf, data);
            } else {
              valid = true;
            }
          } else {
            valid = true;
          }
        }

      }

    } else {
      if (conf.fieldNature == 1) {

        if (typeof data.value !== 'undefined') {
          if (data.value !== "") {
            return this.validationTypeField(conf, data.value);
          } else {
            valid = false;
          }
        } else {
          valid = false;
        }
      } else {
        if (typeof data !== "object") {
          if (data !== "") {
            return this.validationTypeField(conf, data);
          } else {
            valid = false;
          }
        } else {
          valid = false;
        }
      }
    }

    if (!valid) {
      conf.errormsg = "Se champ est obligatoire"
    } else {
      conf.errormsg = "";
    }
    return conf;

  }

  validationTypeField(conf, data) {

    var type = conf.fieldType;
    conf.errormsg = "";
    if (type == "integer" || type == "float") {
      var regex = /^\d+$/;
      if (!regex.test(data)) {
        conf.errormsg = "Merci d'introduire un nombre valide";
      }
    } else if (type == "datetime") {
      var regex = /^(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[012])[-](19|20)\d\d$/;
      if (!regex.test(data)) {
        conf.errormsg = "Merci d'introduire une date valide";
      }
    }
    return conf;
  }

  updateSubEntityData() {

    var error = false;


    for (let fld of this.field) {

      fld = this.validationRequireField(fld, this.actionData[fld.fieldEntityName]);
      if (fld.errormsg == "") {
        fld.error = false;
      } else {
        error = true;
        fld.error = true;
      }
    }

    if (typeof this.action.actionSubEntity !== 'undefined') {
      if (this.actionsubdatacollection.length == 0 && this.action.actionLevelDepth !== 1) {
        error = true;
      }
    } else {
      if (this.choiceDataValidate.length == 0 && this.action.actionLevelDepth !== 1) {
        error = true;
      }
    }

    if (!error) {

      var param = {};
      param.action = this.action;
      param.data = this.actionData;
      param.entity = this.entity;
      param.dimfilter = this.dimFielter;
      param.firstData = this.firstData;
      param.subdatacollection = this.actionsubData;

      if (typeof this.action.actionSubEntity != 'undefined') {
        param.subentity = this.subentity;
        param.subdata = this.actionsubdatacollection;
      } else {
        param.subdata = this.choiceDataValidate;
        param.subprocess = this.subprocess;
      }

      this.manager.checksubentity(param).subscribe((res: Response) => {


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


      }).bind(this);

    }

  }


  onUpdateSubEntiy(SubData) {
    this.subforMode = 'update';
    this.actionsubData = SubData;
  }

  doAction() {

    var error = false;


    for (let fld of this.field) {

      fld = this.validationRequireField(fld, this.actionData[fld.fieldEntityName]);
      if (fld.errormsg == "") {
        fld.error = false;
      } else {
        error = true;
        fld.error = true;
      }
    }

    if (typeof this.action.actionSubEntity !== 'undefined') {
      if (this.actionsubdatacollection.length == 0 && this.action.actionLevelDepth !== 1) {
        error = true;
      }
    } else {
      if (this.choiceDataValidate.length == 0 && this.action.actionLevelDepth !== 1) {
        error = true;
      }
    }

    if (!error) {

      var param = {};
      param.action = this.action;
      param.data = this.actionData;
      param.entity = this.entity;
      param.dimfilter = this.dimFielter;
      param.firstData = this.firstData;

      if (typeof this.action.actionSubEntity != 'undefined') {
        param.subentity = this.subentity;
        param.subdata = this.actionsubdatacollection;
      } else {
        param.subdata = this.choiceDataValidate;
        param.subprocess = this.subprocess;
      }

      this.manager.doAction(param).subscribe((res: Response) => {
        this.callbackAction(res)
      });

    }
  }

  callbackAction(action) {
    var res = JSON.parse(action);

    if (res.error == true) {
      this.FormMessage = "Régles : " + res.message;
    } else {
      this.FormMessage = "";
      this.refrechMainView.emit(action);
    }
  }


  switchView() {
    this.refrechMainView.emit();
  }

  populateform(data) {


    this.actionData[this.entity.entityKey] = data["entityData"][0][this.entity.entityKey];

    for (let fld of this.field) {
      if (fld.fieldNature !== 1) {
        if (fld.fieldType !== "datetime") {
          this.actionData[fld.fieldEntityName] = data["entityData"][0][fld.fieldEntityName];
        } else {
          this.actionData[fld.fieldEntityName] = this.datePipe.transform(data["entityData"][0][fld.fieldEntityName], "dd-MM-yyyy");
        }
      } else {
        this.actionData[fld.fieldEntityName] = new Object();
        if (typeof data["entityData"][0][0][fld.fieldEntityName] != 'undefined') {
          this.actionData[fld.fieldEntityName].value = data["entityData"][0][0][fld.fieldEntityName][fld.fieldTargetEntityId.entityKey];
        }
      }
    }

    this.firstData = this.copyObj(this.actionData);

    if (this.action.actionLevelDepth == 2 || this.action.actionIsmainLevel == 0) {

      for (let dat of data["subEntityData"]) {

        var subdat = new Object();

        subdat[this.subentity.entityKey] = dat[0][this.subentity.entityKey];

        for (let fld of this.subfield) {
          if (fld.fieldNature !== 1) {
            if (fld.fieldType !== "datetime") {
              subdat[fld.fieldEntityName] = dat[0][fld.fieldEntityName];
            } else {
              subdat[fld.fieldEntityName] = this.datePipe.transform(dat[0][fld.fieldEntityName]);
            }
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

  openDissciationModal(id) {
    this.dissciationId = id;
    this.NgxSmartModalServices.open('confirmDissociateModal');
  }


  confirmDissociation() {
    var param = {}
    param.id = this.dissciationId
    param.action = this.action
    param.data = this.actionData
    param.subData = this.actionsubData
    console.log(param);
    this.manager.disscoiateEntity(param).subscribe((res: Response) => {

    });
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

  cleanData(data, fld) {

    if (data[0][fld.fieldEntityName]) {
      return data[0][fld.fieldEntityName][fld.fieldTargetEntityId.entityDisplayfield];
    }
    return "-";
  }

  copyObj(obj) {
    return JSON.parse(JSON.stringify(obj));
  }

  deleteSubEntity(subData,$event){
    $event.stopPropagation();
  }

}
