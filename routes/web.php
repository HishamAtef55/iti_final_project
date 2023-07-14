<?php


define('PAGINATION_COUNT', 2);
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\AttributeController;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\AdController;
// use App\Http\Controllers\PageController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PackageController;
// use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\UserController;

use App\Models\Ad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;

use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AdpageController;
use App\Http\Controllers\Frontend\CategoryPageController;
use Faker\Guesser\Name;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacebookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/{page}', [AdminController::class, 'index'])->middleware('admin');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/admin/{page}', [AdminController::class, 'index'])->middleware(['admin']);
Route::resource('/packages', PackageController::class);
Route::put('/packages/change/{id}', [PackageController::class, 'change'])->name("packages.change");
Route::delete('/packages/deleteCategory/{id}', [PackageController::class, 'deleteCategoryFromPackage'])->name("package_category.destroy");
Route::put('/packages/updateCategory/{id}', [PackageController::class, 'updateCategoryPackage'])->name("package_category.update");
Route::get('/packages/categoryCreate/{id}', [PackageController::class, 'createCategoryToPackage'])->name("package_category.create");
Route::post('/packages/category/', [PackageController::class, 'addCategoryToPackage'])->name("package_category.store");
Route::post('/packages/editCategory/{id}', [PackageController::class, 'editSingleCategory'])->name("package_category.edit");
Route::get('/userCategoryCreate', [PackageController::class, 'userCategoryCreate'])->name("userCategory.create");
Route::post('/userPackageCreate', [PackageController::class, 'userPackageCreate'])->name("userPackage.create");
Route::post('/buy', [PackageController::class, 'buy'])->name("buy");
Route::get('/packageUsers/{id}', [PackageController::class, 'packageUsers'])->name("package.users");
Route::get('/userPackages/{id}', [PackageController::class, 'userPackages'])->name("user.packages");
Route::get('/mypackages', [PackageController::class, 'myPackages'])->name("user.myPackages");
Route::get('/cart', [PackageController::class, 'cart'])->name('cart');
Route::resource('orders', OrderController::class);
Route::get('/myOrders', [OrderController::class, 'myOrders'])->name('MyOrders');
Route::get('/orderDetails/{id}', [OrderController::class, 'details'])->name('details');

Route::get('/front/{page}', [PageController::class, 'index']);
Route::resource('attributes', AttributeController::class);
Route::resource('categories', CategoryController::class)->middleware(['admin']);
Route::get('/xx', [CategoryController::class, 'get_all_parents']);
Route::get('/attributes/create2/{id}', [AttributeController::class, 'create2'])->name('add-attribute');

Route::get('/category/child/{id}', [CategoryController::class, 'get_child']);

Auth::routes(['verify' => true]);

Route::get('/attributes/create2/{id}', [AttributeController::class, 'create2'])->name('add-attribute');

Route::get('/category/child/{id}', [CategoryController::class, 'get_child']);


Route::resource('ads', AdController::class)->middleware('auth');
Route::post('/ads/attributes', [AdController::class, 'create2'])->name('create-ad')->middleware('verified');

Route::get('/ads/category/{id}', [AdController::class, 'create3'])->name('create_ad_form');
Route::post('/api/fetch/state', [AdController::class, 'fetchstate']);
Route::post('/ad/sold/status', [AdController::class, 'soldaduser']);
Route::get('/ads/category/{id}', [AdController::class, 'create3'])->name('create_ad_form')->middleware('auth');
Route::delete('/delete/image', [UserController::class, 'ddestroy']);


Route::post('/ads/attributes/createad', [AdController::class, 'store']);
Route::delete('/ads/delete', [AdController::class, 'destroy']);
Route::get('myusers', [UserController::class, 'index'])->name('user.index')->middleware(['admin']);
Route::get('aboutus/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('update/{id}', [UserController::class, 'update'])->name('user.update');

Route::delete('/delete/{id}', [UserController::class, 'ddestroy'])->name('user.destroy');
Route::get('/See/All/Ads', [AdController::class, 'SeeAllAds']);
Route::get('/See/Ads/{ad}', [AdController::class, 'show'])->name('shows.ads.details');
Route::get('/changestatus/Ads/{ad}', [AdController::class, 'UpdateStatus'])->name('updates.ads.status');
Route::get('/rejectstatus/Ads/{ad}', [AdController::class, 'rejectStatus'])->name('reject.ads.status');
Route::get('/edituser/Ads/{id}', [AdController::class, 'edit'])->name('UseradEdit');
Route::put('/updateuser/Ads/{id}', [AdController::class, 'update'])->name('UserAdUpdate');




Route::get('profile/{user}', [UserProfileController::class, 'index'])->name('profile');


Route::put('profileUpdate/{user}', [UserProfileController::class, 'update'])->name('profileUpdate');
Route::get('/adss/{id}', [UserProfileController::class, 'show'])->name('po')->middleware('auth');



//Route::get('myusers', [UserController::class, 'index'])->name('user.index')->middleware(['admin']);

Route::resource('users', UserController::class);

Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');


Route::get('/category/{id?}', [CategoryPageController::class, 'categoryPage'])->name('category-page');

Route::get('/category/{order}/{id?}', [CategoryPageController::class, 'categoryOrder'])->name('category.order');

Route::post('/ad/search', [CategoryPageController::class, 'searchAd'])->name('search_form');
Route::post('/ad/search_name', [CategoryPageController::class, 'searchAd_name'])->name('search_name');


Route::get('/ad-details/{id}', [AdpageController::class, 'getAddDetails'])->name('adDetails');
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ResetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');




Route::get('/{page}', [PageController::class, 'index']);

Route::get('add/user', [UserController::class, 'index2']);
Route::post('add/user', [UserController::class, 'create'])->name('registerr');

Route::get('user/ads/{id}', [UserController::class, 'index3'])->name('users_posts');







Route::get('/{page}', [PageController::class, 'index']);




Route::get('/wishlist/add/{ad}', [HomeController::class, 'wishlist_store'])->name('wishlist.store')->middleware('auth');
Route::get('/wishlist/delete/{ad}', [HomeController::class, 'wishlist_destroy'])->name('wishlist.destroy')->middleware('auth');
Route::get('/wishlist/show', [HomeController::class, 'wishlist_show'])->name('wishlist.show')->middleware('auth');



Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('auth/facebook', [FacebookController::class, 'redirect'])->name('facebook.login');
Route::get('auth/facebook/callback', [FacebookController::class, 'callbackFacebook']);


Route::get('/chatify/{ad}', [AdController::class, 'sendmessg'])->name('sendmessage');

Route::get('/republish/Ads/{id}', [AdController::class, 'publish'])->name('republishad');

Route::get('/pay/money/{order}', [App\Http\Controllers\FatoorahController::class, 'payOrder'])->name('pay_order')->middleware('auth');
Route::get('call_back', [App\Http\Controllers\FatoorahController::class, 'call_back']);




Route::get('/chatify/{ad}', [AdController::class, 'sendmessg'])->name('sendmessage');
