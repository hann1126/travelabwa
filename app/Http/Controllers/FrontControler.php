<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class FrontControler extends Controller
{
    //
    public function index(){
        return view('welcome');
    }
}
