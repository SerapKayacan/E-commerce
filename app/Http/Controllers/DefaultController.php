<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class DefaultController extends Controller
{
    public function index(Request $request)
    {
        $data = ['name' => 'Kenan'];




        return view('default.index', $data);
    }
}
