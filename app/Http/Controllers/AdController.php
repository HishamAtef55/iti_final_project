<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CategoryController;
use App\Enums\Type;
use Illuminate\Support\Facades\DB;
use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;

use App\Http\Requests\FormDataRequest;
use App\Models\Attribute;
use App\Models\AdAttribute;
use App\Models\Image;
use App\Models\Package;
use App\Models\User;
// use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Constraint\Count;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Events\NotifEvent;
use App\Notifications\NotifNotification;
use function PHPUnit\Framework\fileExists;

class AdController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_category = (new CategoryController)->get_all_parents();
        $categories = $parent_category->ToArray();

        return view('front.select-category', ['categories' => $categories]);
    }

    public function create2(Request $request)
    {

        $child_id = $request->childs;
        $category = Category::find($child_id);
        $category_packages = $category->packages()->get()->toArray();
        $user = User::find(Auth::id());
        $user_packages = $user->packages()->where('status', 'active')->get();
        $pack_id = [];
        foreach ($user_packages as $package) {
            foreach ($category_packages as $category_package) {
                if ($package->id == $category_package['id']) {
                    $pack_id[] = $package->id;
                }
            }
        }

        $packages_num_days = Package::whereIn('id', $pack_id)->sum('num_of_ads');
        $check_num = $packages_num_days + $category->max_number_free_ads;

        $user_ads_count = $user->ads->where('category_id', $child_id)->count();
        if ($user_ads_count >= $check_num) {
            return redirect()
                ->back()
                ->with('package', 'Your number of free ads is out');
        }
        return redirect()->route('create_ad_form', ['id' => $child_id]);
    }

    public function create3($id)
    {
        $child_id = $id;
        if ($child_id) {
            $category = (new CategoryController)->show($child_id);
            $atributes = $category->category['attributes'];
            $city = City::get();
            $country = Country::get();
            $x = $category->category['id'];

            return view('front.post-ad', ['atributes' => $atributes, 'x' => $x, 'city' => $city,  'country' => $country]); ///myform
        } else {
            return view('post-ad', ['atributes' => []]);
        }
    }

    public function fetchstate(Request $request)
    {
        $data['states'] = City::where('country_id', $request->country_id)->get(['name', 'id']);
        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormDataRequest $request)
    {

        $validateData = $request->validated();
        $atributes = new AdAttribute;



        // $ads->category_id =  $validateData['category_id'];
        // $ads->name = $validateData['name'];
        // $ads->price = $validateData['price'];
        // $ads->description = $validateData['description'];
        // $ads->city_id = $validateData['city_id'];
        // $ads->country_id = $validateData['country_id'];
        // $ads->location = $validateData['location'];
        // $ads->start_date = fake()->dateTimeBetween('now', '+1 week');
        // $ads->end_date  = fake()->dateTimeBetween('+1 week', '+2 week');
        // $ads->user_id = Auth::id();
        // // $ads->location = $validateData['location'];
        // $ads->save();





        $new_ad_data = [
            'category_id' =>  $validateData['category_id'],
            'name' => $validateData['name'],
            'price' => $validateData['price'],
            'description' => $validateData['description'],
            'city_id' => $validateData['city_id'],
            'country_id' => $validateData['country_id'],

            'location' => $validateData['location'],

            // 'state_id' => $validateData['state_id'],
            'start_date' => fake()->dateTimeBetween('now', '+1 week'),
            'end_date' => fake()->dateTimeBetween('+1 week', '+2 week'),
            'user_id' => Auth::id()
        ];
        $last_id = Ad::insertGetId($new_ad_data);

        $atributes = Category::find($validateData['category_id'])->attributes;
        $attr_names = [];
        foreach ($atributes as $atribute) {
            $attr_names[] = $atribute->name;
            $attr_ids[] = $atribute->id;
        }
        $data = [];
        $attributes_data = $request->only($attr_ids);
        foreach ($attributes_data as $attribute => $value) {
            $data[] = [
                'attribute_id' => $attribute,
                'value' => $value,
                'ad_id' => $last_id,
            ];
        }
        AdAttribute::insert($data);
        if ($request->hasFile('fileimage')) {
            $uploadpath = 'ads/image/';
            $i = 1;
            foreach ($request->file('fileimage') as $fileimage) {
                $extension = $fileimage->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $fileimage->move($uploadpath, $filename);
                $finalImagePathName = $filename;
                $ad_image_data = [
                    'ad_id' => $last_id,
                    'fileimage' => $finalImagePathName,
                ];
                Image::create($ad_image_data);
            }
        }


        $this->sendAdminMail('emails.ad_status', ['user' => 'Admin'], 'New ad has been created and need to approve.');
        return redirect()->route('home');
    }

    public function SeeAllAds()
    {
        $ads = Ad::get();

        return view('dashboard.ads.index', ['ads' => $ads]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ads = Ad::with('attributes')->find($id);

        return view('dashboard.ads.ShowSingleAd', ['ads' => $ads]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = Ad::find($id);
        $country = Country::get();
        return view('front.edit-user-ad', ['ad' => $ad, 'country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ads = Ad::find($id);
        $ad_record = Ad::with('attributes')->find($id);
        $ad_data = $request->only(
            [
                "category_id",
                "name",
                "price",
                "description",
                "city_id",
                'country_id',
                $ad_record->status = 'Update Pending',
                "location"
            ]
        );


        $ad_data['status'] = 'Pending';




        // $ad_data = $request->only(
        //     [
        //         "category_id",
        //         "name",
        //         "price",
        //         "description",
        //         "city_id",
        //         "location"
        //     ]
        // );
        $ad_data['status'] = 'Update Pending';
        $ad_record->update($ad_data);
        $atributes = Category::find($request['category_id'])->attributes;
        $attr_names = [];
        $attr_ids = [];
        foreach ($atributes as $atribute) {
            $attr_names[] = $atribute->name;
            $attr_ids[] = $atribute->id;
        }
        $values = $request->only($attr_ids);
        foreach ($values as $attribute_id => $value) {

            $ad_record->attributes()->updateExistingPivot($attribute_id, [
                'value' => $value,
            ]);
        }

        if ($request->hasFile('fileimage')) {
            $uploadpath = 'ads/image/';
            $i = 1;
            foreach ($request->file('fileimage') as $fileimage) {
                $extension = $fileimage->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $fileimage->move($uploadpath, $filename);
                $finalImagePathName = $filename;

                $ads->image()->create([
                    'ad_id' => $ads->id,
                    'fileimage' => $finalImagePathName,
                ]);
            }
        }

        $this->sendAdminMail('emails.ad_status', ['user' => 'Admin'], 'Ad need admin to confirm updating.');

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $ads = $request->image_id;

        $query = Ad::with('image')->find($ads);
        foreach ($query['image'] as $ad) {
            $file = public_path() . '/ads/image/' . $ad['fileimage'];

            if (fileExists($file)) {
                unlink($file);
            }
        }
        DB::table('images')
            ->where("ad_id", '=',   $ads)
            ->delete();


        DB::table('ad_attribute')
            ->where("ad_id", '=',   $ads)
            ->delete();
        DB::table('ads')
            ->where("id", '=',   $ads)
            ->delete();
        if ($query) {
            return response()->json(['status' => 'Ads has deleted successfully']);
        } else {
            return response()->json(['status' =>  'no Ads found']);
        }
        return redirect()->Back()->with('message', 'Ads  Deleted successfully');
    }

    public function UpdateStatus(Ad $ad)
    {
        $adUser = Ad::where('id', $ad->id)->with('user', 'category')->first();
        $notify_user = $adUser->user;
        $user = $adUser->ToArray();
        $free_days = $user['category']['free_ads_days'] - 1;

        if ($ad->status == 'Pending') { // new ad

            $end =  Carbon::now()->addDays($free_days);
            $today = Carbon::now()->toDateString();
            $remaining  = ($end->diffInDays(Carbon::now()));
            $end1 = $end->toDateString();

            DB::table('ads')
                ->where("ads.id", '=',  $ad->id)
                ->update([
                    'ads.status' => 'Approved', 'ads.start_date' => "$today",
                    'ads.end_date' => "$end1", 'ads.remaining' => $remaining
                ]);

            $usercc = $notify_user;
            $usercc->notify((new NotifNotification('status : approved')));

            $this->sendAdMail('emails.ad_status', ['status' => 'approved', 'user' => $user['user']['name']], $user, 'Congratulations! Your ad has been approved');
            return redirect()->Back()->with('message', 'Ad has been accepted successfully');
        } else if ($ad->status == 'Update Pending') { // update existing ad
            $remaining = $user['remaining'];
            $end =  Carbon::now()->addDays($remaining);
            $end1 = $end->toDateString();

            DB::table('ads')
                ->where("ads.id", '=',  $ad->id)
                ->update(['ads.status' => 'Approved', 'ads.end_date' => "$end1"]);
            $usercc = $notify_user;
            $usercc->notify((new NotifNotification('status : updated')));

            $this->sendAdMail('emails.ad_status', ['status' => 'updated', 'user' => $user['user']['name']], $user, 'Congratulations! Your ad has been updated');

            return redirect()->Back()->with('message', 'Ad has been updated successfully');
        } else if ($ad->status == 'Approved') {

            DB::table('ads')
                ->where("ads.id", '=',  $ad->id)
                ->update(['ads.status' => 'sold']);

            $usercc = $notify_user;
            $usercc->notify((new NotifNotification('status : sold')));

            $this->sendAdMail('emails.ad_status', ['status' => 'sold', 'user' => $user['user']['name']], $user, 'Your ad has been sold');

            return redirect()->Back()->with('message', 'ads has been sold');
        }
    }


    public function sendAdMail($view, $values, $use, $sub)
    {
        if (env('MAIL_HOST') == 'mail.your-beauty.online') {
            Mail::send($view,  $values, function ($message) use ($use, $sub) {
                $message->to($use['user']['email']);
                $message->subject($sub);
            });
        }
    }

    public function sendAdminMail($view, $values, $sub)
    {
        $admin = User::where('role', 'admin')->get()->first();
        // dd( $admin);
        if (env('MAIL_HOST') == 'mail.your-beauty.online') {
            Mail::send($view,  $values, function ($message) use ($admin, $sub) {
                $message->to($admin->email);
                $message->subject($sub);
            });
        }
    }

    public function rejectStatus(Ad $ad)
    {
        $adUser = Ad::where('id', $ad->id)->with('user')->first();
        $user = $adUser->ToArray();

        if ($ad->status == 'Pending') {
            DB::table('ads')
                ->where("ads.id", '=',  $ad->id)

                ->update(['ads.status' => 'Rejected']);
            $this->sendAdMail('emails.ad_status', ['status' => 'Rejected', 'user' => $user['user']['name']], $user, 'Sorry! You ad is illegal Please! check the rules and edit your ad');
            return redirect()->Back()->with('message', 'ads has been Rejected');
        }
    }

    public function soldaduser(Request $request)
    {
        $ad = $request->sold_id;



        // $adUser = Ad::where('id', $ad->id)->with('user')->first();
        // $user = $adUser->ToArray();


        $adUser = Ad::where('id', $ad)->with('user')->first();
        $user = $adUser->ToArray();


        // $adUser = Ad::where('id', $ad->id)->with('user')->first();
        // $user = $adUser->ToArray();

        $adUser = Ad::where('id', $ad)->with('user')->first();
        $user = $adUser->ToArray();


        $query = Ad::where('status', $ad)->update(['ads.status' => 'Sold']);


        DB::table('ads')
            ->where("ads.id", '=',  $ad)

            ->update(['ads.status' => 'Sold']);


        // $this->sendAdMail('emails.ad_status', ['status' => 'sold', 'user' => $user['user']['name']], $user, 'Thank You For caring about our website');

        $this->sendAdMail('emails.ad_status', ['status' => 'sold', 'user' => $user['user']['name']], $user, 'Thank You For caring about our website');


        // $this->sendAdMail('emails.ad_status', ['status' => 'sold', 'user' => $user['user']['name']], $user, 'Thank You For caring about our website');
        $this->sendAdMail('emails.ad_status', ['status' => 'sold', 'user' => $user['user']['name']], $user, 'Thank You For caring about our website');

        if ($query) {
            return response()->json(['status' => 'congratulation ads accepted!']);
        } else {
            return response()->json(['status' =>  'no Ads found']);
        }
    }

    public function sendmessg(Ad $ad)
    {

        // retur view ('chatmssg',['id'])
    }
    public function publish(Request $request, $id)
    {
        $ad = Ad::find($id);

        if ($ad->status == 'Deactive') { // new ad

            DB::table('ads')
                ->where("ads.id", '=',  $ad->id)
                ->update([
                    'ads.status' => 'Pending'
                ]);
        }
        $ad->update($request->all());
        return redirect()->route('home');
    }
}
