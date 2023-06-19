<?php

use App\Http\Controllers\Firebase\AuthController;
use App\Http\Controllers\Firebase\AssignmentController;
use App\Http\Controllers\Firebase\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Firebase\ExamController;
use App\Http\Controllers\Firebase\DiscussionController;
use App\Http\Controllers\Firebase\ReportController;
use App\Http\Controllers\Firebase\CourseDetailController;
use App\Http\Controllers\Firebase\ScheduleController;


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
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/updateprofile', [AuthController::class, 'updatePassword']);

Route::get('/register',function (){
    return view('register');
});
// Route::group(['middleware' => ["web"]], function(){
//     Route::get('/Beranda', function(){
//         return view('Beranda');
//     });
// });



Route::get('/Assignment',function(){
    return view('Assignment');
});
Route::get('/Exam',function(){
    return view('Exam');
});
Route::get('/Discussion',function(){
    return view('Discussion');
});
// Route::get('/Report',function(){
//     return view('Report');
// });
Route::get('/Schedule',function(){
    return view('Schedule');
});
// Route::get('/Beranda',function(){
//     return view('Beranda');
// });

Route::get('Courses' ,[CourseController::class , 'index']);

Route::get('add-course' ,[CourseController::class, 'create']);

Route::post('add-course' ,[CourseController::class, 'store']);
Route::post('/upload' ,[CourseController::class, 'uploadFile']);

Route::get('edit-course/{id}', [CourseController::class, 'edit']);
Route::put('update-course/{id}',[CourseController::class, 'update']);
Route::get('delete-course/{id}',[CourseController::class, 'delete']);
// Route::get('updateprofile',function(){
//     return view('Updateprofile');
// });

Route::get('/upload',function(){
    return view('upload');
});

Route::get('add-assignment' ,[AssignmentController::class , 'create']);
Route::post('add-assignment' ,[AssignmentController::class, 'store']);
Route::get('Assignment' ,[AssignmentController::class , 'index']);



Route::post('add-Exam' ,[ExamController::class, 'store']);
Route::get('add-Exam',[ExamController::class ,'create']);
Route::get('Exam' ,[ExamController::class , 'index']);
Route::get('edit-exam/{id}', [ExamController::class, 'edit']);
Route::put('update-exam/{id}',[ExamController::class, 'update']);
Route::get('delete-exam/{id}',[ExamController::class, 'delete']);


Route::get('edit-assignment/{id}', [AssignmentController::class, 'edit']);
Route::put('update-assignment/{id}',[AssignmentController::class, 'update']);
Route::get('delete-assignment/{id}',[AssignmentController::class, 'delete']);

Route::get('/searchExam',[ExamController::class , 'search']);

Route::get('/search',[CourseController::class,'search']);

Route::post('/upload', [CourseController::class , 'upload']);

Route::get('/testing',[CourseController::class , 'testing']);


Route::get('add-discussion' ,[DiscussionController::class , 'create']);
Route::post('add-discussion' ,[DiscussionController::class , 'store']);
Route::get('Discussion' ,[DiscussionController::class , 'index']);
Route::get('details/{id}', [DiscussionController::class, 'detail']);
Route::get('edit-discussion/{id}', [DiscussionController::class, 'edit']);
Route::put('update-discussion/{id}',[DiscussionController::class, 'update']);
Route::get('delete-discussion/{id}',[DiscussionController::class, 'delete']);
// Route::get('details/{id}', [DiscussionController::class, 'comment']);

Route::get('/Report',[ReportController::class,'search']);
Route::get('edit-report/{id}', [ReportController::class, 'edit']);
Route::put('update-report/{id}',[ReportController::class, 'update']);


Route::get('CourseDetail/{id}' ,[CourseDetailController::class , 'index']);
Route::post('add-material/{id}',[CourseDetailController::class , 'store']);
Route::get('add-material/{id}',[CourseDetailController::class , 'create']);

Route::get('edit-material/{id}', [CourseDetailController::class, 'edit']);
Route::put('update-material/{id}',[CourseDetailController::class, 'update']);
Route::get('delete-material/{id}',[CourseDetailController::class, 'delete']);

Route::get('searchMaterial/{id}',[CourseDetailController::class,'search']);
Route::get('/searchAssignment',[AssignmentController::class,'search']);
Route::get('/searchForum',[DiscussionController::class,'search']);

Route::get('add-schedule' ,[ScheduleController::class , 'create']);
Route::post('add-schedule' ,[ScheduleController::class , 'store']);
Route::get('Schedule' ,[ScheduleController::class , 'index']);
Route::get('Beranda',[ScheduleController::class ,'Beranda']);
Route::get('edit-schedule/{id}' ,[ScheduleController::class , 'edit']);
Route::put('update-schedule/{id}',[ScheduleController::class, 'update']);
Route::get('delete-schedule/{id}',[ScheduleController::class, 'delete']);

Route::post('add-comment/{id}' ,[DiscussionController::class , 'addcomment']);
Route::put('update',[AuthController::class, 'changePassword']);


Route::get('/Forums',function(){
    return view('TestingForum');
});
