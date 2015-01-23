<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class File extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    public static $unguarded = true;



    public static function addfile($data)
    {
        File::create([
            'filename' => 123131

        ]);
    }

    public static function getfff()
    {
        $folders = Folder::all();
        return $folders;


    }
}