<?php
function comparePoints($a, $b) {
    if ($a->y == $b->y) {
        return $a->x - $b->x; // Sortowanie rosnąco po $x, jeśli $y jest taki sam
    }
    return $b->y - $a->y; // Sortowanie malejąco po $y
}
