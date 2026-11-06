<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $data = Blog::all();
        return view('admin/blog/blog', compact('data'));
    }

    public function add()
    {
        return view('admin/blog/add-blog');
    }

    public function insert(CreateBlogRequest $request)
    {
        $file = $request->image;
        Blog::insert(["title" => $request->title, "image" => $file->getClientOriginalName(), "description" => $request->description, "content" => $request->content, "id_user" => Auth::id(), "created_at" => now(), "updated_at" => now()]);
        $file->move('upload/blog', $file->getClientOriginalName());
        $data = Blog::all();
        return view('admin/blog/blog', compact('data'));
    }

    public function edit($id)
    {
        $data = Blog::where('id', $id)->get();
        $data = $data[0];
        return view('admin/blog/edit-blog', compact('data'));
    }

    public function update(UpdateBlogRequest $request, $id)
    {
        $file = $request->image;
        if (empty($file)) {
            Blog::where('id', $id)->update(["title" => $request->title,  "description" => $request->description, "content" => $request->content]);
        } else {
            Blog::where('id', $id)->update(["title" => $request->title,  "image" => $file->getClientOriginalName(), "description" => $request->description, "content" => $request->content]);
            $file->move('upload/blog', $file->getClientOriginalName());
        }
        $data = Blog::all();
        return view('admin/blog/blog', compact('data'));
    }

    public function delete($id)
    {
        Blog::where('id', $id)->delete();

        $data = Blog::all();
        return view('admin/blog/blog', compact('data'));
    }
}
