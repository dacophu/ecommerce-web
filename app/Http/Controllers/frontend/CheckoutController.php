<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $data = [];
        if (session()->has('cart')) {
            $data = session()->get('cart');
        }

        foreach ($data as $item) {
            $images = json_decode($item->hinhanh, true);
            $item->image = $images[0];
        }
        return view('frontend/checkout/checkout', compact('data'));
    }
}
