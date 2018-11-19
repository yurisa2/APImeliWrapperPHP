<?php
class products extends melis
{
  public function get_products()
  {
    $url = '/users/' .USER_ID. '/items/search';
    $params = array(
      'access_token' => $this->access_token,
      'limit' => 100
    );

    $return = $this->meli->get($url, $params);

    return $return->results;
  }

  public function get_product($product_id)
  {
    $params = array(
      'access_token' => $this->access_token,
    );

    $return = $this->meli->get("items/$product_id", $params);

    return $return;
  }

  public function update_product_information($product_data)
  {
    $params = array('access_token' => $this->access_token);
    $mlb = $product_data['mlb'];
    $body = array(
      'title' => $product_data['title'],
      'price' => $product_data['price'],
      'available_quantity' => $product_data['available_quantity'],
      'attributes' =>
      array(
        array('name' => "Marca",
        'value_name' => $product_data['marca']),
        array('id' => "MODEL",
        'value_name' => $product_data['sku']))
    );

    $return = $this->meli->put('/items/MLB'.$mlb, $body, $params);

    return $return;
  }


  public function update_product_description($product_data)
  {
    $mlb = $product_data['mlb'];
    $params = array('access_token' => $this->access_token);

    $body = array
    (
      'plain_text' => $product_data['description']
    );

    $return = $this->meli->put('/items/MLB'.$mlb.'/description', $body, $params);


    return $return;
  }


  public function update_product($product_data)
  {
    $product_info = update_product_information($product_data);
    $product_description = update_product_description($$product_data);

    $return = array($product_info,$product_description);

    return $return;
  }

  public function put_product($product_data)
  {
    array(
      'title' => $product_data['title'],
      'category_id' => "MLA3530",
      'price' => $product_data['price'],
      'currency_id' => "ARS",
      'available_quantity' => $product_data['qty'],
      'buying_mode' => "buy_it_now",
      'listing_type_id' => "gold_special",
      'description' => $product_data['description'],
      'attributes' => [
        array('id'  => "ITEM_CONDITION",
              'value_name' => "Novo"),
        array('id'  => "BRAND",
              'value_name' => BRAND),
        array('id'  => "MODEL",
              'value_name' => $product_data['sku'])],
      'sale_terms' => [
        array('id' => "WARRANTY_TIME", 'value_name' => "90 dias")
      ],
      'pictures' =>[
        array('source' =>"http://mla-s2-p.mlstatic.com/968521-MLA20805195516_072016-O.jpg")
      ]);
  }



}
 ?>
