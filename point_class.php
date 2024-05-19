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
        echo"Wstaw e{$this->id} do T i ustaw pomocnika e{$this->id} na v{$this->id} <br />";
        $_SESSION['edges'][$this->id]->helper=$_SESSION['points'][$this->id];
        $_SESSION['t'][]=$_SESSION['edges'][$this->id];
    }
    public function HandleEndVertex()
    {
        //1. if pomocnik(𝑒𝑖−1) jest wierzchołkiem łączącym
        echo"pomocnik e".($this->id-1)."jest wiechołkiem łączącym ";
        if($_SESSION['edges'][$this->id-1]->helper->type==4){
            //2. then Wstaw do 𝐷 przekątną łączącą 𝑣𝑖 z pomocnik(𝑒𝑖−1)
            echo "Wstaw do D przekątną łączącą v{$this->id} z pomocnikiem e".($this->id-1);
            $_SESSION['d'][]=new edge($_SESSION['points'][$this->id],$_SESSION['edges'][$this->id-1]->helper);
            echo"drawline('green',{$_SESSION['points'][$this->id]->x},{$_SESSION['points'][$this->id]->y},".($_SESSION['edges'][$this->id-1]->helper->x).",".$_SESSION['edges'][$this->id-1]->helper->y.")";
        }
        echo" Usuń e".($this->id-1)."z T";
        for($i=0;$i<=count($_SESSION['t']);$i++){
            if($_SESSION['t'][$i]->id==$this->id-1){
                unset($_SESSION['t'][$i]);
            }
        }
        echo"<br />";
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
        //kierunek zgody z zegarem
        if($_SESSION['dir']){
            //po prawej
            if($_SESSION['points'][$this->id-1]->y<=$this->y&&$_SESSION['points'][$this->id+1]->y>=$this->y){
                $site=1;
            }else{//po lewej
                $site=2;
            }
        }else{
            //po lewej
            if($_SESSION['points'][$this->id-1]->y<=$this->y&&$_SESSION['points'][$this->id+1]->y>=$this->y){
                $site=2;
            }else{// po prawej
                $site=1;
            }
        }
        if($site==1){
            echo"wnętrze P leży po prawej stronie od v{$this->id}";
            if($_SESSION['edges'][$this->id-1]->helper->type==4){
                echo "pomocnik e".($this->id - 1)." jest wierzchołkiem łączącym";
                $_SESSION['d']=new edge($_SESSION['points'][$this->id],$_SESSION['edges'][$this->id-1]);
                echo"drawline('green',{$_SESSION['points'][$this->id]->x},{$_SESSION['points'][$this->id]->y},".($_SESSION['edges'][$this->id-1]->helper->x).",".$_SESSION['edges'][$this->id-1]->helper->y.")";

            }
            echo"usun e".($this->id - 1)."z T";
            for($i=0;$i<=count($_SESSION['t']);$i++){
                if($_SESSION['t'][$i]->id==$this->id-1){
                    unset($_SESSION['t'][$i]);
                }
            }
            echo"wstaw e{$this->id} do T i ustaw pomocnika e{$this->id} na v{$this->id}";
            $_SESSION['edges'][$this->id]->helper=$_SESSION['points'][$this->id];
            $_SESSION['t'][]=$_SESSION['edges'][$this->id];

        }else if($site==2){
            echo"wnętrze P leży po lewej stronie od v{$this->id}";
            
        }
        echo"<br />";
    }

}