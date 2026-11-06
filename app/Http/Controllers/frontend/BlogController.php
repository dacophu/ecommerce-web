<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $currentPage = 1;
        $blogs = $this->loadBlogs();
        $totalPage = (int)(count($blogs) / 3);
        if (count($blogs) % 3 != 0) {
            $totalPage++;
        }

        $pages = $this->calculatePage($currentPage, $totalPage);
        $data = $this->calculateData($currentPage, $blogs);

        return view('frontend/blog/blog', compact('data', 'pages', 'currentPage'));
    }

    public function index2($id)
    {
        $blog = Blog::where('id', $id)->firstOrFail();
        $blog->user = User::where('id', $blog->id_user)->firstOrFail()->name;
        $time = explode(' ', $blog->updated_at);
        $blog->date = $time[0];
        $blog->time = $time[1];


        $blogs = Blog::orderBy('updated_at', 'desc')->get();

        $pre = $next = -1;
        for ($i = 0; $i < count($blogs); $i++) {
            if ($blogs[$i]->id == $blog->id) {
                if ($i - 1 >= 0) {
                    $pre = $blogs[$i - 1]->id;
                }
                if ($i + 1 < count($blogs)) {
                    $next = $blogs[$i + 1]->id;
                }
            }
        }

        return view('frontend/blog/blog-detail', compact('blog', 'pre', 'next'));
    }


    public function changePage($page)
    {
        $currentPage = $page;
        $blogs = $this->loadBlogs();
        $totalPage = (int)(count($blogs) / 3);
        if (count($blogs) % 3 != 0) {
            $totalPage++;
        }
        $pages = $this->calculatePage($currentPage, $totalPage);
        $data = $this->calculateData($currentPage, $blogs);

        return view('frontend/blog/blog', compact('data', 'pages', 'currentPage'));
    }

    private function loadBlogs()
    {
        $blogs = Blog::orderBy('updated_at', 'desc')->get();
        foreach ($blogs as $blog) {
            $blog->user = User::where('id', $blog->id_user)->firstOrFail()->name;
            $time = explode(' ', $blog->updated_at);
            $blog->date = $time[0];
            $blog->time = $time[1];
        }
        return $blogs;
    }

    private function calculatePage($currentPage, $totalPage)
    {
        $pages = [];
        switch ($currentPage) {
            case 1:
                $pages = [$currentPage, $currentPage + 1, $currentPage + 2];
                break;
            case $totalPage:
                $pages = [$currentPage - 2, $currentPage - 1, $currentPage];
                break;
            default:
                $pages = [$currentPage - 1, $currentPage, $currentPage + 1];
                break;
        }
        return $pages;
    }

    private function calculateData($currentPage, $blogs)
    {
        $index = 3 * ($currentPage - 1);
        $data = [];

        for ($i = 0; $i <= 2 && $index + $i < count($blogs); $i++) {
            array_push($data, $blogs[$index + $i]);
        }
        return $data;
    }
}
