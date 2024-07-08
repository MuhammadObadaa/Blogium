@extends('layout.app')

@section('title','idea')

@section('content')
<div class="row">
    <div class="col-3">
        @include('shared.leftside-bar')
    </div>
    <div class="col-9">
        @include('shared.success-message')
        <div class="mt-1">
            @include('blogs.shared.blog-card')
        </div>
    </div>
</div>
@endsection
