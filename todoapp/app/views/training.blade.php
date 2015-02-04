<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset ('css/login.css') }}">
    <script src="{{ asset ('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{ asset ('js/jquery-ui.min.js')}}"></script>

    <title>todo</title>

</head>
<body>


<div class="puthere" id="1">
<h3 id="count">0</h3>
<button id="show">zzzzzzz</button>
<button id="reset">reset</button>
</div>




<script>
$(document).ready(function(){


 $('#show').click(function(){
var counter = parseInt($("#count").text());
                counter++;
      $("#count").text(counter)
    });
    $('#reset').click(function(){

          $("#count").text(0)
        });





//$('#2').datepicker( "option", "dateFormat", 'yy-mm-dd' );

  /*$(function() {
     $( ".puthere" ).sortable({
       revert: false
     });
     $( ".droped" ).draggable({
       connectToSortable: ".puthere",
      // helper: "clone",
       revert: "invalid"
     });

   });*/
    /*$(function() {
           $('.puthere').sortable({
               connectWith: '.puthere',
               dropOnEmpty: true,
               receive:function(event, ui ){
                           alert(ui.item.attr('id'));
                           alert($(this).attr('id'));
                       }
           });
      });*/



/*$('#1').click(function(){
var myDate = new Date();
var datepicker = $('#2').val();

var date = (myDate.getFullYear()) + '-' + ("0" + myDate.getMonth() + 1).slice(-2) + '-' + myDate.getDate();
    if (date == datepicker){
        console.log('today');

    }
var tomorrow = myDate.getDate() + 1;
var date2 = (myDate.getFullYear()) + '-' + ("0" + myDate.getMonth() + 1).slice(-2) + '-' + tomorrow;
if (date2 == datepicker){
    console.log('tomorrow');
}
var upcoming = myDate.getDate() + 5;
var date3 = (myDate.getFullYear()) + '-' + ("0" + myDate.getMonth() + 1).slice(-2) + '-' + upcoming;
if (date2 <= date3 >= datepicker ){
    console.log('upcoming');
}
console.log();

});*/
});
</script>

</body>
</html>