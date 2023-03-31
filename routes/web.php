<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AdminSettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\FixtureController;
use App\Http\Controllers\Backend\WinnerController;
use App\Http\Controllers\Backend\ColorSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\SeasonController;
use App\Http\Controllers\Backend\PrizeController;



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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

// Route::middleware('loggedin')->group(function() {
//     Route::get('login', [AuthController::class, 'loginView'])->name('login.index');
//     Route::post('login', [AuthController::class, 'login'])->name('login.check');
//     Route::get('register', [AuthController::class, 'registerView'])->name('register.index');
//     Route::post('register', [AuthController::class, 'register'])->name('register.store');
// });

// Route::middleware('auth')->group(function() {
//     Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//     Route::get('/', [PageController::class, 'dashboardOverview1'])->name('dashboard-overview-1');
//     Route::get('dashboard-overview-2-page', [PageController::class, 'dashboardOverview2'])->name('dashboard-overview-2');
//     Route::get('dashboard-overview-3-page', [PageController::class, 'dashboardOverview3'])->name('dashboard-overview-3');
//     Route::get('inbox-page', [PageController::class, 'inbox'])->name('inbox');
//     Route::get('file-manager-page', [PageController::class, 'fileManager'])->name('file-manager');
//     Route::get('point-of-sale-page', [PageController::class, 'pointOfSale'])->name('point-of-sale');
//     Route::get('chat-page', [PageController::class, 'chat'])->name('chat');
//     Route::get('post-page', [PageController::class, 'post'])->name('post');
//     Route::get('calendar-page', [PageController::class, 'calendar'])->name('calendar');
   // Route::get('crud-data-list-page', [PageController::class, 'crudDataList'])->name('crud-data-list');
   // Route::get('crud-form-page', [PageController::class, 'crudForm'])->name('crud-form');
//     Route::get('users-layout-1-page', [PageController::class, 'usersLayout1'])->name('users-layout-1');
//     Route::get('users-layout-2-page', [PageController::class, 'usersLayout2'])->name('users-layout-2');
//     Route::get('users-layout-3-page', [PageController::class, 'usersLayout3'])->name('users-layout-3');
//     Route::get('profile-overview-1-page', [PageController::class, 'profileOverview1'])->name('profile-overview-1');
//     Route::get('profile-overview-2-page', [PageController::class, 'profileOverview2'])->name('profile-overview-2');
//     Route::get('profile-overview-3-page', [PageController::class, 'profileOverview3'])->name('profile-overview-3');
//     Route::get('wizard-layout-1-page', [PageController::class, 'wizardLayout1'])->name('wizard-layout-1');
//     Route::get('wizard-layout-2-page', [PageController::class, 'wizardLayout2'])->name('wizard-layout-2');
//     Route::get('wizard-layout-3-page', [PageController::class, 'wizardLayout3'])->name('wizard-layout-3');
//     Route::get('blog-layout-1-page', [PageController::class, 'blogLayout1'])->name('blog-layout-1');
//     Route::get('blog-layout-2-page', [PageController::class, 'blogLayout2'])->name('blog-layout-2');
//     Route::get('blog-layout-3-page', [PageController::class, 'blogLayout3'])->name('blog-layout-3');
//     Route::get('pricing-layout-1-page', [PageController::class, 'pricingLayout1'])->name('pricing-layout-1');
//     Route::get('pricing-layout-2-page', [PageController::class, 'pricingLayout2'])->name('pricing-layout-2');
//     Route::get('invoice-layout-1-page', [PageController::class, 'invoiceLayout1'])->name('invoice-layout-1');
//     Route::get('invoice-layout-2-page', [PageController::class, 'invoiceLayout2'])->name('invoice-layout-2');
//     Route::get('faq-layout-1-page', [PageController::class, 'faqLayout1'])->name('faq-layout-1');
//     Route::get('faq-layout-2-page', [PageController::class, 'faqLayout2'])->name('faq-layout-2');
//     Route::get('faq-layout-3-page', [PageController::class, 'faqLayout3'])->name('faq-layout-3');
//     Route::get('login-page', [PageController::class, 'login'])->name('login');
//     Route::get('register-page', [PageController::class, 'register'])->name('register');
//     Route::get('error-page-page', [PageController::class, 'errorPage'])->name('error-page');
//     Route::get('update-profile-page', [PageController::class, 'updateProfile'])->name('update-profile');
//     Route::get('change-password-page', [PageController::class, 'changePassword'])->name('change-password');
//     Route::get('regular-table-page', [PageController::class, 'regularTable'])->name('regular-table');
//     Route::get('tabulator-page', [PageController::class, 'tabulator'])->name('tabulator');
//     Route::get('modal-page', [PageController::class, 'modal'])->name('modal');
//     Route::get('slide-over-page', [PageController::class, 'slideOver'])->name('slide-over');
//     Route::get('notification-page', [PageController::class, 'notification'])->name('notification');
//     Route::get('accordion-page', [PageController::class, 'accordion'])->name('accordion');
//     Route::get('button-page', [PageController::class, 'button'])->name('button');
//     Route::get('alert-page', [PageController::class, 'alert'])->name('alert');
//     Route::get('progress-bar-page', [PageController::class, 'progressBar'])->name('progress-bar');
//     Route::get('tooltip-page', [PageController::class, 'tooltip'])->name('tooltip');
//     Route::get('dropdown-page', [PageController::class, 'dropdown'])->name('dropdown');
//     Route::get('typography-page', [PageController::class, 'typography'])->name('typography');
//     Route::get('icon-page', [PageController::class, 'icon'])->name('icon');
//     Route::get('loading-icon-page', [PageController::class, 'loadingIcon'])->name('loading-icon');
//     Route::get('regular-form-page', [PageController::class, 'regularForm'])->name('regular-form');
//     Route::get('datepicker-page', [PageController::class, 'datepicker'])->name('datepicker');
//     Route::get('tom-select-page', [PageController::class, 'tomSelect'])->name('tom-select');
//     Route::get('file-upload-page', [PageController::class, 'fileUpload'])->name('file-upload');
//     Route::get('wysiwyg-editor-classic', [PageController::class, 'wysiwygEditorClassic'])->name('wysiwyg-editor-classic');
//     Route::get('wysiwyg-editor-inline', [PageController::class, 'wysiwygEditorInline'])->name('wysiwyg-editor-inline');
//     Route::get('wysiwyg-editor-balloon', [PageController::class, 'wysiwygEditorBalloon'])->name('wysiwyg-editor-balloon');
//     Route::get('wysiwyg-editor-balloon-block', [PageController::class, 'wysiwygEditorBalloonBlock'])->name('wysiwyg-editor-balloon-block');
//     Route::get('wysiwyg-editor-document', [PageController::class, 'wysiwygEditorDocument'])->name('wysiwyg-editor-document');
//     Route::get('validation-page', [PageController::class, 'validation'])->name('validation');
//     Route::get('chart-page', [PageController::class, 'chart'])->name('chart');
//     Route::get('slider-page', [PageController::class, 'slider'])->name('slider');
//     Route::get('image-zoom-page', [PageController::class, 'imageZoom'])->name('image-zoom');
// });


//admin routes

Route::prefix('admin')->group(function() {
    Route::get('login', [AuthController::class, 'loginView'])->name('admin/login.index');
    Route::post('login', [AuthController::class, 'login'])->name('admin/login');
    Route::get('register', [AuthController::class, 'registerView'])->name('register.index');
    Route::post('register', [AuthController::class, 'register'])->name('register.store');
});
Route::prefix('admin')->middleware([ 'isAdmin'])->group(function() {
    // Route::get('dashboard', [PageController::class, 'dashboardOverview1'])->name('admin/dashboard');
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin/dashboard');
    Route::match(['get' , 'post'] , 'profile', [AdminSettingController::class, 'profile'])->name('admin/profile');
    // Route::match(['get' , 'post'] , 'password', [AdminSettingController::class, 'changePassword'])->name('admin/password');
    Route::get('password', [AdminSettingController::class, 'password'])->name('admin/password');
    Route::post('update_password', [AdminSettingController::class, 'updatePassword'])->name('admin/update_password');


    Route::get('user', [UserController::class, 'user_management'])->name('admin/user');
    Route::get('user_data', [UserController::class, 'user_data'])->name('admin/user_data');
    Route::get('fixtures', [FixtureController::class, 'fixtures'])->name('admin/fixtures');
    Route::get('fixtures_data', [FixtureController::class, 'fixtures_data'])->name('admin/fixtures_data');
    Route::get('add_fixtures', [FixtureController::class, 'add_fixtures'])->name('admin/add_fixtures');
    Route::post('store_fixture', [FixtureController::class, 'store_fixture'])->name('admin/store_fixture');
    Route::get('edit_fixture/{id}', [FixtureController::class, 'edit_fixture'])->name('admin/edit_fixture/{id}');
    Route::post('update_fixture/{id}', [FixtureController::class, 'update_fixture'])->name('admin/update_fixture/{id}');
    // Route::get('delete_fixture/{id}', [FixtureController::class, 'delete_fixture'])->name('admin/delete_fixture/{id}');
    Route::get('fixtures/{id}', [FixtureController::class, 'delete_fixture'])->name('admin/fixtures/{id}');

    //results rotues
    Route::get('winner', [WinnerController::class, 'index'])->name('admin/winner');
    //color setting
    Route::get('color_setting', [ColorSettingController::class, 'index'])->name('admin/color_setting');
    Route::get('edit_color/{id}', [ColorSettingController::class, 'edit_color'])->name('admin/edit_color/{id}');
    Route::post('update_color/{id}', [ColorSettingController::class, 'update_color'])->name('admin/update_color/{id}');



    Route::get('team',[TeamController::class,'index'])->name('admin/team');
    Route::get('team_data',[TeamController::class,'getAll'])->name('admin/team_data');
    Route::get('team-edit/{id}',[TeamController::class,'edit'])->name('admin/team-edit');
    Route::get('team-add',[TeamController::class,'add'])->name('admin/team-add');
    Route::post('team-create',[TeamController::class,'create'])->name('admin/team-create');
    Route::get('team-delete/{id}',[TeamController::class,'delete'])->name('admin/team-delete');
    Route::post('team-update/{id}',[TeamController::class,'update'])->name('admin/team-update');
    Route::get('allPayments',[PaymentController::class,'getAll'])->name('admin/allPayments');

    Route::get('payments',[PaymentController::class,'index'])->name('admin/payments');

    Route::resources([
        'season' => SeasonController::class,        
    ]);
    Route::get('allSeasons',[SeasonController::class,'allSeasons'])->name('allSeasons');
    Route::get('seasonDelete/{id}',[SeasonController::class,'delete'])->name('seasonDelete');

    Route::get('prize',[PrizeController::class,'index'])->name('prize');
    Route::get('prize-list',[PrizeController::class,'list'])->name('prize-list');
    Route::get('prize-edit/{id}',[PrizeController::class,'edit'])->name('prize-edit');
    Route::get('prize-delete/{id}',[PrizeController::class,'delete'])->name('prize-delete');
   
    Route::get('logout', [AuthController::class, 'logout'])->name('admin/logout');
});


//user routes

Route::match(['get' , 'post'], 'login', [LoginController::class, 'login'])->name('login');
Route::middleware(['auth' , 'user'])->get('dashboard' , function(){
   return "hello";
});



