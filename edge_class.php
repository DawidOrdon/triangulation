<?php
class edge{
    public function __construct($s_p,$e_p)
    {
        $this->e_p=$e_p;
        $this->s_p=$s_p;
        $this->id=$this->s_p;
    }
    public $s_p, $e_p, $id, $helper;
}