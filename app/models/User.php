<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function users(){
		return $this->hasMany('User');
	}

	public function owns(User $user){
		return $this->id == $user->owner;
	}

	public function canEdit(User $user){
		return $this->is_admin or $this->owns($user);
	}

	public function albums()
	{
		return $this->hasMany('Album');
	}

	public function photos()
	{
		return $this->hasMany('Photo');
	}

	public function comments()
	{
		return $this->hasMany('Comment');
	}
}
