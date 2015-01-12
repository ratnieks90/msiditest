$(document).ready(function(){
    $('#conteiner').hide();
    $('#tabs-2').hide();
    $('#newfolder').hide();




    $('#reg').click(function(){
        $('#loginform').hide();
        $('#registerform').show();
    });
    $('#log').click(function(){
        $('#registerform').hide();
        $('#loginform').show();
        });
    $('#subtasks2').click(function(){
        $('#managesubs').show();
        $('#managenotes').hide();
        $('#managefiles').hide();
    });
    $('#filename').click(function(){
        $('#managefiles').show();
        $('#managenotes').hide();
        $('#managesubs').hide();
    });
    $('#notes').click(function(){
        $('#managenotes').show();
        $('#managefiles').hide();
        $('#managesubs').hide();
    });



    $("#time").click(function(){
        $('#tabs-1').show();
        $('#tabs-2').hide();
        $('#newfolder').hide();
    });
    $('#folder').click(function(){
        $('#tabs-2').show();
        $('#tabs-1').hide();
        $('#newfolder').show();
    });
    $("#list").click(function(){
        $('.block').css({'float' : 'none',
            'margin-bottom' : '15px',
            'width' : '90%'

        });

    });
    $("#grid").click(function(){
        $('.block').css({'float' : 'left',
            'margin-top' : 'none',
            'width' : '300px',
            'margin-left' : 'none',
            'margin-right' : '10px'

        });

    });
//--------get task info------------//
    $('#main').delegate(".text", "click", function(){
        $('#taskfolders').empty();
        var info = {};
        info ['id'] = $(this).parent().attr('id');
        $.post('taskinfo', info, function(data){
            $('#taskid').text(data.id);
            $('#update').val(data.taskname);
            if(data.dayid ==1){
                $('#tasknameupdt').append('<h3 id="day">Today</h3>');
            }
            if(data.dayid ==2){
                $('#tasknameupdt').append('<h3 id="day">Tomorrow</h3>');
            }if(data.dayid ==3){
                $('#tasknameupdt').append('<h3 id="day">Upcoming</h3>');
            }if(data.dayid ==4){
                $('#tasknameupdt').append('<h3 id="day">Someday</h3>');
            }
            /*var foldid = data.folderid;
            $.post('getfolder', foldid, function(info){
                console.log(info);
                $.each(info, function(i, value){
                    if(foldid == value.id){
                        $('#taskfolders').append('<input class="check" type="radio" name="sex" value="'+value.id+'" checked>'+value.folder+'<br>');
                    }else {
                        $('#taskfolders').append('<input class="check" type="radio" name="sex" value="'+value.id+'">'+value.folder+'<br>');
                    }

                });
            });*/
        });
        $.post('subtasks', info, function(data){
            $('#subtasks2').text("Subtasks ("+ data.length +")");
            $.each(data, function(i, value){
                $('#subtasklist').append('<li id="'+value.id+'">'+value.subtask+'<button class="delsub">Delete</button></li>');
            });
        });
        $.post('notes', info, function(data){
            $('#notes').text("Notes ("+ data.length +")");
            $.each(data, function(i, value){
                $('#notelist').append('<li id="'+value.id+'">'+value['notes']+'<button class="delnote">Delete</button></li>');
            });
        });

        $('#taskcontrol').hide();
        $('#taskinfo').show();
    });

//-----------delete subtask---------------//
    $('#taskinfo').delegate(".delsub", "click", function(){
        var subid = {};
        subid['id'] = $(this).parent().attr('id');
        $.post('delsubtask', subid, function(data){

        });
        $(this).parent().remove();
    });

//----------------addsubtask----------//
    $('#newsub').bind("enterKey",function(){
        var info = {};
        info['taskid'] = $('#taskid').text();

        info['subtask'] = $('#newsub').val();
        if(info['subtask'] != ""){
            $.post('addsub', info, function(data){
                $('#subtasklist').append('<li id="'+data.id+'">'+data.subtask+'<button class="delsub">Delete</button></li>');
            });
            $('#newsub').val('');
        }else {
            alert('Please enter subtask');
        }

        return false;
    });
    $('#newsub').keyup(function(e){
        if(e.keyCode == 13)
        {
            $(this).trigger("enterKey");
        }
    });

//----------updatetask---------//
    $('#updttask').click(function(){
        var task = {};
        var taskid = $('#taskid').text();
        var taskname = $('#update').val();
        if(taskname != ""){
            task['id'] = taskid;
            task['taskname'] = taskname;
            $('#'+taskid).children('.text').text(taskname);
            $('#tabs-2').find('#'+taskid).children('.text').text(taskname);
            $.post('uptaskname', task, function(data){
            });
            alert('updated successfully');
        }else {
            alert('Please enter task');
        }

        return false;
    });
    //---------------addnote---------------------//
    $('#newnote').bind("enterKey",function(){
        var info = {};
        info['taskid'] = $('#taskid').text();

        info['note'] = $('#newnote').val();
        if(info['note'] != ""){
            $.post('addnote', info, function(data){
                $('#notelist').append('<li id="'+data.id+'">'+data['notes']+'<button class="delnote">Delete</button></li>');
            });
            $('#newnote').val('');
        }else {
            alert('Please enter note');
        }

        return false;
    });
    $('#newnote').keyup(function(e){
        if(e.keyCode == 13)
        {
            $(this).trigger("enterKey");
        }
    });

    //---------------deletenote------------------//
    $('#taskinfo').delegate(".delnote", "click", function(){
        var noteid = {};
        noteid['id'] = $(this).parent().attr('id');
        $.post('delnote', noteid, function(data){

        });
        $(this).parent().remove();
    });
//-----------------updatefolder------------------//
    $('#getfolder').click(function(){

        var folder= {};
        folder['id'] = $('.check:checked').attr('value');
        folder['taskid'] = $('#taskid').text();
        alert(folder['id'] + 'Not working right now!!!');
    });

    $('#backtask').click(function(){
        $('#subtasklist').children().remove();
        $('#notelist').children().remove();
        $('#day').remove();
        $('#taskcontrol').show();
        $('#taskinfo').hide();
    });
//----------add task ---------//
    $('#main').delegate(".addline", "click", function(){
        $('#folderlist2').empty();
        $.post('folderlist', function(data){

            var pushedData = jQuery.parseJSON(data);
            $.each(pushedData, function(i, value){
                var folder = value.folder;
                var idnum = value.id;
//$('#folderlist').append('<li class="folder"><input class="check" type="radio"><p id="foldid">'+idnum+'</P>'+folder+'</li>');
                $('#folderlist2').append('<input class="check2" type="radio" name="sex" value="'+idnum+'">'+folder+'<br>');
            });
        });
        var id = $(this).attr('id')
        $('#dayid').append(id);
        $('#taskcontrol').hide();
        $('#addtask').show();
    });


    $('#gotomain').click(function(){
        $('#dayid').empty();
        $('#newtask').val('');
        $('.check').removeAttr('checked');
        $('#taskcontrol').show();
        $('#addtask').hide();

    });
    //----------------------delete task--------------------//
    $('#main').delegate(".delete", "click", function(){
        var id = $(this).parent().attr('id');
        var data = {};
        data['id'] = id;
        $.post('delete', data,  function(data){});
        $('.delete').parent('#'+id).remove();
    });

//----------------------delete folder ------------------//
    $('#tabs-2').delegate(".delfolder", "click", function(){

        var data = $(this).parent().parent().attr('id');
        var folderid = {};
        folderid['id']=data;
        $.post('delfolder', folderid, function(data){
            $.each(data, function(i,value){
                $('#6').children('.item-column').append('<div class="taskcont" id="'+value.id+'"><p class="text">'+value.taskname+'</p><a class="delete"><img src="img/delbutton.jpg" width="20" height="20" alt="post img"></a></div>');
            });

        });
        $(this).parent().parent().remove();
        return false;
    });

//--add task function--//
    $('#addtaskbutton').click(function(){
        var dayid = $('#dayid').text();
//var folderid = $('.check:checked').parent().children('#foldid').text();
        var folderid = $('.check2:checked').attr('value');
        var task = $('#newtask').val();
        var date = $('#dateadd').val();

        if (task > ""){
            var newtask = {};
            newtask["task"] = task;
            newtask["day"] = dayid;
            newtask["folder"] = folderid;
            newtask["date"] = date;
            $.post('addtask', newtask,  function(data){
                $('#'+dayid).children('.item-column').append('<div class="taskcont" id="'+data.id+'"><p class="text">'+task+'</p><a class="delete"><img src="img/delbutton.jpg" width="20" height="20" alt="post img"></a></div>').find('.taskcont').draggable({containment:'document', helper:'clone'});
                $('#'+folderid).children('.item-column').append('<div class="taskcont" id="'+data.id+'"><p class="text">'+task+'</p><a class="delete"><img src="img/delbutton.jpg" width="20" height="20" alt="post img"></a></div>').find('.taskcont').draggable({containment:'document', helper:'clone'});
            });

            $('#dayid').empty();
            $('#newtask').val('');
            $('.check2').removeAttr('checked');
            $('#addtask').hide();

            $('#taskcontrol').show();
            $( ".taskcont" ).draggable({containment:'document', helper:'clone'});
            return false;
        }else{
            alert('Please enter Task name')
        }

    });
// search function//
    $('#search').keyup(function(){
        var text = $('#search').val();
        if (text !=""){
            $('.text').parent().hide();
            $('.text').each(function() {
                var taskname = $(this).text();
                if (taskname.indexOf(text) >= 0){
                    $(this).parent().show();
                }
            });
        } else {
            $('.text').parent().show();
        }

    });
    //---------------------add new folder--------------------//
    $('#addfolder').click(function(){
        if ($('#foldname').val()>""){
            var foldname = {};
            foldname['folder'] = $('#foldname').val();
            $.post('addfolder', foldname, function(data){
                var block = $('#6').clone();
                $(block).find('.delfolder').show();
                $(block).find('.foldern').text(data.folder);
                $(block).attr('id', data.id);
                $(block).find('.taskcont').remove();
                $(block).appendTo('#tabs-2');
                $(block).children('.item-column').droppable({ hoverClass: 'border', tolerance:'intersect', helper: 'clone',
                    drop: function(event, ui) {

                        $(this).append(ui.draggable);
                        var data1 = {};
                        var colid = $(this).parent().attr('id');
                        var taskid = ui.draggable.attr("id");
                        data1 ['colid'] = colid;
                        data1['taskid'] = taskid;
                        $.post('updatecolumn', data1, function (data) {

                        });

                    }

                });
                $('#foldname').val('');
            });}
        else{
            alert('Please enter folder name');
        }
        return false;
    });
//--------------------registration---------------------//
$('#register').click(function(){
    $('#errors').children().remove();
    var regdata = {};
    var name = $('#name').val();
    var surname = $('#surname').val();
    var pass1 = $('#pass1').val();
    var pass2 = $('#pass2').val();

    if(name.length < 5){
        $('#errors').append('<li>Name must be at least 5 characters </li>');
    }

    if(surname.length < 5) {
        $('#errors').append('<li>Surname must be at least 5 characters </li>');
    }
    if(pass1.length < 5) {
        $('#errors').append('<li>Password must be at least 5 characters </li>');
    }
    if(pass1 != pass2){
        $('#errors').append('<li>Passwords must be equal </li>');
    }
    if(name.length >=5 && surname.length >= 5 && pass1.length >= 5 && pass1 == pass2 ) {
        regdata['name'] = name;
        regdata['surname'] = surname;
        regdata['pass1'] = pass1;
        $.post('adduser', regdata, function (data) {

        });
        $('#name').val('');
        $('#surname').val('');
        $('#pass1').val('');
        $('#pass2').val('');
        alert('Registration was successful');
    }
});
    //-------------------login-----------------//
    $('#connect').click(function(){
        $('#logerrors').children().remove();
        var loginfo = {};
        var name = $('#logname').val();
        var pass = $('#logpass').val();
        if(name.length < 5){
            $('#logerrors').append('<li>Name must be at least 5 characters </li>');
        }

        if(pass.length < 5) {
            $('#logerrors').append('<li>Surname must be at least 5 characters </li>');
        }

        if (name.length >= 5 && pass.length >= 5){
            loginfo['name'] = name;
            loginfo['pass'] = pass;
            $.post('login', loginfo, function (data) {
                if(data != ""){
                    $('#userinfo').text('Welcome ' + data.name+ " " +data.surname);

                    $('#mainpg').hide();
                    $('#conteiner').show();
                }

            });

        }

    });
    //-------------------mouse hover ----------------------//
    $('#taskcontrol').delegate('.taskcont','mouseover mouseout',function(e){
        if(e.type=='mouseover')
        {
            $(this).css("background-color", "#dfdfdf");
            $(this).children('.delete').show();
        }
        else if(e.type=='mouseout')
        {
            $(this).css("background-color", "white");
            $(this).children('.delete').hide();
        }
    });

    //---------------------drag and drop function-------------------//
    $(function() {
        $( ".taskcont" ).draggable({containment:'document', helper:'clone'});
        $( ".item-column" ).droppable({ hoverClass: 'border', tolerance:'intersect', helper: 'clone',
            drop: function(event, ui) {

               $(this).append(ui.draggable);
                var data1 = {};
                var colid = $(this).parent().attr('id');
                var taskid = ui.draggable.attr("id");
                data1 ['colid'] = colid;
                data1['taskid'] = taskid;
                $.post('updatecolumn', data1, function (data) {

                });

            }

        });
    });

});