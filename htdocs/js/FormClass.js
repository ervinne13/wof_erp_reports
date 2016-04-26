
function FormClass(settings) {
    this.setting = settings
}

$(function () {

    FormClass.prototype.initialize = function(){
        $.extend({
            form:null,
            initialize:{
                variables:null,
                events:function(){
                    
                }
            },
        },this.settings);
    }
    // PaymentTerms.prototype.generateDueDate = function (dateFrom) {
    //     if (!this.terms) {
    //         console.error(CONTEXT, 'Terms not defined, generateDueDate failed');
    //         return dateFrom;
    //     }

    //     if (!dateFrom) {
    //         console.error(CONTEXT, 'dateFrom not defined, generateDueDate failed');
    //         return dateFrom;
    //     }

    //     try {
    //         var translatedTerms = translateTerms(this.terms);
    //         if (translatedTerms.unit == "Days") {
    //             var date = addDaysToDate(dateFrom, translatedTerms.value);
    //             return dateStringFromDate(date);
    //         } else if (translatedTerms.unit == "Weeks") {
    //             var date = addDaysToDate(dateFrom, translatedTerms.value * 7);
    //             return dateStringFromDate(date);
    //         } else {
    //             console.warn(CONTEXT, 'Unable to determine day count from unit: ' + translatedTerms.unit);
    //         }

    //         // TODO: add support for other units: Months and Years

    //     } catch (e) {
    //         console.error('PaymentTerms', e);
    //     }

    //     return dateFrom;
    // };

    // //  private functions

    // function addDaysToDate(dateString, days) {
    //     var date = dateFromDateString(dateString);
    //     date.setDate(date.getDate() + parseInt(days));
    //     return date;
    // }

    // function pad(numberToPad, width, padding) {
    //     padding = padding || '0';
    //     numberToPad = numberToPad + '';
    //     return numberToPad.length >= width ? numberToPad : new Array(width - numberToPad.length + 1).join(padding) + numberToPad;
    // }

    // function dateFromDateString(dateString) {
    //     var splittedDateString = dateString.split('-');

    //     var year = splittedDateString[0];
    //     var month = splittedDateString[1] - 1;
    //     var day = splittedDateString[2];

    //     return new Date(year, pad(month, 2), pad(day, 2));

    // }

    // function dateStringFromDate(date) {

    //     var day   = date.getDate();
    //     var month = date.getMonth() + 1;
    //     var year  = date.getFullYear();

    //     return year + "-" + pad(month, 2) + "-" + pad(day, 2);

    // }

    // function translateTerms(terms) {
    //     var splittedTerms = terms.split('-');

    //     if (splittedTerms.length === 2) {
    //         return {
    //             value: splittedTerms[0],
    //             unit: splittedTerms[1]
    //         };
    //     } else {
    //         console.error(CONTEXT, 'Untranslatable terms: ' + terms);
    //     }

    // }

})();

