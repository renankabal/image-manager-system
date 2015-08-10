@extends('master')
@section('header')
	<a href="{{('users/'.$user->id.'')}}">&larr; Cancel </a>
	<h2>
		@if($method == 'post')
			Add a new user
		@elseif($method == 'delete')
			Delete {{$user->name}}?
		@else
			Edit {{$user->name}}
		@endif
	</h2>
@stop
@section('content')
	{{Form::model($user, array('method' => $method, 'url'=>
	'users/'.$user->id))}}
	@unless($method == 'delete')
		<div class="form-group">
			{{Form::label('Nickname')}}
			{{Form::text('nickname')}}
		</div>
		<div class="form-group">
			{{Form::label('Full name')}}
			{{Form::text('fullname')}}
		</div>
		<div class="form-group">
			{{Form::label('Email Address')}}
			{{Form::text('email')}}
		</div>
		<div class="form-group">
			{{Form::label('Date of birth')}}
			{{Form::text('date_of_birth')}}
		</div>
		{{Form::submit("Save", array("class"=>"btn btn-default"))}}
		@else
			{{Form::submit("Delete", array("class"=>"btn btn-default"))}}
		@endif
		{{Form::close()}}
@stop