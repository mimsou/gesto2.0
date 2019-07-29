import { Injectable } from '@angular/core';
import {BehaviorSubject, Subject} from "rxjs/Rx";

@Injectable({
  providedIn: 'root'
})

export class ModulestateService {
    private module = new BehaviorSubject<any>();

    constructor() { }

    public setModule(module: string): void  {
        localStorage.setItem("module", module);
        this.module.next(module);
    }


    public getModule() {
       return this.module.asObservable();
    }

    public getModuleValue(){
        return localStorage.getItem("module");
    }




}
