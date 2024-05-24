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
//    echo"<br /><br />punkt";
//    print_r($point);
    echo"<br /><br /><br />";
    //sprawdzenie czy x jest w figurze
//    foreach ($edges as $edge){
//        echo "sprawdzam krawędz [{$edge->s_p->x};{$edge->s_p->y}] do [{$edge->e_p->x};{$edge->e_p->y}] ".matrix_calc($edge->s_p,$edge->e_p,$point)."<br/>";
//        if(matrix_calc($edge->s_p,$edge->e_p,$point)>=0){
//            echo"test";
////            return true;
//        }
//    }
//    return false;

    return !isPointInsidePolygon($point,$edges);
}
function isPointInsidePolygon($point, $edges) {
    $x = $point->x;
    $y = $point->y;
    $inside = false;

    $n = count($edges);
    for ($i = 0, $j = $n - 1; $i < $n; $j = $i++) {
        $xi = $edges[$i]->s_p->x;
        $yi = $edges[$i]->s_p->y;
        $xj = $edges[$j]->s_p->x;
        $yj = $edges[$j]->s_p->y;

        $intersect = (($yi > $y) != ($yj > $y)) &&
            ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
        if ($intersect) {
            $inside = !$inside;
        }
    }

    return $inside;
}