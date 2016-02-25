function builtCalendarBoard(M,Y){
    
    var M = M || $("#calendarboard").attr("data-month");
    var Y = Y || $("#calendarboard").attr("data-year");   
    
    var field_name = $("#calendarboard").attr("data-name");
    
    var _url = window.location.href;
    _url = _url.replace("/edit", "/field");
    _url += "/" + field_name + "/calendarboard/";
    
    $.ajax({
        url: _url + "get-month-board/" + M + "/" + Y,
        type: 'GET',
        success: function(board) {
          $("#calendarboard").html(board);         
        }
    });    
}

(function($) {
  $.fn.createCalendar = function() {
    return builtCalendarBoard();
  }
}(jQuery));