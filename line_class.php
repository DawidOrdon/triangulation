<?php
class line{
    public function __construct($p1,$p2)
    {
        $this->a = ($p2->y - $p1->y) / ($p1->x - $p2->x);

        // Obliczenie wyrazu wolnego b
        $this->b = $p1->y - $this->a * $p1->x;
    }
    public $a, $b;
    public function get_value($x): float
    {
        return $x * $this->a + $this->b;
    }
}