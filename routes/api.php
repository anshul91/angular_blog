<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
   
    return $request->user();
});
// Route::get('/foo',function(){
//     echo json_encode([['id'=>1,"name"=>"anshul"]]);die;
// });
Route::group([
    'middleware' => ['api']
], function ($router) {
     //Add you routes here, for example:
     Route::get('/getUsers',"UserController@getUsers");
     Route::get('/getUserDetail/{id}',"UserController@getUserDetail");
     Route::post('/addUser',"UserController@addUser");
     Route::put('/updateUser/{id}',"UserController@updateUser");
     Route::delete('deleteUser/{id}',"UserController@deleteUser");
});
