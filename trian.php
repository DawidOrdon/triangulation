<?php
include_once ('./import.php');
include_once ('./make_edges.php');
include_once ('./sort.php');
include_once ('./direction.php');
include_once ('./first_left.php');
include_once ('./split_to_monotonic.php');
include_once ('./triangulate_monotone_polygon.php');
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./main.css" type="text/css">
    <title>Document</title>
</head>
<body>
<div class="left">
    <canvas width="600" height="600" id="canvas"></canvas>
</div>
<div class="right">
<?php
    //import punktów z pliku
    $_SESSION['points']=import_from_file('./points3.txt');
    //tworzenie krawędzi
    $_SESSION['edges']=make_edges($_SESSION['points']);
    //sortowanie
    $_SESSION['sorted_points']=$_SESSION['points'];
    usort($_SESSION['sorted_points'], 'comparePoints');
    //tworzenie tablic pomocniczych
    $_SESSION['t']=array();
    $_SESSION['d']=array();

    foreach ($_SESSION['sorted_points'] as $p){
        $p->analyze();
    }

    $points_array=split_to_monotonic();
    foreach ($points_array as $points){
        if(count($points)>3){
            $d[]=TriangulateMonotonePolygon($points);
        }

        echo"<br /><br />";
    }
    print_r($d);
?>
</div>
<script src="./script.js"></script>
<script>
    // Rozmiar układu
    var width = 600;
    var height = 600;
    var unitStep = 1; // Domyślny krok

    // Rysowanie osi z określonymi wymiarami i krokiem
    drawAxes(width, height, unitStep);

    // rysowanie punktów
    var points = [
        <?php
        foreach ($_SESSION['points'] as $point){
            echo "[{$point->x},{$point->y},{$point->id}],";
        }
        ?>
    ];
    console.log(points);
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

    var edges = [
        <?php
        foreach ($_SESSION['d'] as $edge){
                echo "[{$edge->s_p->x},{$edge->s_p->y},{$edge->e_p->x},{$edge->e_p->y}],";
        }
        ?>
    ];
    for (i=0;i<edges.length;i++){
        console.log("linia z ["+edges[i][0]+","+edges[i][1]+"] do ["+edges[i][2]+","+edges[i][3]+"]")
        drawLine('green',edges[i][0],edges[i][1],edges[i][2],edges[i][3])
    }

    var end_edges = [
        <?php
        foreach ($d as $edges){
            foreach ($edges as $edge){
                echo "[{$edge->s_p->x},{$edge->s_p->y},{$edge->e_p->x},{$edge->e_p->y}],";
            }
        }
        ?>
    ];
    for (i=0;i<edges.length;i++){
        console.log("linia z ["+edges[i][0]+","+edges[i][1]+"] do ["+edges[i][2]+","+edges[i][3]+"]")
        drawLine('blue',edges[i][0],edges[i][1],edges[i][2],edges[i][3])
    }
</script>
</body>
</html>