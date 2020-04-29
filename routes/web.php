<?php

use Illuminate\Support\Facades\Route;

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

// FrontEnd

// Product
Route::get('/' , 'HomeController@index');

Route::get('/trang-chu', 'HomeController@index');

Route::get('/danh-muc-san-pham/{id}/{slug}' , 'HomeController@getProductCategory');

Route::get('/thuong-hieu/{id}/{slug}' , 'HomeController@getProductBrand');

Route::get('/chi-tiet-san-pham/{id}/{slug}' , 'HomeController@getProductDetails');

// post Comment
Route::post('/chi-tiet-san-pham/{id}/{slug}' , 'CommentController@postCommentAdd');

// Search
Route::post('/tim-kiem' , 'HomeController@postProductSearch');


// Cart
Route::post('/cart-add' , 'CartController@postCartAdd');

Route::get('/cart-show' , 'CartController@getCartShow');

Route::get('/cart-delete-one/{rowId}' , 'CartController@getCartDeleteOne');

Route::post('/cart-update' , 'CartController@postCartUpdate');

// Coupon
Route::post('/check-coupon' , 'CartController@postCheckCoupon');

Route::get('/delete-coupon' , 'CartController@getDeleteCoupon');


// Checkout and login
Route::get('/login-show' , 'CheckoutController@getCheckoutLoginShow');

Route::post('/login-add' , 'CheckoutController@postCheckoutLoginAddCustomers');

Route::get('/checkout-show' , 'CheckoutController@getCheckout');

Route::post('/checkout-add' , 'CheckoutController@postCheckoutAdd');

Route::post('/login-customers' , 'CheckoutController@postLoginCustomers');

Route::get('/logout-customers' , 'CheckoutController@getLogoutCustomers');

// Payment - Order - Order details
Route::get('/payment-show' , 'CheckoutController@getPayment');

Route::post('/order-payment-orderdetail/add' , 'CheckoutController@postPayment_Order_OrderDetailsAdd');

// Thank for sale
Route::get('/handcash/thankyou' , 'CheckoutController@getThankHandCash');

// Account
Route::get('/account/{id}' , 'AccountController@getAccount');

Route::get('/account/{id}/huy-don-hang/{idPayment}' , 'AccountController@getStatusPaymentEdit');

// Chosen
Route::get('/chosen/{id}' , 'ChosenController@getChosenShow');

Route::post('/chosen/{id}' , 'ChosenController@postChosenAdd');

Route::post('/chosen/cancel/{id}' , 'ChosenController@postChosenCancel');










// BackEnd
// Login-logout Admin
Route::get('/admin-login' , 'AdminController@getAdminLogin');
Route::post('/admin-login' , 'AdminController@postAdminLogin');

Route::get('/logout' , 'AdminController@getAdminLogout');

// Trang Admin

Route::group(['prefix' => 'admin' , 'middleware' => 'AdminLoginMiddleware'] , function(){
	Route::get('/dashboard' , 'AdminController@getAdminDashboard');

	// category_product
	Route::group(['prefix' => 'category-product'] , function(){

		Route::get('/add' , 'CategoryProduct@getAddCateProduct');
		Route::post('/add' , 'CategoryProduct@postAddCateProduct');

		Route::get('/all' , 'CategoryProduct@getAllCateProduct');

		Route::get('/all/unactive/{id}' , 'CategoryProduct@getUnactiveCateProduct');
		Route::get('/all/active/{id}' , 'CategoryProduct@getActiveCateProduct');

		Route::get('edit/{id}' , 'CategoryProduct@getEditCateProduct');	
		Route::post('edit/{id}' , 'CategoryProduct@postEditCateProduct');

		Route::get('delete/{id}' , 'CategoryProduct@getDeleteCateProduct');	
	});
	

	// brand_product
	Route::group(['prefix' => 'brand-product'] , function(){

		Route::get('/add' , 'BrandProduct@getAddBrandProduct');
		Route::post('/add' , 'BrandProduct@postAddBrandProduct');

		Route::get('/all' , 'BrandProduct@getAllBrandProduct');

		Route::get('/all/unactive/{id}' , 'BrandProduct@getUnactiveBrandProduct');
		Route::get('/all/active/{id}' , 'BrandProduct@getActiveBrandProduct');

		Route::get('edit/{id}' , 'BrandProduct@getEditBrandProduct');	
		Route::post('edit/{id}' , 'BrandProduct@postEditBrandProduct');

		Route::get('delete/{id}' , 'BrandProduct@getDeleteBrandProduct');	
	});

	// color
	Route::group(['prefix' => 'color'] , function(){

		Route::get('/add' , 'ColorController@getAddColorProduct');
		Route::post('/add' , 'ColorController@postAddColorProduct');

		Route::get('/all' , 'ColorController@getAllColorProduct');

		Route::get('/all/unactive/{id}' , 'ColorController@getUnactiveColorProduct');
		Route::get('/all/active/{id}' , 'ColorController@getActiveColorProduct');

		Route::get('edit/{id}' , 'ColorController@getEditColorProduct');	
		Route::post('edit/{id}' , 'ColorController@postEditColorProduct');

		Route::get('delete/{id}' , 'ColorController@getDeleteColorProduct');	
	});

	// color_details
	Route::group(['prefix' => 'color-details'] , function(){

		Route::get('/add' , 'ColorDetailController@getAddColorDetailsProduct');
		Route::post('/add' , 'ColorDetailController@postAddColorDetailsProduct');

		Route::get('/all' , 'ColorDetailController@getAllColorDetailsProduct');

		Route::get('/all/unactive/{id}' , 'ColorDetailController@getUnactiveColorDetailsProduct');
		Route::get('/all/active/{id}' , 'ColorDetailController@getActiveColorDetailsProduct');

		Route::get('edit/{id}' , 'ColorDetailController@getEditColorDetailsProduct');	
		Route::post('edit/{id}' , 'ColorDetailController@postEditColorDetailsProduct');

		Route::get('delete/{id}' , 'ColorDetailController@getDeleteColorDetailsProduct');	
	});

	// Size
	Route::group(['prefix' => 'size'] , function(){

		Route::get('/add' , 'SizeController@getAddSize');
		Route::post('/add' , 'SizeController@postAddSize');

		Route::get('/all' , 'SizeController@getAllSize');

		Route::get('/all/unactive/{id}' , 'SizeController@getUnactiveSize');
		Route::get('/all/active/{id}' , 'SizeController@getActiveSize');

		Route::get('edit/{id}' , 'SizeController@getEditSize');	
		Route::post('edit/{id}' , 'SizeController@postEditSize');

		Route::get('delete/{id}' , 'SizeController@getDeleteSize');	
	});

	// Size_Detail
	Route::group(['prefix' => 'size-details'] , function(){

		Route::get('/add' , 'SizeDetailsController@getAddSizeDetails');
		Route::post('/add' , 'SizeDetailsController@postAddSizeDetails');

		Route::get('/all' , 'SizeDetailsController@getAllSizeDetails');

		Route::get('/all/unactive/{id}' , 'SizeDetailsController@getUnactiveSizeDetails');
		Route::get('/all/active/{id}' , 'SizeDetailsController@getActiveSizeDetails');

		Route::get('edit/{id}' , 'SizeDetailsController@getEditSizeDetails');	
		Route::post('edit/{id}' , 'SizeDetailsController@postEditSizeDetails');

		Route::get('delete/{id}' , 'SizeDetailsController@getDeleteSizeDetails');	
	});

	// Product
	Route::group(['prefix' => 'product'] , function(){
		
		Route::get('/add' , 'ProductController@getAddProduct');
		Route::post('/add' , 'ProductController@postAddProduct');

		Route::get('/all' , 'ProductController@getAllProduct');

		Route::get('/all/unactive/{id}' , 'ProductController@getUnactiveProduct');
		Route::get('/all/active/{id}' , 'ProductController@getActiveProduct');

		Route::get('edit/{id}' , 'ProductController@getEditProduct');	
		Route::post('edit/{id}' , 'ProductController@postEditProduct');

		Route::get('delete/{id}' , 'ProductController@getDeleteProduct');	
	});

	// Total_Product_Details
	Route::group(['prefix' => 'total-product-details'] , function(){
		
		Route::get('/add' , 'Total_Product_DetailsController@getChoseTotalProduct');
		Route::post('/add' , 'Total_Product_DetailsController@postChoseTotalProduct');

		Route::get('/add-total' , 'Total_Product_DetailsController@getAddTotalProduct');
		Route::post('/add-total' , 'Total_Product_DetailsController@postAddTotalProduct');

		Route::get('/all' , 'Total_Product_DetailsController@getAllTotalProduct');

		Route::get('edit/{id}' , 'Total_Product_DetailsController@getEditTotalProduct');	
		Route::post('edit/{id}' , 'Total_Product_DetailsController@postEditTotalProduct');

		Route::get('delete/{id}' , 'Total_Product_DetailsController@getDeleteProduct');	
	});

	// Total_Product_Details
	Route::group(['prefix' => 'chosen'] , function(){
		Route::get('/all' , 'ChosenController@getAllChosenProductAdmin');
	});

	// Manager 
	Route::group(['prefix' => 'manager'] , function(){
		Route::get('/all' , 'ManagerController@getAllManageOrder');

		Route::get('all/sending' , 'ManagerController@getAllSendingProductManageOrder');
		Route::post('all/sending' , 'ManagerController@postSendingProductManageOrder');

		Route::get('all/checked' , 'ManagerController@getAllCheckedProductManageOrder');
		Route::post('all/checked' , 'ManagerController@postCheckedProductManageOrder');

		Route::get('all/cancel' , 'ManagerController@getAllCancelProductManageOrder');

		Route::get('/all/cancel/{id}/{idPayment}' , 'ManagerController@getCancelManageOrder');

		Route::get('/details/{id}' , 'ManagerController@getDetailsManageOrder');
		Route::post('/details/{id}' , 'ManagerController@postDetailsManageOrder');
	});

	// Coupon
	Route::group(['prefix' => 'coupon'] , function(){
		
		Route::get('/add' , 'CouponController@getAddCoupon');
		Route::post('/add' , 'CouponController@postAddCoupon');

		Route::get('/all' , 'CouponController@getAllCoupon');

		Route::get('delete/{id}' , 'CouponController@getDeleteCoupon');	
	});
});
	
	