<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\AddProductRequest;
use App\Http\Requests\frontend\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index($id)
    { //product-detail
        $product = Product::where('id', $id)->firstOrFail();
        $images = json_decode($product->hinhanh, true);
        $selectedImage = $images[0];
        $brand = Brand::where('id', $product->id_brand)->firstOrFail();

        return view('frontend/product/product-details', compact('product', 'images', 'selectedImage', 'brand'));
    }

    public function add()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('frontend/account/add-product', compact('categories', 'brands'));
    }
    private function getProductImages($request)
    {
        $data = [];
        if ($request->file('images')) {
            foreach ($request->file('images') as $xx) {
                $image = Image::read($xx);

                // $name = now() . $xx->getClientOriginalName();
                $name = date('Y-m-d_H-i-s') . $xx->getClientOriginalName();

                $name_2 = "hinh2_" . $name;
                $name_3 = "hinh3_" . $name;

                //$image->move('upload/product/', $name);

                $id_user = Auth::id();

                $folder = public_path('upload/product/' . $id_user);

                if (!File::exists($folder)) {
                    File::makeDirectory($folder, 0777, true);
                }

                $path = $folder . '/' . $name;
                $path2 = $folder . '/' . $name_2;
                $path3 = $folder . '/' . $name_3;

                // $path = public_path('upload/product/' . $id_user . '/' . $name);
                // $path2 = public_path('upload/product/' . $id_user . '/' . $name_2);
                // $path3 = public_path('upload/product/' . $id_user . '/' . $name_3);

                $image->save($path);
                $image->resize(85, 84)->save($path2);
                $image->resize(329, 380)->save($path3);

                $data[] = $name;
            }
            // dd($data);
        }
        return $data;
    }

    public function create(AddProductRequest $request)
    {
        $data = $this->getProductImages($request);

        $product = new Product();
        $product->id_user  =  Auth::id();
        $product->name  = $request->name;
        $product->price = $request->price;
        $product->id_category =  $request->id_category;
        $product->id_brand = $request->id_brand;
        $product->status = 0;
        $product->sale = $request->sale;
        $product->company = $request->company;
        $product->hinhanh = json_encode($data);
        $product->detail =  $request->detail;
        $product->save();

        return back()->with('success', 'Product has been added successfully');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::where('id', $id)->firstOrFail();
        $product->hinhanh = json_decode($product->hinhanh, true);
        return view('frontend/account/edit-product', compact('categories', 'brands', 'product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $hinhxoa = [];
        if ($request->hinhxoa) {
            $hinhxoa = $request->hinhxoa;
        }
        $arr =  json_decode($product->hinhanh, true);
        foreach ($arr as $key => $value) {
            if (in_array($value, $hinhxoa)) {
                unset($arr[$key]);
                $id_user = Auth::id();
                unlink('upload/product/' . $id_user . '/' . $value);
            }
        }
        $arr = array_values($arr);
        if (count($arr) + count($request->images) > 3) {
            return redirect()->back()->withErrors('Hình ảnh không được nhiều hơn 3');
        } else {
            $data = $this->getProductImages($request);
            $data = array_merge($arr, $data);
            //dd($data);
            $product->name  = $request->name;
            $product->price = $request->price;
            $product->id_category =  $request->id_category;
            $product->id_brand = $request->id_brand;
            $product->status = 0;
            $product->sale = $request->sale;
            $product->company = $request->company;
            $product->hinhanh = json_encode($data);
            $product->detail =  $request->detail;
            $product->save();
            return redirect()->back()->with('success', __('Update product success'));
        }
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $product->hinhanh = json_decode($product->hinhanh, true);
        foreach ($product->hinhanh as $item) {
            $id_user = Auth::id();
            unlink('upload/product/' . $id_user . '/' . $item);
            unlink('upload/product/' . $id_user . '/' . 'hinh2_' . $item);
            unlink('upload/product/' . $id_user . '/' . 'hinh3_' . $item);
        }
        $product->delete();

        return redirect()->back()->with('success', __('Delete product success'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::where('id', $request->id)->firstOrFail();
        $data = [];
        if (session()->has('cart')) {
            $data  = session()->get('cart');
        }

        $check = false;
        foreach ($data as $item) {
            if ($item->id == $product->id) {
                $check = true;
                $item->qty++;
                break;
            }
        }
        if (!$check) {
            $product->qty = 1;
            array_push($data, $product);
        }
        session()->put('cart', $data);
        return response()->json(['data' => $data]);
    }
}
