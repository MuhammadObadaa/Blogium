@extends('layout.app')

@section('title','admin | blogs')

@section('content')
<div class="row">
    <div class="col-3">
        @include('admin.shared.leftside-bar')
    </div>
    <div class="col-9">
        <h1> Blogs </h1>
        <table class="table table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>show Owners</th>
                    <th>title</th>
                    <th>text</th>
                    <th>Created at</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                <tr>
                    <td>{{$blog->id}}</td>
                    <td><a href="{{route('admin.blogs.users',$blog)}}">Owners</a></td>
                    <td>{{$blog->title}}</td>
                    <td>{{$blog->text}}</td>
                    <td>{{$blog->created_at->toDateString()}}</td>
                    <td>
                        <a href="{{route('blogs.show',$blog)}}">View</a>
                        <a href="{{route('blogs.edit',$blog)}}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $blogs -> links() }}
        </div>

    </div>
</div>
@endsection
