<?php
function split_to_monotonic()
{
//    print_r($_SESSION['points']);
    $po=$_SESSION['points'];
    $points_array[]=$po;
    echo"<br />";
    echo count($_SESSION['d']);
    for($d=0; $d<count($_SESSION['d']); $d++) {

        echo "Odcinek dzielący nr $d od x:{$_SESSION['d'][$d]->s_p->x} y:{$_SESSION['d'][$d]->s_p->y} do x:{$_SESSION['d'][$d]->e_p->x} y:{$_SESSION['d'][$d]->e_p->y} <br />";

        for($a=0; $a<count($points_array); $a++) {
            $array1 = array();
            $array2 = array();
            $helper = 1;

            for($i=0; $i<count($points_array[$a]); $i++) {
                if(($points_array[$a][$i]->x == $_SESSION['d'][$d]->s_p->x && $points_array[$a][$i]->y == $_SESSION['d'][$d]->s_p->y) ||
                    ($points_array[$a][$i]->x == $_SESSION['d'][$d]->e_p->x && $points_array[$a][$i]->y == $_SESSION['d'][$d]->e_p->y)) {
                    $helper = $helper * -1;
                    $array1[] = $points_array[$a][$i];
                    $array2[] = $points_array[$a][$i];
                } else {
                    if($helper == 1) {
                        $array1[] = $points_array[$a][$i];
                    } else if($helper == -1) {
                        $array2[] = $points_array[$a][$i];
                    }
                }
            }

            if(!empty($array1) && !empty($array2)) {
                unset($points_array[$a]);
                $points_array[] = $array1;
                $points_array[] = $array2;
                $points_array = array_values($points_array);
                break;
            }
        }
    }

    foreach ($points_array as $points) {
        echo "nowo powstałą figura";
        echo "<br /><br />";
        foreach ($points as $a1) {
            echo "V{$a1->id}[{$a1->x}:{$a1->y}] ";
        }
        echo "<br /><br />";
    }
    return$points_array;

}