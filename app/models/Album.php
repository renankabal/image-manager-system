<?php

class Album extends \Eloquent {
	protected $fillable = [];

	public function photos()
	{
		return $this->hasMany('Photo');
	}

	public function owner()
	{
		return $this->belongsTo('User');
	}
}