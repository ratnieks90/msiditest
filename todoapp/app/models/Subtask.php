<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Subtask extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    public static $unguarded = true;


    public static function get_subtasks_byid ($id)
        {
            $subtasks = Subtask::where('taskid', '=', $id['id'])->take(100)->get();
            return $subtasks;
        }
    public static function deletesub($id){

        Subtask::where('id', '=', $id['id'])->delete();
    }
    public static function addsubtask($data)
    {
        Subtask::create([
            'subtask' => $data['subtask'],
            'taskid' => $data['taskid']


        ]);
    }
    public static function getlastsub(){

        $sub = Subtask::orderBy('id', 'DESC')->first();
        return $sub;
    }
    public static function deletesubbytaskid($id){

        Subtask::where('taskid', '=', $id['id'])->delete();
    }

}