<?php
include_once ('./point_class.php');
include_once ('./turn_left.php');
include_once ('./check_type.php');
include_once ('./direction.php');
function import_from_file($file_name){
    $data = file($file_name);
    $i=0;
    foreach ($data as $line) {
        $array = explode(";", $line);
        $points[]=new Point($array[0],$array[1],$i);
        $i++;
    }
    if(isClockwise($points)){
        $points=array_reverse($points);
    }
    for ($i=0;$i<count($points);$i++)
    {
        $points[$i]->id=$i;
    }
    $points[0]->dir=check_if_turn_left($points[count($points)-1],$points[0],$points[1]);
    for($i=1;$i<count($points)-1;$i++){
        $points[$i]->dir=check_if_turn_left($points[$i-1],$points[$i],$points[$i+1]);
    }
    $points[count($points)-1]->dir=check_if_turn_left($points[count($points)-2],$points[count($points)-1],$points[0]);

//określenie typu wierzchołka
    $points[0]->type=check_type($points[count($points)-1],$points[0],$points[1]);
    for($i=1;$i<count($points)-1;$i++){
        $points[$i]->type=check_type($points[$i-1],$points[$i],$points[$i+1]);
    }
    $points[count($points)-1]->type=check_type($points[count($points)-2],$points[count($points)-1],$points[0]);

    return $points;
}