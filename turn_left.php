<?php
include_once('./matrix_calc.php');
function check_if_turn_left($p, $q, $r){
    $matrix_result = matrix_calc($p, $q, $r);
    if($matrix_result==0){//punkt na prostej
        return 0;
    }else if($matrix_result>0){//punkt po lewej
        return 0;
    }else if($matrix_result<0){//punkt po prawej
        return 1;
    }
    return 0;
}