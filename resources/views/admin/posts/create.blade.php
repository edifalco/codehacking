@extends('layouts.admin')

@section('content')
    <h1>Create Posts</h1>

    @include('includes.display_errors')

    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}

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
        {!! Form::select('category_id', ['0'=>'Choose A Category'] + $categories, null, ['class'=>'form-control']) !!}
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
        {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

@stop

