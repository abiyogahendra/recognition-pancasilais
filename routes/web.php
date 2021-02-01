<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;

use App\Http\Controllers\TwitterController;
use App\Http\Controllers\CleanTextController;

use App\Http\Controllers\Page\DashboardController;
use App\Http\Controllers\Page\UsernameController;


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

// Route::get('/', function () {
//     return view('welcome');
// });


// login
Route::get('login',[LoginController::class, 'LoginIndex'])->name('login');
Route::post('login_post',[LoginController::class, 'LoginProcess']);




Route::group(['middleware' => ['auth']], function(){
    Route::get('/',[DashboardController::class, 'IndexDashboard'] );

    // username - input (tweet minings)
    Route::get('/input-user',[UsernameController::class, 'IndexUsernameInput'] );
    Route::post('/',[UsernameController::class, 'PostUsernameInput'] );
    
    





});

Route::get('/data', function()
{
    $data = Twitter::getUserTimeline(['screen_name' => 'arsiimam', 'count' => 20, 'format' => 'object']);
    dd($data);
});

Route::get('/get_data',[TwitterController::class, 'GetData']);

Route::get('/clean_text_input',[CleanTextController::class, 'IndexCleanTextInput']);

