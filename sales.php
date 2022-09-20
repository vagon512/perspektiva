<?php
require_once 'include/head.php';
require_once "class/Pagination.php";
$page = new pagination();

if(empty($_GET['offer_id'])) {
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
                        <p><input type="submit" value="F I N D"</p>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <a href="sales.php">
        <button>сбросить</button>
    </a>
    <p>показывать по
    <a href="sales.php?step=9">  9</a>
    <a href="sales.php?step=12">  12</a>
    <a href="sales.php?step=18"> 18</a>
    </p>
    <?php
}
?>

 <?php
$step = isset($_GET['step']) ? $_GET['step'] : 9;
$start = isset($_GET['page']) && $_GET['page'] > 1 ? ($_GET['page'] - 1) * $step : 0;
$page->setStart($start);
$page->setStep($step);
$pagination = $page->getPagination();

$searchParameters = array();
if (isset($_GET['select']) && $_GET['select'] == 1) {
    $searchParameters['select'] = 1;
    $searchParameters['price'] = !empty($_GET['price']) ? $_GET['price'] : "%";
    $searchParameters['mortgage'] = $_GET['mortgage'];
    $searchParameters['rooms'] = $_GET['room'];
    $searchParameters['type'] = $_GET['type'];
} else {
    $searchParameters['select'] = 0;
    $searchParameters['price'] = "%";
    $searchParameters['mortgage'] = "%";
    $searchParameters['rooms'] = "%";
    $searchParameters['type'] = "%";
}

if (!isset($_GET['offer_id'])) {



    $offers = $perspektiva->searchOffers($pdo, $searchParameters['price'], $searchParameters['mortgage'],
        $searchParameters['rooms'], $searchParameters['type'], $pagination['start'], $pagination['step']);

    ?>
    <div class="row">

    <?php
    foreach ($offers as $offer) {
        ?>
        <div class="col-sm-4">
            <div class="card" style="width: 18rem;">


                <?php

                if (isset($offer['image_path'])) {
                    echo '<img src="' . $offer['image_path'][0] . '" class="card-img-top" alt="Нет изображения">';
                } else {
                    echo '<img src="pic/stock.png" class="card-img-top card-small" alt="Нет изображения">';
                } ?>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo "{$offer['offer_name']} {$offer['category_name']}" ?>
                    </h5>
                    <p class="card-text">
                        <?php echo $offer['category_name'] . " " . $offer['area_value'] . " " . $offer['area_unit'] ?>
                    </p>
                    <a href="sales.php?offer_id=<?php echo $offer['offer_id'], "&select={$searchParameters['select']}&type={$searchParameters['type']}&price={$searchParameters['price']}&mortgage={$searchParameters['mortgage']}&room={$searchParameters['rooms']}"; ?>" class="btn btn-primary">К
                        объявлению</a>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    $offers = $perspektiva->setOnceOffer($pdo, $_GET['offer_id']);
    if(!empty($offers[0]['description'])){
        $description = explode('.', $offers[0]['description']);
        $description = array_diff_key($description, [0 => "xx", 1 =>'sd']);
        $description = implode(".", $description);
    }
    else{
        $description = "";
    }

    ?>
    <div class="col-sm-6">
    <div class="card" style="width: 25rem;">
        <h5 class="card-title"><?php echo $offers[0]['offer_name']," ", $offers[0]['category_name'];?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo $offers[0]['price_value']," ",$offers[0]['price_currency'];?></h6>

    <!--        <img src="pic/stock.png" class="d-block w-100 img-fluid" alt="фотография" data-bs-toggle="modal" data-bs-target="#photoset" style="width:640px;height:360px">-->

    <!-- Modal -->
    <?
    if (!empty($offers['images'])) { ?>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="pic/stock.png" class="d-block w-100 img-fluid" alt="фотография" style="width:640px;height:360px">
        </div>
        <?php
        foreach ($offers['images'] as $image) {
            ?>
                    <div class="carousel-item">
                        <img src="<?PHP echo $image; ?>" class="d-block w-100 img-fluid" alt="фотография" style="width:640px;height:360px">
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
        <?php
    }
    else{
        ?>
        <img src="pic/stock.png" class="d-block w-100 img-fluid" alt="фотография" style="width:640px;height:360px">
        <?php
    }
        ?>
        </div>
        </div>


        <div class="card-body">
            <p>Площадь: <?php echo $offers[0]['area_value'], $offers[0]['area_unit'];  ?></p>
            <p>Комнат: <?php echo $offers[0]['rooms'];  ?></p>
            <p>Этаж: <?php echo $offers[0]['floors_total']>0 ? $offers[0]['floors_total'] : " ";  ?></p>
            <p>место: <?php echo $offers[0]['location_locality_name'];  ?></p>
            <p>год постройки: <?php echo $offers[0]['build_year']>0 ? $offers[0]['build_year'] : "не указан";  ?></p>
            
            <p><?php echo $description;  ?></p></div>
        </div>
        <?php
    }
//echo "<pre>";
//print_r($offers);
//echo "</pre>";
    ?>

    </div>
    <?php

//пагинация
    if (empty($_GET['offer_id'])) {
        $p = isset($_GET['page']) ? $_GET['page'] : 1;
        $page->setCurrentPage($p) ;//$_GET['pages'] > 1 ? $_GET['pages'] : 1;
        $page->setData($searchParameters);
        //$page->setTotalRows($pdo);
        $page->setTotalRows($pdo)->paginations();
    } else {

        if(!empty($searchParameters['select'])){
            echo "<a href=sales.php?select={$searchParameters['select']}&type={$searchParameters['type']}&price={$searchParameters['price']}&mortgage={$searchParameters['mortgage']}&room={$searchParameters['rooms']}>вернуться</a>";
        }
        else{
            echo "<a href=sales.php>вернуться</a>";
        }

    }

    require_once 'include/footer.php';
    ?>