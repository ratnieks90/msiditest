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
            'login'=>$data['login'],
            'name'=>$data['username'],
            'surname'=>$data['usersurname'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['pass1'])

        ]);


    }
    public static function addimg($data) {
        User::where('id', '=', $data['zz'])->update([
            'img'=>$data['img']
        ]);
    }
    public static function getuserinfo($data) {
        $user = User::where('id', '=', $data['userid'])->firstOrFail();
        return $user;
    }

    public static function updtname($data) {
        User::where('id', '=', $data['userid'])->update([
            'name'=>$data['name']
        ]);
    }
    public static function updtsurname($data) {
        User::where('id', '=', $data['userid'])->update([
            'surname'=>$data['surname']
        ]);
    }
    public static function updtemail($data) {
        User::where('id', '=', $data['userid'])->update([
            'email'=>$data['email']
        ]);
    }
}
