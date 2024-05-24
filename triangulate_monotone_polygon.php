<?php
include_once ('./sort.php');
include_once ('./class_stos.php');
include_once ('./if_in.php');
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
//    print_r($p[$top]);
    echo "top punkt [{$p[$top]->x};{$p[$top]->y}]<br />";
    echo "bot punkt [{$p[$bot]->x};{$p[$bot]->y}]<br />";
    //działa
    $u=$p;
    //tablica z krawędziami
    $edges=make_edges_objects($p);
    $d=array();
    usort($u, 'comparePoints');
    echo"posortowana tablica u:<br />";
    foreach($u as $i=>$k){
        echo"$i=[{$k->x};{$k->y}]<br />";
    }


    $stos = new stos();
    $stos->add($u[0]);
    $stos->add($u[1]);
//    echo "test stosu<br />";
//    print_r($stos->tablica);
//    echo "<br />";
    for ($j=2;$j<count($u)-1;$j++){
//        echo "test dla j=$j<br />";

//        echo"if {$u[$j]->site} != {$stos->last()->site}";

        if($u[$j]->site != $stos->last()->site){
//            echo"wierzchołki są po przeciwnych stronach<br />";
            $n_last=$stos->del();
//            echo"ostatni element";
//            print_r($n_last);
//            echo"<br />";
//            print_r($stos->tablica);
//            echo "ostatni wierchołek [{$n_last->x};{$n_last->y}]<br />";
            $n_p_last=$stos->del();
//            echo "przed ostatni wierchołek [{$n_p_last->x};{$n_p_last->y}]<br />";
            $d[]=new edge($n_last,$u[$j]);
            for($i=0;$i<=$stos->count()-3;$i++){
                $d[]=new edge($stos->del(),$u[$j]);
            }
            $stos->add($n_p_last);
            $stos->add($n_last);
        }else{
            echo"wierzchołki są po tej samej stronach<br />";
            $v=$stos->del();
            for($i=0;$i<$stos->count();$i++){
                //zdejmij wierzchołek
                $v=$stos->del();
                $e=new edge($v,$u[$j]);
                //przekątna z uj do $stos->del() nie może się przecinać z innymi krawędziami
//                print_r($edges);
                if(if_cross($e,$edges)){
                    echo "tnie";
                    break;
                }else{
                    //oraz musi być wewnątrz figury
                    if(if_in($e,$edges)){
                        echo "poza";
                        break;
                    }
                }
                $d[]=$e;
            }
            $stos->add($v);
            $stos->add($u[$j]);
        }
    }
    echo "d=";
//    print_r($d);
    echo"<br />";
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

