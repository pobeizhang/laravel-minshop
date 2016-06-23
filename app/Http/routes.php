<?php
use App\Entity\Member;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/member',function(){
    return Member::all();
});

Route::get('/pay',function(){
    return view('alipay');
});
Route::group(['prefix'=>'service'],function(){
    //验证码
    Route::get('validate_code/create','Service\ValidateController@create');

    Route::post('validate_code/send','Service\ValidateController@sendSMS');
    //注册路由
    Route::post('register','Service\MemberController@register');
    //登录路由
    Route::post('login','Service\MemberController@login');

    Route::get('validate_email','Service\ValidateController@validateEmail');

    Route::get('category/parent_id/{parent_id}','Service\BookController@getCategoryByParentId');

    Route::get('cart/add/{product_id}','Service\CartController@addCart');

    Route::get('cart/deleteCart','Service\CartController@deleteCart');

    Route::post('alipay','Service\PayController@alipay');

    Route::post('pay/ali_notify','Service\PayController@aliNotify');

    Route::get('pay/ali_result','Service\PayController@aliResult');

    Route::get('pay/ali_merchant','Service\PayController@aliMerchant');

    Route::post('wxpay', 'Service\PayController@wxPay');

    Route::post('upload/{type}', 'Service\UploadController@uploadFile');
});

//登录路由
Route::get('/login', 'View\MemberController@toLogin');
//注册路由
Route::get('/register', 'View\MemberController@toRegister');

Route::get('/category', 'View\BookController@toCategory');

Route::get('/product/category_id/{category_id}','View\BookController@toProduct');

Route::get('/product/{product_id}','View\BookController@toPdtContent');

Route::get('/cart','View\CartController@toCart');

Route::group(['middleware'=>'check.login'],function(){
    Route::post('/order_commit','View\OrderController@toOrderCommit');
    Route::get('/order_list','View\OrderController@toOrderList');
});

Route::group(['prefix'=>'admin'],function(){
    Route::group(['prefix'=>'service'],function(){
        Route::post('login','Admin\IndexController@login');
        Route::post('category/add','Admin\CategoryController@categoryAdd');
        Route::post('category/del','Admin\CategoryController@categoryDel');
        Route::post('category/edit','Admin\CategoryController@categoryEdit');
        Route::post('product/add', 'Admin\ProductController@productAdd');
        Route::post('product/del', 'Admin\ProductController@productDel');
        Route::post('product/edit', 'Admin\ProductController@productEdit');
    });
    Route::get('index','Admin\IndexController@toIndex');
    Route::get('category','Admin\CategoryController@toCategory');
    Route::get('login','Admin\IndexController@toLogin');
    Route::get('category_add','Admin\CategoryController@toCategoryAdd');
    Route::get('category_edit','Admin\CategoryController@toCategoryEdit');
    Route::get('product', 'Admin\ProductController@toProduct');
    Route::get('product_info', 'Admin\ProductController@toProductInfo');
    Route::get('product_add', 'Admin\ProductController@toProductAdd');
    Route::get('product_edit', 'Admin\ProductController@toProductEdit');
});
