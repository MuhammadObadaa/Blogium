@extends('layout.app')

@section('title','dashboard')

@section('content')
<div class="row">
    <div class="col-3">
        @include('shared.leftside-bar')
    </div>
    <div class="col-9">
        @include('shared.success-message')
        @include('blogs.shared.submit-blog')
        <hr>
        @forelse($blogs as $blog)
            <div class="mt-3">
                @include('blogs.shared.blog-card')
            </div>
        @empty
            <p class="text-center mt-4">No results found</p>
        @endforelse
        <div class="mt-3">
            {{ $blogs -> withQueryString() -> links() }}
        </div>
    </div>
</div>
@endsection
