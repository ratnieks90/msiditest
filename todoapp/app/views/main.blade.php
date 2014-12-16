<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset ('css/login.css') }}">
    <script src="{{ asset ('js/jquery-1.11.1.min.js')}}"></script>

    <title>todo</title>

</head>
<body>

<button id="ttt">Click me</button>
<p id="content"></p>
/////////////////////////
<p id="puthere"> </p>
<form id="mailsend">
<input type="text" name="mail">
<input type="text" name="login">
<button type="submit">Send</button>
</form>

////////////////////////
<script>
$(document).ready(function(){
$('#ttt').click(function(){
$('#content').load('load');
});
});

$("#mailsend").submit(function(){
var str = $(this).serialize();
$.ajax({
type: "POST",
url: "load",
data: str,
success: function(data){
alert('done');
$('#puthere').html(data);
}

});
return false;
});
</script>
</body>
</html>
