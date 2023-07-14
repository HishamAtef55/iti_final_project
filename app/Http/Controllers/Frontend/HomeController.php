<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;

use App\Http\Middleware\AdminMiddelware;
use App\Models\Category;
use App\Models\Ad;
use App\Models\User;
use App\Models\Package;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $categories = Category::where('category_id', !null)->get();
        //dd($categories);
        $ads = Ad::where('status','approved')->with('user', 'category', 'city', 'image')->get();
        //dd($ads);
        $ads = $ads->ToArray();


        foreach ($ads as &$ad) {

            $ad['parent_name'] = CategoryController::parent_name($ad['category']['category_id'])['name'];
        }

        $packages = Package::with("categories")->get();
        // dd($packages);
        $packages = $packages->ToArray();
//                dd($packages);

        return view('front.index', ['categories' => $categories, "ads" => $ads , "packages"=>$packages]);
    }

    public function wishlist_store($id){
        $user=User::find(Auth::id());
        $ads=$user->wishlist()->get();

        if ($ads->count()>=1) {
            foreach ($ads as $ad) {
                if ($ad->id==$id) {
                    return redirect()
                    ->back()
                    ->with('exsists', 'Your ad is already exists in you Favorites');

                }
            }
        }
        $user->wishlist()->attach($id);
        return redirect()
        ->back()
        ->with('success', 'Your message has been sent successfully!');
    }

    public function wishlist_show(){

        $user=User::find(Auth::id());
        $ads=$user->wishlist()->get();
        // dd($ads);
        return view('front.account-favourite-ads',['ads'=>$ads]);

    }
    public function wishlist_destroy($id){

        $user=User::find(Auth::id());
        $user->wishlist()->detach($id);
        return redirect()
        ->back()
        ->with('success', 'Your ad has been removed successfully!');
    }
}
