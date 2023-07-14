<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::with("categories")->withCount('users')->get();
        // dd($packages);
        return view("dashboard.packages.index",['packages'=>$packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('category_id','!=',null)->get();
        // dd($categories);
        return view("dashboard.packages.create",['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $data = $request->validate([
            'name'=> 'required',
            'available'=> 'required',
            'num_of_ads'=> 'required',
            'price'=> 'required',
            'days'=> 'required',
        ]);
        $category_ids = $request->input('category_id');
        // dd(count($category_ids));
        if(count($category_ids) > 0){
            $package = Package::create($data);
            foreach($category_ids as $category_id){
                $package->categories()
                ->attach($category_id);
            }
            return redirect()->route('packages.index');
        }else{
            $package = Package::create($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::with("categories")->withcount('users')->find($id);
        // dd($package);
        return view("dashboard.packages.show",['package'=>$package]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('category_id',!null)->get();
        $package = Package::with("categories")->find($id);
        return view("dashboard.packages.edit",compact("package","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $package = Package::find($id);
        $data = $request->validate([
            'name'=> 'required',
            'available'=> 'required',
            'num_of_ads'=> 'required',
            'price'=> 'required',
            'days'=> 'required',
        ]);
        $category_ids = $request->input('category_id');
        if(count($category_ids) > 0)
        {
            $package->update($data);
                $package->categories()
                ->sync($category_ids);
        }else{
            $package->update($data);
        }
        return redirect()->route('packages.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();
        return back();
    }
    public function change($id)
    {
        $package = Package::find($id);
        // dd($package->available);
        $package->available == "available" ? $package->update(['available'=>'unavailable']): $package->update(['available'=>'available']);
        return back();
    }

    /*********************category_package**********************/

    public function createCategoryToPackage ($id)
    {
        $package = Package::find($id);
        //get all category ids
        $category_ids = $package->categories->pluck('id')->toArray();
        // retreive all subcategories && not used before with this package
        $categories   = Category::where('category_id',!null)
        ->whereNotIn('id',$category_ids)
        ->get();
        return view("dashboard.categoryPackage.create",compact('categories','package'));
    }
    public function addCategoryToPackage (Request $request)
    {
        $package_id = $request->package_id;
        $package = Package::find($package_id);
        $category_ids = $request->input('category_id');
        $package->categories()
        ->syncWithoutDetaching($category_ids);
        return redirect()->route('packages.show',$package_id);
    }
    public function editSingleCategory (Request $request,$id)
    {
        $package = Package::find($id);
        //get all category ids
        $category_id = $request->category_id;
        $category_ids = $package->categories->pluck('id')->toArray();
        if (($key = array_search($category_id, $category_ids)) !== false) {
            unset($category_ids[$key]);
        }
        // retreive all subcategories && not used before with this package
        $categories   = Category::where('category_id',!null)
        ->whereNotIn('id',$category_ids)
        ->get();
        return view("dashboard.categoryPackage.edit",compact('categories','package','category_id'));
    }
    public function updateCategoryPackage (Request $request ,$id)
    {
        $oldCategory_id = $request->oldCategory_id;
        $package        = Package::find($id);
        $category_id    = $request->category_id;
        $package->categories()
        ->attach($category_id);
        $package->categories()
        ->detach($oldCategory_id);
        return redirect()->route('packages.show',$id);
    }
    public function deleteCategoryFromPackage (Request $request,$category_id){
        $package = Package::find($request->package_id);
        $package->categories()
        ->detach($category_id);
        return back();
    }
    public function userCategoryCreate(){
        $categories   = Category::where('category_id',null)->get();
        return view('front.packages.category', compact('categories'));
    }
    public function userPackageCreate(Request $request)
    {
        $category_id = $request->validate(['subCategory'=>'required']);
        $category = Category::with("packages")->find($category_id)->first();
        return view('front.packages.packages',compact('category'));
    //    dd(Auth::user()->id);
    }
    public function buy(Request $request)
    {
        $category_id = $request->category_id;
        $package_id  = $request->package_id;
        $user_id     = Auth::user()->id;
        $user = User::with('packages')->find($user_id);
        $user->packages()
        ->attach($package_id);
        return redirect()->route('user.myPackages');

    }
    public function packageUsers($id)
    {
        $package = Package::with('users')->find($id);
        return view("dashboard.packages.users",["package"=>$package]);

    }
    public function userPackages($id)
    {
        $user = User::with('packages')->find($id);
        return view("dashboard.users.userPackages",["user"=>$user]);

    }
    public function myPackages()
    {
        $id = Auth::user()->id;
        $user = User::with('packages')->find($id);
        // dd($user->packages);
        return view("front.user.packages",["user"=>$user]);
    }
    public function cart()

    {
        return view("front.packages.cart");
    }
    /*
    public function addToCart($id ,$category_id)
    {
        // dd($category_id);
        // $category_id = $request->category_id;
        // $id  = $request->package_id;
        $user_id     = Auth::user()->id;
        $package = Package::find($id);

        $cart = session()->get('cart');

        // if cart is empty then this the first package
        if(!$cart) {
            $cart = [
                    $id => [
                        "name" => $package ->name,
                        "quantity" => 1,
                        "category_id"=>$category_id,
                        "price" => $package->price,

                    ]
            ];
            session()->put('cart', $cart);
            seesion()->flash('success','Package Added to cart successfully ');
            return $cart;
        }

        // if cart not empty then check if this package exist then increment quantity
        if(isset($cart[$id]) && $cart[$id]['category_id'] == $category_id){

            session()->flash('success', "this package already exist in cart");
            return $cart;

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $package ->name,
            "quantity" => 1,
            "category_id"=>$category_id,
            "price" => $package->price,
        ];

        session()->put('cart', $cart);
        seesion()->flash('success','Package Added to cart successfully ');
        return $cart;
    }
    public function removeFromCart($id ,$category_id){
        $cart = session()->get('cart');
        if(isset($cart[$id]) && $cart[$id]['category_id'] == $category_id){
           unset($cart[$id]);
           session()->put('cart', $cart);
           return $cart;
        }
    }
    public function clearCart(){
        $cart = session()->get('cart');

    }
    public function increment(){
        $cart = session()->get('cart');

    }
    public function decrement(){
        $cart = session()->get('cart');

    }
    */

}

