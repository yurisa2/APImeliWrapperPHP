<?php
class products extends melis
{
  public function meliGetProducts()
  {
    $url = '/users/' .USER_ID. '/items/search';
    $params = array(
      'access_token' => $this->access_token,
      'limit' => 100
    );

    $productsId = $meli->get($url, $params);

    $params2 = array(
      'access_token' => token(),
      'limit' => 100,
      'offset' => 100,
    );
    $productsId2 = $meli->get($url, $params2);

    $allProductsId = array_merge($productsId,$productsId2);
    $allProductsId = array_unique($allProductsId);

    return $allProductsId;
  }

  public function meliGetProduct($productId)
  {
    $params = array(
      'access_token' => $this->access_token,
    );

    $return = $this->meli->get("items/$productId", $params);

    return $return;
  }

  public function meliUpdateProduct($productData)
  {
    $params = array('access_token' => $this->access_token);
    $mlb = $productData['mlb'];
    $body = array(
      'title' => $productData['title'],
      'price' => $productData['price'],
      'available_quantity' => $productData['available_quantity'],
      'attributes' =>
      array(
        array('name' => "Marca",
        'value_name' => $productData['marca']),
        array('id' => "MODEL",
        'value_name' => $productData['sku']))
    );

    $return = $this->meli->put('/items/MLB'.$mlb, $body, $params);

    return $return;
  }


  public function meliUpdateProductDescription($productData)
  {
    $mlb = $productData['mlb'];
    $params = array('access_token' => $this->access_token);

    $body = array
    (
      'plain_text' => $productData['description']
    );

    $return = $this->meli->put('/items/MLB'.$mlb.'/description', $body, $params);


    return $return;
  }

  public function meliUpdateProductImages($productId, $images_url)
  {
    $mlb = $productId;
    $params = array('access_token' => token());
    $body = array('pictures' => $images_url);

    $return = $meli->put("/items/MLB$mlb", $body, $params);

    return $return;
  }


  public function meliCreateProduct($productData)
  {
    array(
      'title' => $productData['title'],
      'category_id' => "MLA3530",
      'price' => $productData['price'],
      'currency_id' => "ARS",
      'available_quantity' => $productData['qty'],
      'buying_mode' => "buy_it_now",
      'listing_type_id' => "gold_special",
      'description' => $productData['description'],
      'attributes' => [
        array('id'  => "ITEM_CONDITION",
              'value_name' => "Novo"),
        array('id'  => "BRAND",
              'value_name' => BRAND),
        array('id'  => "MODEL",
              'value_name' => $productData['sku'])],
      'sale_terms' => [
        array('id' => "WARRANTY_TIME", 'value_name' => "90 dias")
      ],
      'pictures' =>[
        array('source' =>"http://mla-s2-p.mlstatic.com/968521-MLA20805195516_072016-O.jpg")
      ]);
  }


}
 ?>
