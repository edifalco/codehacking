@extends('layouts.admin')

@section('content')

    <h1>Replies for comment id: {{$comment->id}}, post id: {{$comment->post_id}}</h1>

    @if(Session::has('reply_updated'))
        <p class="bg-success">{{session('reply_updated')}}</p>
    @endif

    @if(Session::has('reply_deleted'))
        <p class="bg-success">{{session('reply_deleted')}}</p>
    @endif

    @if(count($replies) > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Reply</th>
                <th>Comment</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Approve/Reject</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($replies as $reply)
                    <tr>
                        <td>{{$reply->id}}</td>
                        <td>{{$reply->author}}</td>
                        <td>{{$reply->email}}</td>
                        <td>{{$reply->body}}</td>
                        <td><a href="{{route('home.post', $reply->comment->post->id)}}" target="_blank">{{$reply->comment->post->title}}</a></td>
                        <td>{{$reply->created_at->diffForHumans()}}</td>
                        <td>{{$reply->updated_at->diffForHumans()}}</td>
                        <td>
                            @if($reply->is_active == 1)
                                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                                {{csrf_field()}}
                                <input type="hidden" name="is_active" value="0">
                                <div class="form-group">
                                    {!! Form::submit('Reject', ['class'=>'btn btn-danger']) !!}
                                </div>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                                {{csrf_field()}}
                                <input type="hidden" name="is_active" value="1">
                                <div class="form-group">
                                    {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                                </div>
                                {!! Form::close() !!}
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}
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

        <p>There are no replies.</p>

    @endif

@stop