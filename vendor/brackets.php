<?php
include 'db.php';

function brackets($string) {
        $count_letters = strlen($string);
        $validation = true;
        $stack = [];
        $symbols = ["(", ")", "[", "]", "{", "}", "<", ">"];

        if (!preg_match('#[\(\)\[\]\{\}]#', $string)) {
            $validation = false;
        }
        else
        {
            for($position_letter = 0; $position_letter < $count_letters; $position_letter++){
                if(in_array($string[$position_letter], $symbols)) {
                    $current_symbol = $string[$position_letter];
                    $index_bracket = array_search($current_symbol, $symbols);
                    if($index_bracket % 2 == 0) {
                        array_push($stack, $current_symbol);
                    }
                    else {
                        if(empty($stack) || $symbols[$index_bracket-1] != end($stack)) {
                            $validation = false;
                            break;
                        }
                        array_pop($stack);
                    }
                    
                }
            }
        }


        if($validation && !empty($stack)) {
            $validation = false;
        }

        $json = [
            'success' => $validation
        ];

        Db::get_instance()->insert("bracket_info", ["value" => $string, "success" => intval($validation)]);

        echo json_encode($json);
}

brackets(file_get_contents('php://input'));