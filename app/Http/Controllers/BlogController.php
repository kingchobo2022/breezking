<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function BlogList() {
        return view('admin.blog.list');
    }

    public function BlogAdd() {
        return view('admin.blog.add');
    }

    public function BlogStore(Request $request) {
        $validateData = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);

        // 대량할당
        Blog::create([
            'title' => trim($validateData['title']),
            'slug' => trim($validateData['slug']),
            'description' => trim($validateData['description'])
        ]);

        return redirect('admin/blog')->with('success', 'Blog Successfully Add');
    }
}
