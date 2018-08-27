@extends('layouts.app')

@section('content')

	<h1>{{$username}}</h1>

	@if(count($posts) > 0)
		@foreach($posts as $p)
			<ul>
				<li>{{$p->title}}</li>
			</ul>
		@endforeach
	@endif

@endsection