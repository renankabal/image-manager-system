<?php

class Vote extends \Eloquent {
	protected $fillable = array('value', 'album_id', 'voter_id');

	public function album()
	{
		return $this->belongsTo('Album');
	}

	public function voter()
	{
		return $this->belongsTo('User');
	}
}