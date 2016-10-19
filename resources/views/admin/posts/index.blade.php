@extends('layouts.admin')

@section('content')

    <h1>All Posts</h1>

    @if(Session::has('post_created'))
        <p class="bg-success">{{session('post_created')}}</p>
    @endif

    @if(Session::has('post_updated'))
        <p class="bg-success">{{session('post_updated')}}</p>
    @endif

    @if(Session::has('post_deleted'))
        <p class="bg-success">{{session('post_deleted')}}</p>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Body</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Edit Post</th>
            <th>View Comments</th>
        </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img width="60" src="{{$post->photo ? $post->photo->file : "/images/placeholder.jpg"}}"></td>
                    <td><a href="{{route('home.post', $post->slug)}}" target="_blank">{{$post->title}}</a></td>
                    <td>{{str_limit($post->body, 50)}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category ? $post->category->name : 'Not categorized' }}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{!! Form::submit('Edit Post', ['class'=>'btn btn-primary']) !!}</a></td>
                    <td><a href="{{route('admin.comments.show', $post->id)}}">{!! Form::submit('View Comments', ['class'=>'btn btn-primary']) !!}
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@stop