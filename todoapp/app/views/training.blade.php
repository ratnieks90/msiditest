<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset ('css/login.css') }}">
    <script src="{{ asset ('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{ asset ('js/jquery-ui.min.js')}}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <title>todo</title>

</head>
<body>


         <div id="tabs-2">
              <?php
               $lenght = count($folders);
              for ($i=1; $i<=$lenght; $i++)
              {

                $array = explode(',' ,$folders[$i-1]['positions']);
                $a =  implode(',',$array);
              ?>
               <div class="block" id="<?php echo $folders[$i-1]['id'];?>">
                               <div class="blockinfo"><h2 class="foldern"><?php echo $folders[$i-1]['folder']?></h2></div>


                                  <div class="item-column">
              <?php

                  foreach ($tasks as $task=>$row){


                  if ($row['folderid']==$folders[$i-1]['id']){
                  if ($row['status'] == 1){
                          ?>
                          <div class="taskcont color" id="<?php echo $row['id'];?>">
                          <?php
                          }
                          else {
                          ?>
                          <div class="taskcont" id="<?php echo $row['id'];?>">
                          <?php
                          }
                          ?>

                           <p class="text"><?php echo $row['taskname'];?></p>
                      </div>
                  <?php
                  }
              }
              ?>
                  </div>
                </div>
                <p><?php echo $a;?></p>
                 <?php
                  }
              ?>
<script>

$(document).ready(function(){

$('#getvalue').click(function(){
    $('#move').appendTo('#second');
});
$("#zz").focus(function() {
    console.log('in');
}).blur(function() {
var text = $('#zz').val();
    console.log(text);
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