<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SpeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UnitCoordinatorController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use App\Models\UnitCoordinator;
use App\Models\Upload;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});

//Unit Coordinator Functions
Route::get('/unit_coordinators', [UnitCoordinatorController::class, "view"]);
Route::get('/unit_coordinators/create',[UnitCoordinatorController::class, "create"]);
Route::post('/unit_coordinators/create',[UnitCoordinatorController::class, "processCreate"]);
Route::get('/unit_coordinators/{uc}/update',[UnitCoordinatorController::class, "update"]);
Route::post('/unit_coordinators/{uc}/update',[UnitCoordinatorController::class, 'processUpdate']);
Route::get('/unit_coordinators/{uc}/delete',[UnitCoordinatorController::class, "delete"]);
Route::post('/unit_coordinators/{uc}/delete',[UnitCoordinatorController::class, "processDelete"]);

//Module functions
Route::get('/modules', [ModuleController::class, "view"]);
Route::get('/modules/create',[ModuleController::class, "create"]);
Route::post('/modules/create',[ModuleController::class, "processCreate"]);
Route::get('/modules/{m}/update',[ModuleController::class, "update"]);
Route::post('/modules/{m}/update',[ModuleController::class, 'processUpdate']);
Route::get('/modules/{m}/delete',[ModuleController::class, "delete"]);
Route::post('/modules/{m}/delete',[ModuleController::class, "processDelete"]);

// controller to associate a user with a team
Route::get('/teams', [TeamController::class, "view"]);
Route::get('/teams/{team}/details', [TeamController::class, 'details']);
Route::get('/teams/{team}/update', [TeamController::class, 'update'] );
Route::post('/teams/{team}/update', [TeamController::class, 'processUpdate']);
Route::get('/teams/create',[TeamController::class, "create"]);
Route::post('/teams/create',[TeamController::class, "processCreate"]);
Route::get('/teams/{team}/delete',[TeamController::class, "delete"]);
Route::post('/teams/{team}/delete',[TeamController::class, "processDelete"]);

//spesurvey functions
Route::get('/spe_surveys', [SpeController::class, "view"]);
Route::get('/spe_surveys/{spe_surveys}/details', [SpeController::class, 'details']);
Route::get('/spe_surveys/{spe_survey}/update', [SpeController::class, 'update'] );
Route::post('/spe_surveys/{spe_survey}/update', [SpeController::class, 'processUpdate']);
Route::get('/spe_surveys/create',[SpeController::class, "create"]);
Route::post('/spe_surveys/create',[SpeController::class, "processCreate"]);
Route::get('/spe_surveys/{spe_survey}/delete',[SpeController::class, "delete"]);
Route::post('/spe_surveys/{spe_survey}/delete',[SpeController::class, "processDelete"]);

Route::get('/spe_surveys/{spe_survey}/students/update', [SpeController::class, 'updateStudents']);
Route::post('/spe_surveys/{spe_survey}/students/update', [SpeController::class, 'processUpdateStudents']);
// question controller
Route::get('/questions/{speSurvey}/show', [QuestionController::class, "show"]);
Route::get('/questions/{speSurvey}/create',[QuestionController::class, "create"]);
Route::post('/questions/{speSurvey}/create',[QuestionController::class, "processCreate"]);

Route::get('/questions/{question}/update',[QuestionController::class, "update"]);
Route::post('/questions/{question}/update',[QuestionController::class, "processUpdate"]);

Route::get('/questions/{question}/delete',[QuestionController::class, "delete"]);
Route::post('/questions/{question}/delete',[QuestionController::class, "processDelete"]);


// upload controller
Route::get('/upload', [UploadController::class, 'upload']);
Route::post('/upload', [UploadController::class, 'processUpload']);