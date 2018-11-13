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

  public function update_product($product_data, $mlb)
  {
    global $app_Id;
    global $secret_Key;
    global $DEBUG;
    global $ajuste_preco_multiplicacao;
    global $ajuste_estoque;
    global $ajuste_preco_soma;
    global $sufixo_prod;
    global $prefixo_prod;
    global $marca;


    $produto = magento_product_summary($SKU);
    echo "produto";var_dump($produto);
    if(!$produto) return 0;
    $title = $prefixo_prod.$produto['name'].$sufixo_prod;

    if (strlen($title) > 60) $title = $prefixo_prod.$produto['name'];

    $price = round(($produto['price'] * $ajuste_preco_multiplicacao)+$ajuste_preco_soma,2);
    $available_quantity = floor($produto['qty_in_stock'] + ($produto['qty_in_stock']*$ajuste_estoque));

    if($available_quantity < 0) $available_quantity = 0;

    $params = array('access_token' => $this->access_token);

    $body = array
    (
      'title' => $title,
      'price' => $price,
      'available_quantity' => $available_quantity,
      'attributes' =>
      array(
        array('name' => "Marca",
        'value_name' => $marca),
        array('id' => "MODEL",
        'value_name' => $SKU)
      )
    );


    $result = $this->meli->put('/items/MLB'.$mlb, $body, $params);

    return $result;
  }





}
 ?>
