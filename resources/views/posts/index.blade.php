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
				<small>By {{$p->author}} - {{$p->created_at}}</small>
			</div>
		@endforeach
		{{-- Pagination Links --}}
		{{$posts->links()}} 
		<a href="/posts/create">New Post</a>
	@else
		<p>No posts found</p>
	@endif
@endsection 