<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShortlinkController extends Controller
{

    public function index()
    {
        return view('shortlink');
    }


    public function ShortlinkCalback(Request $request)
    {
        print_r($request->all());
    }
}
