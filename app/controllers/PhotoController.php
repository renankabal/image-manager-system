<?php

/**
 * Created by PhpStorm.
 * User: Lyudmil
 * Date: 16.12.2014
 * Time: 12:32
 */
class PhotoController extends BaseController {

    public $restful = true;

    public function viewDetails($id)
    {
        $photo = Photo::find($id);
        if ($photo === null) {
            $error = 'No such photo found.';
            return View::make('errors.error', array('errorMsg' => $error));
        }

        $comments = Comment::where('photo_id', '=', $photo->id)->with('author')->get();

        return View::make('photo.details', array('photo' => $photo, 'comments' => $comments));
    }

    public function post_upload()
    {
        $input = Input::all();
        if(isset($input['description']))
        {
            $input['description'] = filter_var($input['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        }

        $rules = array(
            'photo'       => 'required|image|max:500',
            'title' => 'required',
            'album' => 'required'
        );

        $v = Validator::make($input, $rules);

        if($v->fails())
        {
            return Redirect::to('profile')->with_errors($v);
        }

        $extension = $input['photo']->guessExtension();
        $directory = public_path() . '\uploads';
        $filename = sha1(Auth::user()->id . time()) . ".{$extension}";

        $upload_success = $input['photo']->move($directory, $filename);

        if($upload_success)
        {
            $photo = new Photo([
                'title' => $input['title'],
                'img_name' => $filename,
                'author_id' => Auth::user()->id,
                'album_id' => $input['album']
                ]);

            $photo->save();
            Session::flash('status_success', 'You have successfully uploaded your new pic!');
        } else
        {
            Session::flash('status_error', 'An error has occured while uploading your pic -- Please Try Again!');
        }

        return Redirect::to('/albums/'.$photo->album_id);
    }
}