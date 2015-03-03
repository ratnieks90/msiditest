<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset ('css/todoapp.css') }}">
    <script src="{{ asset ('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{ asset ('js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset ('js/zz.js')}}"></script>

    <title>todo</title>
 <script>

  </script>
</head>
<body>
<div id="usercontrol">
    <div id="picture">
        <img id="profileimg" src="img/profile.png" width="150" height="150" alt="post img">
    </div>
    <div id="imguploadbox">
        <form id="imgform" enctype="multipart/form-data">
             <label for="image">(.jpg .png .jpeg)</label>
             <input type="file" id="imgupload" id="image" name="image">
             <button type="submit">Upload</button>
        </form>
        <p id="imgerors"></p>
    </div>
    <div id="userinfomanage">
        <div class="edit">
            <input class="editp" id="name" name="name">
            <img id="updtname" class="updtimg" src="img/update.jpg" width="80" height="40" alt="post img">
        </div>
        <div class="edit">
            <input class="editp" id="surname" name="surname">
            <img id="updtsurname" class="updtimg" src="img/update.jpg" width="80" height="40" alt="post img">
        </div>
        <div class="edit">
            <input class="editp" id="email" name="email">
            <img id="updtemail" class="updtimg" src="img/update.jpg" width="80" height="40" alt="post img">
        </div>
        <p id="updterors" align="center"></p>
    </div>

</div>
<div id="hover"></div>
    <div id="conteiner">
        <div id="header">
            <div id="nav-bar">
                <ul>
                    <li class="nav" id="time">Time</li>
                    <li class="nav" id="folder">Folder</li>
                </ul>
            </div>
            <div id="view-select">
                            <ul>
                                <li class="view" id="list">List</li>
                                <li class="view" id="grid">Grid</li>
                            </ul>
            </div>
            <div id="userinfobox">
            <a href="logout"><img id="logout" src="img/logout.png" width="25" height="25" alt="post img"></a>
            <h4 class="userinfo" id="{{ Auth::user()->id }}">Profile</h4>
            </div>
            <div id="searchbox">
                <input id="search" placeholder="Search tasks "type="text">
            </div>
            <div id="newfolder">
                         <input id="foldname" placeholder="Enter folder name">
                         <button id="addfolder">Add folder</button>
                         </div>

        </div>
        <div id="main">
        <div id="addtask">
            <div id="taskcontainer">
            <img id="gotomain" src="img/goback.png" width="40" height="40" alt="post img">
                <h2 id="dayid" style="display: none"></h2>
                <div id="titlebox">
                    <textarea id="newtask" placeholder="I want to..." autofocus></textarea>
                    <img id="addtaskbutton2" src="img/addtask.jpg" width="60" height="60" alt="post img">
                </div>
                <select id="folderlist3">
               </select>

            </div>
        </div>


        <div id="taskinfo">
            <div id="info">
                 <img id="backtask" src="img/goback.png" width="40" height="40" alt="post img">
                 <p id="taskid" style="display: none"></p>
                 <div id="tasknameupdt">
                 <textarea id="update" style="overflow:hidden" autofocus></textarea>
                 </div>
                 <div id="features">
                     <select id="folderlist4"></select>
                     <img class="alert" src="img/alert.jpg" width="35" height="30" alt="post img">
                 </div>
            </div>

            <div id="manageform">
                   <h3 class="managenames" id="notes">Notes</h3>
                   <h3 class="managenames" id="subtasks228">Subtasks</h3>
                   <h3 class="managenames" id="filename">Attachments</h3>
                  <div class="manage" id="managesubs" style="display: none">
                  <h2>Manage subtasks</h2>
                  <div id="subtaskwraper">
                     <div id="newsubblock">
                     <input id="newsub" placeholder="+ Add a sub task">
                     </div>
                     <div id="addededsubs">
                     <ul id="subslist">

                     </ul>
                     </div>
                     </div>
                    </div>

                 <div class="manage" id="managenotes">
                 <h2>Manage notes</h2>
                 <textarea id='newnotes' class="notes"></textarea>
                 </div>
                 <div class="manage" id="managefiles" style="display: none">
                <div class="drop" id="dropfiles"> Drop files here...</div>
                <ul id="filelist"></ul>
                 </div>
            </div>


        </div>
        <div id="taskcontrol">
            <div id="tabs-1">
<?php
for ($i=1; $i<=4; $i++)
{
$days= ["Today","Tomorrow", "Upcoming", "Someday"]
?>
 <div class="block" id="<?php echo $i;?>">
                 <h2 class="folden"><?php echo $days[$i-1];?></h2>
                <div class="addline" id="<?php echo $i;?>"><a class="add">+</a></div>

                    <div class="item-column">
<?php
    foreach ($tasks as $task=>$row){


    if ($row['dayid']==$i){

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
             <p class="text"><?php echo $row['taskname'];?></p><a class="delete"><img src="img/delbutton.jpg" width="20" height="20" alt="post img"></a>
        </div>
    <?php
    }
}
?>
    </div>
  </div>
   <?php
    }
?>
 </div>
            <div id="tabs-2">
              <?php
               $lenght = count($folders);
              for ($i=1; $i<=$lenght; $i++)
              {


              ?>
               <div class="block" id="<?php echo $folders[$i-1]['id'];?>">
                               <div class="blockinfo"><h2 class="foldern"><?php echo $folders[$i-1]['folder']?></h2><p class="delfolder" id="<?php echo $folders[$i-1]['folder']?>"><img class="ziga" src="img/delfolder.jpg" width="20" height="20" alt="post img"></p></div>
                              <div class="addline" id="1"><a class="add">+</a></div>

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

                           <p class="text"><?php echo $row['taskname'];?></p><a class="delete"><img src="img/delbutton.jpg" width="20" height="20" alt="post img"></a>
                      </div>
                  <?php
                  }
              }
              ?>
                  </div>
                </div>
                 <?php
                  }
              ?>

            </div>
            </div>
         </div>

</div>

</div>
   </div>

</body>

</html>
