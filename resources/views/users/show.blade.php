@extends('layout.app')

@section('title','user')

@section('content')
<div class="row">
    <div class="col-3">
        @include('shared.leftside-bar')
    </div>
    <div class="col-6">
        @include('shared.success-message')
        <div class="mt-3">
            @if($editing ?? false)
            @include('users.shared.user-edit-card')
            @php $editing = false @endphp
            @else
            @include('users.shared.user-card')
            @endif
        </div>
        @forelse($ideas as $idea)
        <div class="mt-3">
            @include('ideas.shared.idea-card')
        </div>
        @empty
        <p class="text-center mt-4">No results found</p>
        @endforelse
        <div class="mt-3">
            {{ $ideas -> withQueryString() -> links() }}
        </div>
    </div>
    <div class="col-3">
        @include('shared.search-bar')
        @include('shared.follow-bar')
    </div>
</div>
@endsection
