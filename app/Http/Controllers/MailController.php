<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Exception;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'subject' => "Test Mail",
            'body' => "Hello this is test"
        ];
        try {
            Mail::to('testshoppe52@gmail.com')->send(new MailNotify($data));
            return response()->json(['OK']);
        } catch (Exception $ex) {
            return response()->json(['error']);
        }
    }
}
