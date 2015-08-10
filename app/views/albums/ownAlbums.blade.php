@extends('master')

@section('content')
<div class="span12"><h1>Own Albums</h1></div>
<div class="row">
	@foreach($ownAlbums as $album)
	<div class="span3">
		<div class="thumbnail">
		<a href="/albums/{{$album->id}}">
			<img src="/img/album-default.png" alt="{{$album->name}}">
			<div class="caption">
				<h3>{{$album->name}}</h3>
				<strong>Rank: </strong>{{$album->rank}}
			</div>
		</a>
				<p>
					<a href="/albums/{{$album->id}}/edit" class="btn btn-primary" role="button">Edit</a>
					<a href="/albums/{{$album->id}}/delete" class="btn btn-danger" role="button">Delete</a>
				</p>
		</div>
	</div>
	@endforeach
</div>
@stop