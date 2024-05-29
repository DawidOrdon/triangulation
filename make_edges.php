<?php
include_once ('./edge_class.php');
function make_edges($points)
{
    for($i=0;$i<count($points)-1;$i++){
        $edges[]=new edge($i,$i+1);
    }
    $edges[]=new edge(count($points)-1,1);
    return $edges;
}
function make_edges_objects($points)
{
//    echo"<br /> punkty:";
//    print_r($points);
    for($i=0;$i<count($points)-1;$i++){
        $edges[]=new edge($points[$i],$points[$i+1]);
    }
    $edges[]=new edge($points[count($points)-1],$points[0]);
//    echo"<br /> krawedzie";
//    print_r($edges);
//    echo "<br />";
    return $edges;
}