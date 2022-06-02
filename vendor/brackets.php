<?php
include 'db.php';

function brackets($string) {
        $count_letters = strlen($string);
        $validation = true;
        $stack = [];
        $symbols = ["(", ")", "[", "]", "{", "}", "<", ">"];

        for($position_letter = 0; $position_letter < $count_letters; $position_letter++){
            if(in_array($string[$position_letter], $symbols)) {
                $sym = $string[$position_letter];
                $key_sym = array_search($sym, $symbols);
                if($key_sym % 2 == 0) {
                    array_push($stack, $sym);
                }
                else {
                    if(empty($stack) || $symbols[$key_sym-1] != end($stack)) {
                        $validation = false;
                        break;
                    }
                    array_pop($stack);
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