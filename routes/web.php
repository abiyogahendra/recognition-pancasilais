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

// connect to Controller ImportToDatabase
use App\Http\Controllers\Page\ImportDB\HistoryImportToDatabaseController;
use App\Http\Controllers\Page\ImportDB\ImportToDatabaseController;
use App\Http\Controllers\Page\ImportDB\PrepareDataToReadyProcessController;

// Connect to controller InputKamuController
use App\Http\Controllers\Page\Kamus\InputKamusController;

// connect to controller PelabelanController
use App\Http\Controllers\Page\Pelabelan\PelabelanController;

// conncect to Controller FinalClassification
use App\Http\Controllers\Page\Classification\FinalClassificationController;

// connect to Modal Controller
use App\Http\Controllers\Modal\PersentaseAccuntController;


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
    // modal
    Route::post('/persentase-account',[PersentaseAccuntController::class, 'ModalAccuntPersentase'] );




    // dahsboard
    Route::get('/',[DashboardController::class, 'IndexDashboard'] );
    Route::get('/data-history-user',[DashboardController::class, 'DataUser'] );
    Route::post('/delete-all-data-history-user',[DashboardController::class, 'DeleteAllDataUser'] );

    // username - input (tweet minings)
    Route::get('/index-history-mining',[HistoryMiningController::class, 'IndexHistoryMining'] );
    Route::get('/data-history-mining',[HistoryMiningController::class, 'DataHistoryMining'] );
    Route::get('/input-username',[UsernameController::class, 'IndexUsernameInput'] );
    Route::post('/check-username',[UsernameController::class, 'CheckUsername']);
    Route::post('/post-username',[UsernameController::class, 'PostUsernameInput'] );
    Route::post('/delete-user-mining',[UsernameController::class, 'DeletedUsernameTweet'] );
        
        // export Data Tweet Yang Sudah Diambil
        Route::get('/index-export-data-mining',[ExportTweetMiningController::class, 'IndexExportMining'] );
        Route::get('/data-export-mining',[ExportTweetMiningController::class, 'DataExportMining'] );
        Route::post('/process-export-data-mining',[ExportTweetMiningController::class, 'ExportDataTweet'] );



    // Preprocessing - input (pembersihan data kotor)
    Route::get('/index-history-preprocessing',[HistoryPreprocessingController::class, 'IndexHistoryPreprocessing'] );
    Route::get('/data-history-preprocessing',[HistoryPreprocessingController::class, 'DataHistoryPreprocessing'] );
    Route::post('/confirmation-download-file-preprocessing',[HistoryPreprocessingController::class, 'ConfirmationDownloadFilePreprocession'] );
    Route::get('/download-file-preprocessing/{id}',[HistoryPreprocessingController::class, 'DownloadFilePreprocession'] );
    Route::get('/input-preprocessing',[InputDataPreprocessingController::class, 'IndexPreprocessingInput'] );
    Route::post('/post-input-preprocessing',[InputDataPreprocessingController::class, 'PostPreprocessingInput'] );
    Route::get('/index-process-preprocessing',[ProcessPreprocessingController::class, 'IndexProcessPreprocessing'] );
    Route::get('/data-process-preprocessing',[ProcessPreprocessingController::class, 'DataProcessPreprocessing'] );
    Route::post('/process-preprocesing',[ProcessPreprocessingController::class, 'ProcessPreprocessing'] );
    
    // Import data to Database 
    Route::get('/index-history-import-database',[HistoryImportToDatabaseController::class, 'IndexHistoryImportDB'] );
    Route::get('/data-history-import-database',[HistoryImportToDatabaseController::class, 'dataHistoryImportDB'] );
    Route::get('/input-import-to-database',[ImportToDatabaseController::class, 'IndexInputImportDatabase'] );
    Route::post('/data-import-to-database',[ImportToDatabaseController::class, 'DataInputImportDatabase'] );
    Route::get('/index-data-to-ready-process',[PrepareDataToReadyProcessController::class, 'IndexDataReady'] );
    Route::get('/data-to-ready-process',[PrepareDataToReadyProcessController::class, 'ListDataToReadyProcess'] );
    Route::post('/process-data-to-ready-data',[PrepareDataToReadyProcessController::class, 'ProcessDataToReadyProcess'] );
    Route::post('/check-data-import',[PrepareDataToReadyProcessController::class, 'CheckDataImport']);
    Route::post('/check-data-ready',[PrepareDataToReadyProcessController::class, 'CheckDataReady']);
    
    
    // input Kamus Pancasilais - Negative
    Route::get('/input-data-kamus',[InputKamusController::class, 'IndexInputKamus'] );
    Route::post('/process-input-kamus',[InputKamusController::class, 'ProcessInputKamus'] );
    Route::post('/process-input-kamus-pancasilais',[InputKamusController::class, 'ProcessInputKamusPancasilais']);
    Route::post('/process-input-kamus-negative',[InputKamusController::class, 'ProcessInputKamusNegative']);
    
    
    // proses pelabelan dengan menggunakan kamus
    Route::get('/index-history-pelabelan',[PelabelanController::class, 'IndexPelabelan'] );
    Route::get('/data-history-pelabelan',[PelabelanController::class, 'DataPelabelan'] );
    Route::post('/proses-pelabelan',[PelabelanController::class, 'ProsesPelabelanPancasilais'] );
    Route::post('/proses-klasifikasi-label',[PelabelanController::class, 'ProcessKlasifikasiLabel']);
    
    // proses Klasifikasi Final
    Route::get('/index-dashboard-final-klasifikasi',[FinalClassificationController::class, 'IndexFinalClassification'] );
    Route::get('/data-table-final-classification',[FinalClassificationController::class, 'DataFinalClassification'] );
    Route::post('/post-data-final-username',[FinalClassificationController::class, 'GetDataFromDataTweet'] );
    Route::post('/post-preprocessing-final-username',[FinalClassificationController::class, 'PreprocessingFinalClassification'] );
    Route::post('/post-process-final-data',[FinalClassificationController::class, 'ProcessFinalDataClassification'] );

    
});

Route::get('/data', function()
{
    $data = Twitter::getUserTimeline(['screen_name' => 'arsiimam', 'count' => 20, 'format' => 'object']);
    dd($data);
});

Route::get('/get_data',[TwitterController::class, 'GetData']);

Route::get('/clean_text_input',[CleanTextController::class, 'IndexCleanTextInput']);




// cutom 
Route::get('/custom-data',[FinalClassificationController::class, 'CustomData']);

