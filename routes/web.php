<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MoyasarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ApplePayController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderFileController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\OrderProgressController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\FileDownloaderController;
use App\Http\Controllers\FreelancerPaymentController;
use App\Http\Controllers\Customer\CustomerRegisterController;
use App\Http\Controllers\ProductOrderController;


Route::get('/business-card', function () {
    $name = 'John Doe';
    $imageUrl = asset('assets/imgs/avatar.png');
    $socialLinks = [
        'https://www.facebook.com',
        'https://www.twitter.com',
        'https://www.instagram.com',
    ];
    return view('components.business-card', compact('name', 'imageUrl', 'socialLinks'));
});

Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('lang-swape/{locale}', [LanguageController::class, 'langSwape'])->name('langSwape');


Route::get('/register', [CustomerRegisterController::class, 'registerPage'])->name('register');
Route::post('/register', [CustomerRegisterController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'customerLogin'])->name('login');
Route::get('/cpanel-login', [AuthController::class, 'cpanelLogin'])->name('cpanel.login');
// Route::get('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.post');


// Guest Routes
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/services', 'services')->name('services');
    Route::get('/products', 'products')->name('products');
    Route::get('/products/{product}', 'product')->name('products.product-details');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/order', 'order')->name('order');
    // terms and conditions
    Route::get('/terms-conditions', 'termsConditions')->name('terms-conditions');
    Route::get('/privacy', 'privacy')->name('privacy');
});


Route::middleware('auth')->group(function () {
    Route::get('/offers/archive', [OfferController::class, 'archive'])->name('offers.archive');
    Route::get('/orders/archive', [OrderController::class, 'archive'])->name('orders.archive');
    Route::get('/chats/archive', [ChatController::class, 'archive'])->name('chats.archive');
    Route::post('/contact-messages', [ContactMessageController::class, 'store'])->name('contact-messages.store');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');
    Route::get('/chats/{chat}/messages', [ChatController::class, 'getMessages'])->name('chats.messages');
    Route::post('/chats/{chat}/messages', [ChatController::class, 'storeMessage'])->name('chats.store-message');
    Route::get('/chats/updates/{chat}', [ChatController::class, 'updates'])->name('chats.updates');
    Route::get('/chats/{chat}/messages/new/{lastMessageId}', [ChatController::class, 'getNewMessages'])->name('chats.new-messages');
    Route::get('/file-download', FileDownloaderController::class)->name('file.download');
    // Customer
    Route::middleware('role:customer')->prefix('/')->group(function () {
        Route::controller(CustomerController::class)->group(function () {
            Route::get('/account', 'account')->name('customer.account');
            Route::put('/account/update-image', 'updateImage')->name('customer.account.update-image');
            Route::put('/account/update-password', 'updatePassword')->name('customer.account.update-password');
            Route::put('/account/update-info', 'updateInfo')->name('customer.account.update-info');
        });
        Route::get('/chats', [ChatController::class, 'index'])->name('customer.chats');
        Route::controller(\App\Http\Controllers\Customer\OrderController::class)->group(function () {
            Route::get('/orders', 'index')->name('customer.orders.index');
            Route::post('/orders', 'store')->name('customer.orders.store');
            Route::put('/orders/{order}', 'update')->name('orders.update');
            Route::put('/orders/{order}/cancel', 'cancel')->name('orders.cancel');
            Route::get('/orders/{order}/{type}', 'show')->name('customer.orders.show');
            // Route::get('/orders/{order}/checkout', 'checkout')->name('customer.orders.checkout');
            Route::post('/orders/{order}/accept-offer', 'customerAcceptOffer')->name('customer.orders.accept-offer');
        });
        Route::get('/checkout/{order}', [CheckoutController::class, 'checkout'])->name('checkout');
        Route::get('/payment/callback', [CheckoutController::class, 'callback'])->name('payment.callback');
    });
    // Freelancer
    Route::middleware('role:freelancer')->prefix('/freelancer')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'freelancer'])->name('freelancer.dashboard');
        Route::controller(ArchiveController::class)->group(function () {
            Route::get('/archived-orders', 'freelancerArchivedOrders')->name('freelancer.archived-orders');
            Route::get('/archived-offers', 'freelancerArchivedOffers')->name('freelancer.archived-offers');
            Route::put('/orders/{order}/archive', 'freelancerArchiveOrder')->name('orders.freelancer-archive');
            Route::put('/orders/{order}/unarchive', 'freelancerUnarchiveOrder')->name('orders.freelancer-unarchive');
            Route::put('/offers/{offer}/archive', 'freelancerArchiveOffer')->name('offers.freelancer-archive');
            Route::put('/offers/{offer}/unarchive', 'freelancerUnarchiveOffer')->name('offers.freelancer-unarchive');
        });
        Route::controller(ChatController::class)->group(function () {
            Route::get('/chats', 'index')->name('freelancer.chats');
        });
        Route::controller(OrderController::class)->group(function () {
            Route::get('/orders', 'freelancerIndex')->name('freelancer.orders.index');
            Route::get('/orders/{order}', 'freelancerShow')->name('freelancer.orders.show');
            Route::post('/orders/{order}/upload', 'freelancerUpload')->name('freelancer.orders.upload');
            Route::put('/orders/{order}/mark-completed', 'freelancerMarkCompleted')->name('freelancer.orders.mark-completed');
        });
        Route::controller(OrderProgressController::class)->group(function () {
            Route::post('/orders/{order}/progress', 'store')->name('freelancer.orders.progress.store');
        });
        Route::controller(OrderFileController::class)->group(function () {
            Route::post('/orders/{order}/files', 'store')->name('freelancer.orders.files.store');
            Route::delete('/orders/files/{orderFile}', 'destroy')->name('freelancer.orders.files.destroy');
        });
        Route::controller(OfferController::class)->group(function () {
            Route::get('/offers', 'freelancerIndex')->name('freelancer.offers.index');
            Route::put('/offers/{offer}/accept', 'accept')->name('freelancer.offers.accept');
            Route::put('/offers/{offer}/reject', 'reject')->name('freelancer.offers.reject');
            Route::put('/offers/{offer}/send-price', 'sendPrice')->name('freelancer.offers.sendPrice');
        });
        Route::get('/payments', [FreelancerPaymentController::class, 'freelancerIndex'])->name('freelancer.payments.index');
        Route::view('settings', 'freelancer.settings')->name('freelancer.settings.view');
        Route::post('/settings', [SettingsController::class, 'freelancerUpdate'])->name('freelancer.settings.update');
    });

    // Admin
    Route::middleware('role:admin')->prefix('/admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::resource('services', ServiceController::class);
        Route::resource('users', UserController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('freelancers', FreelancerController::class);
        Route::resource('products', ProductController::class);
        Route::resource('offers', OfferController::class);
        Route::put('/offers/{offer}/cancel', [OfferController::class, 'cancel'])->name('offers.cancel');
        Route::resource('orders', OrderController::class)->except(['store', 'update']);
        Route::put('/orders/{order}/set-price', [OrderController::class, 'setPrice'])->name('orders.set-price');
        Route::resource('product-orders', ProductOrderController::class)->except(['store', 'update']);
        Route::get('/product-orders/{productOrder}', [ProductOrderController::class, 'show'])->name('product-orders.show');
        Route::put('/product-orders/{productOrder}/update-status', [ProductOrderController::class, 'updateStatus'])->name('product-orders.update-status');
        Route::controller(OrderProgressController::class)->group(function () {
            Route::post('/orders/{order}/progress', 'store')->name('admin.orders.progress.store');
            Route::put('/orders/progress/{orderProgress}/accept', 'accept')->name('admin.orders.progress.accept');
            Route::delete('/orders/progress/{orderProgress}', 'destroy')->name('admin.orders.progress.destroy');
            Route::put('/orders/progress/{orderProgress}', 'update')->name('admin.orders.progress.update');
        });
        Route::controller(OrderFileController::class)->group(function () {
            Route::post('/orders/{order}/files', 'store')->name('orders.files.store');
            Route::delete('/orders/files/{orderFile}', 'destroy')->name('admin.orders.files.destroy');
            Route::put('/orders/files/{orderFile}/accept', 'accept')->name('admin.orders.files.accept');
        });
        Route::put('/orders/{order}/approve', [OrderController::class, 'approve'])->name('admin.orders.approve');
        Route::put('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');
        Route::resource('chats', ChatController::class)->except(['store']);
        Route::resource('messages', MessageController::class);
        Route::resource('payments', PaymentController::class);
        Route::resource('freelancer-payments', FreelancerPaymentController::class);
        Route::resource('contact-messages', ContactMessageController::class)->except(['store']);
        Route::view('settings', 'admin.settings')->name('admin.settings.view');
        Route::post('settings', [SettingsController::class, 'adminUpdate'])->name('admin.settings.update');
        Route::controller(ArchiveController::class)->group(function () {
            Route::get('/archived-orders', 'adminArchivedOrders')->name('admin.archived-orders');
            Route::get('/archived-chats', 'adminArchivedChats')->name('admin.chats.archived');
            Route::get('/archived-offers', 'adminArchivedOffers')->name('admin.archived-offers');
            Route::put('/orders/{order}/archive', 'adminArchiveOrder')->name('orders.admin-archive');
            Route::put('/orders/{order}/unarchive', 'adminUnarchiveOrder')->name('orders.admin-unarchive');
            Route::put('/chats/{chat}/archive', 'adminArchiveChat')->name('admin.chats.archive');
            Route::put('/chats/{chat}/unarchive', 'adminUnarchiveChat')->name('admin.chats.unarchive');
            Route::put('/offers/{offer}/archive', 'adminArchiveOffer')->name('offers.admin-archive');
            Route::put('/offers/{offer}/unarchive', 'adminUnarchiveOffer')->name('offers.admin-unarchive');
        });
        Route::resource('pages', App\Http\Controllers\Admin\PageController::class)->only(['index', 'edit', 'update']);
        Route::put('home-page', [App\Http\Controllers\Admin\HomePageController::class, 'update'])->name('home-page.update');
        // Route::get('home-page', [App\Http\Controllers\Admin\HomePageController::class, 'edit'])->name('home-page.edit');
        Route::resource('sections', App\Http\Controllers\Admin\SectionController::class)->only(['update']);
        Route::resource('components', App\Http\Controllers\Admin\ComponentController::class)->only(['update']);
        Route::get('site-settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('site-settings.index');
        Route::put('site-settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('site-settings.update');
    });
});


// Password Resets
Route::controller(PasswordResetController::class)->group(function () {
    Route::get('password/forgot', 'forgotPasswordPage')->name('password.request');
    Route::post('password/send-email', 'forgotPassword')->name('password.email');
    Route::get('password/reset/{token}', 'resetPasswordPage')->name('password.reset');
    Route::post('password/reset', 'updatePassword')->name('password.update');
});

Route::post('/apple-pay/validate', [ApplePayController::class, 'validate'])->name('apple-pay.validate');

// Product order routes
Route::post('/product/order', [ProductOrderController::class, 'store'])->name('product.order.store');
Route::get('/product/order/{order}/success', [ProductOrderController::class, 'success'])->name('product.order.success');
Route::get('/product/order/{order}/payment', [ProductOrderController::class, 'payment'])->name('product.order.payment');
Route::get('/product/order/payment/callback', [ProductOrderController::class, 'paymentCallback'])->name('product.order.payment.callback');

// API route for requirements
Route::get('/api/product-options/requirements', [ProductOrderController::class, 'getRequirements']);

Broadcast::routes();
