@extends('layouts.app')

@section('content')
	<h1>Posts</h1>
	@if(count($posts) > 0 ) 
		@foreach($posts as $p)
			<div class="mb-08 card card-body bg-light">
				<div class="pre_post">
				<div class="row">
					<div class="col-md-2 col-sm-2">
						<img style="width:100%; border-radius:5px" src="/storage/cover_images/{{$p->cover_image}}">
					</div>
					<div class="col-md-8 col-sm-8">
						<h3><a href="/posts/{{$p->id}}">{{$p->title}}</a></h3>
						@if ($p->author == '')
							<small>By Unknown - {{$p->created_at}}</small>
						@else
							<small>By {{$p->author}} - {{$p->created_at}}</small>
						<p>{!!str_limit($p->body, 30)!!}</p>
					</div>
				</div>
				</div>
				@endif
			</div>
		@endforeach
		{{-- Pagination Links --}}
		{{$posts->links()}}
	@else
		<p>No posts found</p>
	@endif
@endsection 