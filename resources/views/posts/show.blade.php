@extends('layouts.app')

@section('content')

	<div>
		<img style="width:40%; border-radius:5px" src="/storage/cover_images/{{$post->cover_image}}">
		<br />
		<br />
		<h1>{{$post->title}}</h1>
		<small>By {{$post->author}} - {{$post->created_at}}</small>
		<BR />
		<div>
			{{-- By using !! instead of {{}}, it will parse the HTML instead of the displaying raw code. --}}
			{!!$post->body!!}
		</div>
	</div>
	<br />
	<a href="/posts" class="btn btn-default">Back</a>
	<hr>

	{{-- Edit / Delete buttons for auth users --}}
	@if(!Auth::guest())
		@if(Auth::user()->id == $post->user_id)
			<div class="split">
				<a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a>
				<div>
					{!! Form::open(['action' => ['PostsController@destroy', $post->id], 
													'method' => 'POST', 
													'class' => 'pull-right', 
													'onsubmit' => 'return ConfirmDelete()']) 
					!!}
						{!! Form::hidden('_method', 'DELETE') !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		@endif
	@endif
@endsection