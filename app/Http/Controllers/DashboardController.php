<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $blogs = Blog::orderBy('created_at','DESC');

        return view('dashboard',['blogs' => $blogs->paginate(5)]);
    }
}
