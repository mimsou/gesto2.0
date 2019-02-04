export class User {

    id: string;
    UserLogin: string;
    UserName: string;
    UserLastname: string;
    UserEmail: string;
    UserPasworld: string;

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
}

export class GestMenu {
    menuId: string;
    menuLibelle: string;
    menuTag: string;
    menuInterface: string;
    menuParent: string;
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


export class Field {
    fieldId: string;
    fieldEntityName: string;
    fieldColumnName: string;
    fieldType: string;
}

export class Entitie {
    entityId: string;
    entityTable: string;
    entityEntity: string;
    entityKey: string;
    entityType: string;
    entityPos: string;
    entityInterfaceName: string;
    fields: Array<Field>;
}





