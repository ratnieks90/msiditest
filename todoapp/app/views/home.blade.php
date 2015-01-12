<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset ('css/login.css') }}">
    <script src="{{ asset ('js/jquery-1.11.1.min.js')}}"></script>

    <title>todo</title>

</head>
<body>
<div id="container">
    <div id="header">

        <div id="navigation">

            <ul id="nav">

                <li id="time">Time View</li>
                <li id="folder">Folder View</li>
                <li >List</li>
                <li >Grid</li>
            </ul>

        </div>

    </div>
    <div id="insert">

    </div>

</div>

<script>
$(document).ready(function(){
$('#time').click(function(){
$('#insert').load('personal');
});
});
$(document).ready(function(){
$('#folder').click(function(){
$('#insert').load('folder');
});
});

</script>
</body>
</html>