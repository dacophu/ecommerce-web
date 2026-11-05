<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\RegisterMemberRequest;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('frontend/member/register', compact('countries'));
    }
    public function register(RegisterMemberRequest $request)
    {
        $data = $request->all();
        $file = $request->avatar;

        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        $data['password'] == bcrypt($data['password']);
        $data['level'] = 0;
        // dd($data);

        if (User::create($data)) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Sign Up success'));
        } else {
            return redirect()->back()->withErrors('Sign Up error');
        }
    }
}
