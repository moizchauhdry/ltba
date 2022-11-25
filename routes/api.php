<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('inquiry', 'API\InquiryController@inquiry');


Route::get('fingerprint/service', function () {
    $data = [
        'service' => true,
    ];
    return response()->json(['status' => true, 'data' => $data, 'message' => 'success']);
});

Route::post('fingerprint/capture', function (Request $request) {
    $data = [
        'sync_id' => $request->sync_id,
        'template_xml' => $request->template_xml,
        'template_binary' => $request->template_binary,
    ];
    return response()->json(['status' => true, 'data' => $data, 'message' => 'success']);
});

Route::post('fingerprint/verification', function (Request $request) {
    $data = [
        'emp_no' => $request->emp_no,
    ];


    return response()->json(['status' => true, 'data' => $data, 'message' => 'success']);
});
