<div class="modal hide" id="upload_modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h3>Upload A New Pic</h3>
	</div>
	<div class="modal-body">
		{{ Form::open(array('files' => true, 'url' => '/upload', 'id' => 'upload_modal_form', 'enctype' => 'multipart/form-data')) }}		
		{{ Form::label('title', 'Title') }}
		{{ Form::text('title', '', array('placeholder' => 'Your photo title here!', 'id' => 'title', 'class' => 'span5')) }}
		{{ Form::label('photo', 'Photo') }}
		{{ Form::file('photo') }}
		@section('')
		{{ $albums = Album::where('owner_id', '=', Auth::user()->id)->get() }}
		@endsection
		{{ Form::label('album', 'Album') }}
		<select name="album">
		@foreach($albums as $album)
			<option value="{{$album->id}}">{{$album->name}}</option>
		@endforeach
		</select>
		{{ Form::close() }}
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Cancel</a>
		<button type="button" onclick="$('#upload_modal_form').submit();" class="btn btn-primary">Upload Pic</button>
	</div>
</div>