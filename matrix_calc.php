<?php
function matrix_calc($p, $q, $r){
    $first=$p->x*$q->y+$p->y*$r->x+$q->x*$r->y;
    $second=$q->y*$r->x+$p->x*$r->y+$p->y*$q->x;
    return($first-$second);
}