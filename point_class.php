<?php
class Point{
    public function __construct($x,$y)
    {
        $this->x=$x;
        $this->y=$y;
    }

    public $x, $y, $id, $type, $dir, $site=-1;

    public function analyze()
    {
        switch ($this->type){
            case 1:{
                echo "wierzchołek v{$this->id} jest wierzchołkiem początkowym<br />";
                $this->HandleStartVertex();
                break;
            }
            case 2:{
                echo "wierzchołek v{$this->id} jest wierzchołkiem dzielącym<br />";
                $this->HandleSplitVertex();
                break;
            }
            case 3:{
                echo "wierzchołek v{$this->id} jest wierzchołkiem końcowym<br />";
                $this->HandleEndVertex();
                break;
            }
            case 4:{
                echo "wierzchołek v{$this->id} jest wierzchołkiem łączącym<br />";
                $this->HandleMergeVertex();
                break;
            }
            case 5:{
                echo "wierzchołek v{$this->id} jest wierzchołkiem prawidłowym<br />";
                $this->HandleRegularVertex();
                break;
            }
        }
        echo"<br /><br />";
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
        $id=$this->id - 1;
        if($id==-1){
            $id=count($_SESSION['points'])-1;
        }

        echo "pomocnik e" . ($id) . "jest wierzchołkiem łączącym <br />";
        if ($_SESSION['edges'][$id]->helper->type == 4) {
            //2. then Wstaw do 𝐷 przekątną łączącą 𝑣𝑖 z pomocnik(𝑒𝑖−1)
            echo "Wstaw do D przekątną łączącą v{$this->id} z pomocnikiem e" . ($id);
            $_SESSION['d'][] = new edge($_SESSION['points'][$this->id], $_SESSION['edges'][$id]->helper);
       }
        echo " Usuń e" . ($id) . "z T";
        for ($i = 0; $i <= count($_SESSION['t']); $i++) {
            if ($_SESSION['t'][$i]->id == $id) {
                unset($_SESSION['t'][$i]);
                $_SESSION['t']=array_values($_SESSION['t']);
                break;
            }
        }

        echo "<br />";

    }
    public function HandleRegularVertex()
    {
        $idm=$this->id - 1;
        if($idm==-1){
            $idm=count($_SESSION['points'])-1;
        }
        $idp=$this->id+1;
        if($idp==count($_SESSION['points'])){
            $idp=0;
        }

        //po lewej
        if($_SESSION['points'][$idm]->y<=$this->y&&$_SESSION['points'][$idp]->y>=$this->y){
            $site=2;
        }else{// po prawej
            $site=1;
        }

        if($site==1){
            echo"wnętrze P leży po prawej stronie od v{$this->id}<br />";
            echo"sprawdź czy helper ".($idm)."jest typem 4 <br /> <br />";
            if(isset($_SESSION['edges'][$idm]->helper)){
                if($_SESSION['edges'][$idm]->helper->type==4){
                    echo "pomocnik e".($idm)." jest wierzchołkiem łączącym <br />";
                    echo"wstaw do d przekątną z v{$this->id} do pomocnika e".($idm);
                    $_SESSION['d'][]=new edge($_SESSION['points'][$this->id],$_SESSION['edges'][$idm]->helper);
                }
            }

            echo"usuń e".($idm)."z T";
            echo $idm;
            for($i=0;$i<=count($_SESSION['t']);$i++){
                if($_SESSION['t'][$i]->id==$idm){
                    unset($_SESSION['t'][$i]);
                    $_SESSION['t']=array_values($_SESSION['t']);
                    break;
                }
            }
            echo"wstaw e{$this->id} do T i ustaw pomocnika e{$this->id} na v{$this->id}";
            $_SESSION['edges'][$this->id]->helper=$_SESSION['points'][$this->id];
            $_SESSION['t'][]=$_SESSION['edges'][$this->id];

        }else if($site==2){
            echo"wnętrze P leży po lewej stronie od v{$this->id}";
            //szukanie krawędzie bezpośrednio na lewo na ten moment zakładam że bezpośrednio na lewo jest odzcinek którego wyższy punkt jest bliżej punktu
            echo"szukaj w t krawędzi bezpośrednio na lewo od v{$this->id}<br />";
            $first_left=first_left($_SESSION['points'][$this->id],$_SESSION['t']);
            if($_SESSION['edges'][$first_left]->helper->type==4){
                echo"pomocnik e{$first_left} jest wierzhołkiem łączącym";
                echo"wstaw do d przekątną z v{$this->id} do pomocnika e{$first_left}";
                $_SESSION['d'][]= new edge($_SESSION['points'][$this->id],$_SESSION['edges'][$first_left]->helper);
            }
            echo"ustaw pomocnika e{$first_left} na v{$this->id}";
            $_SESSION['edges'][$first_left]->helper=$_SESSION['points'][$this->id];
        }
        echo"<br />";
    }

    public function HandleSplitVertex()
    {
        echo"szukaj w t krawędzi bezpośrednio na lewo od v{$this->id}<br />";
        $first_left=first_left($_SESSION['points'][$this->id],$_SESSION['t']);
        echo"wstaw do d przekątną z v{$this->id} do pomocnika e{$first_left}";
        $_SESSION['d'][]=new edge($_SESSION['points'][$this->id],$_SESSION['edges'][$first_left]->helper);
        $_SESSION['edges'][$first_left]->helper=$_SESSION['points'][$this->id];
        $_SESSION['edges'][$this->id]->helper=$_SESSION['points'][$this->id];
        $_SESSION['t'][]=$_SESSION['edges'][$this->id];
    }

    public function HandleMergeVertex()
    {
        $idm=$this->id - 1;
        if($idm==-1){
            $idm=count($_SESSION['points'])-1;
        }

        if($_SESSION['edges'][$idm]->helper->type==4){
            echo"helper ".($idm)." jest łączący<br />";
            echo"wstaw do d przekątną z v{$this->id} do pomocnika e".($idm);
            $_SESSION['d'][]= new edge($_SESSION['points'][$this->id],$_SESSION['edges'][$idm]->helper);
        }
        echo"usuń e".($idm)."z tablicy t<br />";
        for($i=0;$i<count($_SESSION['t']);$i++){
            if($_SESSION['t'][$i]->id==$idm){
                unset($_SESSION['t'][$i]);
                $_SESSION['t']=array_values($_SESSION['t']);
                break;
            }
        }
        echo"szukaj w t krawędzi bezpośrednio na lewo od v{$this->id}<br />";
        $first_left=first_left($_SESSION['points'][$this->id],$_SESSION['t']);
        if($_SESSION['edges'][$first_left]->helper->type==4){
            echo"pomocnik e{$first_left} jest wierzhołkiem łączącym";
            echo"wstaw do d przekątną z v{$this->id} do pomocnika e{$first_left}";
            $_SESSION['d'][]= new edge($_SESSION['points'][$this->id],$_SESSION['edges'][$first_left]->helper);
        }
        echo"ustaw pomocnika e{$first_left} na v{$this->id}";
        $_SESSION['edges'][$first_left]->helper=$_SESSION['points'][$this->id];
    }
}