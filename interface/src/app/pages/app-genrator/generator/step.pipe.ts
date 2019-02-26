import {Pipe, PipeTransform} from '@angular/core';
import {ManagerService} from "../../../@core/data/manager.service";

@Pipe({
    name: 'step'
})
export class StepPipe implements PipeTransform {

    constructor(private manager: ManagerService) {

    }



    transform(value: any, args?: any): any {
         for(let arg of args){
             if(arg.stepId == value){
                 return arg.stepName;
             }
         }

    }

}
