@extends('layout.app')

@section('title','admin | users')

@section('content')
<div class="row">
    <div class="col-3">
        @include('admin.shared.leftside-bar')
    </div>
    <div class="col-9">
        <h1> Users
            @if(Route::is('admin.blogs.users'))
                of {{$blog->title}} blog
            @endif
        </h1>
        <table class="table table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined At</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at->toDateString()}}</td>
                    <td>
                        <a href="{{route('admin.users.show',$user)}}">View</a>
                        <a href="{{route('admin.users.edit',$user)}}">Edit</a>
                        @if($user->is_admin)
                            <p class="text-success">Admin</p>
                        @else
                            <form method="POST" action="{{route('admin.users.setAsAdmin',$user)}}">
                                <button type="submit" class="text-warning">make admin</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $users -> links() }}
        </div>
            @if(Route::is('admin.blogs.users') && count($otherUsers)>0)
                <p>add other owners for the blog {hold ctrl to select multiple}</p>
                <form action="{{route('admin.blogs.setOwners',$blog)}}" method="post">
                    <select name="users[]" id="users" multiple >
                        @forelse($otherUsers as $otherUser)
                            <option value="{{$otherUser->id}}">
                                {{$otherUser->name}}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit">submit</button>
                </form>
            @endif
    </div>
</div>
@endsection
