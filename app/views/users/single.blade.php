@extends('master')
@section('header')
	<a href="{{url('/')}}">Back to overview</a>
	<h2>
		{{{$user->name}}}
	</h2>
	<a href="{{url('users/'.$user->id.'/edit')}}">
		<span class="glyphicon glyphicon-edit"></span> Edit
	</a>
	<a href="{{url('users/'.$user->id.'/delete')}}">
		<span class="glyphicon glyphicon-trash"></span> Delete
	</a>
@stop
@section('content')
	<p>Date of Birth: {{$user->name}} </p>
@stop