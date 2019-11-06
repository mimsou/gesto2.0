import index from "@angular/cli/lib/cli";

export class User {
    id: string;
    UserLogin: string;
    UserName: string;
    UserLastname: string;
    UserEmail: string;
    UserPasworld: string;
    USerRoles:any
}

export class Article {
    articleCode: string;
    articleLibelle: string;
    articleDateCreation: string;
}

export class ArticleBcn {
    articleBcnDetailCode: string;
    articleBcncol: string;
    articleBcnQteDem: string;
    articleBcnQteValider: string;
    articleBcnQteFacture: string;
    articleBcnPrixUnitaire: string;
    articleBcnPrixTtc: string;
}

export class Bcn {
    bcnCode: string;
    bcnDateCreation: string;
    bcnDateValidation: string;
    bcnExercice: string;
    bcnEtat: string;
}

export class Crb {
    crbLibelle: string;
}

export class Etat {
    etatCode: string;
    etatLibelle: string;
}

export class Facture {
    factureCode: string;
    factureExerice: string;
    factureNumeoBl: string;
    factureCodeRegroupement: string;
    factureCodeDevis: string;
    factureDateDevis: string;
    factureDateReception: string;
    factureDateValidation: string;
}

export class FondType {
    fontTypeCode: string;
    fontTypeLibelle: string;
}

export class Fournisseur {
    fournisseurCode: string;
    fournisseurLibelle: string;
}

export class GestAccessPath {
    apId: string;
    apController: string;
    apLibelle: string;
    role: any;
}

export class GestMenu {
    menuId: string;
    menuLibelle: string;
    menuTag: string;
    menuInterface: string;
    menuParent: string;
    link:any;
    role:any;
}

export class GestRole {
    roleId: string;
    roleLibelle: string;
    roleGroup: string;
}

export class Renouvellement {
    renouvellementCode: string;
    renouvellementExercice: string;
}

export class Service {
    serviceCode: string;
    serviceLibelle: string;
}

export class Solde {
    crbCode: string;
    exercice: string;
    solde: string;
}

export class Action {
    actionId: string;
    actionName: string;
    actionEntity:string;
    actionSubEntity:string;
    actionProcess:string;
    actionSubProcess:any;
    actionBtnName: string;
    actionType:string;
    actionLevelDepth:any;
    actionLevelDepth:any;
    actionIsmainLevel:any;
    actionExistingSubEntity:any;
    step:Step;
    updateField:any;
    viewField:any;

}

export class Step {
    stepId: string;
    stepName: string;
    stepSequence:string;
    stepProcess: Process;
    action: Action;
}

export class Process {
    processId: string;
    processDesignation: string;
    gestEntity: any;
    steps: Array<Step>;
    gestEntityDimention: any;
}

export class List {
    listId: string;
    listName: string;
    listType:any
    steps: Step;
    listReportConfig:any;
    listProcess:Process;
    field:any;
}

export class Dim {
    entityId: string;
    fieldId: string;
    type:any;
}



