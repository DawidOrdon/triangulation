<?php
include_once ('./import.php');
include_once ('./make_edges.php');
include_once ('./sort.php');
session_start();
//import punktów z pliku
$_SESSION['points']=import_from_file('./points2.txt');
//tworzenie krawędzi
$_SESSION['edges']=make_edges($_SESSION['points']);
//sortowanie
$_SESSION['sorted_points']=$_SESSION['points'];
usort($_SESSION['sorted_points'], 'comparePoints');

$_SESSION['t']=array();
$_SESSION['d']=array();

foreach ($_SESSION['sorted_points'] as $p){
    $p->analyze();
}

//print_r($_SESSION['t']);

//print_r($_SESSION['points']);
//echo"<br />";
//echo"<br />";
//print_r($sorted_points);
//print_r($endges);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<canvas width="1000" height="1000" id="canvas"></canvas>
<script src="./script.js"></script>
<script>
    // Rozmiar układu
    var width = 1000;
    var height = 1000;
    var unitStep = 1; // Domyślny krok

    // Rysowanie osi z określonymi wymiarami i krokiem
    drawAxes(width, height, unitStep);

    // rysowanie punktów
    var points = [
        <?php
        foreach ($_SESSION['points'] as $point){
            echo "[{$point->x},{$point->y}],";
        }
        ?>
    ];

    // Rysowanie obrysu figury
    drawPolygon('red', points);

    // Nanoszenie liter w określonych punktach
    var points2 = [
        <?php
        foreach ($_SESSION['points'] as $point){
            if($point->type==1)
            echo "[{$point->x},{$point->y}],";
        }
        ?>
    ];
    drawLetters(points2, 'P');


    var points3 = [
        <?php
        foreach ($_SESSION['points'] as $point){
            if($point->type==2)
            echo "[{$point->x},{$point->y}],";
        }
        ?>
    ];
    drawLetters(points3, 'D');

    var points4 = [
        <?php
        foreach ($_SESSION['points'] as $point){
            if($point->type==3)
            echo "[{$point->x},{$point->y}],";
        }
        ?>
    ];
    drawLetters(points4, 'K');

    var points5 = [
        <?php
        foreach ($_SESSION['points'] as $point){
            if($point->type==4)
            echo "[{$point->x},{$point->y}],";
        }
        ?>
    ];
    drawLetters(points5, 'Ł');

    var points6 = [
        <?php
        foreach ($_SESSION['points'] as $point){
            if($point->type==5)
            echo "[{$point->x},{$point->y}],";
        }
        ?>
    ];
    drawLetters(points6, 'PR');
</script>
</body>
</html>