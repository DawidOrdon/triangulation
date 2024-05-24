<?php
class line{
    public function __construct($p1,$p2)
    {
        echo "p1:";
        print_r($p1);
        echo"<br />p2:";
        print_r($p2);
        $this->a = ($p2->y - $p1->y) / ($p1->x - $p2->x);
        // Obliczenie wyrazu wolnego b
        echo"<br /><br /><br />";
        echo"b={$p1->y}-({$this->a}*{$p1->x}";
        echo"<br /><br /><br />";
        $this->b = $p2->y - ($this->a * $p2->x);
        echo "a = {$this->a} b = {$this->b}";
    }
    public $a, $b;
    public function get_value($x): float
    {
        return $x * $this->a + $this->b;
    }
}