﻿import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {ApiLink} from './api.link'
import {delay} from "rxjs/internal/operators";


@Injectable({
    providedIn: 'root'
})

export class ManagerService {

    constructor(private http: HttpClient, private apiLink: ApiLink) {
    }


    MenuAll(id) {
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/menu/${id}`);
    }

    LinkAll(id) {
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/link/${id}`);
    }

    load(id) {
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/${id}`);
    }

    MenuCreate(menu) {
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/menu/`, JSON.stringify(menu));
    }

    MenuUpdate(menu) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/menu/${menu.menuId}`, JSON.stringify(menu));
    }

    MenuDelete(menu) {
        return this.http.delete(`${this.apiLink.MANAGER_BASE_URL}/menu/${menu.menuId}`);
    }

    RootUpdate(root) {
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/manager/`, JSON.stringify(root));
    }

    MenuLink(parentid, childid) {
        var param = {}
        param.parentid = parentid
        param.childid = childid
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/linkmenu/`, JSON.stringify(param));
    }


    MenuUnlink(childid) {
        var param = {}
        param.childid = childid
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/unlinkmenu/`, JSON.stringify(param));
    }

    RoleAll(module) {
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/role/${module}`);
    }

    loadRole(id) {
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/role/${id}`);
    }

    RoleCreate(role) {
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/role/`, JSON.stringify(role));
    }

    RoleAddUser($user, $role) {
        var param = {};
        param.role = $role;
        param.user = $user;
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/roleadduser/`, JSON.stringify(param));
    }

    RoleRemoveUser($user, $role) {
        var param = {};
        param.role = $role;
        param.user = $user;
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/roleremoveuser/`, JSON.stringify(param));
    }

    RoleUpdate(role) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/role/${role.roleId}`, JSON.stringify(role));
    }

    RoleDelete(role) {
        return this.http.delete(`${this.apiLink.MANAGER_BASE_URL}/role/${role.roleId}`);
    }

    deleteAgField(field) {
        return this.http.delete(`${this.apiLink.MANAGER_BASE_URL}/agfield/${field.fieldId}`);
    }

    deleteAcreg(acreg) {
        return this.http.delete(`${this.apiLink.MANAGER_BASE_URL}/acreg/${acreg.acregId}`);
    }


    deleteListreg(listreg) {
        return this.http.delete(`${this.apiLink.MANAGER_BASE_URL}/listreg/${listreg.listregId}`);
    }


    RoleAddLink($link, $role){
        var param = {};
        param.role = $role;
        param.link = $link;
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/roleaddlink/`, JSON.stringify(param));
    }

    RoleRemoveLink($link, $role){
        var param = {};
        param.role = $role;
        param.link = $link;
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/roleremovelink/`, JSON.stringify(param));
    }


    RoleAddAp($ap, $role){
        var param = {};
        param.role = $role;
        param.ap = $ap;
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/roleaddcontroller/`, JSON.stringify(param));
    }

    RoleRemoveAp($ap, $role){
        var param = {};
        param.role = $role;
        param.ap = $ap;
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/roleremovecontroller/`, JSON.stringify(param));
    }

    allController(){
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/allcontroller`);
    }

    getMenu(id){
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/menufront/${id}`);
    }

    getSchema(id){
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/schema/${id}`);
    }

    entityPos(pos,id) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/entitypos/${id}`, JSON.stringify(pos));
    }

    AddProcess(param) {
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/process/`, JSON.stringify(param));
    }

    AddSteps(param) {
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/step/`, JSON.stringify(param));
    }

    addRemoveStepFromProcee(param) {
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/stepfromprocess/`, JSON.stringify(param));
    }

    AddActionToStep(param) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/stepactions/`, JSON.stringify(param));
    }

    removeActionFromStep(param){
    return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/actionfromstep/`, JSON.stringify(param));
   }

    getProcess(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/process`, JSON.stringify(param));
    }

    getSingleProcess(id){
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/process/${id}`);
    }

    getSingleStep(id){
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/step/${id}`);
    }


    addAction(param) {
    return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/action/`, JSON.stringify(param));
    }

    updateFieldInAction(param) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/fieldupdateaction/`, JSON.stringify(param));
    }

    viewFieldInAction(param) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/fieldviewaction/`, JSON.stringify(param));
    }

    addList(param) {
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/list/`, JSON.stringify(param));
    }

    addDim(param) {
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/dimention/`, JSON.stringify(param));
    }

    doAction(param) {
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/doaction/`, JSON.stringify(param));
    }

    getDatalist(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/datalist/`, JSON.stringify(param));
    }

    getDatalistAction(param) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/datalistaction/`, JSON.stringify(param));
    }

    AddListToStep(param) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/steplist/`, JSON.stringify(param));
    }

    removeListFromStep(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/listfromstep/`, JSON.stringify(param));
    }

    updateFieldInList(param) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/fieldlistaction/`, JSON.stringify(param));
    }

    updateFieldExpAg(param) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/fieldlagexp/`, JSON.stringify(param));
    }

    updateAcregAg(param) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/acregexp/`, JSON.stringify(param));
    }

    updateListregAg(param) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/listregexp/`, JSON.stringify(param));
    }

    updateFieldRequire(param) {
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/fieldrequireaction/`, JSON.stringify(param));
    }

    updateField(param){
        var id = param.fieldId;
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/field/${id}`, JSON.stringify(param));
    }

    updateEntity(param){
        var id = param.entityId;
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/entity/${id}`, JSON.stringify(param));
    }

    comoboGetData(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/combo`, JSON.stringify(param));
    }

    deleteEntityData(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/deleteentitydata`, JSON.stringify(param));
    }

    refrechRelationalEntity(){
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/entitymeta`);
    }


    ProcessDelete(id){
        return this.http.delete(`${this.apiLink.MANAGER_BASE_URL}/process/${id}`);
    }

    StepDelete(id){
        return this.http.delete(`${this.apiLink.MANAGER_BASE_URL}/step/${id}`);
    }

    listDelete(id){
        return this.http.delete(`${this.apiLink.MANAGER_BASE_URL}/list/${id}`);
    }

    ActionDelete(id){
        return this.http.delete(`${this.apiLink.MANAGER_BASE_URL}/action/${id}`);
    }

    DimentionDelete(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/dimention/`, JSON.stringify(param));
    }


    RoleAddStep(id, role){
        var param = {};
        param.role = role;
        param.id = id;
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/roleaddstep/`, JSON.stringify(param));
    }

    RoleRemoveStep(id, role){
        var param = {};
        param.role = role;
        param.id = id;
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/roleremovestep/`, JSON.stringify(param));
    }

    RoleAddAction(id, role){
        var param = {};
        param.role = role;
        param.id = id;
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/roleaddaction/`, JSON.stringify(param));
    }

    RoleRemoveAction(id, role){
        var param = {};
        param.role = role;
        param.id = id;
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/roleremoveaction/`, JSON.stringify(param));
    }



    RoleAddList(id, role){
        var param = {};
        param.role = role;
        param.id = id;
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/roleaddlist/`, JSON.stringify(param));
    }

    RoleRemoveList(id, role){
        var param = {};
        param.role = role;
        param.id = id;
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/roleremovelist/`, JSON.stringify(param));
    }

    updateAccessData(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/accessdata/`, JSON.stringify(param));
    }

    updateRoleAccessData(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/dataroleaccess/`, JSON.stringify(param));
    }

    getAccessData(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/getdata/`, JSON.stringify(param));
    }

    getJoinData(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/getjoindata/`, JSON.stringify(param));
    }


    setJoin(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/setjoin/`, JSON.stringify(param));
    }

    getGenField(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/getgenfield/`, JSON.stringify(param));
    }

    addEntity(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/addentity/`, JSON.stringify(param));
    }

    addEntityField(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/addfieldtoentity/`, JSON.stringify(param));
    }

    removeEntityField(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/removefieldfromentity/`, JSON.stringify(param));
    }


    addModule(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/addmodule/`, JSON.stringify(param));
    }

    getAllModule(){
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/getallmodule`);
    }

    getAllModuleFront(){
      return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/getallmodulefront`);
  }


    addEntityToModule(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/addentitytomodule/`, JSON.stringify(param));
    }

    saveConnectionConfig(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/addconnectionconfig/`, JSON.stringify(param));
    }


    getAllConnections(id){
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/getallconnections/${id}`);
    }


    deleteConnection(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/deleteconnectionconfig/`, JSON.stringify(param));
    }

    deleteQuery(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/deletequery/`, JSON.stringify(param));
    }


    saveQuery(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/addquery/`, JSON.stringify(param));
    }



    getQueryResult(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/getqueryresult/`, JSON.stringify(param));
    }

    regenerateEntity(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/regenerateentitys/`, JSON.stringify(param));
    }

    upsateList(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/updatelist/`, JSON.stringify(param));
    }

    refrechViewField(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/getqueryresult/`, JSON.stringify(param));
    }


    getQueryData(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/getquerydata/`, JSON.stringify(param));
    }

    disscoiateEntity(param){
        return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/dissociateentity/`, JSON.stringify(param));
    }

    isadmin(param){
      return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/isadmin/`, JSON.stringify(param));
  }

  checksubentity(param){
    return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/checksubdata`, JSON.stringify(param));
  }

  savemodulehelp(param){
    return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/savemodulehelp`, JSON.stringify(param));
  }

  getModuleHelper(param){
    return this.http.patch(`${this.apiLink.MANAGER_BASE_URL}/getmodulehelper`, JSON.stringify(param));
  }

}
