<?php

declare(strict_types=1);

namespace Tests\Unit;

use Classes\MatrixOperations;
use PHPUnit\Framework\TestCase;

class MatrixOperationsTest extends TestCase
{
    public function test_matrix_multiplication_multipliable()
    {
        $matrix_1 = [["1", "2", "3"]];
        $matrix_2 = [["4"], ["5"], ["6"]];
        $function_result = MatrixOperations::multiply($matrix_1, $matrix_2);
    }

    public function test_matrix_multiplication_wrong_type_input()
    {
        $matrix_1 = [["1", "2", "3"]];
        $matrix_2 = "a string";

        $this->expectException(\TypeError::class);

        $function_result = MatrixOperations::multiply($matrix_1, $matrix_2);
    }


    public function test_matrix_stringify_positive()
    {
        $matrix = [ [5, 6, 7, 9, 247],
                   [1, 4, 9, 15, 777],
                   [100, 14, 15, 24, 124],
                   [123, 444, 1024, 946, 554]];

        $asserted_result = [["E", "F", "G", "I", "IM"],
                               ["A", "D", "I", "O", "ACW"],
                               ["CV", "N", "O", "X", "DT"],
                               ["DS", "QB", "AMJ", "AJJ", "UH"]];

        $function_result = MatrixOperations::stringify($matrix);

        $this->assertEquals($asserted_result, $function_result);
    }


    public function test_matrix_stringify_negative()
    {
        $matrix = [ [-5, -6, -7, -9, -247],
                   [1, 4, 9, 15, 777],
                   [-100, 14, -15, 24, -124],
                   [123, 444, 1024, 946, 554]];

        $asserted_result = [["-E", "-F", "-G", "-I", "-IM"],
                               ["A", "D", "I", "O", "ACW"],
                               ["-CV", "N", "-O", "X", "-DT"],
                               ["DS", "QB", "AMJ", "AJJ", "UH"]];

        $function_result = MatrixOperations::stringify($matrix);

        $this->assertEquals($asserted_result, $function_result);
    }
}
