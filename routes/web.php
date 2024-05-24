<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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



Route::group(
    [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function()
{
    Route::get('/', [HomeController::class,'index'])->name('home')->middleware('preload.page');
    Route::get('/contact', [HomeController::class,'contact'])->name('contact')->middleware('preload.page');
    Route::get('/shop-list', [HomeController::class,'shop'])->name('shop')->middleware('preload.page');
    Route::get('/page/{page}', [HomeController::class,'showPage'])->name('page')->middleware('preload.page');
    Route::get('/product/{slug}', [HomeController::class,'showProduct'])->name('product')->middleware('preload.page');
    Route::get('/search', [HomeController::class,'searchProduct'])->name('search')->middleware('preload.page');

    // CART
    Route::get('/cart', [CartController::class,'index'])->name('cart')->middleware('preload.page');
    Route::get('/cart/add/{productId}', [CartController::class,'addToCart'])->name('cart.add')->middleware('preload.page');
    Route::get('/cart/remove/{productId}/{quantity}', [CartController::class,'removeFromCart'])->name('cart.remove')->middleware('preload.page');

    // COMPARE
    Route::get('/compare', [CompareController::class,'index'])->name('compare')->middleware('preload.page');
    Route::get('/compare/add/{productId}', [CompareController::class,'addToCompare'])->name('compare.add')->middleware('preload.page');
    Route::get('/compare/remove/{productId}', [CompareController::class,'removeFromCompare'])->name('compare.remove')->middleware('preload.page');


    // WISHLIST
    Route::get('/wishlist', [WishListController::class,'index'])->name('wishlist')->middleware('preload.page');
    Route::get('/wishlist/add/{productId}', [WishListController::class,'addToWishList'])->name('wishlist.add')->middleware('preload.page');
    Route::get('/wishlist/remove/{productId}', [WishListController::class,'removeFromWishList'])->name('wishlist.remove')->middleware('preload.page');

    // SECURITY

    //LOAD DATA
    // Route::get('/load', [ProductController::class,'load'])->name('load');

    Route::get('/dashboard/index', [DashboardController::class,'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [DashboardController::class,'index'])->name('index');
        Route::get('/address', [DashboardController::class,'index'])->name('address');
        // Route::get('/orders', [DashboardController::class,'findOrderUser'])->name('orders');
        // Route::get('/orders/view', [DashboardController::class,'userOrder'])->name('orders.user');
        Route::get('/account', [DashboardController::class,'index'])->name('account');
        Route::get('/logout', [DashboardController::class,'index'])->name('logout');
        Route::get('/address/add', [DashboardController::class,'createAddress'])->name('address.add');
        Route::get('/address/edit/{id}', [DashboardController::class,'addressEdit'])->name('address.edit');
        Route::post('/address/store', [DashboardController::class,'store'])->name('address.store');
        Route::put('/address/update/{address}', [DashboardController::class,'update'])->name('address.update');
        Route::delete('/address/delete/{id}', [DashboardController::class,'delete'])->name('address.delete');

        // PROFILE
        Route::put('/profile/update', [DashboardController::class,'updateProfile'])->name('profile.update');
        Route::put('/profile/update/password', [DashboardController::class,'updateUserPassword'])
        ->name('profile.update.password');
    });

    Route::get('/checkout', [CheckoutController::class,'index'])->name('checkout');
    Route::get('/checkout/payment/success', [CheckoutController::class,'paymentSuccess'])->name('checkout.payment.success');
    Route::post('/checkout/create-paiment-intent/{orderId}', [CheckoutController::class,'createPaymentIntent'])->name('checkout.payment.intent');



    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    require __DIR__.'/auth.php';


    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function(){
        //Get Categories datas
        Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');

        //Show Category by Id
        Route::get('/categories/show/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');

        //Get Categories by Id
        Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('category.create');

        //Edit Category by Id
        Route::get('/categories/edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('category.edit');

        //Save new Category
        Route::post('/categories/store', 'App\Http\Controllers\CategoryController@store')->name('category.store');

        //Update One Category
        Route::put('/categories/update/{category}', 'App\Http\Controllers\CategoryController@update')->name('category.update');

        //Update One Category Speedly
        Route::put('/categories/speed/{category}', 'App\Http\Controllers\CategoryController@updateSpeed')->name('category.update.speed');

        //Delete Category
        Route::delete('/categories/delete/{category}', 'App\Http\Controllers\CategoryController@delete')->name('category.delete');


        //Get Products datas
        Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');

        //Show Product by Id
        Route::get('/products/show/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');

        //Get Products by Id
        Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');

        //Edit Product by Id
        Route::get('/products/edit/{id}', 'App\Http\Controllers\ProductController@edit')->name('product.edit');

        //Save new Product
        Route::post('/products/store', 'App\Http\Controllers\ProductController@store')->name('product.store');

        //Update One Product
        Route::put('/products/update/{product}', 'App\Http\Controllers\ProductController@update')->name('product.update');

        //Delete Product
        Route::delete('/products/delete/{product}', 'App\Http\Controllers\ProductController@delete')->name('product.delete');



        //Get Users datas
        Route::get('/users', 'App\Http\Controllers\UserController@index')->name('user.index');

        //Show User by Id
        Route::get('/users/show/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');

        //Get Users by Id
        Route::get('/users/create', 'App\Http\Controllers\UserController@create')->name('user.create');

        //Edit User by Id
        Route::get('/users/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');

        //Save new User
        Route::post('/users/store', 'App\Http\Controllers\UserController@store')->name('user.store');

        //Update One User
        Route::put('/users/update/{user}', 'App\Http\Controllers\UserController@update')->name('user.update');

        //Delete User
        Route::delete('/users/delete/{user}', 'App\Http\Controllers\UserController@delete')->name('user.delete');


        //Get Banners datas
        Route::get('/banners', 'App\Http\Controllers\BannerController@index')->name('banner.index');

        //Show Banner by Id
        Route::get('/banners/show/{id}', 'App\Http\Controllers\BannerController@show')->name('banner.show');

        //Get Banners by Id
        Route::get('/banners/create', 'App\Http\Controllers\BannerController@create')->name('banner.create');

        //Edit Banner by Id
        Route::get('/banners/edit/{id}', 'App\Http\Controllers\BannerController@edit')->name('banner.edit');

        //Save new Banner
        Route::post('/banners/store', 'App\Http\Controllers\BannerController@store')->name('banner.store');

        //Update One Banner
        Route::put('/banners/update/{banner}', 'App\Http\Controllers\BannerController@update')->name('banner.update');

        //Update One Banner Speedly
        Route::put('/banners/speed/{banner}', 'App\Http\Controllers\BannerController@updateSpeed')->name('banner.update.speed');

        //Delete Banner
        Route::delete('/banners/delete/{banner}', 'App\Http\Controllers\BannerController@delete')->name('banner.delete');

        

        //Get Collections datas
        Route::get('/collections', 'App\Http\Controllers\CollectionController@index')->name('collection.index');

        //Show Collection by Id
        Route::get('/collections/show/{id}', 'App\Http\Controllers\CollectionController@show')->name('collection.show');

        //Get Collections by Id
        Route::get('/collections/create', 'App\Http\Controllers\CollectionController@create')->name('collection.create');

        //Edit Collection by Id
        Route::get('/collections/edit/{id}', 'App\Http\Controllers\CollectionController@edit')->name('collection.edit');

        //Save new Collection
        Route::post('/collections/store', 'App\Http\Controllers\CollectionController@store')->name('collection.store');

        //Update One Collection
        Route::put('/collections/update/{collection}', 'App\Http\Controllers\CollectionController@update')->name('collection.update');

        //Update One Collection Speedly
        Route::put('/collections/speed/{collection}', 'App\Http\Controllers\CollectionController@updateSpeed')->name('collection.update.speed');

        //Delete Collection
        Route::delete('/collections/delete/{collection}', 'App\Http\Controllers\CollectionController@delete')->name('collection.delete');




        //Get Pages datas
        Route::get('/pages', 'App\Http\Controllers\PageController@index')->name('page.index');

        //Show Page by Id
        Route::get('/pages/show/{id}', 'App\Http\Controllers\PageController@show')->name('page.show');

        //Get Pages by Id
        Route::get('/pages/create', 'App\Http\Controllers\PageController@create')->name('page.create');

        //Edit Page by Id
        Route::get('/pages/edit/{id}', 'App\Http\Controllers\PageController@edit')->name('page.edit');

        //Save new Page
        Route::post('/pages/store', 'App\Http\Controllers\PageController@store')->name('page.store');

        //Update One Page
        Route::put('/pages/update/{page}', 'App\Http\Controllers\PageController@update')->name('page.update');

        //Update One Page Speedly
        Route::put('/pages/speed/{page}', 'App\Http\Controllers\PageController@updateSpeed')->name('page.update.speed');

        //Delete Page
        Route::delete('/pages/delete/{page}', 'App\Http\Controllers\PageController@delete')->name('page.delete');





        //Get Tags datas
        Route::get('/tags', 'App\Http\Controllers\TagController@index')->name('tag.index');

        //Show Tag by Id
        Route::get('/tags/show/{id}', 'App\Http\Controllers\TagController@show')->name('tag.show');

        //Get Tags by Id
        Route::get('/tags/create', 'App\Http\Controllers\TagController@create')->name('tag.create');

        //Edit Tag by Id
        Route::get('/tags/edit/{id}', 'App\Http\Controllers\TagController@edit')->name('tag.edit');

        //Save new Tag
        Route::post('/tags/store', 'App\Http\Controllers\TagController@store')->name('tag.store');

        //Update One Tag
        Route::put('/tags/update/{tag}', 'App\Http\Controllers\TagController@update')->name('tag.update');

        //Update One Tag Speedly
        Route::put('/tags/speed/{tag}', 'App\Http\Controllers\TagController@updateSpeed')->name('tag.update.speed');

        //Delete Tag
        Route::delete('/tags/delete/{tag}', 'App\Http\Controllers\TagController@delete')->name('tag.delete');




        //Get Megacollections datas
        Route::get('/megacollections', 'App\Http\Controllers\MegacollectionController@index')->name('megacollection.index');

        //Show Megacollection by Id
        Route::get('/megacollections/show/{id}', 'App\Http\Controllers\MegacollectionController@show')->name('megacollection.show');

        //Get Megacollections by Id
        Route::get('/megacollections/create', 'App\Http\Controllers\MegacollectionController@create')->name('megacollection.create');

        //Edit Megacollection by Id
        Route::get('/megacollections/edit/{id}', 'App\Http\Controllers\MegacollectionController@edit')->name('megacollection.edit');

        //Save new Megacollection
        Route::post('/megacollections/store', 'App\Http\Controllers\MegacollectionController@store')->name('megacollection.store');

        //Update One Megacollection
        Route::put('/megacollections/update/{megacollection}', 'App\Http\Controllers\MegacollectionController@update')->name('megacollection.update');

        //Update One Megacollection Speedly
        Route::put('/megacollections/speed/{megacollection}', 'App\Http\Controllers\MegacollectionController@updateSpeed')->name('megacollection.update.speed');

        //Delete Megacollection
        Route::delete('/megacollections/delete/{megacollection}', 'App\Http\Controllers\MegacollectionController@delete')->name('megacollection.delete');




        //Get Settings datas
        Route::get('/settings', 'App\Http\Controllers\SettingController@index')->name('setting.index');

        //Show Setting by Id
        Route::get('/settings/show/{id}', 'App\Http\Controllers\SettingController@show')->name('setting.show');

        //Get Settings by Id
        Route::get('/settings/create', 'App\Http\Controllers\SettingController@create')->name('setting.create');

        //Edit Setting by Id
        Route::get('/settings/edit/{id}', 'App\Http\Controllers\SettingController@edit')->name('setting.edit');

        //Save new Setting
        Route::post('/settings/store', 'App\Http\Controllers\SettingController@store')->name('setting.store');

        //Update One Setting
        Route::put('/settings/update/{setting}', 'App\Http\Controllers\SettingController@update')->name('setting.update');

        //Update One Setting Speedly
        Route::put('/settings/speed/{setting}', 'App\Http\Controllers\SettingController@updateSpeed')->name('setting.update.speed');

        //Delete Setting
        Route::delete('/settings/delete/{setting}', 'App\Http\Controllers\SettingController@delete')->name('setting.delete');




        //Get Socials datas
        Route::get('/socials', 'App\Http\Controllers\SocialController@index')->name('social.index');

        //Show Social by Id
        Route::get('/socials/show/{id}', 'App\Http\Controllers\SocialController@show')->name('social.show');

        //Get Socials by Id
        Route::get('/socials/create', 'App\Http\Controllers\SocialController@create')->name('social.create');

        //Edit Social by Id
        Route::get('/socials/edit/{id}', 'App\Http\Controllers\SocialController@edit')->name('social.edit');

        //Save new Social
        Route::post('/socials/store', 'App\Http\Controllers\SocialController@store')->name('social.store');

        //Update One Social
        Route::put('/socials/update/{social}', 'App\Http\Controllers\SocialController@update')->name('social.update');

        //Update One Social Speedly
        Route::put('/socials/speed/{social}', 'App\Http\Controllers\SocialController@updateSpeed')->name('social.update.speed');

        //Delete Social
        Route::delete('/socials/delete/{social}', 'App\Http\Controllers\SocialController@delete')->name('social.delete');




        //Get Contacts datas
        Route::get('/contacts', 'App\Http\Controllers\ContactController@index')->name('contact.index');

        //Show Contact by Id
        Route::get('/contacts/show/{id}', 'App\Http\Controllers\ContactController@show')->name('contact.show');

        //Get Contacts by Id
        Route::get('/contacts/create', 'App\Http\Controllers\ContactController@create')->name('contact.create');

        //Edit Contact by Id
        Route::get('/contacts/edit/{id}', 'App\Http\Controllers\ContactController@edit')->name('contact.edit');

        //Save new Contact
        Route::post('/contacts/store', 'App\Http\Controllers\ContactController@store')->name('contact.store');

        //Update One Contact
        Route::put('/contacts/update/{contact}', 'App\Http\Controllers\ContactController@update')->name('contact.update');

        //Update One Contact Speedly
        Route::put('/contacts/speed/{contact}', 'App\Http\Controllers\ContactController@updateSpeed')->name('contact.update.speed');

        //Delete Contact
        Route::delete('/contacts/delete/{contact}', 'App\Http\Controllers\ContactController@delete')->name('contact.delete');





        //Get Roles datas
        Route::get('/roles', 'App\Http\Controllers\RoleController@index')->name('role.index');

        //Show Role by Id
        Route::get('/roles/show/{id}', 'App\Http\Controllers\RoleController@show')->name('role.show');

        //Get Roles by Id
        Route::get('/roles/create', 'App\Http\Controllers\RoleController@create')->name('role.create');

        //Edit Role by Id
        Route::get('/roles/edit/{id}', 'App\Http\Controllers\RoleController@edit')->name('role.edit');

        //Save new Role
        Route::post('/roles/store', 'App\Http\Controllers\RoleController@store')->name('role.store');

        //Update One Role
        Route::put('/roles/update/{role}', 'App\Http\Controllers\RoleController@update')->name('role.update');

        //Update One Role Speedly
        Route::put('/roles/speed/{role}', 'App\Http\Controllers\RoleController@updateSpeed')->name('role.update.speed');

        //Delete Role
        Route::delete('/roles/delete/{role}', 'App\Http\Controllers\RoleController@delete')->name('role.delete');
    });

    Route::prefix('admin')->name('admin.')->group(function(){

        //Get Carriers datas
        Route::get('/carriers', 'App\Http\Controllers\CarrierController@index')->name('carrier.index');

        //Show Carrier by Id
        Route::get('/carriers/show/{id}', 'App\Http\Controllers\CarrierController@show')->name('carrier.show');

        //Get Carriers by Id
        Route::get('/carriers/create', 'App\Http\Controllers\CarrierController@create')->name('carrier.create');

        //Edit Carrier by Id
        Route::get('/carriers/edit/{id}', 'App\Http\Controllers\CarrierController@edit')->name('carrier.edit');

        //Save new Carrier
        Route::post('/carriers/store', 'App\Http\Controllers\CarrierController@store')->name('carrier.store');

        //Update One Carrier
        Route::put('/carriers/update/{carrier}', 'App\Http\Controllers\CarrierController@update')->name('carrier.update');

        //Update One Carrier Speedly
        Route::put('/carriers/speed/{carrier}', 'App\Http\Controllers\CarrierController@updateSpeed')->name('carrier.update.speed');

        //Delete Carrier
        Route::delete('/carriers/delete/{carrier}', 'App\Http\Controllers\CarrierController@delete')->name('carrier.delete');



        //Get Addresses datas
        Route::get('/addresses', 'App\Http\Controllers\AddressController@index')->name('address.index');

        //Show Address by Id
        Route::get('/addresses/show/{id}', 'App\Http\Controllers\AddressController@show')->name('address.show');

        //Get Addresses by Id
        Route::get('/addresses/create', 'App\Http\Controllers\AddressController@create')->name('address.create');

        //Edit Address by Id
        Route::get('/addresses/edit/{id}', 'App\Http\Controllers\AddressController@edit')->name('address.edit');

        //Save new Address
        Route::post('/addresses/store', 'App\Http\Controllers\AddressController@store')->name('address.store');

        //Update One Address
        Route::put('/addresses/update/{address}', 'App\Http\Controllers\AddressController@update')->name('address.update');

        //Update One Address Speedly
        Route::put('/addresses/speed/{address}', 'App\Http\Controllers\AddressController@updateSpeed')->name('address.update.speed');

        //Delete Address
        Route::delete('/addresses/delete/{address}', 'App\Http\Controllers\AddressController@delete')->name('address.delete');



        //Get Methods datas
        Route::get('/methods', 'App\Http\Controllers\MethodController@index')->name('method.index');

        //Show Method by Id
        Route::get('/methods/show/{id}', 'App\Http\Controllers\MethodController@show')->name('method.show');

        //Get Methods by Id
        Route::get('/methods/create', 'App\Http\Controllers\MethodController@create')->name('method.create');

        //Edit Method by Id
        Route::get('/methods/edit/{id}', 'App\Http\Controllers\MethodController@edit')->name('method.edit');

        //Save new Method
        Route::post('/methods/store', 'App\Http\Controllers\MethodController@store')->name('method.store');

        //Update One Method
        Route::put('/methods/update/{method}', 'App\Http\Controllers\MethodController@update')->name('method.update');

        //Update One Method Speedly
        Route::put('/methods/speed/{method}', 'App\Http\Controllers\MethodController@updateSpeed')->name('method.update.speed');

        //Delete Method
        Route::delete('/methods/delete/{method}', 'App\Http\Controllers\MethodController@delete')->name('method.delete');



        //Get Orders datas
        Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('order.index');

        //Show Order by Id
        Route::get('/orders/show/{id}', 'App\Http\Controllers\OrderController@show')->name('order.show');

        //Get Orders by Id
        Route::get('/orders/create', 'App\Http\Controllers\OrderController@create')->name('order.create');

        //Edit Order by Id
        Route::get('/orders/edit/{id}', 'App\Http\Controllers\OrderController@edit')->name('order.edit');

        //Save new Order
        Route::post('/orders/store', 'App\Http\Controllers\OrderController@store')->name('order.store');

        //Update One Order
        Route::put('/orders/update/{order}', 'App\Http\Controllers\OrderController@update')->name('order.update');

        //Update One Order Speedly
        Route::put('/orders/speed/{order}', 'App\Http\Controllers\OrderController@updateSpeed')->name('order.update.speed');

        //Delete Order
        Route::delete('/orders/delete/{order}', 'App\Http\Controllers\OrderController@delete')->name('order.delete');

        //Delete Order
        Route::get('/orders/download-invoice/{id}', 'App\Http\Controllers\OrderController@downloadInvoice')->name('order.download');



        //Get Orderdetails datas
        Route::get('/orderdetails', 'App\Http\Controllers\OrderdetailsController@index')->name('orderdetails.index');

        //Show Orderdetail by Id
        Route::get('/orderdetails/show/{id}', 'App\Http\Controllers\OrderdetailsController@show')->name('orderdetails.show');

        //Get Orderdetails by Id
        Route::get('/orderdetails/create', 'App\Http\Controllers\OrderdetailsController@create')->name('orderdetails.create');

        //Edit Orderdetail by Id
        Route::get('/orderdetails/edit/{id}', 'App\Http\Controllers\OrderdetailsController@edit')->name('orderdetails.edit');

        //Save new Orderdetail
        Route::post('/orderdetails/store', 'App\Http\Controllers\OrderdetailsController@store')->name('orderdetails.store');

        //Update One Orderdetail
        Route::put('/orderdetails/update/{orderdetails}', 'App\Http\Controllers\OrderdetailsController@update')->name('orderdetails.update');

        //Update One Orderdetail Speedly
        Route::put('/orderdetails/speed/{orderdetails}', 'App\Http\Controllers\OrderdetailsController@updateSpeed')->name('orderdetails.update.speed');

        //Delete Orderdetail
        Route::delete('/orderdetails/delete/{orderdetails}', 'App\Http\Controllers\OrderdetailsController@delete')->name('orderdetails.delete');

    });

});
