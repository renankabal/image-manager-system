<?php

class Comment extends \Eloquent {
	protected $fillable = array('content', 'author_id', 'photo_id', 'album_id');

	public function author()
	{
		return $this->belongsTo('User');
	}

	public function photo()
	{
		return $this->belongsTo('Photo');
	}
}