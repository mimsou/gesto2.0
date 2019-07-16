import { HttpInterceptor, HttpHandler, HttpRequest, HttpEvent, HttpResponse , HttpErrorResponse }   from '@angular/common/http';
import { Injectable } from "@angular/core"
import { Observable, of } from "rxjs";
import { tap, catchError } from "rxjs/operators";
import {NgxSmartModalService} from 'ngx-smart-modal';
import  { MessageService } from './message.service'
import { DialogTemplateComponent } from 'dialog.template/dialog.template.component'


@Injectable()
export class AppHttpInterceptor implements HttpInterceptor {

    constructor(public ngxSmartModalService: NgxSmartModalService, public msgService : MessageService) {}


    intercept(
        req: HttpRequest<any>,
        next: HttpHandler
    ): Observable<HttpEvent<any>> {

        return next.handle(req).pipe(
            tap(evt => {

                if (evt instanceof HttpResponse) {

                    if(evt.body) {
                        try {
                         if(evt.headers.get("message")!==null){
                             this.msgService.addMessages([evt.headers.get("message")]);
                         }
                        }catch (e) {
                          console.log(e);
                        }

                    }

                }
            }),
            catchError((err: any) => {
                if(err instanceof HttpErrorResponse) {
                    if(err.headers.get("message")!==null){
                        this.msgService.addMessages([err.headers.get("message")]);
                    }
                }
                return of(err);
            }));

    }



}