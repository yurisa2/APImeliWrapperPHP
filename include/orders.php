<?php
class orders extends melis
{
  public function get_order_information($order_id)
  {
    $params = array('access_token' => $this->access_token);
    $return = $meli->get("/orders/$order_id", $params);

    return $return['body'];
  }

  public function get_orders()
  {
    $params = array('access_token' => $this->access_token,
    'seller' => USER_ID, 'order.status' => "paid");

    $return = $meli->get("/orders/search", $params);

    return $return['body'];
  }

  public function get_order_label($shipment_ids, $nome, $order_id)
  {
    $filename = "etiquetas/$order_id-$nome.pdf";
    $curl_url =  "https://api.mercadolibre.com/shipment_labels?shipment_ids=$shipment_ids&response_type=pdf&access_token=$this->accesstoken";
    $out = fopen($filename,"w+");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_FILE, $out);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL, $curl_url);
    curl_exec($ch);
    curl_close($ch);

    return $filename;
  }

}
 ?>
