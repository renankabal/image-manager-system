<?php

class Category extends \Eloquent {
	protected $fillable = [];

	public function photos()
	{
		return $this->hasMany('Photo');
	}
}