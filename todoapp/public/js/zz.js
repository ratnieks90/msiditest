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
    $('#subtasks228').click(function(){
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
            'width' : '1500px'

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
            $('#subtasks228').text("Subtasks ("+ data.length +")");
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
        $.post('filess', info, function(data){
            $('#filename').text("Attachments ("+ data.length +")");
            $.each(data, function(i, value){
                var size = (value['size']/ 1000);
                $('#filelist').append('<li class="download" id="'+value.id+'"><a class="delfiles"><img src="img/delfile.jpg" width="30" height="25" alt="post img"></a><a class="downimg"><img src="img/down.jpg" width="25" height="25" alt="post img"></a>'+value['fname']+'</li>');
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
        var sub = $('#subtasklist li').length;
        $('#subtasks228').text('Subtasks (' +sub+')');
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
        var sub = $('#subtasklist li').length;
        var subs = sub + 1
        $('#subtasks228').text('Subtasks (' +subs+')');
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
        var note = $('#notelist li').length;
        var notes = note + 1
        $('#notes').text('Notes (' +notes+')');
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
        var note = $('#notelist li').length;
        $('#notes').text('Notes (' +note+')');
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
        $('#filelist').children().remove();
        $('#day').remove();
        $('#taskcontrol').show();
        $('#taskinfo').hide();
    });
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            $('#subtasklist').children().remove();
            $('#notelist').children().remove();
            $('#filelist').children().remove();
            $('#day').remove();
            $('#dayid').empty();
            $('#newtask').val('');
            $('.check').removeAttr('checked');
            $('#taskcontrol').show();
            $('#taskinfo').hide();
            $('#addtask').hide();
        }
    });
//----------add task ---------//
    $('#main').delegate(".addline", "click", function(){
        $('#folderlist2').empty();
        var folderid = $(this).parent().attr('id');
        console.log(folderid);
        $.post('folderlist', function(data){
            var pushedData = jQuery.parseJSON(data);
            $.each(pushedData, function(i, value){
                var folder = value.folder;
                var idnum = value.id;
                if (folderid == idnum){
                    $('#folderlist2').append('<input class="check2" type="radio" name="sex" value="'+idnum+'" checked>'+folder+'<br>');
                }else{
//$('#folderlist').append('<li class="folder"><input class="check" type="radio"><p id="foldid">'+idnum+'</P>'+folder+'</li>');
                $('#folderlist2').append('<input class="check2" type="radio" name="sex" value="'+idnum+'">'+folder+'<br>');
                }
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
                $( ".taskcont" ).draggable({containment:'document', helper:'clone'});
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
    $('#newtask').keyup(function(e){
        if(e.keyCode == 13)
        {
            $('#addtaskbutton').click();
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
    $('#regform').submit(function(e){
        e.preventDefault();
        var that = $(this),
            url = that.attr('action'),
            method = that.attr('method'),
            data = {};
        that.find('[name]').each(function(i, value){
            var that = $(this),
                name = that.attr('name'),
                value = that.val();
            data[name] = value;

        });
        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(data){
                $('#errors').empty().hide();
                if(!data.sucess){
                    $.each(data.errors, function(i, error){
                        $('#errors').append('<li style="display: block; color: red" >'+error+'</li>');
                    });
                    $('#errors').slideDown();
                }else {
                    $('#errors').append('<li style="display: block; color: green" >Registration successful !!!</li>');
                    $('#errors').slideDown();
                    $('#regform')[0].reset();
                }
            }
        });
        return false
    });
    //-------------------login-----------------//
    $('#logform').submit(function(e){
        e.preventDefault();

       var that = $(this),
            url = that.attr('action'),
            method = that.attr('method'),
            data = {};
        that.find('[name]').each(function(i, value){
            var that = $(this),
                name = that.attr('name'),
                value = that.val();
            data[name] = value;
        });
        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(data){
                $('#logerrors').empty().hide();
                if(data.sucess == 1){
                    $.each(data.errors, function(i, error){
                        $('#logerrors').append('<li style="display: block; color: red" >'+error+'</li>');
                        console.log(error);
                    });
                    $('#logerrors').slideDown();

                }if(data.sucess == 2){
                    $('#userinfo').text(data.user['name']+ ' '+ data.user['surname']);
                    $( "#mainpg" ).fadeOut( 1000, function() {
                        $( "#conteiner" ).fadeIn( 400 );
                    });
                }if(data.sucess == 3){

                    $('#logerrors').append('<li style="display: block; color: red" >'+data.user+'</li>');
                    $('#logerrors').slideDown();
                }
            }

        });

        return false
    });
    $("#userlogin #userpass").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $("logform").submit();
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
    $(function(){
        var cont = $('#dropfiles');
        cont.on('dragover', function(e){
            e.stopPropagation();
            e.preventDefault();
            $(this).css('border', '2px solid #16a085');
        });
        cont.on('dragleave', function(){
            $(this).css('border', '2px dotted #3498db');
        });
        cont.on('drop',function(e){
            e.stopPropagation();
            e.preventDefault();
            $(this).css('border', '2px dotted #bdc3c7');
            var taskid = $('#taskid').text();
            var files = e.originalEvent.dataTransfer.files;
            var file = files[0];
            var formdata = new FormData();
            formdata.append('file', file);
            formdata.append('taskid', taskid);
            var ext = file.name.split('.').pop().toLowerCase();
            if (file.size < 400000){

              if($.inArray(ext, ['zzz','doc','pdf','docx','rar','zip','ppt','xls'])!== -1) {
                  var request = new XMLHttpRequest();
                  request.open('post', 'fileup', false); // false means that we will wait till script will execute
                  request.send(formdata);
                  $.post('getlastfile', function(data){
                      $('#filelist').append('<li class="download" id="'+data.id+'"><a class="delfiles"><img src="img/delfile.jpg" width="30" height="25" alt="post img"></a><a class="downimg"><img src="img/down.jpg" width="25" height="25" alt="post img"></a>'+data.fname+'</li>');
                  });
                  var attachments = $('#filelist li').length;
                  var attach = attachments + 1;
                  $('#filename').text('Attachments (' +attach+')');
              }else {
                  alert('Wrong file extension');
              }
            }else {
                alert('file size too high');
            }


        });

    });

    $('#taskinfo').delegate(".downimg", "click", function(e){
        e.preventDefault();
        var name = $(this).parent().text();
          //stop the browser from following
        window.location.href = 'uploads/'+name;


    });
    $('#taskinfo').delegate(".delfiles", "click", function(e) {
        e.preventDefault();
        var filename = $(this).parent().text();
        var data = {};
        data['filename'] = filename;
        $.post('delfile', data, function(data){
        });
        $(this).parent().remove();
        var attachments = $('#filelist li').length;
        $('#filename').text('Attachments (' +attachments+')');


    });


});