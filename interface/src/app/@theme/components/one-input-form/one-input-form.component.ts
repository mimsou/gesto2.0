import {Component, OnInit, Input, Output, EventEmitter, ViewChild, AfterViewInit, ElementRef} from '@angular/core';
import {Observable} from "rxjs/Rx";

@Component({
    selector: 'ngx-one-input-form',
    templateUrl: './one-input-form.component.html',
    styleUrls: ['./one-input-form.component.scss']
})
export class OneInputFormComponent  implements AfterViewInit {

    @Input() placeholder: string;
    item: string="";
    @Output() newItem:EventEmitter<any> = new EventEmitter();
    @Output() onkeyUp:EventEmitter<any> = new EventEmitter();
    @ViewChild('smartinput') myDiv: ElementRef;

    constructor() {
    }


    stopClick($event){
        $event.stopPropagation();
    }

    ngAfterViewInit(){
        Observable.fromEvent( this.myDiv.nativeElement , 'keyup').debounceTime(200).subscribe(value =>   this.onkeyUp.emit(this.item))
    }

    addItem($event) {
        $event.stopPropagation();
        this.newItem.emit(this.item);
    }

}
