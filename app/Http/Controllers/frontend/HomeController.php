<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Product::orderBy('created_at', 'desc')->limit(6)->get();
        foreach ($data as $product) {
            $arr = json_decode($product->hinhanh, true);
            $product->hinhanh = $arr[0];
        }
        return view('frontend/home/home', compact('data'));
    }
}
