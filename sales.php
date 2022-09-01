<?php
require_once 'include/head.php';
?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        фильтр
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="sales.php" method="get">
                        <input type="hidden" name="select" value="1">
                        <p>ипотека:<br>
                            <input type="radio" name="type" value="%" checked>все варианты<br>
                            <input type="radio" name="type" value="1">Аренда<br>
                            <input type="radio" name="type" value="2">Продажа
                        </p>
                        <p>цена:<input type="number" name="price"></p>
                        <p>ипотека:<br>
                            <input type="radio" name="mortgage" value="%" checked>все варианты<br>
                            <input type="radio" name="mortgage" value="0">нет<br>
                            <input type="radio" name="mortgage" value="1">Да
                        </p>
                        <p>комнат
                            <select name="room">
                                <option value="%">все</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </p>
                        <p><input type="submit" value="F I N D" </p>
                    </form>
                </div>

            </div>
        </div>
    </div>
<a href="sales.php"><button>сбросить</button></a>
<a href="sales.php?step=9">показывать по 9</a>
    <a href="sales.php?step=12">показывать по 12</a>
    <a href="sales.php?step=18">показывать по 18</a>
<?php
$step   = $_GET['step'] > 0 ? $_GET['step'] : 9;
$start  = $_GET['page'] > 1 ? ($_GET['page']-1)*$step : 0;

if(!$_GET['offer_id']){

    $searchParameters = array();
    if($_GET['select']==1){
        $searchParameters['price']      = !empty($_GET['price']) ?  $_GET['price'] : "%";
        $searchParameters['mortgage']   = $_GET['mortgage'];
        $searchParameters['rooms']      = $_GET['room'];
        $searchParameters['type']       = $_GET['type'];
    }
    else{
        $searchParameters['price']      = "%";
        $searchParameters['mortgage']   = "%";
        $searchParameters['rooms']      = "%";
        $searchParameters['type']       = "%";
    }
    $step = $_GET['step']>0 ? $_GET['step'] : 9;
    $offers = $perspektiva->searchOffers($pdo, $searchParameters['price'], $searchParameters['mortgage'],
                                         $searchParameters['rooms'], $searchParameters['type'], $pagination['start'], $pagination['step']);

    ?>
        <div class="row">

    <?php
    foreach ($offers as $offer){
        ?>
        <div class="col-sm-4">
        <div class="card" style="width: 18rem;">


    <?php

        if(isset($offer['image_path'])){
          echo '<img src="'.$offer['image_path'][0].'" class="card-img-top" alt="Нет изображения">';
        }
        else{
            echo '<img src="pic/stock.png" class="card-img-top card-small" alt="Нет изображения">';
        }?>
        <div class="card-body">
                <h5 class="card-title">
                    <?php echo "{$offer['offer_name']} {$offer['category_name']}"  ?>
                </h5>
                <p class="card-text">
                   <?php echo $offer['category_name']." ".$offer['area_value']." ".$offer['area_unit']?>
                </p>
                <a href="sales.php?offer_id=<?php echo $offer['offer_id'] ?>" class="btn btn-primary">К объявлению</a>
            </div>
        </div>
        </div>
    <?php
    }
}

else{
    $offers = $perspektiva->setOnceOffer($pdo, $_GET['offer_id']);
?>
    <div class="col-sm-6">
    <div class="card" style="width: 25rem;" >

        <img src="pic/stock.png" class="d-block w-100 img-fluid" alt="фотография" data-bs-toggle="modal" data-bs-target="#photoset" style="width:640px;height:360px">

        <!-- Modal -->
        <div class="modal fade" id="photoset" tabindex="-1" aria-labelledby="photoset" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Фотографии</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                foreach ($offers['images'] as $image){
                                    echo $image."<br>";
                                    ?>
                                    <div class="carousel-item ">
                                        <img src="<?php echo $image; ?>" class="d-block w-100 " alt="фотография" style="width:360px;height:360px">
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                    data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Предыдущий</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                    data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Следующий</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="card-body">
            <?php
            echo $offers[0]['creation_date']
            ?>
        </div>
    </div>
    <?php
}
//echo "<pre>";
//print_r($offers);
//echo "</pre>";
?>

    </div>
<?php
require_once 'include/footer.php';
?>