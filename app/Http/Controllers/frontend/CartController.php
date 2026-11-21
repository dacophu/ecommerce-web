<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
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
        // dd($data);
        return view('frontend/cart/cart', compact('data'));
    }

    public function updateQty(Request $request)
    {
        $data = [];
        if (session()->has('cart')) {
            $data = session()->get('cart');
        }

        foreach ($data as $item) {
            if ($item->id == $request->id) {
                $item->qty = $request->qty;
                break;
            }
        }
        session()->put('cart', $data);
        return response()->json(['data' => $data]);
    }

    public function delete(Request $request)
    {
        $data = [];
        if (session()->has('cart')) {
            $data = session()->get('cart');
        }

        foreach ($data as $key => $value) {
            if ($value->id == $request->id) {
                unset($data[$key]);
                break;
            }
        }
        session()->put('cart', $data);
        return response()->json(['data' => $data]);
    }
}
