$(document).ready(function(){
    //$('#conteiner').hide();
    $('#tabs-2').hide();
    $('#newfolder').hide();

    $("#update").keypress(function(event) {
        if(event.which == '13') {
            return false;
        }
    });
    $("#newtask").keypress(function(event) {
        if(event.which == '13') {
            return false;
        }
    });
    $("#newnotes").keyup(function(event) {
        if(event.which == '27') {
            return false;
        }
    });
    $(".editp").keyup(function() {
        $(this).parent().children('.updtimg').show(140);

    });
    $('#taskinfo').on('keyup', '.subname', function(event){
        if(event.which == '27') {
            return false;
        }
    });


    $('#reg').click(function(){
        $('#loginform').hide();
        $('#logerrors').empty().hide();
        $('#registerform').show();
    });
    $('#log').click(function(){
        $('#registerform').hide();
        $('#errors').empty().hide();
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
        $('.item-column').css({'min-height': '70px'});
        $('.folden').css({'margin-top' : '30px'});
        $('#tabs-2').find('.block').css({'padding-top' : '0.5px'});
    });
    $("#grid").click(function(){
        $('.block').css({'float' : 'left',
            'margin-top' : 'none',
            'width' : '300px',
            'margin-left' : 'none',
            'margin-right' : '10px'
        });
        $('#tabs-2').find('.block').css({'padding-top' : '0px'});
        $('.folden').css({'margin-top' : '19.920px'});
        $('.item-column').css({'min-height': '600px'});
    });
    var num1 = Math.floor((Math.random() * 10) + 1);
    var num2 = Math.floor((Math.random() * 10) + 1);
    var result = num1 + num2;
    $('#question').text(num1+ " + "+num2+ " Answer is:");

//--------get task info------------//
    $('#main').delegate(".text", "click", function(){
        $('#folderlist4').empty();
        $('#newsub').val('');
        var info = {};
        info ['id'] = $(this).parent().attr('id');
        $.post('taskinfo', info, function(data){
            $('#taskid').text(data.id);
            var task = $('#tabs-1').find('#'+data.id);
            if (task.is('.color')) {
                $('.alert').addClass('switch')
            }else {
                $('.alert').removeClass('switch');
            }
            $('.alert').attr('id', data.id);
            $('#update').val(data.taskname);
            $('#newnotes').val(data.note);
            /*if(data.dayid ==1){
                $('#tasknameupdt').append('<h3 id="day">Today</h3>');
            }
            if(data.dayid ==2){
                $('#tasknameupdt').append('<h3 id="day">Tomorrow</h3>');
            }if(data.dayid ==3){
                $('#tasknameupdt').append('<h3 id="day">Upcoming</h3>');
            }if(data.dayid ==4){
                $('#tasknameupdt').append('<h3 id="day">Someday</h3>');
            }*/
            var foldid = data.folderid;
             $.post('getfolder', foldid, function(info){
             $.each(info, function(i, value){
                 if (foldid == value.id){
                     $('#folderlist4').append('<option value="'+value.id+'" selected>'+value.folder+'</option>');
                 }else{
                     $('#folderlist4').append('<option value="'+value.id+'">'+value.folder+'</option>');
                 }
             });
             });
        });
        $.post('subtasks', info, function(data){
            $('#subtasks228').text("Subtasks ("+ data.length +")");
            $.each(data, function(i, value){
                $('#subslist').append('<li><div class="subcontainer" id="'+value.id+'"><input type="text" class="subname" value="'+value.subtask+'"><img class="delsubs" src="img/subdone.jpg" width="15" height="15" alt="post img"></div></li>');
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
        $("#update").focus();
    });

//-----------delete subtask---------------//
    $('#taskinfo').delegate(".delsubs", "click", function(){
        var subid = {};
        subid['id'] = $(this).parent().attr('id');
        $.post('delsubtask', subid, function(data){

        });

        $(this).parent().parent().remove();
        var sub = $('#subslist li').length;

        console.log(sub);
        $('#subtasks228').text('Subtasks (' +sub+')');
    });

//----------------addsubtask----------//
    $('#newsub').bind("enterKey",function(){
        var info = {};
        info['taskid'] = $('#taskid').text();

        info['subtask'] = $('#newsub').val();
        if(info['subtask'] != ""){
            $.post('addsub', info, function(data){
                $('#subslist').append('<li><div  class="subcontainer" id="'+data.id+'"><input type="text" class="subname" value="'+data.subtask+'"><img class="delsubs" src="img/subdone.jpg" width="15" height="15" alt="post img"></div></li>');
            });
            $('#newsub').val('');
        }else {
            alert('Please enter subtask');
        }
        var sub = $('#subslist li').length;
        var subs = sub + 1;
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
    //$('#updttask').click(function(){
        $('#update').bind("enterKey",function(){
            var task = {};
            var taskid = $('#taskid').text();
            var taskname = $('#update').val();
            if(taskname != ""){
                task['id'] = taskid;
                task['taskname'] = taskname;
                $('#'+taskid).children('.text').text(taskname);
                $('#tabs-1').find('#'+taskid).children('.text').text(taskname);
                $('#tabs-2').find('#'+taskid).children('.text').text(taskname);
                $.post('uptaskname', task, function(data){
                });
                //alert('updated successfully');

                $('#subslist').children().remove();
                $('#notelist').children().remove();
                $('#filelist').children().remove();
                $('#day').remove();
                $('#taskcontrol').show();
                $('#taskinfo').hide();
            }else {
                alert('Please enter task');
            }

            return false;
        });
    $('#update').keyup(function(e){
        if(e.keyCode == 13)
        {
            $(this).trigger("enterKey");
        }
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
        $('#subslist').children().remove();
        $('#notelist').children().remove();
        $('#filelist').children().remove();
        $('#day').remove();
        $('#update').val('');
        $('#taskcontrol').show();
        $('.alert').removeClass('switch');
        $('#taskinfo').hide();
    });
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            $('#subslist').children().remove();
            $('#notelist').children().remove();
            $('#filelist').children().remove();
            $('#day').remove();
            $('#dayid').empty();
            $('#newtask').val('');
            $('.alert').removeClass('switch');
            $('.check').removeAttr('checked');
            $('#taskcontrol').show();
            $('#taskinfo').hide();
            $('#folderlist3').css('opacity', '0' );
            $('#addtaskbutton2').hide();
            $('#addtask').hide();
        }
    });
//----------add task ---------//
    $('#main').delegate(".addline", "click", function(){
        $('#folderlist2').empty();
        $('#folderlist3').empty();

        var folderid = $(this).parent().attr('id');
        console.log(folderid);
        $.post('folderlist', function(data){
            var pushedData = jQuery.parseJSON(data);
            $.each(pushedData, function(i, value){
                var folder = value.folder;
                var idnum = value.id;
                if (folderid == idnum){
                    $('#folderlist3').append('<option value="'+value.id+'" selected>'+value.folder+'</option>');
                }else{
                    $('#folderlist3').append('<option value="'+value.id+'">'+value.folder+'</option>');
                }
            });
        });
        var id = $(this).attr('id');
        $('#dayid').append(id);
        $('#taskcontrol').hide();
        $('#addtask').show();
        $("#newtask").focus();
    });


    $('#gotomain').click(function(){
        $('#dayid').empty();
        $('#newtask').val('');
        $('.check').removeAttr('checked');
        $('#taskcontrol').show();
        $('#addtaskbutton2').hide();
        $('#folderlist3').css('opacity', '0' );
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
    $('#tabs-2').delegate(".ziga", "click", function(){
        var data = $(this).parent().parent().parent().attr('id');
        var folderid = {};
        folderid['id']=data;
        $.post('delfolder', folderid, function(data){
            $.each(data, function(i,value){
                $('#6').children('.item-column').append('<div class="taskcont" id="'+value.id+'"><p class="text">'+value.taskname+'</p><a class="delete"><img src="img/delbutton.jpg" width="20" height="20" alt="post img"></a></div>');
                //$( ".taskcont" ).draggable({containment:'document', helper:'clone'});
            });

        });

        $(this).parent().parent().parent().remove();

        return false;

    });

//--add task function--//
    $('#addtaskbutton2').click(function(){
        var dayid = $('#dayid').text();
//var folderid = $('.check:checked').parent().children('#foldid').text();
        var folderid = $('option:selected').attr('value');
        var task = $('#newtask').val();
        if (task > ""){
            var newtask = {};
            newtask["task"] = task;
            newtask["day"] = dayid;
            newtask["folder"] = folderid;
            $.post('addtask', newtask,  function(data){
                $('#'+dayid).children('.item-column').append('<div class="taskcont" id="'+data.id+'"><p class="text">'+task+'</p><a class="delete"><img src="img/delbutton.jpg" width="20" height="20" alt="post img"></a></div>');
                $('#'+folderid).children('.item-column').append('<div class="taskcont" id="'+data.id+'"><p class="text">'+task+'</p><a class="delete"><img src="img/delbutton.jpg" width="20" height="20" alt="post img"></a></div>');
            });

            $('#dayid').empty();
            $('#newtask').val('');
            $('.check2').removeAttr('checked');
            $('#addtask').hide();
            $('#addtaskbutton2').hide();
            $('#folderlist3').css('opacity', '0' );
            $('#taskcontrol').show();
            //$( ".taskcont" ).draggable({containment:'document', helper:'clone'});
            return false;
        }else{
            alert('Please enter Task name')
        }

    });
    $('#newtask').keyup(function(e){
        if(e.keyCode == 13)
        {
            $('#addtaskbutton2').click();
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

//------------------- show addtask button and selectfolder --------------------//
    $('#newtask').keyup(function (){
        var text = $('#newtask').val();
        if (text > ""){
            $('#addtaskbutton2').show(250);
            $('#folderlist3').css('opacity', '1' );
        }else {
            $('#addtaskbutton2').hide();
            $('#folderlist3').css('opacity', '0' );
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
                $(function() {
                    $('.item-column').sortable({
                        connectWith: '.item-column',
                        dropOnEmpty: true,
                        receive:function(event, ui ){
                            var data1 ={};
                            data1['colid'] = $(this).parent().attr('id');
                            data1['taskid'] = ui.item.attr('id');
                            $.post('updatecolumn', data1, function (data) {});
                        }
                    });
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
            $('#errors').empty().hide();
        });
        var c = $('#validate').val();
        if(c == result){
        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(data){

                if(!data.sucess){
                    $.each(data.errors, function(i, error){
                        $('#errors').append('<li style="display: block; color: red" >'+error+'</li>');
                    });
                    $('#errors').slideDown();
                    var num1 = Math.floor((Math.random() * 10) + 1);
                    var num2 = Math.floor((Math.random() * 10) + 1);
                    result = num1 + num2;
                    $('#question').text(num1+ " + "+num2+ " Answer is:");
                    $('#validate').val('');
                }else {
                    $('#errors').append('<li style="display: block; color: green" >Registration successful !!!</li>');
                    $('#errors').slideDown();
                    $('#regform')[0].reset();
                }
            }
        });
        }if(c != result) {
            var num1 = Math.floor((Math.random() * 10) + 1);
            var num2 = Math.floor((Math.random() * 10) + 1);
            result = num1 + num2;
            $('#question').text(num1+ " + "+num2+ " Answer is:");
            $('#errors').append('<li style="display: block; color: red" >Answer is wrong</li>');
            $('#errors').slideDown();
            $('#validate').val('');
        }
        return false
    });
    //-------------------login-----------------//

    $('#logform').submit(function(e){
        e.preventDefault();
       /* $( "#mainpg" ).fadeOut( 1000, function() {
            $( "#conteiner" ).fadeIn( 400 );
        });*/
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
        $('#logerrors').empty().hide();


        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(data){

                if(data.sucess == 1){
                    $.each(data.errors, function(i, error){
                        $('#logerrors').append('<li style="display: block; color: red" >'+error+'</li>');

                    });
                    $('#logerrors').slideDown();

                }if(data.sucess == 2){
                    $('#userinfo').text(data.user['name']+ ' '+ data.user['surname']);
                    $('.reg').val('');
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


    //---------------------logout----------------------------//
   /* $('#logout').click(function(){
        $.post('logout'
        );
        window.location = "http://localhost/msidi/todoapp/public/"
    });*/
    //---------------------drag and drop function-------------------//
    $(function() {
        $('.item-column').sortable({
            connectWith: '.item-column',
            dropOnEmpty: true,
            placeholder: "ui-state-highlight",
            update: function(event, ui){
                var obj = {};
                var columnid = $(this).parent().attr('id');
                obj['tasks'] = $(this).sortable('toArray');
                obj['folders'] = columnid;
               /* $.post('savepositions', obj, function (data) {

                 });*/
            },
            receive:function(event, ui ){
                var data1 ={};
                data1['colid'] = $(this).parent().attr('id');
                data1['taskid'] = ui.item.attr('id');
                $.post('updatecolumn', data1, function (data) {});
            }
        });
    });
    /*$(function() {
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
    });*/
    //--------------------------- file upload --------------------------//
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
                  alert('There are allowed only files with these - .doc, .docx, .rar, .zip, .ppt, .xls, extensions ');
              }
            }else {
                alert('File size too high');
            }


        });

    });
    //----------------------------- profileimg upload ---------------------------//
    $('form#imgform').submit(function(e){
        e.preventDefault();
        $('#imgerors').text('');
        var profileid = $('.userinfo').attr('id');
        var form = document.querySelector('form#imgform');
        var formdata = new FormData(form);
        var name = $('#imgupload').val();
       formdata.append('profileid', profileid);
        $.ajax({
            url: 'imgupload',
            type: 'POST',
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){

               if(!data.success){
                $('#imgerors').text(data.error['image']).css('color', 'red');

                    $("#imgform")[0].reset();
                }if(data.success) {
                    $('#imgerors').text(data.error).css('color', 'green');
                    console.log(data.img);
                    $('#profileimg').attr('src', 'profileimg/'+data.img);
                    $("#imgform")[0].reset();
                }
            }
    });
        //var ext = file.name.split('.').pop().toLowerCase();

       /* var request = new XMLHttpRequest();
        request.open('post', 'imgupload');
        request.send(formdata);*/
    });
//-------------------download file function-------------------//
    $('#taskinfo').delegate(".downimg", "click", function(e){
        e.preventDefault();
        var name = $(this).parent().text();
          //stop the browser from following
        window.location.href = 'uploads/'+name;


    });
    //------------------delite file function---------------------//
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
    $( ".alert" ).click(function(e) {
        e.preventDefault();
        var taskid = $('#taskid').text();
        var data = {};
        data['id'] = taskid;
        $.post('changestatus', data, function(data){
            console.log(data);
        });
        var task = $('#tabs-1').find('#'+taskid);
        var task2 = $('#tabs-2').find('#'+taskid);
        task.toggleClass('color');
        task2.toggleClass('color');
        $('.alert').toggleClass('switch');


    });

    $('#folderlist4').change(function(){
        var value = $(this).val();
        var taskid = $('#taskid').text();
        var data = {};
        data['colid'] = value;
        data ['taskid'] = taskid;
        $.post('folderupdate', data, function(data){
            console.log(data);
        });
        $('#tabs-2').find('#'+taskid).appendTo( $('#'+value).children('.item-column'));
        console.log(value);


    });


    $("#newnotes").focus(function(e) {
        console.log('in');
        if (e.which === 27){
            return false;
        }
    }).blur(function() {
        var data = {};
        var text = $('#newnotes').val();
        var taskid = $('#taskid').text();
        data['taskid'] = taskid;
        data['note'] = text;
        $.post('noteupdate', data, function(data){
            console.log(data)
        });
    });

    $("body").on("blur", ".subname", function(e) {

        var data = {};
        var text = $(this).val();
        var subid = $(this).parent().attr('id');
        data['subsid'] = subid;
        data['subtask'] = text;
        $.post('subtaskupdt', data, function(data){
            console.log(data)
        });
    });
    $('.userinfo').click(function(){
        var data = {};
        data['userid'] = $('.userinfo').attr('id');
        $.post('getuserinfo3',data,  function(data){
            if (data.img){
            $('#profileimg').attr('src', 'profileimg/'+data.img);
            }
            $('#name').val(data.name);
            $('#surname').val(data.surname);
            $('#email').val(data.email);
        });
        $('#usercontrol').show(300);
        $('#hover').show(150);
    });
    $('#hover').click(function(){
        $('#imgerors').text('');
        $('.updtimg').css('display', 'none');
        $("#imgform")[0].reset();
        $('#usercontrol').hide(200);
        $('#hover').hide();
    });
    $('#updtname').click(function(){
        var data = {};
        data['userid'] = $('.userinfo').attr('id');
        data['name'] = $(this).parent().children('#name').val();
        if (data['name'] != 0){
        $.post('updtname', data, function(data){
        });

        }if (data['name'] == 0){
            alert('Please enter the name');
        }
        $('#updtname').css('display', 'none');
    });
    $('#updtsurname').click(function(){
        var data = {};
        data['userid'] = $('.userinfo').attr('id');
        data['surname'] = $(this).parent().children('#surname').val();
        if (data['surname'] != 0){
            $.post('updtsurname', data, function(data){
            });

        }if (data['surname'] == 0){
            alert('Please enter the surname');
        }
        $('#updtsurname').css('display', 'none');
    });

    $('#updtemail').click(function(){
        $('#updterors').text('');
        var data = {};
        data['userid'] = $('.userinfo').attr('id');
        data['email'] = $(this).parent().children('#email').val();
        if (data['email'] != 0){
            $.post('updtemail', data, function(data){
                if (!data.success){
                $('#updterors').text(data.error['email']);
                }
            });

        }if (data['email'] == 0){
            alert('Please enter the email');
        }
        $('#updtemail').css('display', 'none');
    });


});