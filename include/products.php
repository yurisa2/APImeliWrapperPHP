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

    $result = $this->meli->get($url, $params);

    $product_list = $result['body']->results;
    $product_list = array_unique($product_list);

    return $product_list;
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

    $result = $this->meli->put('/items/MLB'.$mlb, $body, $params);

    return $result;
  }


  public function update_product_description($product_data)
  {
    $mlb = $product_data['mlb'];
    $params = array('access_token' => $this->access_token);

    $body = array
    (
      'plain_text' => $product_data['description']
    );

    $result = $this->meli->put('/items/MLB'.$mlb.'/description', $body, $params);


    return $result;
  }


  public function update_product($product_data)
  {
    $product_info = update_product_information($product_data);
    $product_description = update_product_description($$product_data);

    $result = array($product_info,$product_description);

    return $result;
  }





}
 ?>
