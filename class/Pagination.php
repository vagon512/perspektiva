<?php


class Pagination
{
    private $step;
    private $start;
    private $totalRows;
    private $currentPage;

    public function setStep($step=9){
        $this->step = $step;
        return $this;
    }

    public function setStart($start=0){
        $this->start = $start;
        return $this;
    }

    public function setCurrentPage($currentPage = 1){
        $this->currentPage = $currentPage;
        return $this->currentPage;
    }

    public function getPagination(){
        $pagination = array('start'=>$this->start, 'step'=>$this->step);
        return $pagination;
    }

    public function setTotalRows($pdo){
        $querySelectCountColumn = "SELECT count(*) as total FROM offers";
        $result = $pdo->prepare($querySelectCountColumn);
        $result->execute();
        $this->totalRows = $result->fetchColumn();
        return $this; //->totalRows;
    }

    public function checkingValuesForPagination(){
        if(gettype($this->step) === 'integer' && gettype($this->start)==='integer'){
            return true;
        }
        return false;
    }

    public function paginations($currentPage = 1){
        $total = $this->totalRows;//setTotalRows($pdo);
        $pages = ceil($total/$this->step);
        $p = $currentPage > 1 ? $currentPage : 1;
        if($p > 1){
            echo '<a href="?page=1">1</a>'."&nbsp&nbsp...&nbsp&nbsp";
        }
        for($i = $p; $i<= $p+5; $i++){
            echo '<a href="?page='.$i.'">'.$i."</a>&nbsp&nbsp";
        }

        echo '...&nbsp&nbsp<a href="?pages='.$pages.'">'.$pages."</a>";
    }
}