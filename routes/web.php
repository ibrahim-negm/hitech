<?php

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AdvController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;



use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\LanguageController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\GoogleSocialiteController;
use App\Http\Controllers\Front\FacebookSocialiteController;
use App\Http\Controllers\Front\LogoutController;
use App\Http\Controllers\Front\SitemapXmlController;



use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

////--------------------- (start all frontend routes) -----------------------------------////

//all front socialite routes
Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);
Route::get('auth/facebook', [FacebookSocialiteController::class, 'redirectToFB']);
Route::get('callback/facebook', [FacebookSocialiteController::class, 'handleCallback']);


//all front user routes
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('frontend.dashboard');
})->name('dashboard');
Route::get('/user/logout',[LogoutController::class ,'logout'])->name('user.logout');

// all front pages routes
Route::get('/',[PageController::class,'index'])->name('main.home');
Route::get('/about-us',[PageController::class,'AboutPage'])->name('about');
Route::get('/newest-offers',[PageController::class,'NewestOffers'])->name('newest.offers');
Route::get('/contact-us',[PageController::class,'ContactPage'])->name('contact.us');
Route::post('/contact-us/send/message',[PageController::class,'StoreMessage'])->name('store.message');
Route::get('/terms-and-conditions',[PageController::class,'Terms'])->name('terms');
Route::get('/shipping-and-payment',[PageController::class,'Shipping'])->name('shipping');
Route::get('/privacy-policy',[PageController::class,'Privacy'])->name('privacy');
Route::get('/refund-exchange-policy',[PageController::class,'Refund'])->name('refund');
Route::get('/faq',[PageController::class,'Faq'])->name('faq');
Route::get('/send-inquiry',[PageController::class,'SendInquiry'])->name('send.inquiry');

// all front wishlist routes
Route::get('/add/wishlist/{id}',[WishlistController::class,'AddWishlist'])->name('add.wishlist');

//all front subscriber routes
Route::post('/store/subscriber',[PageController::class,'StoreSubscriber'])->name('store.subscriber');
Route::get('/delete/subscriber/{email}',[PageController::class,'DeleteSubscriber']);
Route::get('/subscribe/in/{email}',[PageController::class,'StoreInSubscriber']);

//all front language routes
Route::get('/language/{locale}',[LanguageController::class,'SwitchLanguage']);

Route::middleware('auth')->group(function(){
    // all front user information routes
    Route::post('/user-profile/update/{id}',[UserController::class,'UpdateProfile'])->name('user-profile.update');
    Route::get('/user/update-password',[UserController::class,'UserUpdatePassword'])->name('user.update.password');
    Route::post('/user-password/update',[UserController::class,'UpdatePassword'])->name('user-password.update');
    Route::get('/user/address',[UserController::class,'UserAddress'])->name('user.address');
    Route::get('/user/subscriber',[UserController::class,'UserSubscriber'])->name('user.subscriber');
    Route::get('/user/wishlist/',[UserController::class,'ShowWishlist'])->name('user.wishlist');
    Route::get('/user/order/',[UserController::class,'ShowOrder'])->name('user.order');
    Route::get('/user/order/quick_view/{id}',[UserController::class,'QuickViewOrder'])->name('user.show.order');
    Route::get('/user/traced/order/{id}',[UserController::class,'TracedOrder'])->name('user.traced.order');
    Route::get('/remove/wishlist/{id}',[WishlistController::class,'RemoveWishlist'])->name('delete.wishlist');

});

// all front cart routes
Route::get('/add/to/cart/{id}',[CartController::class,'AddCart'])->name('add.cart');
Route::get('/check/cart',[CartController::class,'CheckCart']);
Route::get('/cart/show/all',[CartController::class,'ShowCart'])->name('show.cart');
Route::get('/cart/remove/{rowId}',[CartController::class,'RemoveCart'])->name('remove.cart');
Route::post('/cart/update/{rowId}',[CartController::class,'UpdateCart'])->name('update.cart');
Route::post('/cart/apply/coupon',[UserController::class,'ApplyCoupon'])->name('apply.coupon');
Route::get('/coupon/remove/',[UserController::class,'RemoveCoupon'])->name('remove.coupon');
Route::get('/user/checkout',[CartController::class,'Checkout'])->name('user.checkout');

//all front product routes

Route::get('/products-in-service/{id}/{service}',[ShopController::class,'ProductsInService'])->name('products.in.service');
Route::get('/products-in-category/{id}/{category}',[ShopController::class,'ProductsInCat'])->name('products.in.category');
Route::get('/products-in-subcategory/{id}/{subcategory}',[ShopController::class,'ProductsInSubCat'])->name('products.in.subcategory');
Route::get('/products-in-sub_subcategory/{id}/{sub_subcategory}',[ShopController::class,'ProductsInSubSubCat'])->name('products.in.sub_subcategory');
Route::get('/products-in-brand/{id}/{brand}',[ShopController::class,'ProductsInBrand'])->name('products.in.brand');

Route::post('/products/price-filter-service/{id}/{service}',[ShopController::class,'PriceFilter'])->name('price.filter');
Route::post('/products/price-filter-category/{id}/{category}',[ShopController::class,'PriceFilter'])->name('price.filter.category');
Route::post('/products/price-filter-subcategory/{id}/{subcategory}',[ShopController::class,'PriceFilter'])->name('price.filter.subcategory');
Route::post('/products/price-filter-sub_subcategory/{id}/{sub_subcategory}',[ShopController::class,'PriceFilter'])->name('price.filter.sub_subcategory');
Route::post('/products/price-filter-brand/{id}/{brand}',[ShopController::class,'PriceFilter'])->name('price.filter.brand');

Route::post('/products/brand-filter-service/{id}/{service}',[ShopController::class,'brandFilter'])->name('brand.filter');
Route::post('/products/brand-filter-category/{id}/{category}',[ShopController::class,'brandFilter'])->name('brand.filter.category');
Route::post('/products/brand-filter-subcategory/{id}/{subcategory}',[ShopController::class,'brandFilter'])->name('brand.filter.subcategory');
Route::post('/products/brand-filter-sub_subcategory/{id}/{sub_subcategory}',[ShopController::class,'brandFilter'])->name('brand.filter.sub_subcategory');
Route::post('/products/brand-filter-brand/{id}/{brand}',[ShopController::class,'brandFilter'])->name('brand.filter.brand');

Route::get('/products/tags-filter-service/{id}/{service}/{tag}',[ShopController::class,'TagFilterProducts'])->name('tag.service.products.filter');
Route::get('/products/tags-filter-category/{id}/{category}/{tag}',[ShopController::class,'TagFilterProducts'])->name('tag.category.products.filter');
Route::get('/products/tags-filter-subcategory/{id}/{subcategory}/{tag}',[ShopController::class,'TagFilterProducts'])->name('tag.subcategory.products.filter');
Route::get('/products/tags-filter-sub_subcategory/{id}/{sub_subcategory}/{tag}',[ShopController::class,'TagFilterProducts'])->name('tag.sub_subcategory.products.filter');
Route::get('/products/tags-filter-brand/{id}/{brand}/{tag}',[ShopController::class,'TagFilterProducts'])->name('tag.brand.products.filter');

Route::get('/product/details/{slug}',[ShopController::class,'ShowProduct'])->name('product.details');
Route::post('/add-product/into-cart/{id}',[ShopController::class,'InsertCart'])->name('add.product.cart');

Route::Post('/products/search',[ShopController::class,'ProductsSearch'])->name('products.search');



//all front post & comment routes
Route::get('/show/all/posts',[PageController::class,'AllPost'])->name('all.posts');
Route::get('/post/{slug}',[PageController::class,'ShowPost'])->name('show.post');
Route::post('/post/search',[ShopController::class,'SearchPost'])->name('search.post');
Route::get('/post/search/{tag}',[ShopController::class,'SearchPostByTag'])->name('search.post.tag');
Route::Post('/post/comments/{id}',[ShopController::class,'StoreComment'])->name('store.comment');


// all user routes for review products and search products.
Route::Post('/store/review/{id}',[ShopController::class,'StoreReview'])->name('store.review');

// all front payment routes
Route::post('/user/payment/process',[PaymentController::class,'Payment'])->name('payment.process');
Route::post('/user/fast/payment/process',[PaymentController::class,'FastPayment'])->name('fast.payment.process');
Route::get('/user/order-completed/{id}/{status}',[PaymentController::class,'orderStatus'])->name('order-completed');
Route::get('/user/order-not-completed/',[PaymentController::class,'FailOrder'])->name('order-not-completed');

// all front gallery page
Route::get('/gallery',[PageController::class,'Gallery'])->name('gallery');

// all front coming soon page
Route::get('/coming-soon',[PageController::class,'ComingSoon'])->name('coming');

// all front site map
Route::get('/sitemap.xml', [SitemapXmlController::class, 'index']);


////--------------------- (end all frontend routes) -----------------------------------////







////--------------------- (all admin routes) -----------------------------------////

Route::prefix('admin')->middleware('guest:admin')->group(function (){
    Route::get('/login', [MainAdminController::class, 'loginForm']);
    Route::post('/login', [MainAdminController::class, 'store'])->name('admin.login');
});

Route::prefix('admin')->middleware('auth:admin')->group(function (){

    Route::get('/logout',[MainAdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/dashboard',[MainAdminController::class,'Index'])->name('admin.dashboard');
    Route::get('/profile',[MainAdminController::class,'ShowProfile'])->name('admin.profile');
    Route::get('/profile/edit',[MainAdminController::class,'EditProfile'])->name('edit.admin_profile');
    Route::post('/profile/update',[MainAdminController::class,'UpdateProfile'])->name('update.admin_profile');
    Route::get('/change-password/edit',[MainAdminController::class,'ChangePassword'])->name('admin.change_password');
    Route::post('/change-password/update',[MainAdminController::class,'UpdatePassword'])->name('update.admin_password');


//all admin services routes
    Route::get('/all/services',[ServiceController::class,'ShowService'])->name('admin.service');
    Route::post('/store/service',[ServiceController::class,'StoreService'])->name('admin.store_service');
    Route::get('/delete/service/{id}',[ServiceController::class,'DeleteService']);
    Route::get('/edit/service/{id}',[ServiceController::class,'EditService'])->name('admin.edit.service');;
    Route::post('/update/service/{id}',[ServiceController::class,'UpdateService']);

//all admin brands routes
    Route::get('/all/brands',[BrandController::class,'ShowBrand'])->name('admin.brand');
    Route::post('/store/brands',[BrandController::class,'StoreBrand'])->name('admin.store_brand');
    Route::get('/edit/brand/{id}',[BrandController::class,'EditBrand'])->name('admin.edit_brand');
    Route::post('/update/brand/{id}',[BrandController::class,'UpdateBrand']);
    Route::get('/delete/brand/{id}',[BrandController::class,'DeleteBrand']);


//all admin categories routes
    Route::get('/all/categories',[CategoryController::class,'ShowCategory'])->name('admin.category');
    Route::post('/store/category',[CategoryController::class,'StoreCategory'])->name('admin.store_category');
    Route::get('/delete/category/{id}',[CategoryController::class,'DeleteCategory']);
    Route::get('/edit/category/{id}',[CategoryController::class,'EditCategory'])->name('admin.edit.category');
    Route::post('/update/category/{id}',[CategoryController::class,'UpdateCategory']);

//all admin subcategories routes
    Route::get('/all/subcategories',[SubCategoryController::class,'ShowSubCategory'])->name('admin.subcategory');
    Route::post('/store/subcategory',[SubCategoryController::class,'StoreSubcategory'])->name('admin.store_subcategory');
    Route::get('/edit/subcategory/{id}',[SubCategoryController::class,'EditSubCategory'])->name('admin.edit.subcategory');
    Route::post('/update/subcategory/{id}',[SubCategoryController::class,'UpdateSubCategory']);
    Route::get('/delete/subcategory/{id}',[SubCategoryController::class,'DeleteSubCategory']);

//all admin subsubcategories routes
    Route::get('/all/subsubcategories',[SubCategoryController::class,'ShowSubSubCategory'])->name('admin.subsubcategory');
    Route::post('/store/subsubcategory',[SubCategoryController::class,'StoreSubSubcategory'])->name('admin.store_subsubcategory');
    Route::get('/edit/subsubcategory/{id}',[SubCategoryController::class,'EditSubSubCategory'])->name('admin.edit.subsubcategory');
    Route::post('/update/subsubcategory/{id}',[SubCategoryController::class,'UpdateSubSubCategory']);
    Route::get('/delete/subsubcategory/{id}',[SubCategoryController::class,'DeleteSubSubCategory']);

//all admin gallery routes
    Route::get('/all/gallery',[ImageController::class,'ShowImage'])->name('admin.image');
    Route::post('/store/gallery',[ImageController::class,'StoreImage'])->name('admin.store_image');
    Route::get('/edit/gallery/{id}',[ImageController::class,'EditImage'])->name('admin.edit.image');
    Route::post('/update/gallery/{id}',[ImageController::class,'UpdateImage']);
    Route::get('/delete/gallery/{id}',[ImageController::class,'DeleteImage']);

//all admin employees routes
    Route::get('/all/employees',[EmployeeController::class,'ShowEmployee'])->name('admin.employee');
    Route::post('/store/employees',[EmployeeController::class,'StoreEmployee'])->name('admin.store_employee');
    Route::get('/edit/employee/{id}',[EmployeeController::class,'EditEmployee'])->name('admin.edit.employee');
    Route::post('/update/employee/{id}',[EmployeeController::class,'UpdateEmployee']);
    Route::get('/delete/employee/{id}',[EmployeeController::class,'DeleteEmployee']);

//all admin coupons routes
    Route::get('/all/coupons',[CouponController::class,'ShowCoupon'])->name('admin.coupon');
    Route::post('/store/coupons',[CouponController::class,'StoreCoupon'])->name('admin.store_coupon');
    Route::get('/edit/coupon/{id}',[CouponController::class,'EditCoupon'])->name('admin.edit.coupon');
    Route::post('/update/coupon/{id}',[CouponController::class,'UpdateCoupon']);
    Route::get('/delete/coupon/{id}',[CouponController::class,'DeleteCoupon']);

//all admin subscriber routes
    Route::get('/all/subscribers',[SubscriberController::class,'ShowSubscriber'])->name('admin.subscriber');
    Route::get('/delete/subscriber/{id}',[SubscriberController::class,'DeleteSubscriber']);
    Route::get('/send/news',[SubscriberController::class,'SendNews'])->name('admin.send.news');
    Route::post('/send/news/to/subscriber',[SubscriberController::class,'SendNewsToSubscriber'])->name('admin.send.to.subscriber');

//all admin product routes
    Route::get('/all-approved-status/products',[ProductController::class,'ApprovedStatusProducts'])->name('admin.approved.status.products');
    Route::get('/all-approved/products',[ProductController::class,'ApprovedProducts'])->name('admin.approved.products');
    Route::get('/all-status/products',[ProductController::class,'StatusProducts'])->name('admin.status.products');
    Route::get('/none/status/approved/products',[ProductController::class,'NoneApprovedStatusProducts'])->name('admin.none.approved.status.products');

    Route::get('/create/product',[ProductController::class,'CreateProduct'])->name('admin.create_product');
    Route::post('/store/product',[ProductController::class,'StoreProduct'])->name('admin.store_product');
    Route::get('/get-subcategory/{category_id}',[ProductController::class,'GetSubcat']);// show subcategory by Ajax
    Route::get('/get-subsubcategory/{subcategory_id}',[ProductController::class,'GetSubSubcat']);// show subsubcategory by Ajax
    Route::get('/active-product/{id}',[ProductController::class,'ActiveProduct'])->name('admin.active.product');
    Route::get('/inactive-product/{id}',[ProductController::class,'InactiveProduct'])->name('admin.inactive.product');
    Route::get('/approved-product/{id}',[ProductController::class,'ApprovedProduct'])->name('admin.approved.product');
    Route::get('/unapproved-product/{id}',[ProductController::class,'UnapprovedProduct'])->name('admin.unapproved.product');
    Route::get('/show-product/{id}',[ProductController::class,'ShowProduct'])->name('admin.show.product');
    Route::get('/edit/product/{id}',[ProductController::class,'EditProduct'])->name('admin.edit.product');
    Route::post('/update/product-data/{id}',[ProductController::class,'UpdateProductData'])->name('admin.update.product_data');
    Route::post('/update/product-image/{id}',[ProductController::class,'UpdateProductImage'])->name('admin.update.product_image');
    Route::get('/delete/product-image/{id}',[ProductController::class,'DeleteProductImage'])->name('admin.delete.product_image');
    Route::post('/update/product-installment/{id}',[ProductController::class,'updateProductInstallment'])->name('admin.update.product_installment');
    Route::get('/delete/product/{id}',[ProductController::class,'DeleteProduct'])->name('admin.delete.product');

//all admin post routes
    Route::get('/all/posts',[PostController::class,'Index'])->name('admin.post');
    Route::get('/create/post',[PostController::class,'CreatePost'])->name('admin.create_post');
    Route::post('/store/post',[PostController::class,'StorePost'])->name('admin.store_post');
    Route::get('/active-post/{id}',[PostController::class,'ActivePost'])->name('admin.active.post');
    Route::get('/inactive-post/{id}',[PostController::class,'InactivePost'])->name('admin.inactive.post');
    Route::get('/show-post/{id}',[PostController::class,'ShowPost'])->name('admin.show.post');
    Route::get('/edit/post/{id}',[PostController::class,'EditPost'])->name('admin.edit.post');
    Route::post('/update/post-data/{id}',[PostController::class,'UpdatePost'])->name('admin.update.post_data');
    Route::get('/delete/post/{id}',[PostController::class,'DeletePost'])->name('admin.delete.post');



// all admin slider routes
    Route::get('/all/sliders',[SliderController::class,'Slider'])->name('admin.slider');
    Route::get('/create/slider',[SliderController::class,'CreateSlider'])->name('admin.create.slider');
    Route::post('/store/slider',[SliderController::class,'StoreSlider'])->name('admin.store.slider');
    Route::get('/edit/slider/{id}',[SliderController::class,'EditSlider'])->name('admin.edit.slider');
    Route::post('/update/slider/{id}',[SliderController::class,'UpdateSlider'])->name('admin.update.slider');
    Route::get('/delete/slider/{id}',[SliderController::class,'DeleteSlider']);
    Route::get('/active-slider/{id}',[SliderController::class,'ActiveSlider'])->name('admin.active.slider');
    Route::get('/inactive-slider/{id}',[SliderController::class,'InactiveSlider'])->name('admin.inactive.slider');

//all admin adv routes
    Route::get('/all/advs',[AdvController::class,'Adv'])->name('admin.adv');
    Route::get('/create/adv',[AdvController::class,'CreateAdv'])->name('admin.create.adv');
    Route::post('/store/adv',[AdvController::class,'StoreAdv'])->name('admin.store.adv');
    Route::get('/active-adv/{id}',[AdvController::class,'ActiveAdv'])->name('admin.active.adv');
    Route::get('/inactive-adv/{id}',[AdvController::class,'InactiveAdv'])->name('admin.inactive.adv');
    Route::get('/edit/adv/{id}',[AdvController::class,'EditAdv'])->name('admin.edit.adv');
    Route::post('/update/adv/{id}',[AdvController::class,'UpdateAdv'])->name('admin.update.adv');
    Route::get('/delete/adv/{id}',[AdvController::class,'DeleteAdv'])->name('admin.delete.adv');

//all admin orders routes
    Route::get('/new/order',[OrderController::class,'Order'])->name('admin.new.order');
    Route::get('/reviewed/order',[OrderController::class,'ReviewedOrder'])->name('admin.reviewed.order');
    Route::get('/done/order',[OrderController::class,'DoneOrder'])->name('admin.done.order');
    Route::get('/refused/order',[OrderController::class,'RefusedOrder'])->name('admin.refused.order');
    Route::get('/approved/order',[OrderController::class,'ApprovedOrder'])->name('admin.approved.order');
    Route::get('/show/order/{id}',[OrderController::class,'ShowOrder'])->name('admin.show.order');
    Route::get('/delivery/process/{id}',[OrderController::class,'DeliveryProcess']);
    Route::get('/delivery/done/{id}',[OrderController::class,'DeliveryDone']);
    Route::get('/order/refused/{id}',[OrderController::class,'OrderRefused']);
    Route::get('/order/approved/{id}',[OrderController::class,'OrderedApproved']);


//all admin wallet routes
    Route::get('/all/wallet',[OrderController::class,'Wallet'])->name('admin.wallet');
    Route::get('/delete/wallet/{id}',[OrderController::class,'DeleteWallet'])->name('admin.wallet.delete');

//all admin reports routes
    Route::get('/daily/report',[ReportController::class,'DailyReport'])->name('admin.daily.report');
    Route::get('/monthly/report',[ReportController::class,'MonthlyReport'])->name('admin.monthly.report');
    Route::get('/search/report',[ReportController::class,'SearchReport'])->name('admin.search.report');
    Route::post('/search/by/date/report',[ReportController::class,'SearchByDate'])->name('search.by.date');
    Route::post('/search/by/month/report',[ReportController::class,'SearchByMonth'])->name('search.by.month');
    Route::post('/search/by/year/report',[ReportController::class,'SearchByYear'])->name('search.by.year');

//all admin role routes
    Route::get('/show/all/admins',[RoleController::class,'ShowAdmin'])->name('admin.show.admin');
    Route::get('/create/admin',[RoleController::class,'CreateAdmin'])->name('admin.create.admin');
    Route::post('/store/admin',[RoleController::class,'StoreAdmin'])->name('admin.store.admin');
    Route::get('/delete/admin/{id}',[RoleController::class,'DeleteAdmin']);
    Route::get('/edit/admin/{id}',[RoleController::class,'EditAdmin'])->name('admin.edit.admin');
    Route::post('/update/admin/{id}',[RoleController::class,'UpdateAdmin'])->name('admin.update.admin');

//all admin  user routes
    Route::get('/show/all/users',[RoleController::class,'ShowUser'])->name('admin.show.user');

//all admin shipping routes
    Route::get('/all/shipping',[MainAdminController::class,'ShowAllShipping'])->name('admin.shipping');
    Route::get('/edit/shipping/{id}',[MainAdminController::class,'EditShipping'])->name('admin.edit.shipping');
    Route::post('/update/shipping/{id}',[MainAdminController::class,'UpdateShipping']);

//all admin seo routes
    Route::get('/seo',[MainAdminController::class,'Seo'])->name('admin.seo');
    Route::post('/update/seo',[MainAdminController::class,'UpdateSeo'])->name('admin.update.seo');

//all admin settings routes
    Route::get('/setting',[MainAdminController::class,'Setting'])->name('admin.setting');
    Route::post('/update/setting',[MainAdminController::class,'UpdateSetting'])->name('admin.update.setting');

//all admin review routes
    Route::get('/review',[MainAdminController::class,'Review'])->name('admin.review');
    Route::get('/new/review',[MainAdminController::class,'NewReview'])->name('admin.new.review');
    Route::get('/read/review',[MainAdminController::class,'ReadReview'])->name('admin.read.review');
    Route::get('/delete/review/{id}',[MainAdminController::class,'DeleteReview']);
    Route::get('/show/review/{id}',[MainAdminController::class,'ShowReview'])->name('admin.show.review');
    Route::post('/reply/review/{id}',[MainAdminController::class,'StoreReplyReview'])->name('reply.review');

//all admin comment routes
    Route::get('/comment',[MainAdminController::class,'Comment'])->name('admin.comment');
    Route::get('/new/comment',[MainAdminController::class,'NewComment'])->name('admin.new.comment');
    Route::get('/reply/comment',[MainAdminController::class,'ReplyComment'])->name('admin.reply.comment');
    Route::get('/delete/comment/{id}',[MainAdminController::class,'DeleteComment']);
    Route::get('/show/comment/{id}',[MainAdminController::class,'ShowComment'])->name('admin.show.comment');
    Route::post('/reply/comment/{id}',[MainAdminController::class,'StoreReplyComment'])->name('reply.comment');
    Route::get('/delete/comment_reply/{id}',[MainAdminController::class,'DeleteReplyComment'])->name('delete.reply.comment');



// all admin message routes
    Route::get('/message',[MainAdminController::class,'Message'])->name('admin.message');
    Route::get('/new/message',[MainAdminController::class,'NewMessage'])->name('admin.new.message');
    Route::get('/read/message',[MainAdminController::class,'ReadMessage'])->name('admin.read.message');
    Route::get('/reply/message',[MainAdminController::class,'ReplyMessage'])->name('admin.reply.message');
    Route::get('/delete/message/{id}',[MainAdminController::class,'DeleteMessage']);
    Route::get('/show/message/{id}',[MainAdminController::class,'ShowMessage'])->name('admin.show.message');
    Route::post('/sent/message/{id}',[MainAdminController::class,'SentMessage'])->name('sent.message');

//all admin stock routes
    Route::get('/stock',[MainAdminController::class,'Stock'])->name('admin.stock');



});

require __DIR__.'/auth.php';
