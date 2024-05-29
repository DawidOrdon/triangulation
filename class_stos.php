<?php
class stos {
    var $tablica;

    function add($element) {
        $this->tablica[] = $element;
    }
    function del() {
        return array_pop($this->tablica);
    }
    function count() {
        return count($this->tablica);
    }
    function last()
    {
        return ($this->tablica[count($this->tablica)-1]);
    }
    function show() {
        for ($i=0;$i<$this->count();$i++) print_r ($this->tablica[$i]);
    }
}