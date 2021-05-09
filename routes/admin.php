<?php

use App\Http\Controllers\Backend\Blogs\BlogCategoryController;
use App\Http\Controllers\Backend\Blogs\BlogController;
use App\Http\Controllers\Backend\Cms\FaqCategory;
use App\Http\Controllers\Backend\Cms\FaqCategoryController;
use App\Http\Controllers\Backend\Cms\FaqController;
use App\Http\Controllers\Backend\Cms\MediaController;
use App\Http\Controllers\Backend\Cms\SliderController;
use App\Http\Controllers\Backend\Discount\DiscountController;
use App\Http\Controllers\Backend\Order\OrderController;
use App\Http\Controllers\Backend\Products\ProductCategoryController;
use App\Http\Controllers\Backend\Products\ProductInfoController;
use App\Http\Controllers\Backend\Products\ProductItemController;
use App\Http\Controllers\Backend\Products\ProductSubCategoryController;
use App\Http\Controllers\Backend\Products\ProductWeightController;
use App\Http\Controllers\Backend\Reviews\BlogReviewController;
use App\Http\Controllers\Backend\Reviews\ProductReviewController;
use App\Http\Controllers\Backend\Testimonials\TestimonialController;
use Illuminate\Support\Facades\Route;

//profile
//Route::get('profile','Admin\AdminController@profile')->name('profile');
//Route::post('profile/update','Admin\AdminController@profileUpdate')->name('profile.update');


//Product Categories
Route::post('categories/updated', [ProductCategoryController::class ,'updated'])->name('categories.updated');
Route::resource('categories', ProductCategoryController::class);

//SubCategories
Route::get('subcategories/list/{id}', [ProductSubCategoryController::class,'subcategories'])->name('subcategories.list');
Route::post('subcategories/updated', [ProductSubCategoryController::class,'updated'])->name('subcategories.updated');
Route::resource('subcategories', ProductSubCategoryController::class);

//ProductWeight
Route::post('productweights/updated', [ProductWeightController::class, 'updated'])->name('productweights.updated');
Route::resource('productweights', ProductWeightController::class);

//ProductItem
Route::resource('productitems', ProductItemController::class);

//ProductInfo
Route::resource('productinfos', ProductInfoController::class);

//Blog Categories
Route::post('blogcategories/updated', [BlogCategoryController::class ,'updated'])->name('blogcategories.updated');
Route::resource('blogcategories', BlogCategoryController::class);

//Blogs
Route::resource('blogs', BlogController::class);

//ProductReview
Route::get('productreviews', [ProductReviewController::class, 'index'])->name('product.reviews');
Route::get('productreviews/view/{id}', [ProductReviewController::class, 'view'])->name('product.reviews.view');
Route::get('productreviews/reply/{id}', [ProductReviewController::class, 'reply'])->name('product.replys.view');
Route::post('productreviews/update', [ProductReviewController::class, 'reviewUpdate'])->name('product.reviews.update');

//BlogReview
Route::get('blogreviews', [BlogReviewController::class, 'index'])->name('blog.reviews');
Route::get('blogreviews/view/{id}', [BlogReviewController::class, 'view'])->name('blog.reviews.view');
Route::get('blogreviews/reply/{id}', [BlogReviewController::class, 'reply'])->name('blog.replys.view');
Route::post('blogreviews/update', [BlogReviewController::class, 'reviewUpdate'])->name('blog.reviews.update');

//
////Orders
Route::get('orders', [OrderController::class,'index'])->name('orders');
Route::get('orders/{id}', [OrderController::class,'order'])->name('order.details');
Route::post('orders/status', [OrderController::class,'orderStatus'])->name('order.status');
Route::post('orders/payment/status', [OrderController::class,'orderPaymentStatus'])->name('order.payment.status');

//Sliders
Route::post('sliders/updated', [SliderController::class,'updated'])->name('sliders.updated');
Route::resource('sliders', SliderController::class);

//Faq Categories
Route::post('faqcategories/updated', [FaqCategoryController::class,'updated'])->name('faqcategories.updated');
Route::resource('faqcategories', FaqCategoryController::class);

//Faqs
Route::post('faqs/updated', [FaqController::class,'updated'])->name('faqs.updated');
Route::resource('faqs', FaqController::class);

//Medias
Route::post('medias/updated', [MediaController::class,'updated'])->name('medias.updated');
Route::resource('medias', MediaController::class);

//Testimonial
Route::post('testimonials/updated', [TestimonialController::class,'updated'])->name('testimonials.updated');
Route::resource('testimonials', TestimonialController::class);

//Testimonial
Route::post('discounts/updated', [DiscountController::class,'updated'])->name('discounts.updated');
Route::resource('discounts', DiscountController::class);
