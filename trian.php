<?php
include_once ('./import.php');
include_once ('./make_edges.php');
//import punktów z pliku
$points=import_from_file('./points2.txt');
//tworzenie krawędzi
$endges=make_edges($points);



print_r($points);
//echo"<br />";
//echo"<br />";
//print_r($endges);