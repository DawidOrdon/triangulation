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
    $u=$p;
    //tablica z krawędziami
    $edges=make_edges($p);
    $d=array();
    usort($u, 'comparePoints');
    $stos = new stos();
    $stos->add($u[0]);
    $stos->add($u[1]);
    for ($j=2;$j<count($u)-2;$j++){
        if($u[$j]->site != $stos->last()->site){
            $n_last=$stos->del();
            $n_p_last=$stos->del();
            $d[]=new edge($n_p_last,$u[$j]);
            for($i=0;$i<=$stos->count()-3;$i++){
                $d[]=new edge($stos->del(),$u[$j]);
            }
            $stos->add($n_p_last);
            $stos->add($n_last);
            echo "jest inne";
        }else{
            $stos->del();
            for($i=0;$i<$stos->count();$i++){
                //zdejmij wierzchołek
                $v=$stos->del();
                $e=new edge($v,$u[$j]);
                //przekątna z uj do $stos->del() nie może się przecinać z innymi krawędziami
                if(if_cross($e,$edges)){

                }
                //oraz musi być wewnątrz figury
            }
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

