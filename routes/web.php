<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Client Controller

    Route::get('/', [ClientController::class, 'viewhomepage']);
    Route::get('/about', [ClientController::class, 'viewaboutpage']);
    Route::get('/faq', [ClientController::class, 'viewfaqpage']);
    Route::get('/contact', [ClientController::class, 'viewcontactpage']);
    Route::get('/login', [ClientController::class, 'viewloginpage']);
    Route::get('/register', [ClientController::class, 'viewregisterpage']);
    Route::get('/cart', [ClientController::class, 'viewcartpage']);
    Route::get('/checkout', [ClientController::class, 'viewcheckoutpage']);
    Route::get('/dashboard', [ClientController::class, 'viewdashboardpage']);
    Route::get('/profile', [ClientController::class, 'viewprofilepage']);
    Route::get('/billingdetails', [ClientController::class, 'viewbillingdetailspage']);
    Route::get('/productbycategory', [ClientController::class, 'viewproductbycategorypage']);
    Route::get('/productdetails', [ClientController::class, 'viewproductdetailspage']);
    Route::get('/searchproduct', [ClientController::class, 'viewsearchproductpage']);

// Admin Controller
    Route::get('/admin', [AdminController::class, 'viewadmindashboard']);
    Route::get('/admin/settings', [AdminController::class, 'viewadminsettings']);
    Route::get('/admin/size', [AdminController::class, 'viewsizepage']);
    Route::get('/admin/addsize', [AdminController::class, 'viewaddsizepage']);
    // Route::get('/admin/editsize', [AdminController::class, 'vieweditsizepage']);
    Route::get('/admin/color', [AdminController::class, 'viewcolorpage']);
    Route::get('/admin/addcolor', [AdminController::class, 'viewaddcolorpage']);
    Route::get('/admin/country', [AdminController::class, 'viewcountrypage']);
    Route::get('/admin/addcountry', [AdminController::class, 'viewaddcountrypage']);
    Route::get('/admin/editcountry', [AdminController::class, 'vieweditcountrypage']);
    Route::get('/admin/shippingcost', [AdminController::class, 'viewshippingcostpage']);
    Route::get('/admin/editshippingcost', [AdminController::class, 'vieweditshippingcostpage']);
    Route::get('/admin/faq', [AdminController::class, 'viewfaqpage']);
    Route::get('/admin/addfaq', [AdminController::class, 'viewaddfaqpage']);
    Route::get('/admin/editfaq', [AdminController::class, 'vieweditfaqpage']);
    Route::get('/admin/registeredcustomer', [AdminController::class, 'viewregisteredcustomerpage']);
    Route::get('/admin/pagesettings', [AdminController::class, 'viewpagesettingspage']);
    Route::get('/admin/socialmedia', [AdminController::class, 'viewsocialmediapage']);
    Route::get('/admin/subscribers', [AdminController::class, 'viewsubscriberspage']);
    Route::get('/admin/adminprofile', [AdminController::class, 'viewadminprofilepage']);

//Category Controller
    Route::get('/admin/toplevelcategory', [CategoryController::class, 'viewtoplevelcategorypage']);
    Route::get('/admin/addtoplevelcategory', [CategoryController::class, 'viewaddtoplevelcategorypage']);
    Route::post('admin/savetoplevelcategory', [CategoryController::class, 'savetoplevelcategory']);
    Route::get('/admin/edittoplevelcategory/{id}', [CategoryController::class, 'viewedittoplevelcategorypage']);
    Route::put('/admin/updatetoplevelcategory/{id}', [CategoryController::class, 'updatetoplevelcategory']);
    Route::delete('/admin/deletetoplevelcategory/{id}', [CategoryController::class, 'deletetoplevelcategory']);
    Route::get('/admin/midlevelcategory', [CategoryController::class, 'viewmidlevelcategorypage']);
    Route::get('/admin/addmidlevelcategory', [CategoryController::class, 'viewaddmidlevelcategorypage']);
    Route::post('/admin/savemidlevelcategory', [CategoryController::class, 'savemidlevelcategory']);
    Route::get('/admin/editmidlevelcategory/{id}', [CategoryController::class, 'vieweditmidlevelcategorypage']);
    Route::put('/admin/updatemidlevelcategory/{id}', [CategoryController::class, 'updatemidlevelcategory']);
    Route::delete('/admin/deletemidlevelcategory/{id}', [CategoryController::class, 'deletemidlevelcategory']);
    Route::get('/admin/endlevelcategory', [CategoryController::class, 'viewendlevelcategorypage']);
    Route::get('/admin/addendlevelcategory', [CategoryController::class, 'viewaddendlevelcategorypage']);
    Route::post('/admin/saveendlevelcategory', [CategoryController::class, 'saveendlevelcategory']);
    Route::get('/admin/editendlevelcategory/{id}', [CategoryController::class, 'vieweditendlevelcategorypage']);
    Route::put('/admin/updateendlevelcategory/{id}', [CategoryController::class, 'updateendlevelcategory']);
    Route::delete('/admin/deleteendlevelcategory/{id}', [CategoryController::class, 'deleteendlevelcategory']);


//Product Controller
    Route::get('/admin/products', [ProductController::class, 'viewproductspage']);
    Route::get('/admin/addproduct', [ProductController::class, 'viewaddproductpage']);
    Route::get('/admin/orders', [ProductController::class, 'vieworderspage']);
    Route::post('admin/saveproduct', [ProductController::class, 'saveproduct']);
    Route::get('/admin/editproduct/{id}', [ProductController::class, 'vieweditproductpage']);
    Route::put('/admin/updateproduct/{id}', [ProductController::class, 'updateproduct']);
    Route::get('/admin/deleteotherphoto/{id}/{photo}', [ProductController::class, 'deleteotherphoto']);
    Route::delete('/admin/deleteproduct/{id}', [ProductController::class, 'deleteproduct']);

//SliderController
    Route::get('/admin/sliders', [SliderController::class, 'viewsliderspage']);
    Route::get('/admin/addsliders', [SliderController::class, 'viewaddsliderspage']);
    Route::get('/admin/editsliders', [SliderController::class, 'vieweditsliderspage']);
    Route::get('/admin/services', [SliderController::class, 'viewservicespage']);
    Route::get('/admin/addservice', [SliderController::class, 'viewaddservicepage']);
    Route::get('/admin/editservice', [SliderController::class, 'vieweditservicepage']);

//SettingController
    Route::post('admin/savelogo', [SettingController::class, 'savelogo']);
    Route::put('admin/updatelogo/{id}', [SettingController::class, 'updatelogo']);
    Route::post('admin/savefavicon', [SettingController::class, 'savefavicon']);
    Route::put('admin/updatefavicon/{id}', [SettingController::class, 'updatefavicon']);
    Route::post('admin/saveinformation', [SettingController::class, 'saveinformation']);
    Route::put('admin/updateinformation/{id}', [SettingController::class, 'updateinformation']);

// Shop Controller
    Route::post('admin/savesize', [ShopController::class, 'savesize']);
    Route::get('admin/editsize/{id}', [ShopController::class, 'vieweditsize']);
    Route::put('admin/updatesize/{id}', [ShopController::class, 'updatesize']);
    Route::delete('admin/deletesize/{id}', [ShopController::class, 'deletesize']);
    Route::post('admin/savecolor', [ShopController::class, 'savecolor']);
    Route::get('/admin/editcolor/{id}', [ShopController::class, 'vieweditcolorpage']);
    Route::put('admin/updatecolor/{id}', [ShopController::class, 'updatecolor']);
    Route::delete('admin/deletecolor/{id}', [ShopController::class, 'deletecolor']);



