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