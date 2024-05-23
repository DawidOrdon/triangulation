<?php
function first_left($point,$edges)
{
    $index=null;
    $value=-99999;
    for($i=0;$i<count($edges);$i++){
        if($_SESSION['points'][$edges[$i]->s_p]->x>$value){
            $index=$edges[$i]->id;
            $value=$_SESSION['points'][$edges[$i]->s_p]->x;
        }
        if($_SESSION['points'][$edges[$i]->e_p]->x>$value){
            $index=$edges[$i]->id;
            $value=$_SESSION['points'][$edges[$i]->e_p]->x;
        }
    }
    return $index;
}