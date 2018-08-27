@extends('layouts.app')

@section('content')
	<h1>Edit Profile</h1>
	{{-- Form from LaravelCollective --}}
	{!! Form::open(['action' => ['ProfileController@update', $profile->id], 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
    <div class="form-group">
			{{-- Forename --}}
			{{Form::label('forename', "First Name")}}
			{{Form::text('forename', $profile->forename, ['class' => 'form-control', 'placeholder' => 'First name'])}}
			<br />
    </div>
		<div class="form-group">
			{{-- Surname --}}
			{{Form::label('surname', "Last Name")}}
			{{Form::text('surname', $profile->surname, [ 'class' => 'form-control', 'placeholder' => 'Last name'])}}
		</div>
		<br />
		<div class="form-group">
			{{-- Bio --}}
			{{Form::label('bio', "About You")}}
			{{Form::textarea('bio', $profile->bio, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Tell us bout yourself'])}}
		</div>
		<br />
		<div class="form-group">
			{{-- Gender --}}
			{{Form::label('gender', "Gender")}}
			{{Form::select('gender', $profile->gender, ['Male' => 'Male', 'Female' => 'Female'])}}
		</div>
		<br />
		{{-- Allows us to send a hidden PUT/UPDATE request (instead of POST) --}}
		{{Form::hidden('_method', 'PUT')}}
		{{-- File upload --}}
		{{Form::label('upload', "Upload Image")}}
		<div class="btn-row split swap">
			<div class="form-group">
				{{Form::file('profile_image', null)}}
			</div>
			{{-- Form Submit Button --}}
			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		</div>
	{!! Form::close() !!}
		<hr>
	<a href="/dashboard" class="btn btn-default">Back</a>

@endsection 