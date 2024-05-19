<?php
class Point{
    public function __construct($x,$y,$id)
    {
        $this->x=$x;
        $this->y=$y;
        $this->id=$id;
    }

    public $x, $y, $id, $type, $dir;

    public function analyze()
    {
        switch ($this->type){
            case 1:{
                $this->HandleStartVertex();
                echo 1;
                break;
            }
            case 2:{
                echo 2;
                break;
            }
            case 3:{
                $this->HandleEndVertex();
                echo 3;
                break;
            }
            case 4:{
                echo 4;
                break;
            }
            case 5:{
                echo 5;
                break;
            }
        }
    }
    public function HandleStartVertex()
    {
        $_SESSION['t'][]=$_SESSION['edges'][$this->id];
        $_SESSION['edges'][$this->id]->helper=$_SESSION['points'][$this->id];
    }
    public function HandleEndVertex()
    {
        //1. if pomocnik(𝑒𝑖−1) jest wierzchołkiem łączącym
        if($_SESSION['edges'][$this->id-1]->helper->type==4){
            //2. then Wstaw do 𝐷 przekątną łączącą 𝑣𝑖 z pomocnik(𝑒𝑖−1)
            $_SESSION['d'][]=new edge($_SESSION['points'][$this->id],$_SESSION['edges'][$this->id-1]->helper);
        }
        //3. Usuń 𝑒𝑖−1 z 𝑇.
        for($i=0;$i<=count($_SESSION['t']);$i++){
            if($_SESSION['t'][$i]->id==$this->id-1){
                unset($_SESSION['t'][$i]);
            }
        }
    }
//    HandleRegularVertex(𝑣𝑖
//    )
//    1. if wnętrze P leży na prawo od 𝑣𝑖
//    2. then if pomocnik(𝑒𝑖−1) jest wierzchołkiem łączącym
//    4. then wstaw do D przekątną łączącą 𝑣𝑖
//    z pomocnik(𝑒𝑖−1)
//    5. Usuń 𝑒𝑖−1 z T
//    6. Wstaw 𝑒𝑖 do T i ustaw z pomocnik(𝑒𝑖
//    ) na 𝑣𝑖
//    7. else Szukaj w T krawędzi 𝑒𝑗 bezpośrednio na lewo od 𝑣𝑖
//    .
//    8. if pomocnik(𝑒𝑗
//    ) jest wierzchołkiem łączącym
//    9. then wstaw do D przekątną łączącą 𝑣𝑖
//    z pomocnik(𝑒𝑗
//    )
//    10. pomocnik(𝑒𝑗
//    )= 𝑣�
    public function HandleRegularVertex()
    {

    }

}