<?php

use App\Http\Controllers\ActicleControll;
use Illuminate\Support\Facades\Route;


// Admin
use App\Http\Controllers\AdminController;

Route::get('/admincp', [AdminController::class, 'index']);
Route::get('/login-admin', [AdminController::class, 'admin_login_index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/list-user', [AdminController::class, 'list_user']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/login', [AdminController::class, 'login']);

// Categories Product
use App\Http\Controllers\CategoryController;

Route::get('/add-category-product', [CategoryController::class, 'add_category_product']);
Route::get('/list-category-product', [CategoryController::class, 'list_category_product']);

Route::get('/edit-category-product/{categories_product_id}', [CategoryController::class, 'edit_category_product']);
Route::get('/delete-category-product/{categories_product_id}', [CategoryController::class, 'delete_category_product']);

Route::get('/active-cate-product/{categories_product_id}', [CategoryController::class, 'active_category_product']);
Route::get('/inactive-cate-product/{categories_product_id}', [CategoryController::class, 'inactive_category_product']);

Route::post('/save-category-product', [CategoryController::class, 'save_category_product']);
Route::post('/update-category-product/{categories_product_id}', [CategoryController::class, 'update_category_product']);


// Brand
use App\Http\Controllers\BrandController;

Route::get('/add-brand', [BrandController::class, 'add_brand']);
Route::get('/list-brand', [BrandController::class, 'list_brand']);

Route::get('/active-brand/{brand_id}', [BrandController::class, 'active_brand']);
Route::get('/inactive-brand/{brand_id}', [BrandController::class, 'inactive_brand']);


Route::get('/edit-brand/{brand_id}', [BrandController::class, 'edit_brand']);

Route::post('/save-brand', [BrandController::class, 'save_brand']);

Route::post('/update-brand/{brand_id}', [BrandController::class, 'update_brand']);
Route::get('/select-brand', [BrandController::class, 'select_brand']);
Route::get('/delete-brand/{brand_id}', [BrandController::class, 'delete_brand']);
// dành cho user
Route::get('/show-brand-user/{brand_id}', [BrandController::class, 'show_brand_user']);


// 
use App\Http\Controllers\RelationController;

Route::get('/list-relation',  [RelationController::class, 'list_relation']);
Route::get('/add-relation',  [RelationController::class, 'add_relation']);
// Products
use App\Http\Controllers\ProductControll;

Route::get('/add-product', [ProductControll::class, 'add_product']);
Route::get('/list-product', [ProductControll::class, 'list_product']);

Route::get('/active-product/{product_id}', [ProductControll::class, 'active_product']);
Route::get('/inactive-product/{product_id}', [ProductControll::class, 'inactive_product']);
Route::get('/edit-product/{product_id}', [ProductControll::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductControll::class, 'delete_product']);

Route::post('/save-product', [ProductControll::class, 'save_product']);
Route::post('/update-product/{product_id}', [ProductControll::class, 'update_product']);



///////////////////////////// Users///////////////////

// Home controller
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/detail-product/{product_id}', [HomeController::class, 'detail_product']);

Route::get('/review-product/{product_id}', [HomeController::class, 'review_product']);

Route::get('/get-review-cmt', [HomeController::class, 'get_review_cmt']);

Route::post('/search', [HomeController::class, 'search']);


Route::post('/favorite-toggle', [HomeController::class, 'favorite_toggle']);
Route::get('/check-favorite/{product_id}', [HomeController::class, 'check_favorite']);
Route::post('/delete-favorite', [HomeController::class, 'delete_favorite']);

Route::post('/send-review', [HomeController::class, 'send_review']);
Route::get('/get-review-cmt-min/{product_id}', [HomeController::class, 'get_review_cmt_min']);
Route::get('/get-review-cmt-all/{product_id}', [HomeController::class, 'get_review_cmt_all']);

Route::get('/average-start/{product_id}', [HomeController::class, 'average_start']);
Route::get('/count-with-star/{product_id}', [HomeController::class, 'count_with_star']);
Route::get('/filter-reviews-min', [HomeController::class, 'filter_reviews_min']);
Route::get('/filter-reviews', [HomeController::class, 'filter_reviews']);

// Users sidebar
Route::get('/thong-tin-ca-nhan', [HomeController::class, 'thong_tin_ca_nhan']);

Route::get('/wishlist', [HomeController::class, 'wishlist']);
Route::get('/data-wishlist', [HomeController::class, 'data_wishlist']);
Route::get('/thong-tin-ca-nhan/setting', [HomeController::class, 'setting']);
Route::post('/change-password', [HomeController::class, 'change_password']);
Route::post('/change-avatar', [HomeController::class, 'change_avatar']);
// // Users s
use App\Http\Controllers\CheckoutController;

Route::get('/login-index', [CheckoutController::class, 'login_index']);
Route::get('/register-index', [CheckoutController::class, 'register_index']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);


// Check out
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/logout', action: [CheckoutController::class, 'logout']);


Route::post('/select-wards-shipping', [CheckoutController::class, 'select_wards_shipping']);
Route::post('/select-district-shipping', [CheckoutController::class, 'select_district_shipping']);

Route::post('/order-product', [CheckoutController::class, 'order_product']);


// Cart Product
use App\Http\Controllers\CartController;
use App\Models\Coupons;

Route::get('/cart', [CartController::class, 'index']);

Route::post('/add-cart', [CartController::class, 'addToCart']);

Route::get('/delete/{session_id}', [CartController::class, 'delete']);
Route::get('/delete-all', [CartController::class, 'delete_all_cart']);


Route::get('/count-cart', [CartController::class, 'count_cart']);
Route::get('/cart-message', [CartController::class, 'cart_message']);

Route::post('/update-quantity-cart', [CartController::class, 'update_quantity_cart']);

// Coupons

use App\Http\Controllers\CouponsController;

Route::get('/add-discount-code', [CouponsController::class, 'add_discount']);
Route::post('/save-coupon', [CouponsController::class, 'save_coupons']);
Route::get('/list-coupons', [CouponsController::class, 'list_coupons']);
Route::get('/update-coupon/{id_coupon}', [CouponsController::class, 'update_coupon']);
Route::get('/delete-coupon/{id_coupon}', [CouponsController::class, 'delete_coupon']);
Route::get('/delete-coupon-checkout', [CouponsController::class, 'delete_coupon_checkout']);
Route::post('/check-coupon', [CouponsController::class, 'check_coupon']);

use App\Http\Controllers\OrderController;

Route::get('/order-view', [OrderController::class, 'order_view']);
Route::get('/view-detail/{order_code}', [OrderController::class, 'view_detail']);

Route::get('/print-order/{order_code}', [OrderController::class, 'print_order']);
Route::post('/update-status-order', [OrderController::class, 'update_status_order']);

Route::get('/history-order', [OrderController::class, 'history_order']);
Route::get('/view-history-order/{order_code}', [OrderController::class, 'view_history']);
Route::post('/cancel-order', [OrderController::class, 'cancel_order']);
// SLIDE CONTROLL

use App\Http\Controllers\SlideController;

Route::get('/add-slide', [SlideController::class, 'new_slide']);
Route::post('/save-slide', [SlideController::class, 'save_slide']);

Route::get('/list-banner', [SlideController::class, 'list_banner']);

Route::get('/active-banner/{id_banner}', [SlideController::class, 'active_banner']);
Route::get('/inactive-banner/{id_banner}', [SlideController::class, 'inactive_banner']);

use App\Http\Controllers\CommentController;


Route::post('/send-comment', [CommentController::class, 'send_comment']);
Route::get('/get-comment', [CommentController::class, 'get_comment']);
Route::get('/comments-index', [CommentController::class, 'comments_index']);
Route::post('/rep-comment/{id_comment}', [CommentController::class, 'rep_comment']);

// POST
// post
// admin
Route::get('/add-post', [ActicleControll::class, 'add_post']);
Route::post('/save-post', [ActicleControll::class, 'save_post']);
Route::get('/all-post', [ActicleControll::class, 'all_post']);
Route::get('/active-post/{id_post}', [ActicleControll::class, 'active_post']);
Route::get('/inactive-post/{id_post}', [ActicleControll::class, 'inactive_post']);
// user
Route::get('/list-post', [ActicleControll::class, 'list_post']);
