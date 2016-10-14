@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>

    @if(Session::has('category_created'))
        <p class="bg-success">{{session('category_created')}}</p>
    @endif

    @if(Session::has('category_updated'))
        <p class="bg-success">{{session('category_updated')}}</p>
    @endif

    @if(Session::has('category_deleted'))
        <p class="bg-success">{{session('category_deleted')}}</p>
    @endif


    <div class="col-sm-6">

        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store', 'files'=>true]) !!}

        {{csrf_field()}}

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}


    </div>

    <div class="col-sm-6">

        @if($categories)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No date'}}</td>
                            <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : 'No date'}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h2>There are no categories in the database.</h2>
        @endif

    </div>

@stop