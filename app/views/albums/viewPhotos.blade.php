@extends('master')

@section('content')
<div class="span12"><h1>Album Photos</h1></div>
    @if(!$isVoted)
    <div id="voting">
        <p>Vote for this album</p>
        {{ Form::open(array('url' => "/votes/$albumId", 'method' => 'post')) }}
        <p>
        {{ Form::selectRange('vote', 1, 10) }}
        </p>
        <input type="submit" class="btn btn-mini" name="submit" value="Vote!">
        {{ Form::close() }}
    </div>
    @endif
    <div class="row">
    	@foreach($photos as $photo)
    	<div class="span3">
    		<div class="thumbnail">
    		<a href="/photo/{{$photo->id}}">
    			<img src="/uploads/{{$photo->img_name}}" alt="{{$photo->title}}">
    			<div class="caption">
    				<h3>{{$photo->title}}</h3>
    			</div>
    		</a>
    		<p>Added on: {{$photo->created_at}}</p>
    		</div>
    	</div>
    	@endforeach
    </div>
    <div id="comment-section">
            <h3>Comments:</h3>
            <div>
                <div>
                    {{ Form::open(array('url' => "/comments/$albumId/album", 'method' => 'post')) }}
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