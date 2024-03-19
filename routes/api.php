<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\Users\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Api\ApiController;
use Illuminate\Http\Request;

Route::get('/chart/comments_chart',     [ApiController::class, 'comments_chart']);
Route::get('/chart/users_chart',        [ApiController::class, 'users_chart']);

/********************************* API ************************************************** */
Route::post('register',                 [AuthController::class,'register']);
Route::post('login',                    [AuthController::class,'login']);
Route::post('refresh_token',            [AuthController::class,'refresh_token']);

Route::get('/all_posts',                [GeneralController::class,'get_posts']);
Route::get('/post/{slug}',              [GeneralController::class,'show_post']);
Route::post('/post/{slug}',             [GeneralController::class,'store_comment']);
Route::get('/search',                   [GeneralController::class,'search']);
Route::get('/category/{category_slug}', [GeneralController::class,'category']);
Route::get('/tag/{tag_slug}',           [GeneralController::class,'tag']);
Route::get('/archive/{date}',           [GeneralController::class,'archive']);
Route::get('/author/{username}',        [GeneralController::class,'author']);
Route::post('/contact-us',              [GeneralController::class,'do_contact']);


Route::group(['middleware'=> ['auth:api']], function () {

    Route::any('/notifications/get',        [UsersController::class, 'getNotifications']);
    Route::any('/notifications/read',       [UsersController::class, 'markAsRead']);

    //---------------- posts -----------------------------
    Route::get('/my_posts',                         [UsersController::class,'my_posts']);
    
    Route::get('/my_posts/create',                  [UsersController::class,'create_post']);
    Route::post('/my_posts/create',                 [UsersController::class,'store_post']);

    Route::get('/my_posts/{post}/edit',             [UsersController::class,'edit_post']);
    Route::patch('/my_posts/{post}/edit',           [UsersController::class,'update_post']);
    
    Route::delete('/my_posts/{post}',               [UsersController::class,'delete_post']);
    Route::post('/delete_post_media/{mesia_id}',    [UsersController::class,'delete_post_media']);
    
    //---------------- Comments ---------------------------
    Route::get('/all_comments',         [UsersController::class,'all_comments']);
    Route::get('/comment/{id}/edit',    [UsersController::class,'edit_comment']);
    Route::patch('/comment/{id}/edit',  [UsersController::class,'update_comment']);
    Route::delete('/comment/{id}',      [UsersController::class,'delete_comment']);

    //---------------- Information -----------------------
    
    Route::get('/user_information',             [UsersController::class,'user_information']);
    Route::patch('/update_user_information',    [UsersController::class,'update_user_information']);
    Route::patch('/update_user_password',       [UsersController::class,'update_user_password']);
    
    //---------------- Logout -----------------------
    Route::post('logout',               [UsersController::class,'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});