function numberToText(v) {
    if(v!=null) {
        return v.toString().replace(".",",")
    } else {
        return 0;
    }
}

function textToNumber(v){
    return parseFloat(v.replace(",","."))
}

function round(n,d) {
    return Math.round(n*(10**d))/(10**d);
}

function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

function asDateDDMMYYYY(date){
    return date.toISOString().substring(0, 10);
}

function windowResize() {
    var item=$('#tabla');
    var posTop = item.offset().top;
    var margenes=item.outerHeight(true)-item.outerHeight(false);
    var windowHeight = $(window).height();
    item.css('height', (windowHeight - posTop - margenes)+"px");
}