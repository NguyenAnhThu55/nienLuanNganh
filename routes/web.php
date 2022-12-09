<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CategoryProduct;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
// frontend routes
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');
Route::get('/tim-kiem','HomeController@search');

// Danh Mục Sản Phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@detail_product');
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProduct@show_brand_home');

// Send Mail
Route::get('/send-mail','HomeController@send_mail');

// Backend routes
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::post('/filter-by-date','AdminController@filter_by_date');
// /show_dashboard
Route::post('/days-order','AdminController@days_order');
Route::post('/dashboard-filter','AdminController@dashboard_filter');
Route::post('/show-dashboard','AdminController@show_dashboard');

// CategoryProduct routes
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');

Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');

// BrandProduct routes
Route::get('/add-brand-product','brandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','brandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','brandProduct@delete_brand_product');
Route::get('/all-brand-product','brandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','brandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','brandProduct@active_brand_product');

Route::post('/save-brand-product','brandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','brandProduct@update_brand_product');
// Contacts PAGE
Route::get('/lien-he','ContactController@lien_he');

// ProductController routes
Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');

// Comments
Route::post('/load-comment','ProductController@load_comment');
Route::post('/sent-comment','ProductController@sent_comment');
// Rating
Route::post('/insert-rating','ProductController@insert_rating');

// insert-rating

// Coupon
Route::post('/check-coupon','CartController@check_coupon');
// Admin CouponController
Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::post('/insert-coupon-code','CouponController@insert_coupon_code');

// cart routes
Route::post('/save-cart','CartController@save_cart');
Route::get('/save-cart','CartController@save_cart');
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
// Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/show-cart-quantity','CartController@show_cart_quantity');
// cart Ajax
Route::post('/add-cart-ajax','CartController@add_cart_ajax');

// checkout cart
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::get('/register-checkout','CheckoutController@register_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/checkout','CheckoutController@checkout');

Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
// Route::get('/save-checkout-customer','CheckoutController@save_checkout_customer');

Route::get('/payment','CheckoutController@payment');

Route::get('/del-fee','CheckoutController@del_fee');

Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/calculate-fee','CheckoutController@calculate_fee');

Route::post('/confirm-order','CheckoutController@confirm_order');


// order routes
Route::get('/print-order/{checkout_code}','CheckoutController@print_order');
Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/view-order/{orderId}','CheckoutController@view_order');
Route::post('/update-order-qty','CheckoutController@update_order_qty');
Route::post('/update-qty','CheckoutController@update_qty');

// DeliveryController
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_feeship');


// Gallery
Route::get('/add-gallery/{product_id}','GalleryController@add_gallery');
Route::post('/select-gallery','GalleryController@select_gallery');
Route::post('/insert-gallery/{product_id}','GalleryController@insert_gallery');
Route::post('/update-gallery-name','GalleryController@update_gallery_name');
Route::post('/delete-gallery','GalleryController@delete_gallery');
