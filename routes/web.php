<?php

use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Location\CityController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\BlogReviewController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\Customer\CustomerController;
use App\Http\Controllers\Front\FacebookLoginController;
use App\Http\Controllers\Front\FavoriteController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\OrderTrakingController;
use App\Http\Controllers\Front\ProductReviewController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\AboutusSliderController;
use App\Http\Controllers\BlogbannerController;
use App\Http\Controllers\ContactusBannerController;
use App\Http\Controllers\ContactusInfoController;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TermsconditionController;
use App\Http\Controllers\PrivacypolicyController;
use App\Http\Controllers\FaqbannerController;
use App\Http\Controllers\NewslettersubsController;
use App\Http\Controllers\OrderbannerController;
use App\Http\Controllers\OutOfStockController;
use App\Http\Controllers\ShopbannerController;
use App\Http\Controllers\WhoweareController;
use App\Http\Controllers\NewsletterDiscount;

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

Route::get('/', [FrontController::class,'index'])->name('front');
Route::get('/{page}',  [FrontController::class,'page'])->name('page')->where('page', 'terms-conditions|privacy-policy');
Route::get('/compares', [FrontController::class,'compare'])->name('compares');
Route::get('/compares/add/{id}', [FrontController::class,'compareAdd'])->name('compares.add');
Route::get('/compares/remove/{id}', [FrontController::class,'compareRemove'])->name('compares.remove');
Route::get('/aboutus', [FrontController::class,'aboutus'])->name('aboutus');


//Contact
Route::get('/contactus', [FrontController::class,'contactus'])->name('contactus');
Route::post('/contactus', [FrontController::class,'contactusSend'])->name('contactus.send');

//Faq
Route::get('faq', [FrontController::class,'faq'])->name('faq');

//shop
Route::get('shop-single/{id}/{slug?}',[ShopController::class,'shopSingle'])->name('shop.single');
Route::get('shop',[ShopController::class,'shop'])->name('shop');
Route::get('shop-quick-view/{id}',[ShopController::class,'shopQuickView'])->name('shop.quick.view');
Route::get('shop-product-info/{id}',[ShopController::class,'shopProductInfo'])->name('shop.product.info');
Route::post('live/search', [ShopController::class,'liveSearch'])->name('live.search');

//blog
Route::get('blog-single/{id}/{slug?}',[BlogController::class,'blogSingle'])->name('blog.single');
Route::get('blogs',[BlogController::class,'blog'])->name('blogs');
Route::get('category-blogs/{id}/{slug?}',[BlogController::class,'categoryBlog'])->name('category.blogs');

//order traking
Route::get('/order-traking',[OrderTrakingController::class, 'index'])->name('order.traking');
Route::post('order-tracking/status', [OrderTrakingController::class,'details'])->name('customer.order_tracking.status')->middleware('customer');

//cart
Route::get('/cart',[CartController::class, 'index'])->name('cart');
Route::post('add-to-cart',[CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('cart/remove/{rowid}',[CartController::class, 'cartRemove'])->name('cart.remove');
Route::post('cart/update',[CartController::class, 'cartUpdate'])->name('cart.update');
Route::post('cart/count',[CartController::class, 'cartCount'])->name('cart.count');
Route::get('cart/product/quantity/{product_id}',[CartController::class, 'productCartCount'])->name('cart.product.count');

//Favorite
Route::get('favorites', [FavoriteController::class,'favorites'])->name('favorites')->middleware('customer');
Route::post('favorites/add', [FavoriteController::class, 'favoriteAdd'])->name('favorites.add');
Route::get('favorites/remove/{id}', [FavoriteController::class, 'favoriteRemove'])->name('favorites.remove')->middleware('customer');
Route::get('favorites/check/{product_info_id}/{user_id}', [FavoriteController::class, 'favoriteCheck'])->name('favorites.check');

//reviews
Route::post('product/review/store',[ProductReviewController::class,'store'])->name('product.review.store')->middleware('customer');
Route::post('blog/review/store',[BlogReviewController::class,'store'])->name('blog.review.store')->middleware('customer');

//user authentication
Route::get('account', [CustomerController::class,'accountView'])->name('account.login');
Route::post('account', [CustomerController::class,'account'])->name('account');
Route::get('account-register', [CustomerController::class,'registerView'])->name('account.register');
Route::post('account-register', [CustomerController::class,'register'])->name('account.register');
Route::get('account-verify/{email}/{token}', [CustomerController::class, 'verify'])->name('account.verify');
Route::get('dashboard', [CustomerController::class,'dashboard'])->name('dashboard')->middleware('customer');
Route::get('orders', [CustomerController::class,'orders'])->name('orders')->middleware('customer');
Route::get('account-details', [CustomerController::class,'accountDetails'])->name('account.details')->middleware('customer');
Route::post('account/info/change', [CustomerController::class, 'accrountInfoChange'])->name('account.info.change')->middleware('customer');
Route::post('account/change/password', [CustomerController::class, 'accrountChangePassword'])->name('account.change.password')->middleware('customer');
Route::get('address', [CustomerController::class,'address'])->name('address')->middleware('customer');
Route::post('address', [CustomerController::class,'addressStore'])->name('address')->middleware('customer');

// Password reset link request routes...
Route::get('password/email',  [CustomerController::class, 'getEmail'])->name('password.email');
Route::post('password/send/email',  [CustomerController::class, 'postEmail'])->name('password.send.email');

// Password reset routes...
Route::get('password/reset/confirm/{token}',  [CustomerController::class, 'getReset'])->name('password.reset');
Route::post('password/reset/confirm',  [CustomerController::class, 'updatePassword'])->name('password.reset.confirm');

//admin login
Route::get('admin-login', [AdminController::class,'login'])->name('admin.login');
Route::post('admin-logged', [AdminController::class,'logged'])->name('admin.logged');

//social login
Route::get('login/facebook', [FacebookLoginController::class,'redirectToProvider']);
Route::get('login/facebook/callback', [FacebookLoginController::class,'handleProviderCallback']);
Route::post('newsletter/subscription',[CustomerController::class,'newsletterSubscription'])->name('newsetter.subscription');

//checkout
Route::get('/checkout', [SslCommerzPaymentController::class,'checkout'])->name('checkout')->middleware('customer');
//SSLCOMMERZ Start
Route::post('pay', [SslCommerzPaymentController::class, 'index']);
Route::post('pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('success', [SslCommerzPaymentController::class, 'success']);
Route::post('fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Referral portion
Route::get('admin/referral', [App\Http\Controllers\HomeController::class, 'referral'])->name('admin.referral');
Route::post('dashboard', [ReferralController::class, 'store'])->name('dashboard.store');
Route::get('admin/referral/details/{mail}', [App\Http\Controllers\HomeController::class, 'referral_details'])->name('admin.referral.details');

//About_us(BackEnd)
Route::get('admin/about-us',[HomeController::class,'about_us_backend'])->name('admin.about_us');
Route::post('admin/about-us',[HomeController::class,'about_us_banner_store'])->name('admin.about_us_banner_store');
Route::get('admin/about-us/{id}/edit',[HomeController::class,'about_us_banner_edit'])->name('admin.about_us_banner_edit');
Route::post('admin/about-us/{id}',[HomeController::class,'about_us_banner_udpate'])->name('admin.about_us_banner_udpate');
Route::delete('admin/about-us/{id}',[HomeController::class,'about_us_banner_destroy'])->name('admin.aboutus.banner.destroy');

//Sliders(About us)
Route::get('admin/aboutus-team-members', [AboutusSliderController::class,'index'])->name('admin.about_us.slider');
Route::post('admin/aboutus-team-members', [AboutusSliderController::class,'store'])->name('admin.about_us.slider.store');
Route::get('admin/aboutus-team-members/{id}/edit', [AboutusSliderController::class,'edit'])->name('admin.about_us.slider.edit');
Route::delete('admin/aboutus-team-members/{id}', [AboutusSliderController::class,'destroy'])->name('admin.about_us.slider.delete');
Route::put('admin/aboutus-team-members/updated', [AboutusSliderController::class,'updated'])->name('admin.about_us.slider.update');


//Who We Are(About us)
Route::get('admin/aboutus-who-we-are', [WhoweareController::class,'index'])->name('admin.about_us.Whoweare');
Route::post('admin/aboutus-who-we-are', [WhoweareController::class,'store'])->name('admin.about_us.Whoweare.store');
Route::get('admin/aboutus-who-we-are/{id}/edit', [WhoweareController::class,'edit'])->name('admin.about_us.Whoweare.edit');
Route::delete('admin/aboutus-who-we-are/{id}', [WhoweareController::class,'destroy'])->name('admin.about_us.Whoweare.delete');
Route::put('admin/aboutus-who-we-are/updated/{id}', [WhoweareController::class,'updated'])->name('admin.about_us.Whoweare.update');

//Terms & Condition(BackEnd)
Route::get('admin/terms-condition',[TermsconditionController::class,'index'])->name('admin.terms_condition');
Route::post('admin/terms-condition',[TermsconditionController::class,'store'])->name('admin.terms_condition.store');
Route::post('admin/terms-condition-banner',[TermsconditionController::class,'banner_store'])->name('admin.terms_condition_banner.store');
Route::get('admin/terms-condition/{id}/edit',[TermsconditionController::class,'edit'])->name('admin.terms_condition.edit');
Route::put('admin/terms-condition/updated/{id}', [TermsconditionController::class,'updated'])->name('admin.terms_condition.udpate');
Route::delete('admin/terms-condition/{id}',[TermsconditionController::class,'destroy'])->name('admin.terms_condition.destroy');
Route::delete('admin/terms-condition-banner/{id}',[TermsconditionController::class,'banner_destroy'])->name('admin.terms_condition_banner.destroy');

//Privacy Policy(BackEnd)
Route::get('admin/privacy-policy',[PrivacypolicyController::class,'index'])->name('admin.privacy_policy');
Route::post('admin/privacy-policy',[PrivacypolicyController::class,'store'])->name('admin.privacy_policy.store');
Route::post('admin/privacy-policy-banner',[PrivacypolicyController::class,'banner_store'])->name('admin.privacy_policy_banner.store');
Route::get('admin/privacy-policy/{id}/edit',[PrivacypolicyController::class,'edit'])->name('admin.privacy_policy.edit');
Route::put('admin/privacy-policy/updated/{id}', [PrivacypolicyController::class,'updated'])->name('admin.privacy_policy.udpate');
Route::delete('admin/privacy-policy/{id}',[PrivacypolicyController::class,'destroy'])->name('admin.privacy_policy.destroy');
Route::delete('admin/privacy-policy-banner/{id}',[PrivacypolicyController::class,'banner_destroy'])->name('admin.privacy_policy_banner.destroy');

//FAQ Banner(Backend)
Route::get('admin/faq-banner', [FaqbannerController::class,'index'])->name('admin.faq_banner');
Route::post('admin/faq-banner', [FaqbannerController::class,'store'])->name('admin.faq_banner.store');
Route::get('admin/faq-banner/{id}/edit', [FaqbannerController::class,'edit'])->name('admin.faq_banner.edit');
Route::delete('admin/faq-banner/{id}', [FaqbannerController::class,'destroy'])->name('admin.faq_banner.delete');
//Route::put('admin/faq-banner/updated/{id}', [FaqbannerController::class,'updated'])->name('admin.faq_banner.update');


//Order Tracking Banner
Route::get('admin/order-tracking-banner', [OrderbannerController::class,'index'])->name('admin.order_tracking_banner');
Route::post('admin/order-tracking-banner', [OrderbannerController::class,'store'])->name('admin.order_tracking_banner.store');
Route::delete('admin/order-tracking-banner/{id}', [OrderbannerController::class,'destroy'])->name('admin.forder_trackingbanner.delete');

//=========================================================================================================================================
// //Shop Page Banner
Route::get('admin/shop-banner', [ShopbannerController::class,'index'])->name('admin.shop_banner');
Route::post('admin/shop-banner', [ShopbannerController::class,'store'])->name('admin.shop_banner.store');
Route::delete('admin/shop-banner/{id}', [ShopbannerController::class,'destroy'])->name('admin.shop_banner.delete');

//Contact us Banner
Route::get('admin/contact-us-banner', [ContactusBannerController::class,'index'])->name('admin.contact_us.banner');
Route::post('admin/contact-us-banner', [ContactusBannerController::class,'store'])->name('admin.contact_usbanner.store');
Route::delete('admin/contact-us-banner/{id}', [ContactusBannerController::class,'destroy'])->name('admin.contact_us.delete');

//Blog Banner
Route::get('admin/blog-banner', [BlogbannerController::class,'index'])->name('admin.order_blog_banner');
Route::post('admin/blog-banner', [BlogbannerController::class,'store'])->name('admin.order_blog_banner.store');
Route::delete('admin/blog-banner/{id}', [BlogbannerController::class,'destroy'])->name('admin.forder_blog_banner.delete');


//Out of stock product show
Route::get('admin/out-of-stock', [OutOfStockController::class,'index'])->name('admin.out_of_stock.produdct');


// Newsletter Discount
Route::get('admin/newsletter-discount', [NewslettersubsController::class,'index'])->name('admin.newsletter.customer');
Route::post('admin/newsletter-discount', [NewslettersubsController::class,'store'])->name('admin.newsletter.customer.store');
Route::get('admin/newsletter-discount/{id}/edit', [NewslettersubsController::class,'edit'])->name('admin.newsletter.customer.edit');
Route::put('admin/newsletter-discount/updated', [NewslettersubsController::class,'updated'])->name('admin.newsletter.customer.udpate');
Route::delete('admin/newsletter-discount/{id}', [NewslettersubsController::class,'destroy'])->name('admin.newsletter.customer.delete');



// Contact us Info
Route::get('admin/contact-us', [ContactusInfoController::class,'index'])->name('admin.contactus');
Route::post('admin/contact-us', [ContactusInfoController::class,'store'])->name('admin.contactus.store');
Route::get('admin/contact-us/{id}/edit', [ContactusInfoController::class,'edit'])->name('admin.contactus.edit');
Route::delete('admin/contact-us/{id}', [ContactusInfoController::class,'destroy'])->name('admin.contactus.delete');
Route::put('admin/contact-us/updated', [ContactusInfoController::class,'updated'])->name('admin.contactus.update');



// Product Rating

Route::get('/ratingvalue','StockoutController@stockoutValue');
Route::post('/shop',[ShopController::class,'productRating'])->name('product.rating');


//Mail verify notice page
Route::get('/notice', [FrontController::class,'notice'])->name('notice');

