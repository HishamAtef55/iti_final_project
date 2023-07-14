<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class CategoryPageController extends Controller
{
    public function categoryPage($id=null){
        $child =  $child = Category::whereNotNull('category_id')->get();
        $cities = City::get();
        $child = $child->toArray();
        if(!$id){
            $ads =Ad::where('status','approved')->with('user','category','city','image')->paginate(PAGINATION_COUNT);
         } else{
            $ads =Ad::where(['category_id'=>$id ,'status'=>'approved'])->with('user','category','city','image')->paginate(PAGINATION_COUNT);
        }
        return view('front.category' , ["categories"=>$child,"ads"=>$ads,'id'=>$id,'cities'=>$cities]);
    }



public function categoryOrder($order,$id=null){

    // dd($id);
    $cities = City::get();
    if ($order=="newness") {
        $child = Category::whereNotNull('category_id')->get();
        $child = $child->toArray();
        if($id==0){
            // dd($id);
            $ads =Ad::with('user','category','city','image')->orderBy('created_at', 'DESC')->paginate(PAGINATION_COUNT);
            // dd($ads);
            } else{
            $ads =Ad::where(['category_id'=>$id,'status'=>'approved'])->with('user','category','city','image')->orderBy('created_at', 'DESC')->paginate(PAGINATION_COUNT);
        }
    }elseif ($order=="oldness") {
        $child = Category::whereNotNull('category_id')->get();
        $child = $child->toArray();
        if($id==0){
            // dd($id);
            $ads =Ad::with('user','category','city','image')->orderBy('created_at','ASC')->paginate(PAGINATION_COUNT);
            } else{
            $ads =Ad::where(['category_id'=>$id,'status'=>'approved'])->with('user','category','city','image')->orderBy('created_at')->paginate(PAGINATION_COUNT);
        }
    }elseif ($order=="price_low") {
        $child =  $child = Category::whereNotNull('category_id')->get();
        $child = $child->toArray();
        if($id==0){
            $ads =Ad::with('user','category','city','image')->orderBy('price')->paginate(2);
            } else{
            $ads =Ad::where(['category_id'=>$id , 'status'=>'approved'])->with('user','category','city','image')->orderBy('price')->paginate(PAGINATION_COUNT);
        }
    }
    elseif ($order=="price_high") {
        $child =  $child = Category::whereNotNull('category_id')->get();
        $child = $child->toArray();
        if($id==0){
            $ads =Ad::with('user','category','city','image')->orderBy('price', 'desc')->paginate(2);
            } else{
            $ads =Ad::where(['category_id'=>$id,'status'=>'approved'])->with('user','category','city','image')->orderBy('price', 'desc')->paginate(PAGINATION_COUNT);
        }
    }


    return view('front.category' , ["categories"=>$child,"ads"=>$ads,'id'=>$id,'cities'=>$cities]);
}

 public function searchAd(Request $request){

    $request->validate([
        'name'=>'required',
        'city_id'=>'required',
        'category_id'=>'required',
    ]);
        $name=$request->name;
        $category_id=$request->category_id;
        $city_id=$request->city_id;
        $child =  $child = Category::whereNotNull('category_id')->get();
        $cities = City::get();
        $child = $child->toArray();
        $ads =Ad::where(['category_id'=>$category_id,'city_id'=>$city_id,'name'=>$name ,'status'=>'approved'])->with('user','category','city','image')->paginate(PAGINATION_COUNT);
        return view('front.category' , ["categories"=>$child,"ads"=>$ads,'id'=>$category_id,'cities'=>$cities]);

 }
 public function searchAd_name(Request $request){

    $request->validate([
        'name'=>'required',

    ]);
        $name=$request->name;
        $category_id=$request->category_id;
        $child =  $child = Category::whereNotNull('category_id')->get();
        $cities = City::get();
        $child = $child->toArray();
        $ads =Ad::where(['name'=>$name ,'status'=>'approved'])->with('user','category','city','image')->paginate(PAGINATION_COUNT);
        return view('front.category' , ["categories"=>$child,"ads"=>$ads,'id'=>$category_id,'cities'=>$cities]);

 }

}

