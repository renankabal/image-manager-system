@extends('master')

@section('content')
	<div id="photo-details">
		<h1>{{$photo->title}}</h1>
		<div id="photo-preview">
			<img src="/uploads/{{$photo->img_name}}" alt="{{$photo->title}}">
		</div>
		<p>
			<em>Added on: </em>{{$photo->created_at}}
		</p>
		<span>
			<a href="/uploads/{{$photo->img_name}}" download="{{$photo->title}}">Download photo</a>
		</span>
	</div>
	<div id="comment-section">
		<h3>Comments:</h3>
		<div>
			<div>
				{{ Form::open(array('url' => "/comments/$photo->id/photo", 'method' => 'post')) }}
				{{ Form::textarea('content', '', array('placeholder' => 'Comment...', 'class' => 'span5', 'rows' => "5")) }}
			</div>
			<p>
				<input type="submit" name="submit" class="btn btn-success" value="Send comment" />
				{{ Form::close() }}
			</p>
		</div>
		<div>
		@foreach($comments as $comment)
			<div>
				<div class="comment-content">{{$comment->content}}</div>
				<div class="author">
					<span class="pull-left">	
						<strong><em>Author: </em></strong>{{$comment->author->username}}
					</span>
					<span>	
						<strong><em>Comment on: </em></strong>{{$comment->created_at}}
					</span>
				</div>
			</div>
		@endforeach
		</div>
	</div>
@stop