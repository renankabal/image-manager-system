<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Photo Album&copy;</title>
	{{HTML::script('js/jquery.js') }}
	{{HTML::script('js/bootstrap.js') }}
	{{HTML::script('js/modal.js') }}
	{{HTML::style('css/bootstrap.css') }}
	{{HTML::style('css/photoalbum.css') }}
</head>
<body>
	<div class="row-fluid">
		<div class="span12 well">
			<h1>Awesome Photo Album</h1>
		</div>
	</div>
	<div class="row">
		<div class="span3">
			<ul class="nav nav-list">
				@if(Auth::user())
					<li class="nav-header">{{ ucwords(Auth::user()->username) }}</li>
				@endif
					<li>{{ HTML::link('/', 'Home') }}</li>
					<li>{{ HTML::link('/albums', 'View all albums') }}</li>
				@if(Auth::user())
					<li>{{ HTML::link('/albums/own', 'View your albums') }}</li>
					<li>{{ HTML::link('/albums/create', 'Create a album') }}</li>
					<li>{{ HTML::link('', 'Upload photos', array('onclick' => 'showModal(); return false')) }}</li>
					<li>{{ HTML::link('logout', 'Logout') }}</li>
				@else
					<li>{{ HTML::link('login', 'Login') }}</li>
				@endif
			</ul>
		</div>
		<div class="span9">
			@yield('content')
		</div>
	</div>
	@section('form-modals')
		@if (Auth::check())
			@include('plugins.upload_modal')
		@endif
</body>
</html>