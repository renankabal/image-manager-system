<?php

class AlbumsController extends BaseController
{


    public function viewPhotos($id)
    {
        $album = Album::find($id);
        if ($album === null) {
            $error = 'Invalid album.';
            return View::make('errors.error', array('errorMsg' => $error));
        }

        if (Auth::user()) {
            $isVoted = sizeof(Vote::where('album_id', '=', $album->id)->where('voter_id', '=', Auth::user()->id)->get()) !== 0;            # code...
        } else {
            $isVoted = true;
        }

        $comments = Comment::where('album_id', '=', $album->id)->with('author')->get();

        return View::make('albums.viewPhotos', array('photos' => $album->photos()->get(),
         'comments' => $comments, 'albumId' => $album->id, 'isVoted' => $isVoted));
    }

    public function viewAllAlbums()
    {
        $allAlbums = Album::with('owner')->get();

        return View::make('albums.allAlbums', array('albums' => $allAlbums));
    }

    public function viewOwnAlbums()
    {
        $allAlbums = DB::table('albums');
        $ownAlbums = $allAlbums->where('owner_id', '=', Auth::user()->id)->get();
        return View::make('albums.ownAlbums', array('ownAlbums' => $ownAlbums));
    }

	public function getCreate()
	{
		return View::make('albums.create');
	}

	public function postCreate()
	{
		//Todo: validate
		$name = $_POST['name'];
		if ($name === '') {
			return View::make('albums.create');
		}

		$album = new Album();
		$album->name = $name;
		$album->owner_id = Auth::user()->id;
		$album->save();

		return Redirect::to('/albums/own');
	}

    public function getEdit($id)
    {
        $album = Album::find($id);
        if($album === null){
            $error = 'Invalid album.';
            return View::make('errors.error', array('errorMsg' => $error));
        }
        if($album->owner_id !== Auth::user()->id){
            $error = 'You don\'t have permission to edit this album.';
            return View::make('errors.error', array('errorMsg' => $error));
        }
        return View::make('albums.edit',array('album' => $album ));
    }

    public function putEdit($id)
    {
        $album = Album::find($id);
        $putData = file_get_contents('php://input', 'r');
        if($album === null) {
            $error = 'Invalid album.';
            return View::make('errors.error', array('errorMsg' => $error));
        }

        if($album->owner_id !== Auth::user()->id) {
            $error = 'You don\'t have permission to edit this album.';
            return View::make('errors.error', array('errorMsg' => $error));
        }

        $parsedData = [];
        parse_str($putData, $parsedData);
        
        if(strlen($parsedData['name']) === 0) {
            $error = 'Cannot rename album to empty string!';
            return View::make('errors.error', array('errorMsg' => $error));
        }

        $album->name = $parsedData['name'];
        $album->save();

        return Redirect::to('/albums/own');
    }

    public function delete($id)
    {
        $album = Album::find($id);
        if($album === null){
            $error = 'Invalid album.';
            return View::make('errors.error', array('errorMsg' => $error));
        }

        if($album->owner_id !== Auth::user()->id){
            $error = 'You don\'t have permission to delete this album. You are not it\'s owner.';
            return View::make('errors.error', array('errorMsg' => $error));
        }

        //delete all photos
        Photo::where('album_id', '=', $album->id)->delete();
        //delete album
        $album->delete();
        return Redirect::to('/albums/own');
    }
}