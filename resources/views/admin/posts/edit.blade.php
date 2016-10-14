@extends('layouts.admin')

@section('content')
    <h1>Edit Post</h1>

    @include('includes.display_errors')

    <div class="col-sm-3">
        <img src="{{$post->photo ? $post->photo->file : "/images/placeholder.jpg"}}" alt="" class="img-responsive img-rounded">
    </div>

    <div class="col-sm-9">
        {!! Form::model($post,['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}

        {{csrf_field()}}

        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Content:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>6]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', ['class'=>'form-control']) !!}
        </div>

        {{--<div class="form-group">--}}
        {{--{!! Form::label('user_id', 'User:') !!}--}}
        {{--{!! Form::select('user_id', array('0'=>'Choose An User', '1'=>'edifalco'), null, ['class'=>'form-control']) !!}--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
        {{--{!! Form::label('user_id', 'User_id:') !!}--}}
        {{--{!! Form::select('user_id', [''=>'Choose An Option'] + $roles, 0, ['class'=>'form-control']) !!}--}}
        {{--</div>--}}

        <div class="form-group">
            {!! Form::submit('Update Post', ['class'=>'btn btn-primary pull-left']) !!}
        </div>

        {!! Form::close() !!}


        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}

        {{csrf_field()}}

        <div class="form-group">
            {!! Form::submit('Delete Post', ['class'=>'btn btn-danger pull-right']) !!}
        </div>

        {!! Form::close() !!}

    </div>


@stop

