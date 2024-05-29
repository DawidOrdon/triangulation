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
    echo "top punkt [{$p[$top]->x};{$p[$top]->y}]<br />";
    echo "bot punkt [{$p[$bot]->x};{$p[$bot]->y}]<br />";
    //działa
    $u=$p;
    //tablica z krawędziami
    $edges=make_edges_objects($p);
    $d=array();
    usort($u, 'comparePoints');

    echo"deklaracja stosu oraz dodanie pierwszego i drugiego elementu<br />";
    $stos = new stos();
    $stos->add($u[0]);
    $stos->add($u[1]);

    for ($j=2;$j<count($u)-1;$j++){

        if($u[$j]->site != $stos->last()->site){
            $stos_count=$stos->count()-1;
            for ($i=0;$i<$stos_count;$i++){
                $d[]= new edge($stos->del(),$u[$j]);
            }
            $stos->del();
            $stos->add($u[($j-1)]);
            $stos->add($u[($j)]);

            //powiedzmy że działa

        }else{
            echo"wierzchołki są po tej samej stronach<br /><br />    ";
            echo"<br /> zdejmij 1 wierzchołek i zapisz w v<br />";
            $v=$stos->del();
            $counter=$stos->count();
            for($i=0;$i<$counter;$i++){
                //zdejmij wierzchołek
                echo"<br /> sprawdz czy da się połączyć następny wierzchołek z uj<br />";
                $z=$stos->last();
                $e=new edge($z,$u[$j]);
                if(if_cross($e,$edges)){
                    echo "Krawędz przecina inną krawędz";
                    break;
                }else{
                    //oraz musi być wewnątrz figury
                    if(!if_in($e,$edges)){
                        echo "Krawędz jest poza figurą";
                        break;
                    }
                }
                $v=$stos->del();
                $d[]=$e;
            }
            $stos->add($v);
            $stos->add($u[$j]);
        }
    }
    echo"<br />Stan stosu<br />";
    foreach ($stos->tablica as $edge){
        echo"wierzchołek [{$edge->x}:{$edge->y}]<br />";
    }
    echo"Dodaj przekątne z [{$u[$bot]->x};{$u[$bot]->y}] do wszystkich wierzchołków na stosie, oprócz pierwszego i ostatniego.";
    for ($i=1;$i<$stos->count()-1;$i++){
        $d[]=new edge($p[$bot],$stos->tablica[$i]);
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

