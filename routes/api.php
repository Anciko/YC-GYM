<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\TrainingGroupController;
use App\Http\Controllers\Trainer\TrainerGroupController;
use App\Models\TrainingGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/check-user-exists', [AuthController::class, 'checkUserExists']);

Route::post('check-phone', [AuthController::class, 'checkPhone']);

Route::get('get-member-plans', [AuthController::class, 'getMemberPlans']);
Route::get('get-ewallet-infos', [AuthController::class, 'getEwalletInfos']);
Route::get('get-banking-infos', [AuthController::class, 'getBankingInfos']);

// change password
Route::post('change-password', [AuthController::class, 'passwordChange']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('me', [AuthController::class, 'me']);

    Route::post('store-bank-payment', [AuthController::class, 'storeBankPayment']);
    Route::post('store-wallet-payment', [AuthController::class, 'storeWalletPayment']);

    //Training Center
    Route::get('training-groups', [TrainingGroupController::class, 'getTrainningGroups']); // end
    Route::post('create-training-group', [TrainingGroupController::class, 'createTrainingGroup']); //end
    Route::post('delete-training-group', [TrainingGroupController::class, 'deleteTrainingGroup']); // end
    Route::post('training-group-view-media', [TrainingGroupController::class, 'trainingGroupViewMedia']);
    // to change get method

    Route::post('members-for-training-group', [TrainingGroupController::class, 'memberForTrainingGroup']);

    Route::post('view-member', [TrainingGroupController::class, 'viewMembers']);//end // to change get method
    Route::get('view-member-profile', [TrainerGroupController::class, 'viewMemberProfile']);
    Route::post('add-member', [TrainingGroupController::class, 'addMember']);
    Route::post('kick-member', [TrainingGroupController::class, 'kickMember']);


});

Route::get('article/{id}', [TrainingGroupController::class, 'test']);
