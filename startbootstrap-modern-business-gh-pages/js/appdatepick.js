$(document).ready(function(){
    $("#begOfSusp").datepicker({beforeShowDay:nonworkingdates});
    function nonworkingdates(datep){
        var day = datep.getDay();
        if(day == 0 || day ==1 || day == 6){
            return [false];
        }
        return [true];
    }
});