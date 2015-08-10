@extends('master')

@section('content')
    <div class="span12"><h1>All Albums</h1></div>
    <div class="row">
    	@foreach($albums as $album)
    	<div class="span3">
    		<div class="thumbnail">
    		<a href="/albums/{{$album->id}}">
    			<img src="/img/album-default.png" alt="{{$album->name}}">
    			<div class="caption">
    				<h3>{{$album->name}}</h3>
    			</div>
    		</a>
            <p>
                <strong>Rank: </strong>{{$album->rank}}<br />
                <strong>Owner: </strong>{{$album->owner->username}}<br />
                <strong>Created at: </strong>{{$album->created_at}}
            </p>
    		</div>
    	</div>
    	@endforeach
    </div>
@stop