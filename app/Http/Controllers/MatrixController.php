<?php

namespace App\Http\Controllers;
use Classes\MatrixOperations;

class MatrixController extends Controller
{
    /**
     * Multiply two matrices.
     *
     * @param  array  $matrices_decoded
     * 
     * First matrix = $matrices_decoded[0]
     * Second matrix = $matrices_decoded[1]
     * 
     */
    public function multiply(array $matrices_decoded)
    {
        $response = [];
        $response["success"] = false;

        if (count($matrices_decoded) == 2) {
            $multiplication = MatrixOperations::multiply($matrices_decoded[0], $matrices_decoded[1]);
            if ($multiplication !== false) {
                $response["success"] = true;
                $response["result"] = $multiplication;
                $response["result_stringified"] = MatrixOperations::stringify($multiplication);
            } else {
                $response["error"] = "Matrices are not multipliable.";
            }
        } else {
            $response["error"] = "Please enter both matrices.";
        }

        return $response;
    
    }
}
