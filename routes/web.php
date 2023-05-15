<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TeamPickController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\FrontPagesController;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AdminSettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\FixtureController;
use App\Http\Controllers\Backend\WinnerController;
use App\Http\Controllers\Backend\ColorSettingController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\SeasonController;
use App\Http\Controllers\Backend\PrizeController;
use App\Http\Controllers\Backend\GeneralController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\TeamResultController;
use App\Http\Controllers\Backend\LeaderboardController;
use App\Http\Controllers\Backend\HomeSettingController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PlayersController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\RegionController;
use App\Http\Controllers\Backend\VacationController;
use App\Models\Winner;

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

//user register
// Route::get('register' ,[AuthController::class , 'userRegister'])->name('register');

Route::middleware('guest')->group(function() {
    Route::get('register',[AuthController::class,'userRegister'])->name('register');
Route::post('new_reg',[AuthController::class,'new_reg'])->name('new_reg');
Route::match(['get' , 'post'], 'login', [AuthController::class, 'UserLogin'])->name('login');
});
// Route::get('payment' , [PaymentController::class , 'paymentPage'])->name('payment');


Route::get('fixtures' , [FixtureController::class, 'showFixtures'])->name('fixtures');

Route::match(['GET','POST'], 'contact_us', [FrontPagesController::class,'contact'])->name('contact_us');
Route::get('about', [FrontPagesController::class,'about'])->name('about');

Route::get('payment', [StripeController::class, 'stripe'])->name('payment');
Route::post('payment/store', [StripeController::class, 'stripePost'])->name('payment.store');
Route::get('success', [StripeController::class, 'success'])->name('success');
Route::post('selectTeam', [StripeController::class, 'selectTeam'])->name('selectTeam');
Route::get('success-message',function(){
    return view('front.payment.success');
})->name('success-message');


Route::middleware(['auth' , 'user'])->group(function() {
//pick a team for user
Route::get('teams', [TeamPickController::class, 'index'])->name('teams');
Route::post('pickTeam', [TeamPickController::class, 'pickTeam'])->name('pickTeam');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('dashboard' , [UserDashboardController::class, 'dashboard'])->name('dashboard');
Route::get('userHistory', [UserDashboardController::class, 'userHistory'])->name('userHistory');
Route::get('userPayment', [UserDashboardController::class, 'userPayment'])->name('userPayment');
});

//data according to alphabets
Route::post('alphabets' , [HomeController::class , 'getAlphabets']);
Route::get('player_roster/{alphabets}' ,[HomeController::class , 'player_roster']);

//match fixture for front
Route::get('fixtures' , [FixtureController::class, 'showFixtures'])->name('fixtures');

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

Route::prefix('admin')->middleware('guest')->group(function() {
    Route::get('login', [AuthController::class, 'AdminLoginCreate'])->name('admin/login.index');
    Route::post('login', [AuthController::class, 'AdminLogin'])->name('admin/login');
    Route::get('register', [AuthController::class, 'registerView'])->name('register.index');
    Route::post('register', [AuthController::class, 'register'])->name('register.store');
});
Route::prefix('admin')->middleware(['isAdmin'])->group(function() {
    // Route::get('dashboard', [PageController::class, 'dashboardOverview1'])->name('admin/dashboard');
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin/dashboard');
    Route::match(['get' , 'post'] , 'profile', [AdminSettingController::class, 'profile'])->name('admin/profile');
    // Route::match(['get' , 'post'] , 'password', [AdminSettingController::class, 'changePassword'])->name('admin/password');
    Route::get('password', [AdminSettingController::class, 'password'])->name('admin/password');
    Route::post('update_password', [AdminSettingController::class, 'updatePassword'])->name('admin/update_password');


    Route::get('user', [UserController::class, 'user_management'])->name('admin/user');
    Route::get('user_data', [UserController::class, 'user_data'])->name('admin/user_data');
    Route::get('fixtures', [FixtureController::class, 'fixtures'])->name('admin/fixtures');
    Route::post('fixture/section_heading', [FixtureController::class, 'section_heading'])->name('admin/fixture/section_heading');
    Route::get('fixtures_data', [FixtureController::class, 'fixtures_data'])->name('admin/fixtures_data');
    Route::get('add_fixtures', [FixtureController::class, 'add_fixtures'])->name('admin/add_fixtures');
    Route::post('store_fixture', [FixtureController::class, 'store_fixture'])->name('admin/store_fixture');
    Route::get('edit_fixture/{id}', [FixtureController::class, 'edit_fixture'])->name('admin/edit_fixture/{id}');
    Route::post('update_fixture/{id}', [FixtureController::class, 'update_fixture'])->name('admin/update_fixture/{id}');
    // Route::get('delete_fixture/{id}', [FixtureController::class, 'delete_fixture'])->name('admin/delete_fixture/{id}');
    Route::get('fixtures/{id}', [FixtureController::class, 'delete_fixture'])->name('admin/fixtures/{id}');

    Route::get('teams/result' ,[FixtureController::class , 'teamResult_index'] )->name('admin/teams/result');
    Route::match(['get', 'post'], 'team_result/edit/{id}',[FixtureController::class, 'edit_teamResult'])->name('admin/team_result/edit');

    //Winner rotues
    Route::get('winner', [WinnerController::class, 'index'])->name('admin/winner');
    Route::get('winner/assign_prize/{id}', [WinnerController::class, 'assign_prize'])->name('admin/winner/assign_prize');
    Route::post('winner/assigned_prize/{id}', [WinnerController::class, 'assigned_prize_store'])->name('admin/winner/assigned_prize');
    Route::get('view_winners', [WinnerController::class, 'view_winners'])->name('admin/view_winners');

    //color setting
    Route::get('color_setting', [ColorSettingController::class, 'index'])->name('admin/color_setting');
    Route::get('edit_color/{id}', [ColorSettingController::class, 'edit_color'])->name('admin/edit_color/{id}');
    Route::post('update_color/{id}', [ColorSettingController::class, 'update_color'])->name('admin/update_color/{id}');


    Route::get('allPayments',[PaymentController::class,'getAll'])->name('admin/allPayments');

    Route::get('payments',[PaymentController::class,'index'])->name('admin/payments');

    Route::resources([
        'season' => SeasonController::class,
    ]);

    Route::resources([
        'team' => TeamController::class,
    ]);
    Route::resources([
        'prize' => PrizeController::class,
    ]);

    Route::get('general', [GeneralController::class , 'general'])->name('admin/general');
    Route::post('general_post', [GeneralController::class , 'general_update'])->name('admin/general_post');

    Route::resources([
        'banner' => BannerController::class,
    ]);

   Route::get('team_result/delete/{id}' ,[TeamResultController::class , 'delete_teamResult']);

   //leaderboard
   Route::get('leaderboard',[LeaderboardController::class , 'index'])->name('admin/leaderboard');
   Route::get('leaderboard_data', [LeaderboardController::class, 'leaderboard_data'])->name('admin/leaderboard_data');
   Route::match(['get', 'post'], 'leaderboard/create',[LeaderboardController::class, 'create'])->name('admin/leaderboard/create');
   Route::match(['get', 'post'], 'leaderboard/edit/{id}',[LeaderboardController::class, 'edit'])->name('admin/leaderboard/edit');
   Route::get('leaderboard/delete/{id}' ,[LeaderboardController::class , 'delete']);
   Route::post('leaderboard/section_heading' ,[LeaderboardController::class , 'section_heading'])->name('admin/leaderboard/section_heading');

   // regions
   Route::resources(['region' => RegionController::class]);
    //home setting


    //News setting
    Route::resources(['news' => NewsController::class]);
    Route::get('news_data/',[NewsController::class,'news_data'])->name('admin/news_data');
    Route::get('news/delete/{id}',[NewsController::class,'destroy']);
    Route::post('news/section_heading',[NewsController::class,'section_heading'])->name('admin/news/section_heading');

    Route::resources(['videoSetting' => VideoController::class]);
    Route::get('videoSettingList/{section?}',[VideoController::class,'videoSettingList'])->name('videoSettingList');
    Route::get('videoSettingDelete/{id}',[VideoController::class,'destroy'])->name('videoSettingDelete');
    Route::post('video/section_heading',[VideoController::class,'section_heading'])->name('admin/video/section_heading');


    Route::resources(['vacation' => VacationController::class]);
    Route::post('vacation/section_heading',[VacationController::class,'section_heading'])->name('admin/vacation/section_heading');


    //menu setting
    Route::resources(['menu' => MenuController::class]);
    Route::get('menuList',[MenuController::class,'menuList'])->name('menuList');
    Route::get('menuDelete/{id}',[MenuController::class,'destroy'])->name('menuDelete');

    //players

    Route::get('players',[PlayersController::class,'index'])->name('admin/players');

     Route::get('logout', [AuthController::class, 'Adminlogout'])->name('admin/logout');
});






