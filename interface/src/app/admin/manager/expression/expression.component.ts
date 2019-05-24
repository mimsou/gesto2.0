import {Component, EventEmitter, Input, OnInit, Output, AfterViewInit, SimpleChanges, OnChanges} from '@angular/core';

@Component({
    selector: 'ngx-expression',
    templateUrl: './expression.component.html',
    styleUrls: ['./expression.component.scss']
})
export class ExpressionComponent implements AfterViewInit, OnChanges {

    constructor() {
    }

    @Input() value: any;
    @Output() valueChange = new EventEmitter();
    @Input() optionvar: any;

    expressionElement: any;

    ngOnChanges(changes: SimpleChanges) {
        if (typeof changes.value != "undefined") {
            this.init(changes.value.currentValue);
        }
    }

    ngAfterViewInit() {
        this.init();
    }

    init() {
        let options = {
            variables: this.optionvar,
            expression: this.value,
            functions: {
                sysdate: function () {
                    return true;
                },
                get: function (x) {
                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");

                    return 'f';
                },
                where: function (x) {
                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");

                    return 'f';
                },
                dim: function (x) {
                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");

                    return 'f';
                },
                input: function (x) {
                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");

                    return 'f';
                },
                php: function (x) {
                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");

                    return 'f';
                }, dql: function (x) {
                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");

                    return 'f';
                },
                nofilter: function (x) {
                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");

                    return 'f';
                },
                substr: function (x, y, z) {
                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (x == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");
                    if (y == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (y == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");
                    if (z == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (z == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");

                    return 'f';
                },

                SUBSTRING: function (x, y, z) {
                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (x == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");
                    if (y == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (y == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");
                    if (z == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (z == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");

                    return 'fb';
                },
                AVG: function (x) {
                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (x == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");

                    return 'fb';
                },
                SUM: function (x) {

                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (x == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");

                    return 'fb';
                },
                COUNT: function (x) {

                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (x == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");

                    return 'fb';
                },
                MIN: function (x) {

                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (x == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");

                    return 'fb';
                }, ABS: function (x) {

                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (x == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");

                    return 'fb';
                },
                MAX: function (x) {

                    if (x == undefined)
                        throw new Error("Paramétre 'x' non définie");
                    if (x == 'f')
                        throw new Error("Paramétre 'x' ne peut pas étre une fonction");

                    return 'fb';
                }
            }
        };

        this.expressionElement = $("#expressionarea").expressionBuilder(options);

        if (typeof this.value !== 'undefined') {
            var tt = JSON.parse(JSON.stringify(this.value));
        }else{
            this.value = new Array();
            var tt = JSON.parse(JSON.stringify(this.value));
        }

        var quoterx = /"([^"]*)"/g;
        var resqt = new Array();
        var ranword = "&°-*¤-@731955^";
        var m;
        var i = 0;

        do {
            i++;
            m = quoterx.exec(tt);
            if (m) {
                var arr = new Object();
                arr.id = ranword + i;
                arr.match = m[0];
                resqt.push(arr);
                tt = tt.replace(m[0], arr.id);
            }
        } while (m && i < 5000);


        var ss = /\[([^\]]+)]/g;
        var ress = new Array();
        var m;
        var i = 0;

        do {
            i++;
            m = ss.exec(tt);
            if (m) {
                var fieldname = this.getFieldName(m[1], this.optionvar);
                tt = tt.replace(m[0], fieldname);
            }
        } while (m && i < 5000);

        for (let ars  of  resqt) {
            tt = tt.replace(ars.id, ars.match);
        }

        $(".expressionarea").val(tt);


    }

    getFieldName(id, optionvar) {
        for (let opt of optionvar) {
            if (opt.variableId == id) {
                return opt.name
            }
        }
    }

    isValid() {
        if (typeof this.expressionElement != 'undefined') {
            return !this.expressionElement.isValid();
        } else {
            return false;
        }
    }


    validateExpression() {
        if (typeof this.expressionElement != 'undefined') {
            if (this.expressionElement.isValid()) {
                var exp = this.expressionElement.getExpression();
                var expresstion = {};
                expresstion.expression = exp;
                this.valueChange.emit(expresstion);
            }
        }


    }


}
