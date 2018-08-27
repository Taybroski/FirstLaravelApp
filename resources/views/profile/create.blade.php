@extends('layouts.app')

@section('content')
	<h1>Create Profile</h1>
	{{-- Form from LaravelCollective --}}
	{!! Form::open(['action' => 'ProfileController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
	<div class="form-group">
    {{-- Forename --}}
			{{Form::label('forename', "First Name")}}
			{{Form::text('forename', '', ['class' => 'form-control', 'placeholder' => 'First name'])}}
			<br />
    </div>
		<div class="form-group">
			{{-- Surname --}}
			{{Form::label('surname', "Last Name")}}
			{{Form::text('surname', '', [ 'class' => 'form-control', 'placeholder' => 'Last name'])}}
		</div>
		<br />
		<div class="form-group">
			{{-- Gender --}}
			{{Form::label('gender', "Gender")}}
			<br />
			{{Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'])}}
		</div>
		<div class="form-group">
			{{-- DOB --}}
			{{Form::label('dob', "Date of Birth")}}
			<br />
			<small>DAY</small>
			{{Form::selectRange('day', 1, 31)}}
			<small>MONTH</small>
			{{Form::selectMonth('month')}}
			<small>YEAR</small>
			{{Form::selectRange('year', 1900, date('Y'))}}
		</div>
		<div class="form-group">
			{{-- Bio --}}
			{{Form::label('bio', "About You")}}
			{{Form::textarea('bio', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Tell us bout yourself'])}}
		</div>
		<br />
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
	<a href="/posts" class="btn btn-default">Back</a>

@endsection 