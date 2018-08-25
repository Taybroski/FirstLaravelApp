@extends('layouts.app')

@section('content')
	<h1>Edit Post</h1>

	<div class="form-group">
		{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
			{{-- Form Title --}}
			{{Form::label('title', "Title")}}
			{{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
			<br />
			{{-- Form Body --}}
			{{Form::label('body', "Body")}}
			{{Form::textarea('body', $post->body, [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Type here'])}}
			<br />
			{{-- Allows us to send a hidden PUT request (instead of POST) --}}
			{{Form::hidden('_method', 'PUT')}}
			{{-- File upload --}}
			{{Form::label('upload', "Upload Image")}}
			<br />
			{{Form::file('cover_image', null)}}
			<br />
			<br />
			<div class="btn-row split">
			{{-- Form Submit Button --}}
			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!} 

		{!! Form::open(['action' => ['PostsController@destroy', $post->id], 
										'method' => 'POST', 
										'class' => 'pull-right', 
										'onsubmit' => 'return ConfirmDelete()']) !!}
			{!! Form::hidden('_method', 'DELETE') !!}
			{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		{!! Form::close() !!}
			</div>
	</div>

	<a href="/posts/{{$post->id}}" class="btn btn-default">Back</a>

	{{-- Confirm Post Delete Script --}}
	<script>
			function ConfirmDelete(){
			return confirm('Are you sure?');
			}
		</script>

@endsection 