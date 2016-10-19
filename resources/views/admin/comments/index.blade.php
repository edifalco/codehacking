@extends('layouts.admin')

@section('content')

    <h1>Comments</h1>

    @if(Session::has('comment_updated'))
        <p class="bg-success">{{session('comment_updated')}}</p>
    @endif

    @if(Session::has('comment_deleted'))
        <p class="bg-success">{{session('comment_deleted')}}</p>
    @endif

    @if(count($comments) > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Post</th>
                <th>Replies</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Approve/Reject</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->author}}</td>
                        <td>{{$comment->email}}</td>
                        <td>{{$comment->body}}</td>
                        <td><a href="{{route('home.post', $comment->post->id)}}" target="_blank">{{$comment->post->title}}</a></td>
                        <td><a href="{{route('admin.comment.replies.show', $comment->id)}}">View replies</a></td>
                        <td>{{$comment->created_at->diffForHumans()}}</td>
                        <td>{{$comment->updated_at->diffForHumans()}}</td>
                        <td>
                            @if($comment->is_active == 1)
                                {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                    {{csrf_field()}}
                                    <input type="hidden" name="is_active" value="0">
                                    <div class="form-group">
                                        {!! Form::submit('Reject', ['class'=>'btn btn-danger']) !!}
                                    </div>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                    {{csrf_field()}}
                                    <input type="hidden" name="is_active" value="1">
                                    <div class="form-group">
                                        {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                                    </div>
                                {!! Form::close() !!}
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
                            {{csrf_field()}}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else

    <p>There are no comments.</p>

    @endif

@stop