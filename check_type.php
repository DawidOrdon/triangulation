<?php
function check_type($p1,$p2,$p3)
{
    if($p1->y<$p2->y&&$p2->y>$p3->y){
        if($p2->dir==1) {
            echo"wierzchołek {$p2->id} - jest to wierzchołek dzielącym, ponieważ jego dwaj sąsiedzi lezą poniżej niego, a kąt wewnętrzny w nim jest większy od 𝜋<br /> <br />";
            return 2;
        }else{
            echo"wierzchołek {$p2->id} - jest to wierzchołek początkowy, ponieważ jego dwaj sąsiedzi lezą poniżej niego, a kąt wewnętrzny w nim jest mniejszy od 𝜋<br /> <br />";
            return 1;
        }
    }else if($p1->y>$p2->y&&$p2->y<$p3->y){
        if($p2->dir==1) {
            echo"wierzchołek {$p2->id} - jest to wierzchołek łączący, ponieważ jego dwaj sąsiedzi lezą powyżej niego, a kąt wewnętrzny w nim jest większy od 𝜋<br /> <br />";
            return 4;
        }else{
            echo"wierzchołek {$p2->id} - jest to wierzchołek końcowy, ponieważ jego dwaj sąsiedzi lezą powyżej niego, a kąt wewnętrzny w nim jest mniejszy od 𝜋<br /> <br />";
            return 3;
        }
    }else{
        echo"wierzchołek {$p2->id} - jest to wierzchołek prawidłowy, ponieważ nie jest żadnym z pozostałych rodzajów<br /> <br />";
        return 5;
    }
}
//    1-początkow
//    2-dzielący
//    3-końcowy
//    4-łączący
//    5-prawidłowy
