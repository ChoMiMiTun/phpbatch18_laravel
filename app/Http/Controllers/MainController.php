<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
       public function welcome()
    {
        return view('welcome');
    }

           public function about()
    {
        return view('about');
    }

           public function testing()
    {
        return view('testing');
    }

           public function contact()
    {
        return view('contact');
    }
}
