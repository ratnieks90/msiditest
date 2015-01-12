<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset ('css/todoapp.css') }}">
    <script src="{{ asset ('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{ asset ('js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset ('js/custom.js')}}"></script>

    <title>todo</title>
 <script>

  </script>
</head>
<body>
<div id="mainpg">
    <div id="mytabs">
      <div id="mainlist">
      <ul>
       <li class="mainlist" id="reg">Registration</li>
       <li class="mainlist" id="log">Login</li>
      </ul>
      </div>
      <div id="loginform">
      <div id="loginbox">
      Name<br><br>
      <input id="logname" type="text">
      <br><br>
      Password<br><br>
      <input id="logpass" type="password">
      <br><br>
      <button id="connect">Login</button>
      </div>
      <ul id="logerrors"></ul>
      </div>
      <div id="registerform">
      <div id="registerbox">
            Name<br><br>
            <input id="name"  type="text">
            <br><br>
            Surname<br><br>
            <input id="surname" type="text">
            <br><br>
             Password<br><br>
             <input id="pass1" type="password">
             <br><br>
             Repeat password<br><br>
             <input id="pass2" type="password">
             <br><br>
      <button id="register">Register</button>
            </div>
            <ul id="errors"></ul>
       </div>
    </div>
</div>
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
            <h4 id="userinfo">Juris Ratnieks</h4>
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
                <h2 id="dayid" style="display: none"></h2>
                <input id="newtask" placeholder="I want to...">
                <form id="folderlist2">

                </form>
                <input id="dateadd" type="date">
                <button id="addtaskbutton">Add task</button>
                <h2 id="gotomain">Back to main</h2>
            </div>
        </div>


        <div id="taskinfo">
            <div id="info">
                 <p id="taskid" style="display: none"></p>
                 <div id="tasknameupdt">
                 <input id="update">
                 <button id="updttask">Update</button>
                 </div>
            </div>
            <h2 id="backtask">go to main</h2>
            <div id="manageform">
                   <h3 class="managenames" id="notes">Notes</h3>
                   <h3 class="managenames" id="subtasks2">Subtasks</h3>
                   <h3 class="managenames" id="filename">Attachments</h3>
                  <div class="manage" id="managesubs" style="display: none">
                  <h2>Manage subtasks</h2>
                  <input id="newsub" placeholder="add subtask ">
                 <ul id="subtasklist"></ul>
                 </div>
                 <div class="manage" id="managenotes">
                 <h2>Manage notes</h2>
                 <input id="newnote" placeholder="add note ">
                 <ul id="notelist"></ul>
                 </div>
                 <div class="manage" id="managefiles" style="display: none">There will be file uploading
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
                 <h2><?php echo $days[$i-1];?></h2>
                <div class="addline" id="<?php echo $i;?>"><a class="add">+</a></div>

                    <div class="item-column">
<?php
    foreach ($tasks as $task=>$row){


    if ($row['dayid']==$i){
    ?>
    <div class="taskcont" id="<?php echo $row['id'];?>">

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
                               <div class="blockinfo"><h2 class="foldern"><?php echo $folders[$i-1]['folder']?></h2><p class="delfolder" id="<?php echo $folders[$i-1]['folder']?>">Del</p></div>
                              <div class="addline" id="1"><a class="add">+</a></div>

                                  <div class="item-column">
              <?php
                  foreach ($tasks as $task=>$row){


                  if ($row['folderid']==$folders[$i-1]['id']){
                  ?>
                  <div class="taskcont" id="<?php echo $row['id'];?>">

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



</body>

</html>
