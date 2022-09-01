<?php

require_once 'include/head.php';

?>
<div class="card">
    <div class="card-body">
        Риэлтерская компания «ПЕРСПЕКТИВА» - работает на рынке недвижимости в Цимлянске и Цимлянском районе. В нашей
        компетенции находятся все услуги, которые связаны с покупкой, продажей, обменом и арендой недвижимости в жилом и
        коммерческом сегменте.

        Мы помогаем находить максимально выгодные предложения на рынке для наших клиентов и берём на себя все заботы по
        подготовке и согласованию документов. Вам не придётся тратить время на инстанции и согласования, приём звонков и
        переговоров, подготовку и проведение просмотров и показов, мы с удовольствием возьмём это на себя.

        Перед каждой сделкой, каждой операцией отдел контроля качества тщательно осматривает и сверяет все документы и
        действия, пошагово перепроверяя все этапы. Задача компании обеспечивать безопасность и конфиденциальность
        сделок. Это наш приоритет.

        Вся наша работа направлена на то, чтобы помогать вам – нашим клиентам уверенно чувствовать себя на рынке
        недвижимости, и делать это выгодно!

        Сегодня ПЕРСПЕКТИВА — это ведущая риэлторская компания города Цимлянска.
    </div>
</div>
<?php
//$perspektiva = new Perspektiva();
//
//$offers = $perspektiva->selectOffersImages($pdo);

//$offers = $perspektiva->photoGeneration();
//$offers = $perspektiva->dataGeneration($pdo);
//$offers = $perspektiva->getOfferType($pdo);
//$perspektiva->putOffersData($pdo);
//echo count($offers);
//echo "<pre>";
//print_r($offers);
//echo "</pre>";

//$a = "100";
//
//if ( gettype($a) === 'integer'){
//  echo "number";
//}
//else{ echo "not number";}

$step = 18;
//if($perspektiva->setStep($step)->setStart($start)->checkingValuesForPagination() == true){
//    $pagination = $perspektiva->getPagination();
//    print_r($pagination);
//}
//else{
//    echo "foooooo";
//}
$p = $_GET['pages'] > 1 ? $_GET['pages'] : 1;
if($p > 1){
    echo '<a href="?pages=1">1</a>'."&nbsp&nbsp...&nbsp&nbsp";
}
$total = $perspektiva->setTotalRows($pdo);
$pages = ceil($total/$step);
for($i = $p; $i<= $p+5; $i++){
    echo '<a href="?pages='.$i.'">'.$i."</a>&nbsp&nbsp";
}

echo '...&nbsp&nbsp<a href="?pages='.$pages.'">'.$pages."</a>";
require_once 'include/footer.php';
?>
