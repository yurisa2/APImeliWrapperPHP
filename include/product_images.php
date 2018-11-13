<?php
class product_images extends melis
{

  public function update_images($images_url)
  {
    $mlb = $images_url['mlb'];
    $params = array('access_token' => token());
    $body = array('pictures' => $images_url);

    $return = $meli->put("/items/MLB$mlb", $body, $params);

    return $return;
  }




}
 ?>
