<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use App\Models\Image;
// use Illuminate\Foundation\Auth\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\UpdateProfileRequest;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $country = Country::get();
        // dd($country);

        $user = User::find($user->id);
        return view('front.userProfile.user_profile', [
            'country' => $country,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show()
    {


        $user = User::find(Auth::id());
        // $ads = Ad::where('user_id', Auth::id())->with('user', 'category', 'city')->get();
        $ads = $user->ads()->get();
        // dd($ad);

        $profileiIamgeAds = Image::get();
        return  view(
            'front.account-myads',
            [
                'ads' => $ads,
                'img' => $profileiIamgeAds,

            ]
        );
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // dd($user);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request, $id)
    {

        $userUpdat = User::find($id);
        $userUpdat->update($request->all());


        return redirect()->back();







        // $country = Country::find($id);
        // $country->update($request->all());

        // dd($country);

        // $userUpdat = User::find($id);

        // dd($userUpdat->city);
        // $userUpdat->update($request->all());


        // $updatuser = $request->only(
        //     [

        //         "city_id",
        //         'country_id',
        //         'name',
        //         'password',

        //     ]
        // );
        // $userUpdat->update($updatuser);




        // $country->update(
        //     [
        //         'city_id' => $request['city_id'],
        //         'country_id' => $request['country_id'],
        //     ]
        // );


        // return view('front.userProfile.user_profile');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}