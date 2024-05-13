<?php
function check_type($p1,$p2,$p3)
{
    if($p1->y<$p2->y&&$p2->y>$p3->y){
        if($p2->dir==1) {
            return 1;
        }else{
            return 2;
        }
    }else if($p1->y>$p2->y&&$p2->y<$p3->y){
        if($p2->dir==1) {
            return 3;
        }else{
            return 4;
        }
    }else{
        return 5;
    }
}
//    1-początkow
//    2-dzielący
//    3-końcowy
//    4-łączący
//    5-prawidłowy
