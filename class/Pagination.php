<?php


class Pagination
{
    private $step;
    private $start;
    private $totalRows;
    private $currentPage;
    public $data = array();

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

    public function setData(array $data){
        $this->data = $data;
        return $this;
    }

    public function setTotalRows($pdo){
        $data = array();
        if (isset($this->data['select']) && $this->data['select'] == 1 ) {
            $data['price']       = $this->data['price'];
            $data['mortgage']    = $this->data['mortgage'];
            $data['type']        = $this->data['type'];
            $data['rooms']       = $this->data['rooms'];
                }

        if(count($this->data)<5){
            $querySelectCountColumn = "SELECT count(*) as total FROM offers";
        }
        elseif(isset($data['price']) && $data['price'] > 0){
            $querySelectCountColumn = "SELECT count(*) 
                         FROM offers   
                             WHERE offers.price_value <= :price 
                             AND offers.mortgage LIKE :mortgage
                             AND offers.rooms LIKE :rooms 
                             AND offers.type LIKE :type";
        }
        else{
            $querySelectCountColumn = "SELECT count(*) 
                         FROM offers   
                             WHERE offers.mortgage LIKE :mortgage
                             AND offers.rooms LIKE :rooms 
                             AND offers.type LIKE :type";
        }

        $result = $pdo->prepare($querySelectCountColumn);
        $result->execute($data);
        $this->totalRows = $result->fetchColumn();
        return $this; //->totalRows;
    }

    public function checkingValuesForPagination(){
        if(gettype($this->step) === 'integer' && gettype($this->start)==='integer'){
            return true;
        }
        return false;
    }

    public function paginations(){
        $total = $this->totalRows;//setTotalRows($pdo);
        $page = ceil($total/$this->step);
        $p = $this->currentPage > 1 ? $this->currentPage : 1;
        $select = isset($this->data['select']) ? $this->data['select'] : '';
        $limit = $page < 5 ? $page : 5;

        if($page == 1){
            echo '<a href="?page=' . $p . '&select=' . $select . '&type=' . $this->data['type'] . '&price=' . $this->data['price'] . '&mortgage=' . $this->data['mortgage'] .
            '&room=' . $this->data['rooms'] . '"><b style="color:#000080">' . $p . "</b></a>&nbsp&nbsp";
        }
        elseif($page > 1 && $page <=5){
            for($i = $p; $i<=$limit; $i++){
                echo $i;
            }
        }
        elseif($page > 5 && $p == 1){
            for($i = $p; $i<=$p+$limit; $i++){
                echo '<a href="?page=' . $i . '&select=' . $select . '&type=' . $this->data['type'] . '&price=' . $this->data['price'] . '&mortgage=' . $this->data['mortgage'] .
            '&room=' . $this->data['rooms'] . '">' . $i . "</a>&nbsp&nbsp";
            }
            echo '...&nbsp&nbsp<a href="?page=' . $page . '&select=' . $select . '&type=' . $this->data['type'] . '&price=' . $this->data['price'] . '&mortgage=' . $this->data['mortgage'] . '&room=' . $this->data['rooms'] . '">' . $page . "</a>";
        }
        else{
            echo '<a href="?page=1">1</a>' . "&nbsp&nbsp...&nbsp&nbsp";
            for($i = $p; $i<=$p+$limit; $i++){
                echo '<a href="?page=' . $i . '&select=' . $select . '&type=' . $this->data['type'] . '&price=' . $this->data['price'] . '&mortgage=' . $this->data['mortgage'] .
                    '&room=' . $this->data['rooms'] . '">' . $i . "</a>&nbsp&nbsp";
            }
            echo '...&nbsp&nbsp<a href="?page=' . $page . '&select=' . $select . '&type=' . $this->data['type'] . '&price=' . $this->data['price'] . '&mortgage=' . $this->data['mortgage'] . '&room=' . $this->data['rooms'] . '">' . $page . "</a>";

        }

    }
}