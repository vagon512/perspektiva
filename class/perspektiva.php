<?php


class Perspektiva
{
////
  private $step;
  private $start;
  private $totalRows;

  public function setStep($step=9){
      $this->step = $step;
      return $this;
  }

  public function setStart($start=0){
      $this->start = $start;
      return $this;
  }



  private function readXML(){
    $xml = simplexml_load_file(PATH_TO_XML);

     foreach($xml->offer as $offer){
         $offers[] = $offer;
     }
     return $offers;
  }

  private function getCategory($pdo){
      $category = array();
      $selectCategory = "SELECT * FROM offer_category";
      $data = $pdo->prepare($selectCategory);
      $data->execute();
      $values=$data->fetchAll(PDO::FETCH_ASSOC);
      foreach($values as $value){
          $category[$value['category_name']] = $value['category_id'];
      }

      return $category;

  }

  public function getOfferType($pdo){
      $offerType = array();
      $selectOfferType = "SELECT * FROM offer_type";
      $values = $this->selecting($pdo, $selectOfferType, array());
      foreach($values as $value){
          $offerType[$value['offer_first_name']] = $value['type_id'];
      }
      return $offerType;
  }

  private function getOfferPropertyType($pdo){
      $offerPropertyType = array();
      $selectOfferPropertyType = "SELECT * FROM offer_property_type";
      $values = $this->selecting($pdo, $selectOfferPropertyType, array());
      foreach($values as $value){
          $offerPropertyType[$value['property_type_name']] = $value['property_type_id'];
      }
      return $offerPropertyType;
  }

  private function photoGeneration(){
      $offers = $this->readXML();
      $photo = array();
      $k = 0;
      foreach($offers as $offer){

         if( count($offer->image) > 0){
             $count = count($offer->image);
             for($i = 0; $i < $count; $i++ ){
                 $photo[$k]['offer_id']    = (int) $offer['internal-id'];
                 $photo[$k]['image_path']  = (string) $offer->image[$i];
                 $k++;
             }
         }
         else{
             $photo[$k]['offer_id']    = (int) $offer['internal-id'];
             $photo[$k]['image_path']  = "";
         }
         $k++;
      }
      return $photo;
  }

  public function dataGeneration($pdo){
      $offers = $this->readXML();
      $categories = $this->getCategory($pdo);
      $offerPropertyType = $this->getOfferPropertyType($pdo);
      $offerType = $this->getOfferType($pdo);

      $offersData = array();

      foreach($offers as $offer){
          $key = (int) $offer['internal-id'];
          $offersData[$key]['offer_id']                       = (int) $offer['internal-id'];
          $offersData[$key]['creation_date']                  = isset($offer->{'creation-date'}) ? (string) $offer->{'creation-date'} : " ";
          $offersData[$key]['last_update_date']               = isset($offer->{'last-update-date'}) ? (string) $offer->{'last-update-date'} : " ";
          $offersData[$key]['location_country']               = isset($offer->location->country) ? (string) $offer->location->country : " ";
          $offersData[$key]['location_region']                = isset($offer->location->region) ? (string) $offer->location->region : " ";
          $offersData[$key]['location_locality_name']         = isset($offer->location->{'locality-name'}) ? (string) $offer->location->{'locality-name'} : " ";
          $offersData[$key]['location_address']               = isset($offer->location->address) ? (string) $offer->location->address : " ";
          $offersData[$key]['price_value']                    = isset($offer->price->value) ? (double) $offer->price->value : 0;
          $offersData[$key]['price_currency']                 = isset($offer->price->currency) ? (string) $offer->price->currency : " ";
          $offersData[$key]['haggle']                         = isset($offer->haggle) ? (int) $offer->haggle : 0;    //torg
          $offersData[$key]['mortgage']                       = isset($offer->mortgage) ? (int) $offer->mortgage : 0;    //ipoteka
          $offersData[$key]['quality']                        = isset($offer->quality) ? (string) $offer->quality : " ";
          $offersData[$key]['area_value']                     = isset($offer->area->value) ? (double)  $offer->area->value : 0;
          $offersData[$key]['area_unit']                      = isset($offer->area->unit) ? (string) $offer->area->unit : " ";
          $offersData[$key]['lot_area_value']                 = isset($offer->{'lot-area'}->value) ? (double) $offer->{'lot-area'}->value : 0;
          $offersData[$key]['lot_area_unit']                  = isset($offer->{'lot-area'}->unit) ?(string) $offer->{'lot-area'}->unit : " ";
          $offersData[$key]['floors_total']                   = isset($offer->{'floors-total'}) ? (int) $offer->{'floors-total'} : 0;
          $offersData[$key]['rooms']                          = isset($offer->rooms) ? (int) $offer->rooms : 0;
          $offersData[$key]['building_type']                  = isset($offer->{'building-type'}) ? (string) $offer->{'building-type'} : " ";
          $offersData[$key]['heating_supply']                 = isset($offer->{'heating-supply'}) ? (int) $offer->{'heating-supply'} : 0;
          $offersData[$key]['sewerage_supply']                = isset($offer->{'sewerage-supply'}) ? (int) $offer->{'sewerage-supply'} : 0;
          $offersData[$key]['electrecity_supply']             = isset($offer->{'electricity-supply'}) ? (int) $offer->{'electricity-supply'} : 0;
          $offersData[$key]['lot_type']                       = isset($offer->{'lot-type'}) ? (string) $offer->{'lot-type'} : " ";
          $offersData[$key]['description']                    = isset($offer->description) ? (string) $offer->description : " ";
          $offersData[$key]['build_year']                     = isset($offer->{'built-year'}) ? (int) $offer->{'built-year'} : 0;


      }

      $offersData = $this->setDataArray('type', $offers, $offerType, $offersData);
      $offersData = $this->setDataArray('property-type', $offers, $offerPropertyType, $offersData);
      $offersData = $this->setDataArray('category', $offers, $categories, $offersData);

      return $offersData;
  }

  private function setDataArray(string $column, $offers, array $arr, array $offersData){
      if(strpos($column, '-')){
          $column_key = str_replace('-', '_', $column);
      }
      else{
          $column_key = $column;
      }
      foreach ($offers as $offer){
          foreach ($arr as $key=>$value){
              if( $offer->{$column} == $key){
                  $key2 = (int) $offer['internal-id'];
                  $offersData[$key2][$column_key] = $value;
              }
          }
      }

      return $offersData;
  }

  public function putOffersData($pdo){

      $offers = $this->dataGeneration($pdo);
      $photos = $this->photoGeneration();



      $queryInsertOffers = "INSERT INTO `offers`
                            (`offer_id`, `type`, `property_type`, `creation_date`, `last_update_date`,
                              `location_country`, `location_region`, `location_locality_name`, `location_address`,
                             `price_value`, `price_currency`, `haggle`, `mortgage`, `category`, `quality`, `area_value`,
                             `area_unit`, `lot_area_value`, `lot_area_unit`, `floors_total`, `rooms`, `building_type`,
                             `heating_supply`, `sewerage_supply`, `electrecity_supply`, `lot_type`, `description`, `build_year`)
                             VALUES (:offer_id, :type, :property_type, :creation_date, :last_update_date, :location_country,
                                     :location_region, :location_locality_name, :location_address, :price_value,
                                     :price_currency, :haggle, :mortgage, :category, :quality, :area_value, :area_unit,
                                     :lot_area_value, :lot_area_unit, :floors_total, :rooms, :building_type,
                                     :heating_supply, :sewerage_supply, :electrecity_supply, :lot_type, :description,
                                     :build_year)";

      $queryInsertPhoto = "INSERT INTO `offer_images`(`offer_id`, `image_path`) VALUES (:offer_id, :image_path)";

      $resultPhoto = $pdo->prepare($queryInsertPhoto);

      $result = $pdo->prepare($queryInsertOffers);
      foreach($offers as $offer){
          $result->execute($offer);
      }

      foreach($photos as $photo) {
          $resultPhoto->execute($photo);
      }

  }

  private function selectOffersImages($pdo){
      $row = array();
      $querySelectImagePath = 'SELECT * FROM offer_images WHERE image_path != ""';
//      $result = $pdo->prepare($querySelectImagePath);
//      $result->execute();
//      $row = $result->fetchAll(PDO::FETCH_ASSOC);
      $row = $this->selecting($pdo, $querySelectImagePath, array());

      return $row;
  }


  ////////////выборка данных
    public function searchOffers($pdo, $price, $mortgage, $rooms, $type, int $limit, int $step){

      $data = array('price'=>$price, 'mortgage'=>$mortgage, 'rooms'=>$rooms, 'type'=>$type);
//      echo $price."==".$mortgage."==".$rooms."==".$type."<br>";
        if($price == "%" && $mortgage == "%" && $rooms == "%" && $type == "%"){
          $querySelectSalesOffers = "SELECT offers.*, offer_type.offer_name, offer_property_type.property_type_name, 
                                offer_category.category_name 
                         FROM offers 
                             JOIN offer_type on offers.type=offer_type.type_id 
                             JOIN offer_property_type on offer_property_type.property_type_id=offers.property_type 
                             JOIN offer_category on offers.category=offer_category.category_id  LIMIT $limit,$step
                             ";
        }
        elseif ($price == "%" && ($mortgage == "%" || $rooms == "%" || $type == "%")){
          $data = array('mortgage'=>$mortgage, 'rooms'=>$rooms, 'type'=>$type);
          $querySelectSalesOffers = "SELECT offers.*, offer_type.offer_name, offer_property_type.property_type_name, 
                                offer_category.category_name 
                         FROM offers 
                             JOIN offer_type on offers.type=offer_type.type_id 
                             JOIN offer_property_type on offer_property_type.property_type_id=offers.property_type 
                             JOIN offer_category on offers.category=offer_category.category_id  
                             WHERE offers.mortgage LIKE :mortgage
                             AND offers.rooms LIKE :rooms 
                             AND offers.type LIKE :type 
                             ";
        }
        else{
          $querySelectSalesOffers = "SELECT offers.*, offer_type.offer_name, offer_property_type.property_type_name, 
                                offer_category.category_name 
                         FROM offers 
                             JOIN offer_type on offers.type=offer_type.type_id 
                             JOIN offer_property_type on offer_property_type.property_type_id=offers.property_type 
                             JOIN offer_category on offers.category=offer_category.category_id  
                             WHERE offers.price_value <= :price 
                             AND offers.mortgage LIKE :mortgage
                             AND offers.rooms LIKE :rooms 
                             AND offers.type LIKE :type  
                             ";

        }

        $rows = $this->selecting($pdo, $querySelectSalesOffers, $data);
        $images = $this->selectOffersImages($pdo);

        //$offerImage = array();
        $count = count($rows);
        for ($i=0; $i<$count; $i++){
            foreach ($images as $image){
                if($rows[$i]['offer_id'] == $image['offer_id']){
                    $rows[$i]['image_path'][]= $image['image_path'];
                }
            }
        }
      return $rows;

   }
    private function selecting($pdo, $query, array $array){
        $result = $pdo->prepare($query);
        $result->execute($array);
        $offer = $result->fetchALL(PDO::FETCH_ASSOC);
        return $offer;
    }
   public function setOnceOffer($pdo, $offerID){
      $querySelectOnceOffer = "SELECT offers.*, offer_type.offer_name, offer_property_type.property_type_name, 
                                offer_category.category_name 
                         FROM offers 
                             JOIN offer_type on offers.type=offer_type.type_id 
                             JOIN offer_property_type on offer_property_type.property_type_id=offers.property_type 
                             JOIN offer_category on offers.category=offer_category.category_id  
                             WHERE offers.offer_id = :offerID";

      $querySelectOfferImages = "SELECT image_path FROM offer_images WHERE offer_id = :offerID";

      $offer = $this->selecting($pdo, $querySelectOnceOffer, array('offerID'=>$offerID));
      $images = $this->selecting($pdo, $querySelectOfferImages, array('offerID'=>$offerID));
      $i=1;
      $allImages = array();
       if(count($images)>1){
           foreach ($images as $key=>$image){
              $allImages['images'][] = $image['image_path'];
              $i++;
           }
       }

       $offer = array_merge($offer, $allImages);
      return $offer;
   }

   public function checkingValuesForPagination(){
      if(gettype($this->step) === 'integer' && gettype($this->start)==='integer'){
          return true;
      }
      return false;
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
      return $this->totalRows;
   }

   public function pagination(){
      $this
   }
}