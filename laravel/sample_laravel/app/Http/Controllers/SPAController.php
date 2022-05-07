<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class SPAController extends Controller
{
    public function index() {
        return view('welcome');
    }
}
