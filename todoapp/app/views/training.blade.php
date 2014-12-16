<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset ('css/login.css') }}">
    <script src="{{ asset ('js/jquery-1.11.1.min.js')}}"></script>

    <title>todo</title>

</head>
<body>
<div id="header">
    <div id="nav">
        <ul >
            <li id="List">List View</li>
            <li id="Grid">Grid View</li>
        </ul>

    </div>
    <div id="search">


    </div>
</div>

<div id="content">
    <div class="col">
    <li id="List">Today</li>
                <p>Google was founded by Larry Page and Sergey Brin while
                they were Ph.D. students at Stanford University. Together
                they own about 14 percent of its shares but control 56 of th
                e stockholder voting power through supervoting stock. They
                incorporated Google as a privately held company on September 4
                , 1998. An initial public offering followed on August 19, 2004.
                 Its mission statement from the outset was "to organize the world's
                  information and make it universally accessible and useful,"[11] and
                   its unofficial slogan was "Don't
                 be evil."[12][13] In 2004, Google moved to its new]</p>
    </div>
    <div class="col">
    <li id="List">Tommorrow</li>
                 <p>Google was founded by Larry Page and Sergey Brin while
                                they were Ph.D. students at Stanford University. Together
                                they own about 14 percent of its shares but control 56 of th
                                e stockholder voting power through supervoting stock. They
                                incorporated Google as a privately held company on September 4
                                , 1998. An initial public offering followed on August 19, 2004.
                                 Its mission statement from the outset was "to organize the world's
                                  information and make it universally accessible and useful,"[11] and
                                   its unofficial slogan was "Don't
                                 be evil."[12][13] In 2004, Google moved to its new]</p>
    </div>
    <div class="col">
    <li id="List">Upcoming</li>
                 <p>Google was founded by Larry Page and Sergey Brin while
                                they were Ph.D. students at Stanford University. Together
                                they own about 14 percent of its shares but control 56 of th
                                e stockholder voting power through supervoting stock. They
                                incorporated Google as a privately held company on September 4
                                , 1998. An initial public offering followed on August 19, 2004.
                                 Its mission statement from the outset was "to organize the world's
                                  information and make it universally accessible and useful,"[11] and
                                   its unofficial slogan was "Don't
                                 be evil."[12][13] In 2004, Google moved to its new]</p>
    </div>
    <div class="last">
    <li id="List">Someday</li>
                 <p>Google was founded by Larry Page and Sergey Brin while
                                they were Ph.D. students at Stanford University. Together
                                they own about 14 percent of its shares but control 56 of th
                                e stockholder voting power through supervoting stock. They
                                incorporated Google as a privately held company on September 4
                                , 1998. An initial public offering followed on August 19, 2004.
                                 Its mission statement from the outset was "to organize the world's
                                  information and make it universally accessible and useful,"[11] and
                                   its unofficial slogan was "Don't
                                 be evil."[12][13] In 2004, Google moved to its new]</p>
    </div>

</div>



<script>
$(document).ready(function(){
$('#List').click(function(){
$('.col').css('float', 'none')
$('.col').css('margin-left', '200px')
$('.last').css('float', 'none')
$('.last').css('margin-left', '200px')
    });
});

$(document).ready(function(){
$('#Grid').click(function(){
$('.col').css('float', 'left')
$('.col').css('margin-left', '2%')
$('.last').css('float', 'right')
$('.last').css('margin-left', '0px')
    });
});
</script>
<style>
.col
{

    margin-left: 200px;
    width: 23%;
    height: 300px;
    background: #BCD42A;
}
.last{
    float: right;
    width: 23%;
    height: 300px;
    background: #BCD42A;
#block2 {

width: 400px;
height: 300px;
background: #BCD42A;
}
</style>
</body>
</html>