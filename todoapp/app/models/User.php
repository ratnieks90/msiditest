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

    public static function reguser($data)
    {
        User::create([
            'name'=>$data['name'],
            'surname'=>$data['surname'],
            'password'=>$data['pass1']

        ]);


    }
    public static function loguser($data){
        $user = User::where(['name' => $data['name'], 'password' => $data['pass']])->firstOrFail();

        return $user;
    }

}
