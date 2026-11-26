<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailNotify;
use App\Models\History;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Country;
use App\Models\User;
use App\Http\Requests\frontend\RegisterMemberRequest;
use App\Http\Requests\frontend\MemberLoginRequest;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $data = [];
            if (session()->has('cart')) {
                $data = session()->get('cart');
            }

            foreach ($data as $item) {
                $images = json_decode($item->hinhanh, true);
                $item->image = $images[0];
            }
            return view('frontend/checkout/checkout', compact('data'));
        } else {
            return view('frontend/checkout/login');
        }
    }
    public function order()
    {
        //gui mail
        $data = [];
        if (session()->has('cart')) {
            $data = session()->get('cart');
        }

        $sum = 0;
        foreach ($data as $item) {
            $images = json_decode($item->hinhanh, true);
            $item->image = $images[0];
            $total = (int)(str_replace('$', '', $item->price)) * (int)($item->qty);
            $item->total = "$" . $total;
            $sum += $total;
        }

        $sum = "$" . $sum;

        $data = [
            'subject' => "Test Mail",
            'body' => [
                'data' => $data,
                'total' => $sum
            ]
        ];

        $user = Auth::user();
        // dd($data);
        try {
            Mail::to($user->email)->send(new MailNotify($data));
        } catch (Exception $ex) {
            return response()->json(['error']);
        }
        //save history
        History::insert(['email' => $user->email, 'phone' => $user->phone, 'name' => $user->name, 'id_user' => $user->id, 'price' => $data['body']['total'], "created_at" => now(), 'updated_at' => now()]);
        return response()->json(['Order success']);
    }

    public function register()
    {
        $countries = Country::all();
        return view('frontend/checkout/register', compact('countries'));
    }
    public function signin(MemberLoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];
        $remember = false;
        if ($request->remember_me) {
            $remember = true;
        }

        if (Auth::attempt($login, $remember)) {
            $data = [];
            if (session()->has('cart')) {
                $data = session()->get('cart');
            }

            foreach ($data as $item) {
                $images = json_decode($item->hinhanh, true);
                $item->image = $images[0];
            }
            return view('frontend/checkout/checkout', compact('data'));
        } else {
            return redirect()->back()->withErrors('Email or password is not correct');
        }
    }
    public function signup(RegisterMemberRequest $request)
    {
        $data = $request->all();
        $file = $request->avatar;

        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        $data['password'] == bcrypt($data['password']);
        $data['level'] = 0;
        if (User::create($data)) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            $login = [
                'email' => $request->email,
                'password' => $request->password,
                'level' => 0
            ];
            if (Auth::attempt($login, true)) {
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
        } else {
            return redirect()->back()->withErrors('Sign Up error');
        }
    }
}
