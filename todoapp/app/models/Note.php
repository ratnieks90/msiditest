<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Note extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    public static $unguarded = true;


    public static function get_note_byid ($id)
    {
        $notes = Note::where('taskid', '=', $id['id'])->take(100)->get();
        return $notes;
    }
    public static function deletenote($id){

        Note::where('id', '=', $id['id'])->delete();
    }
    public static function addnote($data)
    {
        Note::wherwe([
            'notes' => $data['note'],
            'taskid' => $data['taskid']


        ]);
    }
    public static function getlastnote(){

        $note = Note::orderBy('id', 'DESC')->first();
        return $note;
    }
    public static function deletenotebytaskid($id){

        Note::where('taskid', '=', $id['id'])->delete();
    }

}