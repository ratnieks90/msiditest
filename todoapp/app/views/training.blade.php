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


<h3 id="1">click</h3>
<input id="2" type="date">


<script>
$(document).ready(function(){
//$('#2').datepicker( "option", "dateFormat", 'yy-mm-dd' );
$('#1').click(function(){
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

});
});
</script>

</body>
</html>