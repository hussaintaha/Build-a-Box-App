function validateText(evt) {
  var theEvent = evt || window.event;
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}


$(document).ready(function() {
    $('.inputAmount').click(function() {
        $('.ShowAmountField').show();
        $('.ShowProductField').hide();
        $("#inputProductField").val(null);
    });
    $('.inputProduct').click(function() {
        $('.ShowAmountField').hide();
        $('.ShowProductField').show();
        $("#inputAmoutField").val(null);
    });
    $("#inputAmoutField").keypress(function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $("#errmsg").html("Digits Only!").show().fadeOut(5000);
            return false;
        }
    });
    $("#inputProductField").keypress(function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $("#errmsg1").html("Digits Only!").show().fadeOut(5000);
            return false;
        }
    });

    $(".box_price").on('change',function(){
      var show_box_price = $(".box_price:checked").val();
        $("#show_price").hide();
      if(show_box_price == 'yes'){
        $("#show_price").show();
      }
    });
});
