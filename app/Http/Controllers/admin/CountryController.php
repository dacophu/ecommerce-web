<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AddCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin/country/country', compact('countries'));
    }

    public function add()
    {
        return view('admin/country/add-country');
    }

    public function insert(AddCountryRequest $request)
    {
        Country::insert(['name' => $request->name]);
        $countries = Country::all();
        return view('admin/country/country', compact('countries'));
    }

    public function delete($id)
    {
        Country::where('id', $id)->delete();
        $countries = Country::all();
        return view('admin/country/country', compact('countries'));
    }
}
