<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function guide()
    {
        return view('about.guide');
    }

    //
    public function rule()
    {
        return view('about.rule');
    }

}
