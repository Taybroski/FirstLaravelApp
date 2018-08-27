@extends('layouts.app')

@section('content')

	{{-- <h1>{{$user->name}}</h1> --}}

	@if(count($posts) > 0)
		@foreach($posts as $p)
			<ul class="list-group">
				<lic class="list-group-item">{{$p->title}}</li>
			</ul>
		@endforeach
	@endif

@endsection