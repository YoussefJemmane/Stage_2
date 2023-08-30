<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\FraisController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;

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

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::controller(AuthController::class)->middleware('loggedin')->group(function () {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
});


Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(FraisController::class)->group(function(){
        Route::get('/frais', 'index')->name('frais.liste');
        Route::get('/', 'dashboard')->name('dashboard');
        Route::post('/frais', 'store')->name('frais.store');
        Route::get('/frais/create', 'create')->name('frais.create');
        Route::get('/frais/{frais}/edit', 'edit')->name('frais.edit');
        Route::put('/frais/{frais}', 'update')->name('frais.update');
        Route::put('/frais/changeRA/{frais}', 'changeStatusFraisByRA')->name('frais.changeStatusFraisRA');
        Route::put('/frais/changeDT/{frais}', 'changeStatusFraisByDT')->name('frais.changeStatusFraisDT');
        Route::put('/frais/changePM/{frais}', 'changeStatusFraisByPM')->name('frais.changeStatusFraisPM');
        Route::delete('/frais/{frais}', 'destroy')->name('frais.destroy');
        Route::get('/frais/search', 'search')->name('frais.search');
    });


    Route::controller(UserController::class)->group(function(){
        Route::get('/employees/create', 'create')->name('employees.create');
        Route::delete('/employees/{employee}', 'destroy')->name('employees.destroy');
        Route::get('/employees/{employee}/edit', 'edit')->name('employees.edit');
        Route::get('/employees/{employee}/editProfile', 'editProfile')->name('employees.editProfile');
        Route::put('/employees/{employee}', 'update')->name('employees.update');
        Route::put('/employees/{employee}/profile', 'updateProfile')->name('employees.updateProfile');
        Route::post('/employees', 'store')->name('employees.store');
        Route::get('/employees/search', 'search')->name('employees.search');
        Route::get('/employees', 'index')->name('employees.liste');
    });


    Route::controller(PosteController::class)->group(function(){
        Route::get('/poste/create',  'create')->name('poste.create');
        Route::post('/poste',  'store')->name('poste.store');
    });


    Route::controller(ChequeController::class)->group(function(){
        Route::get('/cheques','index')->name('cheques.liste');
        Route::get('/cheques/create','create')->name('cheques.create');
        Route::put('/cheques/changeStatus/{cheque}','changeStatus')->name('cheques.changeStatus');
        Route::get('/cheques/search','search')->name('cheques.search');
        Route::post('/cheques','store')->name('cheques.store');
    });

    Route::controller(FournisseurController::class)->group(function(){
        Route::get('/fournisseur/create','create')->name('fournisseur.create');
        Route::post('/fournisseur','store')->name('fournisseur.store');
    });

    Route::controller(FacturationController::class)->group(function(){
        Route::get('/facturations','index')->name('facturations.liste');
        Route::get('/facturations/create','create')->name('facturations.create');
        Route::get('/facturations/edit/{facturation}','edit')->name('facturations.edit');
        Route::put('/facturations/update/{facturation}','update')->name('facturations.update');
        Route::post('/facturations','store')->name('facturations.store');
        Route::put('/facturations/changeStatus/{facture}','changeStatus')->name('facturations.changeStatus');
        Route::get('/facturations/search','search')->name('facturations.search');

    });

    Route::controller(ClientController::class)->group(function(){
        Route::get('/client/create', 'create')->name('client.create');
        Route::post('/client','store')->name('client.store');
    });

    Route::controller(TeamController::class)->group(function(){
        Route::get('/team/create','create')->name('team.create');
        Route::post('/team','store')->name('team.store');
    });

    Route::controller(PageController::class)->group(function () {
        Route::get('dsfsdfs', 'dashboardOverview1')->name('dashboard-overview-1');
        Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
        Route::get('dashboard-overview-3-page', 'dashboardOverview3')->name('dashboard-overview-3');
        Route::get('dashboard-overview-4-page', 'dashboardOverview4')->name('dashboard-overview-4');
        Route::get('categories-page', 'categories')->name('categories');
        Route::get('add-product-page', 'addProduct')->name('add-product');
        Route::get('product-list-page', 'productList')->name('product-list');
        Route::get('product-grid-page', 'productGrid')->name('product-grid');
        Route::get('transaction-list-page', 'transactionList')->name('transaction-list');
        Route::get('transaction-detail-page', 'transactionDetail')->name('transaction-detail');
        Route::get('seller-list-page', 'sellerList')->name('seller-list');
        Route::get('seller-detail-page', 'sellerDetail')->name('seller-detail');
        Route::get('reviews-page', 'reviews')->name('reviews');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('file-manager-page', 'fileManager')->name('file-manager');
        Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('post-page', 'post')->name('post');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
        Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');
        Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
        Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
        Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
        Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
        Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
        Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
        Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
        Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
        Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
        Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
        Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
        Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
        Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
        Route::get('login-page', 'login')->name('login');
        Route::get('register-page', 'register')->name('register');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('update-profile-page', 'updateProfile')->name('update-profile');
        Route::get('change-password-page', 'changePassword')->name('change-password');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic-page', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline-page', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon-page', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block-page', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document-page', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
    });
});
