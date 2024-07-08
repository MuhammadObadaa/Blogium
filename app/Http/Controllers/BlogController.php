<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Media;
use App\Models\MediaType;
use Illuminate\Database\Query\Builder;

class BlogController extends Controller
{
    //
    public function index() {
        $blog = Blog::orderBy('created_at', 'DESC')->get();

        return $blog;
    }

    public function create(Request $request) {

    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'text' => 'required|min:3|max:65000',
            'media.*' => 'required|file|mimes:jpg,png,mp4|max:1024'
            ]);

        $blog = Blog::create($validated);

        if($request->has('media')) {
            foreach($request->file('media') as $file){
                $path = $file->store('media', 'public');

                $media_type_name = explode('/',$file->getMimeType())[0];

                $media_type_id = MediaType::whereName($media_type_name)->first()->id;

                Media::create([
                    'blog_id' => $blog->id,
                    'url' => $path,
                    'media_type_id' => $media_type_id
                ]);
            }
        }

        return $blog;
    }

    public function show(Blog $blog) {
        return $blog;
    }

    public function edit() {

    }

    public function update(Request $request, Blog $blog) {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'text' => 'required|min:3|max:65000',
            ]);

        $blog->update($validated);

        return $blog;
    }

    public function destroy(Blog $blog) {
        $blog->delete();
    }
}
