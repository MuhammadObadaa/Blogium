@extends('layout.app')

@section('title','admin')

@section('content')
<div class="row">
    <div class="col-3">
        @include('admin.shared.leftside-bar')
    </div>
    <div class="col-9">
        <h1> Admin panel </h1>

        <div class='row'>
            <div class='col-sm-6 col-md-6'>
                @include('shared.widget',[
                'title' => 'Total Users',
                'icon' => 'fas fa-users',// check font awsome for more icons
                'content' => $totalUsers,
                ])
            </div>
            <div class='col-sm-6 col-md-6'>
                @include('shared.widget',[
                'title' => 'Total blogs',
                'icon' => 'fas fa-lightbulb',
                'content' => $totalBlogs,
                ])
            </div>
        </div>
    </div>
</div>
@endsection
