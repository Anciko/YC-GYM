<?php

use Illuminate\Http\Request;
use App\Models\TrainingGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\SocialMediaController;
use App\Http\Controllers\Api\V1\TrainingGroupController;
use App\Http\Controllers\Trainer\TrainerGroupController;
use App\Http\Controllers\Api\V1\CustomerProfileController;
use App\Http\Controllers\Api\V1\TrainingManagementController;
use App\Http\Controllers\Trainer\TrainerManagementConntroller;

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


// Route::post('upgrade-plan', [AuthController::class, 'upgradePlan']);

// change password
Route::post('change-password', [AuthController::class, 'passwordChange']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('me', [AuthController::class, 'me']);

    Route::post('personal-choices', [AuthController::class, 'personalChoices']);


    Route::post('store-bank-payment', [AuthController::class, 'storeBankPayment']);
    Route::post('store-wallet-payment', [AuthController::class, 'storeWalletPayment']);

    //Training Center - For Gold, Ruby, Ruby Premium
    Route::get('training-groups', [TrainingGroupController::class, 'getTrainningGroups']); // end
    Route::get('member-groups', [TrainingGroupController::class, 'getTrainningGroups']);
    Route::get('group-of-members', [TrainingGroupController::class, 'getGroupsOfMember']);
    Route::post('create-training-group', [TrainingGroupController::class, 'createTrainingGroup']); //end
    Route::post('delete-training-group', [TrainingGroupController::class, 'deleteTrainingGroup']); // end
    Route::post('training-group-view-media', [TrainingGroupController::class, 'trainingGroupViewMedia']);
    // to change get method

    Route::post('members-for-training-group', [TrainingGroupController::class, 'memberForTrainingGroup']);
    Route::post('view-member', [TrainingGroupController::class, 'viewMembers']); //end // to change get method
    Route::get('view-member-profile', [TrainerGroupController::class, 'viewMemberProfile']);
    Route::post('add-member', [TrainingGroupController::class, 'addMember']);
    Route::post('kick-member', [TrainingGroupController::class, 'kickMember']);

    //For Platinum, Diamond
    Route::get('workout-videos', [TrainingGroupController::class, 'getWorkoutVideos']);
    Route::get('meals', [TrainingGroupController::class, 'getMeals']);
    Route::post('complete-workouts', [TrainingGroupController::class, 'completeWorkouts']);
    Route::post('eat-meals', [TrainingGroupController::class, 'eatMeals']);
    Route::post('track-water', [TrainingGroupController::class, 'trackWater']);
    Route::get('user-water-level', [TrainingGroupController::class, 'currentUserWaterLevel']);
    Route::get('user-eat-meal', [TrainingGroupController::class, 'currentUserEatMeals']);

    // CustomerProfile
    Route::get('customer-profile', [CustomerProfileController::class, 'customerProfile']);

    Route::put('customer-name-update', [CustomerProfileController::class, 'customerNameUpdate']);
    Route::put('customer-profile-update', [CustomerProfileController::class, 'customerProfileUpdate']);

    Route::get('customer-today-water-level', [CustomerProfileController::class, 'customerWaterTrackForToday']);
    Route::get('customer-last7days-water-level', [CustomerProfileController::class, 'customerWaterTrackForLast7Days']);

    Route::get('customer-request-water-level/{date}', [CustomerProfileController::class, 'customerRequestWaterLevel']); //

    Route::get('customer-request-breakfast-meal-track/{date}', [CustomerProfileController::class, 'customerRequestBreakfastMealTrack']); //

    Route::get('customer-request-lunch-meal-track/{date}', [CustomerProfileController::class, 'customerRequestLunchMealTrack']); //

    Route::get('customer-request-snack-meal-track/{date}', [CustomerProfileController::class, 'customerRequestSnackMealTrack']); //

    Route::get('customer-request-dinner-meal-track/{date}', [CustomerProfileController::class, 'customerRequestDinnerMealTrack']); //

    // Route::get('customer-today-breakfast-meal-track', [CustomerProfileController::class, 'customerMealTrackForTodayBreakfast']);
    // Route::get('customer-today-lunch-meal-track', [CustomerProfileController::class, 'customerMealTrackForTodayLunch']);
    // Route::get('customer-today-snack-meal-track', [CustomerProfileController::class, 'customerMealTrackForTodaySnack']);
    // Route::get('customer-today-dinner-meal-track', [CustomerProfileController::class, 'customerMealTrackForTodayDinner']);

    // Route::get('customer-last7days-breakfast', [CustomerProfileController::class, 'customerMealTrackForLast7DaysBreakfast']);
    // Route::get('customer-last7days-lunch', [CustomerProfileController::class, 'customerMealTrackForLast7DaysLunch']);
    // Route::get('customer-last7days-sanck', [CustomerProfileController::class, 'customerMealTrackForLast7DaysSnack']);
    // Route::get('customer-last7days-dinner', [CustomerProfileController::class, 'customerMealTrackForLast7DaysDinner']);

    Route::get('customer-today-workout', [CustomerProfileController::class, 'customerTodayWorkout']);
    Route::get('customer-last7days-workout', [CustomerProfileController::class, 'customerLast7daysWorkout']);
    Route::get('customer-workout-between/{start_date}/{end_date}', [CustomerProfileController::class, 'customerBetweenDaysWrokout']);

    // Monthly weight Loss history
    Route::get('customer-weight-history/{current_year}', [CustomerProfileController::class, 'weightHistory']);

    Route::get('customer-workout-history', [CustomerProfileController::class, 'customerWorkoutHistoryDates']);

    //Group chat
    Route::post('sendmessage/{id}', [TrainerManagementConntroller::class, 'send']);

    //Group chat for mobile
    Route::post('chat/sendmessage/{id}', [TrainingManagementController::class, 'sendmessage']);
    Route::get('chat/showmessage/{id}', [TrainingManagementController::class, 'chatshow']);


    //social media
    Route::post('search_users', [SocialMediaController::class, 'search_users']); //search users
    Route::post('add_friend', [SocialMediaController::class, 'add_friends']); //add friends
    Route::post('unfriend', [SocialMediaController::class, 'unfriend']); //un friends
    Route::post('cancelRequest', [SocialmediaController::class, 'cancelRequest']); // cancel request
    Route::post('declineRequest', [SocialmediaController::class, 'declineRequest']); //
    Route::post('confirmRequest', [SocialmediaController::class, 'confirmRequest']);//
    Route::post('socialmedia_profile', [SocialmediaController::class, 'socialmedia_profile']);//

    Route::post('cover_profile_photo', [SocialmediaController::class, 'cover_profile_photo']);//

    Route::post('friends', [SocialmediaController::class, 'friends']);//

    Route::get('friends_for_mention', [SocialmediaController::class, 'friends_for_mention']);//



    Route::get('notification', [SocialmediaController::class, 'notification']);

    Route::post('viewFriendRequestNoti', [SocialmediaController::class, 'viewFriendRequestNoti'])->name('viewFriendRequestNoti');

    Route::get('friend_request', [SocialmediaController::class, 'friend_request']);
    Route::get('newFeeds', [SocialmediaController::class, 'newFeeds']);
    Route::get('saved_post',[SocialmediaController::class, 'saved_post']);

    Route::post('one_post',[SocialmediaController::class, 'one_post']);


    Route::post('post_create', [SocialmediaController::class, 'post_store']);
    Route::post('post_delete', [SocialmediaController::class, 'post_destroy']);
    Route::post('post_edit', [SocialmediaController::class, 'post_edit']);
    Route::post('post_update', [SocialmediaController::class, 'post_update']);
    Route::post('post_save', [SocialmediaController::class, 'post_save']);

    Route::post('profile/cover/update', [SocialmediaController::class, 'profile_update_cover']);
    Route::post('profile/image/update', [SocialmediaController::class, 'profile_update_profile_img']);
    Route::post('profile/bio/update', [SocialmediaController::class, 'profile_update_bio']);
    Route::post('profile/photo/delete', [SocialmediaController::class, 'profile_photo_delete']);

    Route::post('message/chat/{user}',[SocialMediaController::class,'chatting']);
    Route::post('post/comment/store', [SocialmediaController::class, 'post_comment_store']);
    Route::post('post/comment/delete', [SocialmediaController::class, 'comment_delete']);
    Route::post('post/comment/edit', [SocialmediaController::class, 'comment_edit']);

    Route::post('post/like', [SocialmediaController::class, 'user_like_post']);
    Route::post('post/like/list', [SocialmediaController::class, 'social_media_likes']);

    Route::post('post/comment/list', [SocialmediaController::class, 'comment_list']);




});

Route::get('test', [AuthController::class, 'test']);
