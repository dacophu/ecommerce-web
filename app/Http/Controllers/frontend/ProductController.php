<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\AddProductRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function add()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('frontend/account/add-product', compact('categories', 'brands'));
    }

    public function create(AddProductRequest $request)
    {
        $data = [];
        if ($request->file('images')) {
            foreach ($request->file('images') as $xx) {
                $image = Image::read($xx);

                $name = $xx->getClientOriginalName();
                $name_2 = "hinh2_" . $xx->getClientOriginalName();
                $name_3 = "hinh3_" . $xx->getClientOriginalName();

                //$image->move('upload/product/', $name);


                $path = public_path('upload/product/' . $name);
                $path2 = public_path('upload/product/' . $name_2);
                $path3 = public_path('upload/product/' . $name_3);

                $image->save($path);
                $image->resize(85, 84)->save($path2);
                $image->resize(329, 380)->save($path3);

                $data[] = $name;
            }
            // dd($data);
        }

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
}
