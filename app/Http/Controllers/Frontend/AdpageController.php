<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Models\Ad;

use Illuminate\Http\Request;

class AdpageController extends Controller
{
    public function getAddDetails($id)
    {
        $ad = Ad::where('id', $id)->with('user', 'category', 'city', 'image', 'attributes')->get()->first();

        // $ad = $ad->ToArray();
        $ad['parent_name'] = CategoryController::parent_name($ad['category_id'])['name'];

        // dd($ad);
        return view('front.ads-details', ["ad" => $ad]);
    }
}