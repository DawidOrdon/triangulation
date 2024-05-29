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

    return isPointInPolygon($point,$edges);
}
function isPointInPolygon($point, $edges) {
    $x = $point->x;
    $y = $point->y;
    $inside = false;

    foreach ($edges as $edge) {
        $x1 = $edge->s_p->x;
        $y1 = $edge->s_p->y;
        $x2 = $edge->e_p->x;
        $y2 = $edge->e_p->y;

        if ((($y1 > $y) != ($y2 > $y)) && ($x < ($x2 - $x1) * ($y - $y1) / ($y2 - $y1) + $x1)) {
            $inside = !$inside;
        }
    }

    return $inside;
}