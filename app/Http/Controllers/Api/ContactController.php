<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Save contacts on DB and notify with email
    public function store(Request $request) {
        $data = $request->all(); 

        return response()->json($data);
    }
}
