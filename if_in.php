<?php
include_once ('./line_class.php');
include_once ('./point_class.php');
include_once ('./matrix_calc.php');
function if_in($e,$edges)
{
    //wzór funkcji
    $line = new line($e->s_p,$e->e_p);
    //wyznaczenie x dla którego liczymy
    $x=($e->s_p->x+$e->e_p->x)/2;
    $y=$line->get_value($x);
    $point=new point($x,$y);

    //sprawdzenie czy x jest w figurze
    foreach ($edges as $edge){
        if(matrix_calc($edge->s_p,$edge->e_p,$point)<0){
            return true;
        }
    }
    return false;


}