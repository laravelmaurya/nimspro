<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index()
    {
        // dd('aaaaaaaaaaaaa');
        if (auth()->user()->can('create-user')) {
            return view('welcome');
        }
    }
}
