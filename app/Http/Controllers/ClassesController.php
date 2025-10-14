<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index() {
        return view('admin.classes.index'); // Create this Blade view later
    } 
}
