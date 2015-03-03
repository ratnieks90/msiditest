<?php

class HomeController extends BaseController {

	public function index()
    {
      if (Auth::user()){
            return Redirect::to('/app');}

else {

        return View::make('main');

    }
       /* $tasks = Task::showtasks();
        $folders = Folder::getfolders();
        return View::make('training')->with('tasks', $tasks)->with('folders', $folders);;*/
    }
    public function reguser()
    {
        if (Auth::user()){
            return Redirect::to('/app');}
        // $tasks = Task::showtasks();
        else {
            // $tasks = Task::showtasks();

            // $folders = Folder::getfolders();
            return View::make('regpage');
        }
        //return View::make('todoapp')->with('tasks', $tasks)->with('folders', $folders);

    }
    public function app (){
         $tasks = Task::showtasks();

         $folders = Folder::getfolders();
        return View::make('todoapp')->with('tasks', $tasks)->with('folders', $folders);
    }


public function myapp (){
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
    public function updatesubtask() {
        $data = Input::all();
        Subtask::updatesub($data);
        return $data;
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
    public function reguser2(){
       $data = Input::all();
       $validator = Validator::make($data,
            [
                'login' => 'required|min:4|max:40|unique:users',
                'username' => 'required|min:3|alpha|max:50',
                'usersurname' => 'required|min:3|alpha',
                'email' => 'required|min:3|email|unique:users|max:50',
                'pass1' => 'required|min:5|max:50',
                'pass2' => 'required|min:5|max:50|same:pass1',
                'code' => 'required|captcha'
            ],
           [
               'captcha' => 'Invalid captcha'
            ]
       );
            if($validator->fails()){
                return Redirect::back()->with('errors', $validator->errors())->withInput(Input::except('pass1', 'pass2'));


             }else {
                    User::reguser($data);
                return Redirect::to('/registration')->with('message','Registration was successful!!!');
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
            return Redirect::back()->with('errors', $validator->errors())->withInput();
        }

        if (Auth::attempt(['login' => $data['login'], 'password' => $data['password']])) {
            Session::put('username', Auth::user()->login);
            Session::put('userid', Auth::user()->id);
            return Redirect::to('/app');
        } else {
            return Redirect::back()->withMessage('Login or password is wrong')->withInput();
        }



    }
    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('/'); // redirect the user to the login screen
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
    public function noteupdate(){
        $data = Input::all();
        Task::updatenote($data);
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
    public function profileimg() {
        $id = Input::all('profileid');
        $data['zz'] = $id['profileid'];
        $validator = Validator::make(Input::all(),[
                'image'=> 'mimes:png,jpg,jpeg|max:1000'
        ]) ;
        if($validator->fails()){
            return ['success'=> false,
                    'error'=>$validator->errors()->toArray()
                    ];
        }else {

            $file = (Input::file('image'));
            $destination = 'profileimg/';
            $filename = date('Y,m,d-H,i,s-').$file->getClientOriginalName();
            $upload_success = $file->move($destination, $filename);
            if($upload_success) {
            $data['img'] = $filename;
            User::addimg($data);
            return ['success'=> true,
                    'error'=> 'image uploaded sucessfuly',
                    'img'=> $filename
            ];
            }
        }

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
    public function logout(){
        if(Session::has('username')){
            Session::flush();
            return ['sucess' => true];
        }else{
           return ['sucess' => false];
        }


    }
    public function kapcha() {
        $data = Input::all();
        $validator = Validator::make($data,
            [
                'kapcha' => 'required|captcha',

            ]);
        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()];
        }else return 'ziga';
    }

    public function getfolders2(){

            $folders = Folder::getfolders();
            return $folders;
        }
    public function status() {
        $data = Input::all();
        $task = Task::gettask($data);

        if ($task['status'] == 0) {
            $data['status'] = 1;
            Task::updatestatus($data);
        }if ($task['status'] == 1){
            $data['status'] = 0;
            Task::updatestatus($data);
        }
    }
    public function foldupdt() {
        $data = Input::all();
        Task::update_task_folder($data);

    }
    public function savesorting()
    {
        $data = Input::all();
       $a =  implode(',',$data['tasks']);
        $data['tasks'] = $a;
        Folder::savepos($data);
        $order = Folder::getfolders();
        $array = explode(',' ,$order[0]['positions']);

        return $array;
    }
    public function getuserinfo2() {
        $data = Input::all();
        $user = User::getuserinfo($data);
        return $user;

    }
    public function updtname() {
        $data = Input::all();
        User::updtname($data);

    }
    public function updtsurname() {
        $data = Input::all();
        User::updtsurname($data);

    }
    public function updtemail()
    {
        $data = Input::all();
        $validator = Validator::make(Input::all(), [
            'email' => 'required|min:3|email|unique:users|max:50',
        ]);
        if ($validator->fails()) {
            return ['success' => false,
                'error' => $validator->errors()->toArray()
            ];
        } else {
            User::updtemail($data);
            return ['success' => true,
                'error' => 'ok'
            ];
        }
    }
}