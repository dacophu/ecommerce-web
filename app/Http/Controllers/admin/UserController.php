<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\Country;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Auth::user();
        // dd($data);
        $countries = Country::all();

        return view('admin/user/profile', compact('data', 'countries'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        $data = $request->all();
        $file = $request->avatar;
        // dd($file);
        // dd($data);

        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if ($data['password']) {
            $data['password'] == bcrypt($data['password']);
        } else {
            $data['password'] == $user->password;
        }
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success'));
        } else {
            return redirect()->back()->withErrors('Update profile error');
        }
    }
}
