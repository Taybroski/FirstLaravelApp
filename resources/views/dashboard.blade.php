@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Dashboard - <small>Welcome {{auth()->user()->name}}</small></div>

                <div class="card-body">
                   <h3>Your Blog Posts</h3>
                   @if(count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Date Posted</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->user->id}}</td>
                            <td><a class="link" href="/posts/{{$post->id}}">{{$post->title}}</td>
                                <td>{{$post->created_at}}</td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                <td>
                                    {!! Form::open([
                                        'action' => ['PostsController@destroy', $post->id], 
                                        'method' => 'POST', 
                                        'class' => 'pull-right', 
                                        'onsubmit' => 'return ConfirmDelete()']) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <div class="txt-center">
                            <p>You have not created any posts.</p>
                        </div>
                        <br />
                    @endif
                <a class="btn btn-info" href="/posts/create/">Create Post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


