<?php

declare(strict_types=1);

use Classes\MatrixOperations;
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

Route::get('/user', function (Request $request) {
    return 'ALLO';
});

Route::post('/matrix_multiply', function (Request $request) {
    require_once  __DIR__ . "/../classes/MatrixOperations.php";

    $matrices_decoded = json_decode($request->getContent());

    if (count($matrices_decoded) == 2) {
        $multiplication = MatrixOperations::multiply($matrices_decoded[0], $matrices_decoded[1]);
        if ($multiplication !== false) {
            $response["success"] = true;
            $response["result"] = $multiplication;
            $response["result_stringified"] = MatrixOperations::stringify($multiplication);
        } else {
            $response["success"] = false;
            $response["error"] = "Matrices are not multipliable.";
        }
    } else {
        $response["success"] = false;
        $response["error"] = "Please enter both matrices.";
    }



    

    return $response;
});
