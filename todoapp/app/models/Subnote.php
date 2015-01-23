<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Subnote extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    public static $unguarded = true;


    public static function getsubnotes($data)
    {
        Subnote::create([
            'fname' => $data[2],
            'taskid' => $data[0],
            'size' => $data[1]
        ]);

    }
    public static function getfilesbyid($data){
        $files = Subnote::where('taskid', '=', $data['id'])->take(100)->get();
        return $files;

    }
    public static function getlastfile(){

        $file = Subnote::orderBy('id', 'DESC')->first();
        return $file;
    }
    public static function deletefile($id){

        Subnote::where('fname', '=', $id['filename'])->delete();
    }

}