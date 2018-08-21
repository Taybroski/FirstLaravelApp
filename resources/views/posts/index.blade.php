@extends('layouts.app')

@section('content')
	<h1>Posts</h1>
	@if(count($posts) > 0 ) 
		@foreach($posts as $p)
			<div class="mb-08 card card-body bg-light">
				<div class="pre_post">
				<div class="row">
					<h3><a href="/posts/{{$p->id}}">{{$p->title}}</a></h3>
					<p>{!!str_limit($p->body, 30)!!}</p>
				</div>
				</div>
				@if ($p->author == '')
					<small>By Unknown - {{$p->created_at}}</small>
				@else
					<small>By {{$p->author}} - {{$p->created_at}}</small>
				@endif
			</div>
		@endforeach
		{{-- Pagination Links --}}
		{{$posts->links()}} 
	@else
		<p>No posts found</p>
	@endif
@endsection 