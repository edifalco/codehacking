@extends('layouts.admin')

@section('content')

    <h1>All Users</h1>

    @if(Session::has('user_created'))
        <p class="bg-success">{{session('user_created')}}</p>
    @endif

    @if(Session::has('user_updated'))
        <p class="bg-success">{{session('user_updated')}}</p>
    @endif

    @if(Session::has('user_deleted'))
        <p class="bg-success">{{session('user_deleted')}}</p>
    @endif

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Id</th>
          <th>Photo</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Created</th>
          <th>Updated</th>
        </tr>
      </thead>
      <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td><img width="60" src="{{$user->photo ? $user->photo->file : "/images/placeholder.jpg"}}"></td>
                  <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->role->name}}</td>
                  <td>{{$user->is_active == 1 ? 'Active' : 'Not active'}}</td>
                  <td>{{$user->created_at->diffForHumans()}}</td>
                  <td>{{$user->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
      </tbody>
    </table>

@stop