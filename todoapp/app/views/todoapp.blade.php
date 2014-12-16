<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset ('css/todoapp.css') }}">
    <script src="{{ asset ('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{ asset ('js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset ('js/custom.js')}}"></script>

    <title>todo</title>

</head>
<body>
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
                 <h2>Update task</h2>
                 <input id="update">
                 <button id="updttask">Update</button>
                 </div>
                 <div id="updtfolder">
                 <form id="taskfolders">

                                 </form>
                  <button id="getfolder">Update</button>
                                 </div>

                  <div id="managesubs">
                  <h2>Manage subtasks</h2>
                  <input id="newsub" placeholder="add subtask ">
                 <ul id="subtasklist"></ul>

                 </div>
                 <h2 id="backtask">go to main</h2>
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
