<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index(){
        return view('backend.winner.index');
    }
}
