<?php
function if_cross($e, $edges){
    foreach ($edges as $edge) {
        $calc1 = matrix_calc($e->s_p, $e->e_p, $edge->s_p);
        $calc2 = matrix_calc($e->s_p, $e->e_p, $edge->e_p);
        $calc3 = matrix_calc($edge->s_p, $edge->e_p, $e->s_p);
        $calc4 = matrix_calc($edge->s_p, $edge->e_p, $e->e_p);


        if (($calc1 * $calc2 < 0) && ($calc3 * $calc4 < 0)) {
            return true;
        }
    }
    return false;
}