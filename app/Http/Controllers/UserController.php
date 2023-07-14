<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\City;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\fileExists;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $users = User::orderBy('created_at', 'desc')->paginate(5);
        $users = User::get();

        // dd($users->city->name);
        return view('dashboard.users.index', ['users' => $users]);
    }

    public function index2()
    {
        $country = Country::get();

        return view('dashboard.users.add', ['country' => $country]);
    }


    public function index3($id)
    {

        $user = Ad::where('user_id', '=', $id)->where('status', '=', 'Approved')->paginate(6);

        return view('front.userProfile.userAds', [


            'userads' => $user,
        ]);
    }








    public function edit($id)
    {

        $country = Country::get();
        $aboutus = User::find($id);
        return view('dashboard.users.update', [
            'country' => $country,
            'u' =>    $aboutus
        ]);
    }





    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'whatsapp' =>  $request->whatsapp,
            'phone' =>  $request->phone,
            'address' =>  $request->address,
            'city_id' =>  $request->city_id,
            'country_id' => $request->country_id,
            'date_of_birth' => $request->date_of_birth,
        ]);



        return redirect()->route('user.index');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userUpdate = user::find($id);

        $userUpdate->update($request->all());
        return redirect()->route('user.index');
    }

    // *********************************

    // public function edit_user_profile(Request $request, $id)
    // {
    //     $userUpdate = Auth::find($id);
    //     $userUpdate->update($request->all());
    //     return redirect()->route('/');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }



    /////////////////////////// my function Dont touch ya ibrahim ///////////////////
    public function ddestroy(request $request)
    {
        $image_id = $request->image_id;
        $query = Image::find($image_id);
        // $ads = Ad::with('image')->find($id);

        $file = public_path() . '/ads/image/' . $query['fileimage'];

        if (fileExists($file)) {
            unlink($file);
        }



        $query->delete();
        if ($query) {
            return response()->json(['status' => 'image hs deleted successfully']);
        } else {
            return response()->json(['status' =>  'no item found']);
        }
    }
}
    //////////////////////////////////////////////////////////////////////////////
