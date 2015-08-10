<?php

class UsersController extends BaseController {

//    public function showUsers()
//    {
//        $user = new User;
//
//        return View::make('users.edit')
//            ->with('user', $user)
//            ->with('method', 'post');
//    }
    public $restful = true;

    public function get_index()
    {
        $title = ucwords(Auth::user()->username . "'s Profile Page");
        $photos = Auth::user()->photos()->order_by('created_at', 'desc')->order_by('id', 'desc')->get();

        return View::make('user.index')
            ->with('title', $title)
            ->with('photos', $photos);
    }

    public function get_create()
    {
        $title = "Register";

        return View::make('home.register')
            ->with('title', $title);
    }

    public function post_create()
    {
        $input = Input::all();

        $rules = array(
            'username' => 'required|unique:users',
            'email'    => 'required|unique:users|email',
            'password' => 'required'
        );

        $v = Validator::make($input, $rules);

        if($v->fails())
        {
            return Redirect::to('register')->with_errors($v);
        } else
        {
            $password = $input['password'];
            $password = Hash::make($password);

            $user = new User;
            $user->username = $input['username'];
            $user->email = $input['email'];
            $user->password = $password;
            $user->save();

            return Redirect::to('/');
        }
    }

    public function post_login()
    {
        $input = Input::all();

        $rules = array('email' => 'required|email', 'password' => 'required');

        $v = Validator::make($input, $rules);

        if($v->fails())
        {
            return Redirect::to('/')->with_errors($v);
        } else
        {
            $credentials = array('username' => $input['email'], 'password' => $input['password']);

            if(Auth::attempt($credentials))
            {
                return Redirect::to('profile');
            } else
            {
                return Redirect::to('/');
            }
        }
    }

    public function get_logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }
}