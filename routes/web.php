<?php

use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/dashboard/user', [App\Http\Controllers\DashboardController::class, 'index'])->name('user');
Route::get('/reset-password/{token}', function ($token) {return view('auth.reset-password', ['token' => $token]);})->middleware('guest')->name('password.reset');

//activity
Route::get('/activity/viewActivity', [App\Http\Controllers\ActivityController::class, 'index'])->name('viewActivity');
Route::get('/activity/createActivity', [App\Http\Controllers\ActivityController::class, 'createAct'])->name('createActivity');
Route::get('/activity/activityApproval', [App\Http\Controllers\ActivityController::class, 'view'])->name('activityApproval');
Route::post('/activity/viewActivity', [App\Http\Controllers\ActivityController::class, 'store']);
Route::post('updateData', [App\Http\Controllers\ActivityController::class,'updateData'])->name('updateData');
Route::get('/activity/viewActivity', [App\Http\Controllers\ActivityController::class, 'viewall'])->name('viewall');
Route::get('/activity/viewDetails/{activity}', [App\Http\Controllers\ActivityController::class, 'viewactivity'])->name('viewDetails.show');
Route::get('/activity/registerActivity/{activity}', [App\Http\Controllers\ActivityController::class, 'viewreg'])->name('registerActivity.show');
Route::match(['get', 'post'],'/activity/registerActivity', [App\Http\Controllers\ActivityController::class,'storereg'])->name('storereg');


//Proposal
Route::get('/proposal', [App\Http\Controllers\ProposalController::class, 'index']);

Route::get('/proposal/create', [App\Http\Controllers\ProposalController::class, 'create']);
Route::post('/proposal', [App\Http\Controllers\ProposalController::class, 'store']);
Route::get('/proposal/report/create/{proposal}', [App\Http\Controllers\ProposalController::class, 'createreport'])->name('createreport.show');
Route::post('/proposal/report', [App\Http\Controllers\ProposalController::class, 'storereport']);
Route::get('coordinator/proposal/approval', [App\Http\Controllers\ProposalController::class, 'viewcapproval']);
Route::get('/proposal/{proposal}', [App\Http\Controllers\ProposalController::class, 'view'])->name('proposal.show');
Route::get('/proposal/report/{report}', [App\Http\Controllers\ProposalController::class, 'viewreport']);
Route::post('storecoordinatorstatus', [App\Http\Controllers\ProposalController::class, 'storecoordinatorstatus'])->name('storecoordinatorstatus');
Route::get('/coordinator/proposal/approval/{proposal}', [App\Http\Controllers\ProposalController::class, 'viewcproposal']);

Route::get('/dean/proposal/approval', [App\Http\Controllers\ProposalController::class, 'viewdapproval']);
Route::post('storedeanstatus', [App\Http\Controllers\ProposalController::class, 'storedeanstatus'])->name('storedeanstatus');
Route::get('/dean/proposal/approval/{proposal}', [App\Http\Controllers\ProposalController::class, 'viewdproposal']);

