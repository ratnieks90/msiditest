<?php

class HomeController extends BaseController {

	public function index()
    {

        $tasks = Task::showtasks();

        $folders = Folder::getfolders();
        return View::make('todoapp')->with('tasks', $tasks)->with('folders', $folders);

    }



    public function showtasks(){
        $data = Task::showtasks();


        return $data;
    }

    public function getfolders(){
        $data = Folder::getfolders();
        $folder = json_encode($data);
        return $folder;
    }

    public function addtask(){
            $data = Input::all();
            Task::addtask($data);
        $user = Task::getlast();
        return $user;
    }


    public function gettaskinfo()
    {
        $data = Input::all();
        $task = Task::gettask($data);
        $subtasks = Subtask::get_subtasks_byid($data);


        return $task;
    }


    public function deletetask()
    {
        $data = Input::all();
        Task::deletetask($data);
        Subtask::deletesubbytaskid($data);
        Note::deletenotebytaskid($data);

    }
    public function delfolder()
    {
        $data = Input::all();
        $tasks = Task::get_tasksby_folderid($data);
        Task::updatefolderid($data);
        Folder::delfolder($data);
        return $tasks;

    }
    public function updttask(){
        $data = Input::all();
        Task::updatetaskname($data);

    }
    public function getsubtask(){
        $data = Input::all();
        $subtasks = Subtask::get_subtasks_byid($data);
        return $subtasks;
    }
    public function delsub(){
        $data = Input::all();
        Subtask::deletesub($data);



    }
    public function addsubtask(){
        $data = Input::all();
        Subtask::addsubtask($data);
        $last = Subtask::getlastsub();

        return $last;
    }
    public function getfold(){
        $data = Input::all();
        $folders = Folder::getfolders();
        return $folders;
    }
    public function newfolder(){
        $data = Input::all();
        Folder::addfolder($data);
        $folder = Folder::getlastfolder();
        return $folder;
    }
    public function reguser(){
        $data = Input::all();
        User::reguser($data);
        return $data;
    }
    public function loguser(){
        $data = Input::all();
       $user = User::loguser($data);
        return $user;
    }
    public function updatefolder1(){
        $data = Input::all();
        if($data['colid'] < 5 ){
            Task::uodate_task_day($data);

        }
        else {
            Task::update_task_folder($data);
        }

    }
    public function addnote(){
        $data = Input::all();
        Note::addnote($data);
        $note = Note::getlastnote();
        return $note;
    }
    public function getnotes(){
        $data = Input::all();
        $notes = Note::get_note_byid($data);
        return $notes;
    }
    public function deletenotes()
    {
        $data = Input::all();
        Note::deletenote($data);
    }

}
