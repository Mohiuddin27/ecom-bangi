<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecyclebinController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

Route::get('/', function () {
    return view('auth.login');
});
// Route::view('/dashboard','home')->middleware('auth');
Route::group(['middleware' => 'auth'],function(){
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/profiles', [AdminController::class, 'Profile'])->name('profile');

//admins route
Route::resource('admins',AdminsController::class);
//roles controller
Route::resource('roles', RolesController::class);

//Categories route
Route::get('categories',[CategoryController::class,'categoryIndex'])->name('category.index');
Route::post('categories-create',[CategoryController::class,'categoryStore'])->name('category.store');
Route::post('new-subcategories-create/{id}',[CategoryController::class,'newSubcategoryStore'])->name('new.subcategory.store');
Route::get('categories-edit/{id}',[CategoryController::class,'categoryEdit'])->name('category.edit');
Route::post('categories-update/{id}',[CategoryController::class,'categoryUpdate'])->name('category.update');
Route::get('categories-delete/{id}',[CategoryController::class,'categoryDelete'])->name('category.delete');
Route::get('subcategories-delete/{id}',[CategoryController::class,'subcategoryDelete'])->name('subcategory.delete');
Route::get('category-of-subcategories/{id}',[CategoryController::class,'categoryOfSubcategories'])->name('subcategories.show');
//Route Color
Route::get('color',[ColorController::class,'colorIndex'])->name('color.index');
Route::post('color-create',[ColorController::class,'colorStore'])->name('color.store');
Route::get('color-edit/{id}',[ColorController::class,'colorEdit'])->name('color.edit');
Route::post('color-update/{id}',[ColorController::class,'colorUpdate'])->name('color.update');
Route::get('color-delete/{id}',[ColorController::class,'colorDelete'])->name('color.delete');

//Route Size
Route::get('size',[SizeController::class,'sizeIndex'])->name('size.index');
Route::post('size-create',[SizeController::class,'sizeStore'])->name('size.store');
Route::get('size-edit/{id}',[SizeController::class,'sizeEdit'])->name('size.edit');
Route::post('size-update/{id}',[SizeController::class,'sizeUpdate'])->name('size.update');
Route::get('size-delete/{id}',[SizeController::class,'sizeDelete'])->name('size.delete');

//product route
Route::get('product',[ProductController::class,'productIndex'])->name('product.index');
Route::get('findsubcategory',[ProductController::class,'findSubCategory'])->name('find.sub.category');
Route::get('product-create',[ProductController::class,'productCreate'])->name('product.create');
Route::post('product-store',[ProductController::class,'productStore'])->name('product.store');
Route::get('product-edit/{id}',[ProductController::class,'productEdit'])->name('product.edit');
Route::post('product-update/{id}',[ProductController::class,'productUpdate'])->name('product.update');
Route::get('product-delete/{id}',[ProductController::class,'productDelete'])->name('product.delete');
Route::get('image-delete/{id}',[ProductController::class,'imageDelete'])->name('image.delete');



//recyclebin
Route::get('recyclebin',[RecyclebinController::class,'index'])->name('recyclebin.index');

Route::get('product-restore/{id}',[RecyclebinController::class,'productRestore'])->name('product.restore');
Route::get('product-permanently-delete/{id}',[RecyclebinController::class,'productPermanentlyDelete'])->name('product.permanently.delete');

Route::get('image-restore/{id}',[RecyclebinController::class,'imageRestore'])->name('image.restore');
Route::get('image-permanently-delete/{id}',[RecyclebinController::class,'imagePermanentlyDelete'])->name('image.permanently.delete');

Route::get('category-restore/{id}',[RecyclebinController::class,'categoryRestore'])->name('category.restore');
Route::get('category-permanently-delete/{id}',[RecyclebinController::class,'categoryPermanentlyDelete'])->name('category.permanently.delete');

Route::get('subcategory-restore/{id}',[RecyclebinController::class,'subcategoryRestore'])->name('subcategory.restore');
Route::get('subcategory-permanently-delete/{id}',[RecyclebinController::class,'subcategoryPermanentlyDelete'])->name('subcategory.permanently.delete');

Route::get('color-restore/{id}',[RecyclebinController::class,'colorRestore'])->name('color.restore');
Route::get('color-permanently-delete/{id}',[RecyclebinController::class,'colorPermanentlyDelete'])->name('color.permanently.delete');

Route::get('size-restore/{id}',[RecyclebinController::class,'sizeRestore'])->name('size.restore');
Route::get('size-permanently-delete/{id}',[RecyclebinController::class,'sizePermanentlyDelete'])->name('size.permanently.delete');


//settings
Route::get('settings',[SettingController::class,'index'])->name('setting.index');
Route::post('settings-update',[SettingController::class,'update'])->name('setting.store');
//activity
Route::get('activity',[ActivityController::class,'index'])->name('activity.index');





});
