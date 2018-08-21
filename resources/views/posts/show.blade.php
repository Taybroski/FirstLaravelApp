@extends('layouts.app')

@section('content')

	<div>
		<h3>{{$post->title}}</h3>
		@if ($post->author == '')
			<small>By Unknown - {{$post->created_at}}</small>
		@else
			<small>By {{$post->author}} - {{$post->created_at}}</small>
		@endif
		<div>
			{{-- By using !! instead of {{}}, it will parse the HTML instead of the displaying raw code. --}}
			{!!$post->body!!}
		</div>
	</div>
	<br />
	<a href="/posts" class="btn btn-default">Back</a>
	<hr>
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