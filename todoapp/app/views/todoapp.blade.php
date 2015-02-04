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
                <form id ="logform" action="login" method="post">
                            <input class="reg" type="text" name="login" placeholder="Login" id="userlogin">
                            <input class="reg" type="password" name="password" placeholder="Password" id="userpass">
                            <button type="submit" id="logbutton">Login</button>
                </form>
      </div>
      <ul id="logerrors" style="display: none"></ul>
      </div>
      <div id="registerform">
            <div id="registerbox">
                <form id ="regform" action="registration" method="post">
                    <input class="reg" type="text" name="login" placeholder="Login" id="userlog">
                    <input class="reg" type="text" name="name" placeholder="Name" id="username">
                    <input class="reg" type="text" name="surname" placeholder="Surname" id="usersur">
                    <input class="reg" type="text" name="email" placeholder="Email" id="usermail">
                    <input class="reg" type="password" name="pass1" placeholder="Password" id="userpass1">
                    <input class="reg" type="password" name="pass2" placeholder="Repeat password" id="userpass2">
                    <h4 id="question"></h4>
                    <input  id="validate" type="text" maxlength="2" size="2">
                    <button type="submit" id="regbutton">Register</button>
                </form>
            </div>


            <ul id="errors" style="display: none">

            </ul>
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
            <img id="logout" src="img/logout.png" width="25" height="25" alt="post img">
            <h4 id="userinfo"></h4>
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
                   <h3 class="managenames" id="subtasks228">Subtasks</h3>
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
                               <div class="blockinfo"><h2 class="foldern"><?php echo $folders[$i-1]['folder']?></h2><p class="delfolder" id="<?php echo $folders[$i-1]['folder']?>"><img class="ziga" src="img/delfolder.jpg" width="20" height="20" alt="post img"></p></div>
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
