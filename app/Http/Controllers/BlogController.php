<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function BlogList() {
        $blogs = Blog::getAll();

        return view('admin.blog.list', compact('blogs'));
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

    public function BlogView($id) {
        $blog = Blog::findOrFail($id);

        return view('admin.blog.view', compact('blog'));
    }

    public function BlogDelete($id) {
        // $blog = Blog::findorFail($id);
        // $blog->delete();

        // return redirect('admin/blog')->with('success', 'Blog Successfully Delete');        

        $blog = Blog::find($id);
        if ($blog) {
            $blog->delete();
            return redirect('admin/blog')->with('success', 'Blog Successfully Delete');        
        }

        return redirect('admin/blog')->with('success', 'Data Not Found');        
    }
}
