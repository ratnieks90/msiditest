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
    <h3 id="sucreg">{{Session::get('message')}}</h3>
    <div id="container">
        <div id="register">
        <b>Registration</b>
        <form id="regform" action="registration" method="post">
            <div class="row">
                <label  for="logins" class="reglabel">Login</label>
                <input id="logins" type="text" name="login" value="{{Input::old('login')}}">
            </div> @if ($errors->has('login')) <style>input#logins {box-shadow: 0 0 6px red;}</style><div class="error">{{($errors->first('login')) }}</div>@endif
            <div class="row">
                <label  for="username" class="reglabel">Name</label>
                <input id="username" type="text" name="username" value="{{Input::old('username')}}">
            </div>@if ($errors->has('username')) <style>input#username {box-shadow: 0 0 6px red;}</style><div class="error">{{($errors->first('username')) }}</div>@endif
            <div class="row">
                <label  for="usersurname" class="reglabel">Surname</label>
                <input id="usersurname" type="text" name="usersurname" value="{{Input::old('usersurname')}}">
            </div>@if ($errors->has('usersurname')) <style>input#usersurname {box-shadow: 0 0 6px red;}</style><div class="error">{{($errors->first('usersurname')) }}</div>@endif
            <div class="row">
                <label  for="email" class="reglabel">Email</label>
                <input id="email" type="text" name="email" placeholder="example@gmail.com" value="{{Input::old('email')}}">
            </div>@if ($errors->has('email')) <style>input#email {box-shadow: 0 0 6px red;}</style><div class="error">{{($errors->first('email')) }}</div>@endif
            <div class="row">
                <label  for="pass" class="reglabel">Password</label>
                <input id="pass" type="password" name="pass1">
            </div>@if ($errors->has('pass1')) <style>input#pass {box-shadow: 0 0 6px red;}</style><div class="error">{{($errors->first('pass1')) }}</div>@endif
            <div class="row">
                <label  for="pass2" class="reglabel">Repeat password</label>
                <input id="pass2" type="password" name="pass2">
            </div>@if ($errors->has('pass2')) <style>input#pass2 {box-shadow: 0 0 6px red;}</style><div class="error">{{($errors->first('pass2')) }}</div>@endif
            <div class="row" id="capchavalid" >
                <img id="captcha" src="{{Captcha::img()}}" width="233" height="35" alt="post img">
                <img id="refresh" src="img/refresh.jpeg" width="25" height="25" alt="post img">
                <div class="row">
                    <label  for="antispam" class="reglabel">Enter security code</label>
                    <input id="antispam" type="text" name="code" size="15">
                </div>@if ($errors->has('code')) <style>input#antispam {box-shadow: 0 0 6px red;}</style><div class="error">{{($errors->first('code')) }}</div>@endif
            </div>
            <div class="row">
                <input id="regbutton" type="submit" value="Register">
            </div>
        </form>
        <a href="http://localhost/msidi/todoapp/public/"><button id="gotolog">Go back to login</button></a>
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