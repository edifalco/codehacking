@extends('layouts.blog-post')

@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt=""> // if I get an object not found error I can do an if statement here to check if there is an image in the db, other option will be to make that column nullable in the db.

    <hr>

    <!-- Post Content -->
    <p class="lead">{{$post->body}}</p>
    <p>{{$post->body}}</p>

    <hr>

    <!-- Blog Comments -->

    @if(Auth::check())

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            @if(Session::has('comment_message'))
                <p class="bg-success">{{session('comment_message')}}</p>
            @endif

            @include('includes.display_errors')
            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

                {{csrf_field()}}

                <input type="hidden" name="post_id" value="{{$post->id}}">

                <div class="form-group">
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}

        </div>

        <hr>

    @endif

    <!-- Posted Comments -->

    <!-- Comment -->

    @if(count($comments) > 0)

        @foreach($comments as $comment)

            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{Auth::user()->gravatar}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    {{$comment->body}}

                    <!-- Nested Comment -->

                    @if(count($comment->replies) > 0)

                        @foreach($comment->replies as $reply)

                            @if($reply->is_active == 1)

                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$reply->author}}
                                            <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                        <div class="media">
                                            {{$reply->body}}
                                        </div>
                                    </div>
                                </div>

                                @if(Auth::check())

                                    <div class="comment-reply-container">

                                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                                        <div class="comment-reply">

                                            @if(Session::has('comment_reply'))
                                                <p class="bg-success">{{session('comment_reply')}}</p>
                                            @endif

                                            @include('includes.display_errors')
                                            {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}

                                            {{csrf_field()}}

                                            <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                            <div class="form-group">
                                                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                                            </div>

                                            <div class="form-group">
                                                {!! Form::submit('Submit Reply', ['class'=>'btn btn-primary']) !!}
                                            </div>

                                            {!! Form::close() !!}

                                        </div>

                                    </div>

                                @endif

                            @endif

                        @endforeach

                    @endif
                    <!-- End Nested Comment -->
                </div>

            </div>

        @endforeach

    @endif

@stop

@section('scripts')
                    <script>
                        $(".comment-reply-container .toggle-reply").click(function(){
                            $(this).next().slideToggle("slow");

                        });

                    </script>
@stop


















