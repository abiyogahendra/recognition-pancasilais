<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;

use App\Http\Controllers\TwitterController;
use App\Http\Controllers\CleanTextController;

use App\Http\Controllers\Page\DashboardController;


// connect to Controllers Minings
use App\Http\Controllers\Page\Mining\UsernameController;
use App\Http\Controllers\Page\Mining\HistoryMiningController;
use App\Http\Controllers\Page\Mining\ExportTweetMiningController;

// connect to Controllers Preprocessing
use App\Http\Controllers\Page\Preprocessing\HistoryPreprocessingController;
use App\Http\Controllers\Page\Preprocessing\InputDataPreprocessingController;
use App\Http\Controllers\Page\Preprocessing\ProcessPreprocessingController;

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
    Route::get('/index-history-mining',[HistoryMiningController::class, 'IndexHistoryMining'] );
    Route::get('/data-history-mining',[HistoryMiningController::class, 'DataHistoryMining'] );
    Route::get('/input-username',[UsernameController::class, 'IndexUsernameInput'] );
    Route::post('/post-username',[UsernameController::class, 'PostUsernameInput'] );
        
        // export Data Tweet Yang Sudah Diambil
        Route::get('/index-export-data-mining',[ExportTweetMiningController::class, 'IndexExportMining'] );
        Route::get('/data-export-mining',[ExportTweetMiningController::class, 'DataExportMining'] );
        Route::get('/process-export-data-mining/{id}',[ExportTweetMiningController::class, 'ExportDataTweet'] );



    // Preprocessing - input (pembersihan data kotor)
    Route::get('/index-history-preprocessing',[HistoryPreprocessingController::class, 'IndexHistoryPreprocessing'] );
    Route::get('/data-history-preprocessing',[HistoryPreprocessingController::class, 'DataHistoryPreprocessing'] );
    Route::get('/input-preprocessing',[InputDataPreprocessingController::class, 'IndexPreprocessingInput'] );
    Route::post('/post-input-preprocessing',[InputDataPreprocessingController::class, 'PostPreprocessingInput'] );
    Route::get('/index-process-preprocessing',[ProcessPreprocessingController::class, 'IndexProcessPreprocessing'] );
    Route::get('/data-process-preprocessing',[ProcessPreprocessingController::class, 'DataProcessPreprocessing'] );
    Route::post('/process-preprocesing',[ProcessPreprocessingController::class, 'ProcessPreprocessing'] );
    

    

});

Route::get('/data', function()
{
    $data = Twitter::getUserTimeline(['screen_name' => 'arsiimam', 'count' => 20, 'format' => 'object']);
    dd($data);
});

Route::get('/get_data',[TwitterController::class, 'GetData']);

Route::get('/clean_text_input',[CleanTextController::class, 'IndexCleanTextInput']);

