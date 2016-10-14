@extends('layouts.admin')

@section('content')

    <h1>Posts</h1>

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
            <th>User</th>
            <th>Category</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img width="60" src="{{$post->photo ? $post->photo->file : "/images/placeholder.jpg"}}"></td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category ? $post->category->name : 'Not categorized' }}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@stop