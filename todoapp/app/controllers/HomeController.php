<?php

class HomeController extends BaseController {

	public function index()
    {

        $tasks = Task::showtasks();

        $folders = Folder::getfolders();
        //return View::make('training');
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
        $validator = Validator::make($data,
            [
                'login' => 'required|min:4|max:40|unique:users',
                'name' => 'required|min:3|alpha|max:50',
                'surname' => 'required|min:3|alpha',
                'email' => 'required|min:3|email|unique:users|max:50',
                'pass1' => 'required|min:5|max:50',
                'pass2' => 'required|min:5|max:50|same:pass1'
            ]);
            if($validator->fails()){
                 return [
                        'sucess' => false,
                        'errors' =>$validator->errors()];
             }else {
                    User::reguser($data);
                    return ['sucess' => true];
              }
    }
    public function loguser()
    {
        $data = Input::all();
        $validator = Validator::make($data,
            [
                'login' => 'required|min:4',
                'password' => 'required|min:5'
            ]);
        if ($validator->fails()) {
            return [
                'sucess' => 1,
                'errors' => $validator->errors()];
        }
            if (Auth::attempt(['login' => $data['login'], 'password' => $data['password']])) {

                return[
                    'sucess' => 2,
                    'user' =>Auth::user()
                        ];
            } else {
                return [
                'sucess' => 3,
                    'user' => 'This user not exist'];
            }


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


    public function upfiles()
    {
        $taskid = Input::all('taskid');
        $file = Input::file('file');
        $destination = 'uploads/';
        $filesize = $file->getSize();
        $filename = date('Y,m,d-H,i,s-').$file->getClientOriginalName();
        $replace = [" ","%",":"];
        $filename2 = str_replace($replace, "", $filename);
        $data = [$taskid['taskid'], $filesize, $filename2];
        Subnote::getsubnotes($data);
        $file->move($destination, $filename2);





                }
    public function getfiles() {
        $data = Input::all();
        $files = Subnote::getfilesbyid($data);
        return $files;

    }
    public function getlast() {
        $lastfile = Subnote::getlastfile();
        return $lastfile;
    }
    public function delitefile(){
        $data = Input::all();
        Subnote::deletefile($data);
        File::delete('uploads/'.$data['filename']);

    }

}