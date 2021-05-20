<?php
/**
 * Matrix Operations
 * @author anil bostanci
 * @version 0.0.1
 * Provides multiply and stringify operations for two matrices.
 *
 */
namespace Classes;

class MatrixOperations
{
    /**
    * Calculates the matrix multiplication matrix($matrix_1 x $matrix_2) for given two matrices.
    * If two matrices are not multipliable, returns false.
    * @param array $matrix_1
    * @param array $matrix_2
    * @return array|boolean
    */
    public static function multiply(array $matrix_1, array $matrix_2)
    {
        $result_arr = [];
        if (self::check_multipliable($matrix_1, $matrix_2)) {
            for ($a = 0; $a < self::get_row_count($matrix_1); $a++) {
                for ($b = 0; $b < self::get_column_count($matrix_2); $b++) {
                    $result_arr[$a][$b] = self::calculate_inner_sum($matrix_1, $a, $matrix_2, $b);
                }
            }
        } else {
            return false;
        }
        return $result_arr;
    }

    /**
    *
    * Helper function that returns the enumeration array for 1=>A 2=>A... mapping
    * @return array
    */
    private static function get_enumeration_array()
    {
    
        //A to Z, 26 characters. ord(A) = 65, chr(65) = A..
        for ($a = 1; $a < 27; $a++) {
            $enumerator[$a] = chr(64 + $a);
        }

        $enumerator[0] = $enumerator[26]; #because we will be doing modulus operations, 0 % 26  == 26 % 26
        return $enumerator;
    }

    /**
    * Stringifies given matrix so that it is mapped as excel columns.(1=>A, 2=>B,...26=>Z).
    * @param array $matrix
    * @return array
    */
    public static function stringify(array $matrix)
    {
        $enumerated_matrix = [];
        for ($a = 0; $a < self::get_row_count($matrix); $a++) {
            $enumerated_matrix[$a] = [];
            for ($b = 0; $b < self::get_column_count($matrix); $b++) {
                $enumerated_matrix[$a][$b] = self::enumerate_integer($matrix[$a][$b]);
            }
        }

        return $enumerated_matrix;
    }

    /**
    * Returns the mapped string of an integer using the enumeration array.
    * @param array $int
    * @return array
    */
    private static function enumerate_integer(int $int)
    {
        $enumerator = self::get_enumeration_array();


        #treat it as positive, add sign at the end
        $absolute_int = abs($int);

        $string = "";
        for (; $absolute_int > 26; (int)$absolute_int = $absolute_int / 26) {
            $string = $enumerator[$absolute_int % 26] . $string;
        }
        //add the final divison
        $string = $enumerator[$absolute_int % 26] . $string;

        //add minus if negative
        $string = $int < 0 ? "-" . $string : $string;


        return $string;
    }

    /**
    * Helper function for matrix multiplication. Calculates the current iteration's sum.
    * matrix_1 is the matrix of the rows, matrix_2 is matrix for the columns.
    * @param array $matrix_1
    * @param int $row_1
    * @param array $matrix_2
    * @param int $column_2
    * @return int
    */
    private static function calculate_inner_sum(array $matrix_1, int $row_1, array $matrix_2, int $column_2)
    {
        $sum = 0;

        for ($a = 0; $a < self::get_column_count($matrix_1); $a++) {
            $sum += $matrix_1[$row_1][$a] * $matrix_2[$a][$column_2];
        }

        return $sum;
    }

    /**
    * Returns true if the operation $matrix_1 x $matrix_2 is multipliable, false otherwise.
    * @param array $matrix_1
    * @param array $matrix_2
    * @return boolean
    */
    private static function check_multipliable(array $matrix_1, array $matrix_2)
    {
        return self::get_column_count($matrix_1) == self::get_row_count($matrix_2);
    }


    /**
    * Returns given matrix's column count
    * @param array $matrix
    * @return int
    */
    private static function get_column_count(array $matrix)
    {
        return count($matrix[0]);
    }

    /**
    * Returns given matrix's row count
    * @param array $matrix
    * @return int
    */
    private static function get_row_count(array $matrix)
    {
        return count($matrix);
    }
}
