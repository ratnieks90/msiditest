<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
    public static $unguarded = true;

	protected $table = 'users';
	protected $hidden = array('password', 'remember_token');

    public static function getuser()
    {
        $users = User::all();
        return $users;


    }

}
