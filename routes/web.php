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
use App\Http\Controllers\MatchResultController;

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
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PlayersController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\RegionController;
use App\Http\Controllers\Backend\VacationController;
use App\Http\Controllers\Backend\ScoreboardController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\AboutPageController;
use App\Http\Controllers\Backend\StaticPageController;
use App\Http\Controllers\Backend\ReviewsController;
use App\Http\Controllers\Backend\GeneralSettingController;
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


Route::get('fixtures', [FrontPagesController::class,'matchfixture'] )->name('fixtures');
//pick the team from match fixture page
Route::post('fixture_team_pick',[FrontPagesController::class, 'fixture_team_pick'])->name('fixture_team_pick');

Route::get('tesst', [FrontPagesController::class,'test'] )->name('tesst');

// Route::post('check_user',[FixtureController::class, 'checkUser']);
Route::get('loss_user',[FixtureController::class, 'loss_user']);

Route::match(['GET','POST'], 'contact', [FrontPagesController::class,'contact'])->name('contact');
Route::get('about', [FrontPagesController::class,'about'])->name('about');
Route::get('privacy', [FrontPagesController::class,'privacy'])->name('privacy');
Route::match(['get' , 'post'] , 'match-result/{season?}', [FrontPagesController::class,'matchResult'])->name('match-result');
// Route::get('match-result/{season?}', [FrontPagesController::class,'matchResult'] )->name('match-result');
Route::get('game-result', [FrontPagesController::class,'gameResult'])->name('game-result');
Route::get('prize', [FrontPagesController::class,'prize'])->name('prize');
Route::get('standings', [FrontPagesController::class,'standings'])->name('standings');
Route::get('results_by_regions',[FrontPagesController::class, 'results_by_regions'])->name('results_by_regions');
Route::post('reviews',[FrontPagesController::class, 'reviews'])->name('reviews');

//payment

//clover

Route::match(['get','post'],'forget_password',[AuthController::class,'forgotPassword'])->name('forget_password');
Route::match(['get','post'],'change_password',[AuthController::class,'changePassword'])->name('change_password');


Route::middleware(['auth' , 'user'])->group(function() {

    Route::get('payment', [StripeController::class, 'stripe'])->name('payment');

Route::post('payment/store', [StripeController::class, 'stripePost'])->name('payment.store');

Route::post('clover_charge', [StripeController::class, 'clover_charge'])->name('clover_charge');

Route::get('success', [StripeController::class, 'success'])->name('success');
Route::post('selectTeam', [StripeController::class, 'selectTeam'])->name('selectTeam');
// Route::get('success-message',function(){
//     return view('front.payment.success' , compact('Payment'));
// })->name('success-message');


//pick a team for user
Route::get('teams', [TeamPickController::class, 'index'])->name('teams');
Route::post('dashboard_team_pick',[TeamPickController::class, 'dashboard_team_pick'])->name('dashboard_team_pick');
// Route::post('pickTeam', [TeamPickController::class, 'pickTeam'])->name('pickTeam')->middleware('timeOver');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard' , [UserDashboardController::class, 'dashboard'])->name('dashboard');
Route::get('my_selections' , [UserDashboardController::class, 'my_selections'])->name('my_selections');
Route::get('my_results',[UserDashboardController::class, 'my_results'])->name('my_results');
Route::get('past_selections', [UserDashboardController::class, 'past_selections'])->name('past_selections');
Route::get('userPayment', [UserDashboardController::class, 'userPayment'])->name('userPayment');
Route::get('upcomingMatches', [UserDashboardController::class, 'upcomingMatches'])->name('upcomingMatches');
Route::match(['get' , 'put'] , 'settings', [UserDashboardController::class, 'settings'])->name('settings');
Route::match(['get' , 'put'] , 'update-password', [UserDashboardController::class, 'updatePassword'])->name('update-password');
// Route::get('personal_details', [UserDashboardController::class, 'personal_details'])->name('personal_details');
});

//data according to alphabets
Route::post('alphabets' , [HomeController::class , 'getAlphabets']);
Route::get('player_roster/{alphabets}' ,[HomeController::class , 'player_roster']);
Route::get('expire_plans',[HomeController::class,'checkPlan'])->name('expire_plans');
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
    Route::post('player_roster/section_heading' ,[UserController::class , 'section_heading'])->name('admin/player_roster/section_heading');
    Route::get('user_data', [UserController::class, 'user_data'])->name('admin/user_data');

    Route::get('Userdetails/{id}', [UserController::class, 'user_datails'])->name('admin/Userdetails/{id}');
    Route::get('UserPaymentdetails/{id}', [UserController::class, 'userPayment_datails'])->name('admin/UserPaymentdetails/{id}');
    Route::get('PaymentInvoice/{id}', [UserController::class, 'payment_invoice'])->name('admin/PaymentInvoice');


    Route::resources(['team' => TeamController::class,]);

    // regions
   Route::resources(['region' => RegionController::class]);
   //seasons
   Route::resources(['season' => SeasonController::class,]);

   //fixtures
   Route::resources(['fixtures' => FixtureController::class,]);
   Route::post('fixture/section_heading' , [FixtureController::class , 'section_heading'])->name('admin/fixture/section_heading');

    Route::get('teams/result' ,[TeamResultController::class , 'index'] )->name('admin/teams/result');

    Route::match(['get', 'post'], 'team_result/edit/{id}',[TeamResultController::class, 'edit_teamResult'])->name('admin/team_result/edit');
    Route::post('leaderboard/section_heading' ,[TeamResultController::class , 'section_heading'])->name('admin/leaderboard/section_heading');


    Route::get('scores',[ScoreboardController::class, 'index'])->name('admin/scores');
    Route::post('add_scores/{id}',[ScoreboardController::class, 'add_scores']);
    Route::match(['get', 'post'], 'add_scores/{id}',[ScoreboardController::class, 'add_scores']);

    Route::resources([
        'prize' => PrizeController::class,
    ]);

    Route::post('prize_banner' , [GeneralController::class , 'prize_banner'])->name('admin/prize_banner');
    Route::post('prize/section_heading' , [PrizeController::class , 'section_heading'])->name('admin/prize/section_heading');


    //Winner rotues
    Route::get('winner', [WinnerController::class, 'index'])->name('admin/winner');
    Route::get('winner/assign_prize/{id}', [WinnerController::class, 'assign_prize'])->name('admin/winner/assign_prize');
    Route::post('winner/assigned_prize/{id}', [WinnerController::class, 'assigned_prize_store'])->name('admin/winner/assigned_prize');
    Route::get('view_winners', [WinnerController::class, 'view_winners'])->name('admin/view_winners');

    //contacts list
    Route::resources([
        'contact' => ContactController::class,
    ]);

    //reviews
    Route::resources([
        'reviews' => ReviewsController::class,
    ]);
    Route::post('reviews/section_heading' ,[ReviewsController::class , 'section_heading'])->name('admin/reviews/section_heading');


    //sitesettings

      //menu setting
      Route::resources(['menu' => MenuController::class]);

      //general settings
      Route::get('general', [GeneralController::class , 'general'])->name('admin/general');
      Route::post('general_post', [GeneralController::class , 'general_update'])->name('admin/general_post');
      //Match results settings
      Route::get('match_result', [MatchResultController::class , 'match_result'])->name('admin/match_result');
      Route::post('match_result_edit', [MatchResultController::class , 'match_result_edit'])->name('admin/match_result_edit');


       //Match fixture settings
       Route::get('match_fixture', [GeneralSettingController::class , 'match_fixture'])->name('admin/match_fixture');
       Route::post('match_fixture_edit', [GeneralSettingController::class , 'match_fixture_edit'])->name('admin/match_fixture_edit');



        //Match Fixture settings
        // Route::get('match_fixture', [GeneralSetting::class , 'match_fixture'])->name('admin/match_fixture');
        // Route::post('match_fixture_edit', [MatchResultController::class , 'match_fixture_edit'])->name('admin/match_fixture_edit');


      //banner setting
      Route::resources([
        'banner' => BannerController::class,
    ]);
    //vacation setting
    Route::resources(['vacation' => VacationController::class]);
    Route::post('vacation/section_heading',[VacationController::class,'section_heading'])->name('admin/vacation/section_heading');

    //News setting
    Route::resources(['news' => NewsController::class]);
    Route::get('news_data/',[NewsController::class,'news_data'])->name('admin/news_data');
    Route::get('news/delete/{id}',[NewsController::class,'destroy']);
    Route::post('news/section_heading',[NewsController::class,'section_heading'])->name('admin/news/section_heading');

    //color setting
    Route::get('color_setting', [ColorSettingController::class, 'index'])->name('admin/color_setting');
    Route::get('edit_color/{id}', [ColorSettingController::class, 'edit_color'])->name('admin/edit_color/{id}');
    Route::post('update_color/{id}', [ColorSettingController::class, 'update_color'])->name('admin/update_color/{id}');

    // //about page
    // Route::resources([ 'about' => AboutPageController::class, ]);

    //static page
   Route::match(['get' , 'put'] ,'contact_page' , [ GeneralSettingController::class , 'contactPage'])->name('admin/contact_page');
   Route::match(['get' , 'put'] ,'about_page/{id?}' , [ StaticPageController::class , 'aboutPage'])->name('admin/about_page');
   Route::match(['get' , 'put'] ,'privacy/{id?}' , [ StaticPageController::class , 'privacyPage'])->name('admin/privacy');

    Route::get('allPayments',[PaymentController::class,'getAll'])->name('admin/allPayments');
    Route::get('payments',[PaymentController::class,'index'])->name('admin/payments');





   Route::get('team_result/delete/{id}' ,[TeamResultController::class , 'delete_teamResult']);

   //leaderboard
   Route::get('leaderboard',[LeaderboardController::class , 'index'])->name('admin/leaderboard');
   Route::get('leaderboard_data', [LeaderboardController::class, 'leaderboard_data'])->name('admin/leaderboard_data');
   Route::match(['get', 'post'], 'leaderboard/create',[LeaderboardController::class, 'create'])->name('admin/leaderboard/create');
   Route::match(['get', 'post'], 'leaderboard/edit/{id}',[LeaderboardController::class, 'edit'])->name('admin/leaderboard/edit');
   Route::get('leaderboard/delete/{id}' ,[LeaderboardController::class , 'delete']);


    //players

    Route::get('players',[PlayersController::class,'index'])->name('admin/players');
     Route::get('logout', [AuthController::class, 'Adminlogout'])->name('admin/logout');
});






