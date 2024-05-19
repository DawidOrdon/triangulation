<?php

function calculateSignedArea($points) {
    $n = count($points);
    $area = 0;

    for ($i = 0; $i < $n; $i++) {
        $x1 = $points[$i]->x;
        $y1 = $points[$i]->y;
        $x2 = $points[($i + 1) % $n]->x;
        $y2 = $points[($i + 1) % $n]->y;
        $area += ($x1 * $y2 - $y1 * $x2);
    }

    return $area / 2;
}

function isClockwise($points) {
    $area = calculateSignedArea($points);
    if ($area < 0) {
        return true;  // zgodnie z ruchem wskazówek zegara
    } else {
        return false; // przeciwnie do ruchu wskazówek zegara
    }
}


?>