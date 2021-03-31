
<?php

use App\Http\Controllers\DisputeCaseController;
use App\Http\Controllers\ExportScoreController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PollingAnswer;
use App\Http\Controllers\PollingAnswerController;
use App\Http\Controllers\PollingController;
use App\Http\Controllers\PollingQuestionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SpeAnswerController;
use App\Http\Controllers\SpeController;
use App\Http\Controllers\StudentSecretary;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UnitCoordinatorController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UploadDeliverable;
use App\Http\Controllers\UploadPollingQuestionController;
use App\Http\Controllers\UploadQuestionController;
use Illuminate\Support\Facades\Route;
use App\Models\UnitCoordinator;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    if (! Auth::user()) {
        return redirect('/login');
    } else {
        return redirect('/home');
    }
});

Auth::routes();

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
Route::get('/modules/{module}/dashboard', [ModuleController::class, "dashboard"]);
Route::get('/modulesadmin', [ModuleController::class, "adminview"]);
Route::get('/modules/create',[ModuleController::class, "create"]);
Route::post('/modules/create',[ModuleController::class, "processCreate"]);
Route::get('/modules/{m}/update',[ModuleController::class, "update"]);
Route::post('/modules/{m}/update',[ModuleController::class, 'processUpdate']);
Route::get('/modules/{m}/delete',[ModuleController::class, "delete"]);
Route::post('/modules/{m}/delete',[ModuleController::class, "processDelete"]);
// {{ route('admin_team_overview')}}
// controller to associate a user with a team
Route::get('/teams/{module}', [TeamController::class, "view"])->name('admin_team_overview');
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
//spesurvey update
Route::get('/spe_surveys/{spe_survey}/update', [SpeController::class, 'update'] );
Route::post('/spe_surveys/{spe_survey}/update', [SpeController::class, 'processUpdate']);

Route::get('/spe_surveys/create',[SpeController::class, "create"]);
Route::post('/spe_surveys/create',[SpeController::class, "processCreate"]);

Route::get('/spe_surveys/{spe_survey}/delete',[SpeController::class, "delete"]);
Route::post('/spe_surveys/{spe_survey}/delete',[SpeController::class, "processDelete"]);

Route::get('/spe_surveys/{spe_survey}/overview', [SpeController::class, 'overview'] );
Route::get('/spe_surveys/{spe_survey}/manage', [SpeController::class, 'manage'] );
Route::post('/spe_surveys/{spe_survey}/send-emails', [SpeController::class, 'sendEmails'] )->name('send_survey_email_to_students');

Route::get('/spe_surveys/{spe_survey}/students/update', [SpeController::class, 'updateStudents']);
Route::post('/spe_surveys/{spe_survey}/students/update', [SpeController::class, 'processUpdateStudents']);

//polling controller
Route::get('/polling/{module}', [PollingController::class, "view"]);
Route::get('/polling/{polling}/details', [PollingController::class, 'details']);
Route::get('/polling/create',[PollingController::class, "create"]);
Route::post('/polling/create',[PollingController::class, "processCreate"]);
Route::get('/polling/{polling}/update', [PollingController::class, 'update'] );
Route::post('/polling/{polling}/update', [PollingController::class, 'processUpdate']);
Route::get('/polling/{polling}/delete',[PollingController::class, "delete"]);
Route::post('/polling/{polling}/delete',[PollingController::class, "processDelete"]);
//Polling Overview
Route::get('/polling/{spePolling}/overview', [PollingController::class, 'overview'] );
Route::get('/polling/{spePolling}/manage', [PollingController::class, 'manage'] );
Route::post('/polling/{spePolling}/send-emails', [PollingController::class, 'sendEmails'] )->name('send_polling_email_to_students');
//Manage Student
Route::get('/polling/{spePolling}/students/update', [PollingController::class, 'updateStudents']);
Route::post('/polling/{spePolling}/students/update', [PollingController::class, 'processUpdateStudents']);

//polling question controller
Route::get('/pollingquestions/{polling}/show', [PollingQuestionController::class, "show"]);
Route::get('/pollingquestions/{polling}/create',[PollingQuestionController::class, "create"]);
Route::post('/pollingquestions/{polling}/create',[PollingQuestionController::class, "processCreate"]);

Route::get('/pollingquestions/{question}/update',[PollingQuestionController::class, "update"]);
Route::post('/pollingquestions/{question}/update',[PollingQuestionController::class, "processUpdate"]);

Route::get('/pollingquestions/{question}/delete',[PollingQuestionController::class, "delete"]);
Route::post('/pollingquestions/{question}/delete',[PollingQuestionController::class, "processDelete"]);



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

//uploadques controller
Route::get('/upload_question', [UploadQuestionController::class, 'upload']);
Route::post('/upload_question', [UploadQuestionController::class, 'processUpload']);

//uploadpolques controller
Route::get('/upload_polquestion', [UploadPollingQuestionController::class, 'upload']);
Route::post('/upload_polquestion', [UploadPollingQuestionController::class, 'processUpload']);

Route::get('/deliverables')->name('secretary_deliverables');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//spe student answer controller
Route::get('/spe-survey/{spe_survey_uuid}',[SpeAnswerController::class, "show"])->name('get_student_survey');
Route::post('/spe-survey/{spe_survey_uuid}',[SpeAnswerController::class, "submit"])->name('submit_student_survey');

Route::get('/submit-polling/{polling_uuid}',[PollingAnswerController::class, "show"])->name('get_student_polling');
Route::post('/submit-polling/{polling_uuid}',[PollingAnswerController::class, "submit"])->name('submit_student_polling');

Route::get('/deliverablesubmission/{deliverable_uuid}',[UploadDeliverable::class, "upload"])->name('get_student_submission');
Route::post('/deliverablesubmission/{deliverable_uuid}',[UploadDeliverable::class, "processUpload"])->name('submit_student_submission');


Route::get('/secretary/{module_id}',[StudentSecretary::class, "getSecretary"]);

Route::get('/exportscore', [ExportScoreController::class, 'export']);
Route::post('/exportscore', [ExportScoreController::class, 'processExport']);

Route::get('/disputecase/{uuid}', [DisputeCaseController::class, 'create'])->name('get_disputecase');

Route::post('/disputecase/{uuid}', [DisputeCaseController::class, 'processCreate']);

Route::get('/disputecase/{module_id}/view', [DisputeCaseController::class, 'view']);
Route::get('/disputecase/{module_id}/manage', [DisputeCaseController::class, 'manage']);
Route::post('/disputecase/{module_id}/manage', [DisputeCaseController::class, 'sendEmails'])->name('send_dispute_case_email_to_students');
Route::get('/disputecase/{disputecase}/details', [DisputeCaseController::class, 'details'])->name('view_dispute_case_details');

Route::get('/deliverable/{module}/overview', [StudentSecretary::class, 'overview'] );
Route::get('/deliverable/{module}/manage', [StudentSecretary::class, 'manage'] )->name('manage_module_deliverable');
Route::post('/deliverable/{module}/send-emails', [StudentSecretary::class, 'sendEmails'] )->name('send_submission_email_to_students');