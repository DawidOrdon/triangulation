<?php
class Point{
    public function __construct($x,$y)
    {
        $this->x=$x;
        $this->y=$y;
    }

    public $x, $y, $type, $dir;
}