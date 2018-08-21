@extends('layouts.app')

	@section('content')
		<div class="jumbotron bg-light">
			<div class="container">
				<h1 class="display-3">{{$title}}</h1>
				<p>A first break into laravel and <i>real</i> PHP.</p>
				<div class="btn-row">
					<p><a class="btn btn-info btn-lg" href="#" role="button">Sign In &raquo;</a></p>
					<p><a class="btn btn-success btn-lg" href="#" role="button">Sign Up &raquo;</a></p>
				</div>
			</div>
		</div>
	@endsection