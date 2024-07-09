@extends('layout.app')

@section('title','user')

@section('content')
<div class="row">
    <div class="col-3">
        @include('shared.leftside-bar')
    </div>
    <div class="col-9">
        @include('shared.success-message')
        <div class="mt-3">
            @if($editing ?? false)
            @include('users.shared.user-edit-card')
            @php $editing = false @endphp
            @else
            @include('users.shared.user-card')
            @endif
        </div>
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
