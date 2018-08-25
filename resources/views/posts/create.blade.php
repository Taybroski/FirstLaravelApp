@extends('layouts.app')

@section('content')
	<h1>Create Post</h1>
	{{-- Form from LaravelCollective --}}
	{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
    <div class="form-group">
			{{-- Form Title --}}
			{{Form::label('title', "Title")}}
			{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
			<br />
    </div>
		<div class="form-group">
			{{-- Form Body --}}
			{{Form::label('body', "Body")}}
			{{Form::textarea('body', '', [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Type here'])}}
		</div>
		<br />
		{{-- File upload --}}
		{{Form::label('upload', "Upload Image")}}
		<div class="btn-row split swap">
			<div class="form-group">
				{{Form::file('cover_image', null)}}
			</div>
			{{-- Form Submit Button --}}
			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		</div>
	{!! Form::close() !!}
		<hr>
	<a href="/posts" class="btn btn-default">Back</a>

@endsection 