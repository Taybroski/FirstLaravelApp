@extends('layouts.app')

@section('content')
	<h1>Create Post</h1>

	{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
    <div class="form-group">
			{{-- Form Title --}}
			{{Form::label('title', "Title")}}
			{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
			<br />
			{{-- Form Body --}}
			{{Form::label('body', "Body")}}
			{{Form::textarea('body', '', [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Type here'])}}
			<br />
			{{-- Form Submit Button --}}
			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    </div>
	{!! Form::close() !!}

	<a href="/posts" class="btn btn-default">Back</a>

@endsection 