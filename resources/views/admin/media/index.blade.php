@extends('layouts.admin')

@section('content')

    <h1>Media</h1>

    @if(Session::has('photo_created'))
        <p class="bg-success">{{session('photo_created')}}</p>
    @endif

    @if(Session::has('photo_deleted'))
        <p class="bg-success">{{session('photo_deleted')}}</p>
    @endif

    @if($photos)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Path</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @foreach($photos as $photo)
                    <tr>
                        <td>{{$photo->id}}</td>
                        <td><img width="200" src="{{$photo ? $photo->file : "/images/placeholder.jpg"}}"></td>
                        <td>{{$photo->file}}</td>
                        <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No date'}}</td>
                        <td>{{$photo->updated_at ? $photo->updated_at->diffForHumans() : 'No date'}}</td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id]]) !!}

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
        <h2>There are no photos in the database.</h2>
    @endif

@stop