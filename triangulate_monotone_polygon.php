<?php
include_once ('./sort.php');
include_once ('./class_stos.php');
function TriangulateMonotonePolygon($p)
{
    $top=find_top($p);
    $bot=find_bot($p);
    if($top>$bot){
        for($i=$top;$i<count($p);$i++){
            $p[$i]->site=0;
        }
        if($top!=0){
            for($i=0;$i<$bot;$i++){
                $p[$i]->site=0;
            }
        }
        for($i=$bot;$i<$top;$i++){
            $p[$i]->site=1;
        }
    }else {
        for ($i = $top; $i < $bot; $i++) {
            $p[$i]->site = 0;
        }
        for ($i = $bot; $i < count($p); $i++) {
            $p[$i]->site = 1;
        }
        for ($i = 0; $i < $top; $i++) {
            $p[$i]->site = 1;
        }
    }
    $n_p=$p;
    $d=array();
    usort($n_p, 'comparePoints');
    $stos = new stos();
    $stos->add($n_p[0]);
    $stos->add($n_p[1]);
    for ($j=2;$j<count($n_p)-2;$j++){
        if($n_p[$j]->site != $stos->last()->site){
            $n_last=$stos->del();
            $n_p_last=$stos->del();
            $d[]=new edge($n_p_last,$n_p[$j]);
            for($i=0;$i<=$stos->count()-3;$i++){
                $d[]=new edge($stos->del(),$n_p[$j]);
            }
            $stos->add($n_p_last);
            $stos->add($n_last);
            echo "jest inne";
        }
    }
    return($d);
}
function find_top($p)
{
    $value=$p[0]->y;
    $id=0;
    for($i=0;$i<count($p);$i++){
        if($value<$p[$i]->y){
            $id=$i;
            $value=$p[$i]->y;
        }
    }
    return $id;
}
function find_bot($p)
{
    $value=$p[0]->y;
    $id=0;
    for($i=0;$i<count($p);$i++){
        if($value>$p[$i]->y){
            $id=$i;
            $value=$p[$i]->y;
        }
    }
    return $id;
}

