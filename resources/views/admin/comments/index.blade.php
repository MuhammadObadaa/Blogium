@extends('layout.app')

@section('title','admin | comments')

@section('content')
<div class="row">
    <div class="col-3">
        @include('admin.shared.leftside-bar')
        @include('admin.shared.search-bar')
    </div>
    <div class="col-9">
        @include('shared.success-message')
        <h1> Comments </h1>
        <table class="table table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Idea</th>
                    <th>Content</th>
                    <th>Joined At</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td><a href="{{route('users.show',$comment->user)}}">{{$comment->user->name}}</a></td>
                    <td><a href="{{route('ideas.show',$comment->idea)}}">{{$comment->idea->id}}</a></td>
                    <td>{{$comment->content}}</td>
                    <td>{{$comment->created_at->toDateString()}}</td>
                    <td>
                        <form action="{{route('admin.comments.destroy',$comment)}}" method="POST">
                            @method('delete')
                            @csrf
                            <a href="#" onclick="this.closest('form').submit();return false;">Delete</a>
                            {{-- or <button class="btn btn-sm btn-danger" type="submit">X</button> --}}
                        </form>
                        {{-- <a href="{{route('comments.edit',$user)}}">Edit</a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $comments -> links() }}
        </div>

    </div>
</div>
@endsection
