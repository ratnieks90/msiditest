<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Folder extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    public static $unguarded = true;


    public static function getfolders()
    {
        $folders = Folder::all();
        return $folders;


    }
    public static function delfolder($id)
    {
        Folder::where('id', '=', $id['id'])->delete();

    }
    public static function getfolder($data)
    {
        $folder = Folder::where('id', '=', $data['id'])->firstOrFail();
        return $folder;
    }
    public static function addfolder($data)
    {
        Folder::create([
            'folder' => $data['folder']

        ]);
    }
    public static function getlastfolder(){

        $fold = Folder::orderBy('id', 'DESC')->first();
        return $fold;
    }

}
