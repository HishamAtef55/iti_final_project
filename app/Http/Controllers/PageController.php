<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index($id)
    {
        if(view()->exists('front.'.$id)){
            return view('front.'.$id);
        }
        else
        {
            return view('404');
        }

     //   return view($id);
    }
}
