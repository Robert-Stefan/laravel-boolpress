<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendNewMail;

class HomeController extends Controller
{
    // ADMIN HOMEPAGE
    public function index() {

        // MAIL 
        // Mail::to(Auth::user()->email)->send(new SendNewMail());


        return view('admin.home');
    }
}
