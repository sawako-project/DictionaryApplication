<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Phrase;
use App\PhraseCategory;
use App\BaseCategory;
use App\Word;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.top');
    }

}
