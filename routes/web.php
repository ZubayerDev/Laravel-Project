<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TagController;
use App\http\Controllers\userController;
use App\Http\Controllers\VariationController;
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

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/details/{pruduct_slug}', [FrontendController::class, 'product_details'])->name('product.details');
Route::post('/getsize', [FrontendController::class, 'getsize']);
Route::post('/getquantity', [FrontendController::class, 'getquantity']);
Route::post('/getprice', [FrontendController::class, 'getprice']);
Route::get('/category/all/{category_slug}', [FrontendController::class, 'category_all'])->name('category.all');
Route::get('/subcategory/all/{subcategory_slug}', [FrontendController::class, 'subcategory_all'])->name('subcategory.all');
Route::get('/offer/product/', [FrontendController::class, 'offer_product'])->name('offer.product');
Route::get('/half/offer/product/', [FrontendController::class, 'half_offer_product'])->name('half.offer.product');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// User ///////////
Route::get('users/list', [userController::class, 'user_list'])->name('user.list');
Route::post('add/user', [userController::class, 'add_user'])->name('add.user');
Route::get('/edit/profile', [userController::class, 'edit_user'])->name('edit.profile');
Route::post('/update/profile', [userController::class, 'update_profile'])->name('profile.update');
Route::post('/update/password', [userController::class, 'update_password'])->name('update.password');
Route::post('/update/picture', [userController::class, 'update_picture'])->name('picture.update');
Route::get('/delete/user/{user_id}', [userController::class, 'user_delete'])->name('user.delete');

// Category //////////
Route::get('/add/category', [CategoryController::class, 'add_category'])->name('add.category');
Route::post('/category/store/', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/all/category/', [CategoryController::class, 'all_category'])->name('all.category');
Route::get('/edit/category/{id}', [CategoryController::class, 'edit_category'])->name('edit.category');
Route::post('/update/category/{id}', [CategoryController::class, 'update_category'])->name('update.category');
Route::get('/delete/category/{id}', [CategoryController::class, 'delete_category'])->name('delete.category');
Route::get('/status/category/{id}', [CategoryController::class, 'status_category'])->name('status.category');
Route::get('/trash/category', [CategoryController::class, 'trash_category'])->name('trash.category');
Route::get('/restore/category/{id}', [CategoryController::class, 'restore_category'])->name('restore.category');
Route::get('/category/force/delete/{id}', [CategoryController::class, 'force_category_delete'])->name('force.category.delete');
Route::post('/category/checked/delete', [CategoryController::class, 'checked_category_delete'])->name('checked.category.delete');
Route::post('/category/checked/restore', [CategoryController::class, 'checked_category_restore_delete'])->name('checked.category.restore.delete');
Route::get('/category/checked/allDelete', [CategoryController::class, 'checked_category_allDelete'])->name('checked.category.allDelete');

///////////////// Sub Cateogry //////////////////////
Route::get('subcategory', [SubcategoryController::class,'subcategory'])->name('subcategory');
Route::post('subcategory/store', [SubcategoryController::class,'subcategory_store'])->name('subcategory.store');
Route::get('allsubcategory/store', [SubcategoryController::class,'allsubcategory_store'])->name('allsubcategory.store');
Route::get('delete/subcategory/{id}', [SubcategoryController::class,'delete_subcategory'])->name('delete.subcategory');
Route::get('edit/subcategory/{id}', [SubcategoryController::class,'edit_subcategory'])->name('edit.subcategory');
Route::post('update/subcategory/{id}', [SubcategoryController::class,'update_subcategory'])->name('update.subcategory');

///////////////// Brand //////////////////////
Route::get('brand', [BrandController::class,'brand'])->name('brand');
Route::post('brand/store', [BrandController::class,'brand_store'])->name('brand.store');
Route::get('brand/delete/{id}', [BrandController::class,'brand_delete'])->name('brand.delete');

///////////////// Tags //////////////////////
Route::get('tags', [TagController::class, 'tags'])->name('tags');
Route::post('tags/store', [TagController::class, 'tags_store'])->name('tags.store');
Route::get('tags/delete/{id}', [TagController::class, 'tags_delete'])->name('tags.delete');

///////////////// Add Product //////////////////////
Route::get('addproduct', [ProductController::class, 'addproduct'])->name('addproduct');
Route::post('/getSubcategory', [ProductController::class, 'getSubcategory']);
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');
Route::get('/product/view/{id}', [ProductController::class, 'product_view'])->name('product.view');
Route::get('/product/update/{id}', [ProductController::class, 'product_update'])->name('product.update');
Route::post('/product/edit_all/{id}', [ProductController::class, 'product_edit_all'])->name('product.edit.all');
Route::get('/product/delete/{id}', [ProductController::class, 'product_delete'])->name('product.delete');


////////////////////// Variation //////////////////////
Route::get('/add/variation', [VariationController::class, 'add_variation'])->name('add.variation');
Route::post('/add/color', [VariationController::class, 'add_color'])->name('add.color');
Route::post('/add/size', [VariationController::class, 'add_size'])->name('add.size');
Route::get('/add/inventory/{id}', [VariationController::class, 'add_inventory'])->name('add.inventory');
Route::post('/inventory/store/{id}', [VariationController::class, 'inventory_store'])->name('inventory.store');
Route::get('/color/delete/{id}', [VariationController::class, 'color_delete'])->name('color.delete');
Route::get('/size/delete/{id}', [VariationController::class, 'size_delete'])->name('size.delete');


////////////////////// Slider//////////////////////
Route::get('/add/slider', [SliderController::class, 'add_slider'])->name('add.slider');
Route::post('/store/slider', [SliderController::class, 'store_slider'])->name('store.slider');



////////////////////// Customers Auth//////////////////////
Route::get('/customer/register', [CustomerAuthController::class, 'customer_register'])->name('customer.register');
Route::get('/customer/login', [CustomerAuthController::class, 'customer_login'])->name('customer.login');
Route::post('/customer/ragister/post', [CustomerAuthController::class, 'customer_ragister_post'])->name('customer.ragister.post');
Route::post('/customer/login/post', [CustomerAuthController::class, 'customer_login_post'])->name('customer.login.post');
Route::get('/customer/logout/post', [CustomerAuthController::class, 'customer_logout_post'])->name('customer.logout.post');
Route::get('/customer/profile', [CustomerController::class, 'customer_profile'])->name('customer.profile');
Route::post('/getcity', [CustomerController::class, 'get_city']);
Route::post('customer/profile/update', [CustomerController::class, 'customer_profile_update'])->name('customer.profile.update');


////////////////////// Cart //////////////////////
Route::post('addto/cart/{product_id}', [CartController::class, 'addto_cart'])->name('addto.cart');
Route::get('cart/remove{cart_id}', [CartController::class, 'cart_remove'])->name('cart.remove');
