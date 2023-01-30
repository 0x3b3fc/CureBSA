<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;

class HomeController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('front.index', compact(['sponsors']));
    }
}
