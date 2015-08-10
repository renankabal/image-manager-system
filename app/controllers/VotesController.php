<?php
class VotesController extends BaseController {
	public function vote($id)
	{
		$album = Album::find($id);
		if ($album === null) {
            $error = 'Can not vote. No such album found.';
            return View::make('errors.error', array('errorMsg' => $error));
		}

		$input = Input::all();
		if (1 > $input['vote'] || $input['vote'] > 10) {
            $error = 'Invalid vote. Must be between 1 and 10.';
            return View::make('errors.error', array('errorMsg' => $error));
		}

		$vote = new Vote([
			'value' => $input['vote'],
			'album_id' => $album->id,
			'voter_id' => Auth::user()->id
			]);

		$album->rank = $album->rank + $vote->value;
		$album->save();
		$vote->save();

		return Redirect::to('/albums/'.$album->id);
	}
}