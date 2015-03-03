<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
   <title>todo</title>
    <link rel="stylesheet" href="{{ asset ('css/loginpage.css') }}">
<script src="{{ asset ('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{ asset ('js/jquery-ui.min.js')}}"></script>
<script src="{{ asset ('js/loginpage.js')}}"></script>
</head>
<body>
<div id="body" align="center">
    <h3>Welcome to my first todo app</h3>
    <div id="container">
        <div id="login">
        <b>Login</b>
        <form id="logform" action="login" method="post">
            <div class="row">
                <label  for="logins" class="reglabel">Login</label>
                <input id="logins" type="text" name="login" value="{{Input::old('login')}}">
            </div>
             @if ($errors->has('login')) <style>input#logins {box-shadow: 0 0 6px red;}</style><div class="error">{{($errors->first('login')) }}</div>@endif
            <div class="row">
                <label  for="pass" class="reglabel">Password</label>
                <input id="pass" type="password" name="password" value="{{Input::old('password')}}">
            </div>
            @if ($errors->has('password')) <style>input#pass {box-shadow: 0 0 6px red;}</style><div class="error">{{($errors->first('password')) }}</div>@endif
            <div class="error">{{Session::get('message')}}</div>
            <div class="row">
                <input id="logbutton" type="submit" value="Login">
            </div>
        </form>
        <a href="registration"><button id="gotoreg">You dont have acc? Sign up now!!!</button></a>
        </div>
    </div>
</div>
<script>
$('#refresh').click(function(e){
e.preventDefault();
 $('#captcha').attr('src','{{Captcha::img()}}');
    });
</script>
</body>
</html>
