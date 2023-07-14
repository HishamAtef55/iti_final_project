<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddelware;
use App\Models\Category;

use Illuminate\Http\Request;

class HomeController extends Controller
{



    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $categories = Category::where('category_id', null)->get();
        // dd($categories);

        return view('front.index', ['categories' => $categories]);
    }
}