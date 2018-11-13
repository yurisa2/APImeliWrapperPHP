<?php
class melis
{
  public function __construct() {
    $variavel = json_decode(file_get_contents("include/files/tokens.json"));
    $this->access_token = $variavel->access_token;
    $this->refresh_token = $variavel->refresh_token;

    if(time() > $variavel->expires_in)
    {
      $this->meli = new Meli(APP_ID, SECRET_KEY, $this->access_token,$this->refresh_token);
      $refresh = $this->meli->refreshAccessToken();
      $token_info["access_token"] = $refresh["body"]->access_token;
      $token_info["refresh_token"] = $refresh["body"]->refresh_token;
      $token_info["expires_in"] = time()+10000;
      file_put_contents("include/files/tokens.json",json_encode($token_info));

      $variavel = json_decode(file_get_contents("include/files/tokens.json"));
      $this->access_token = $variavel->access_token;
      $this->refresh_token = $variavel->refresh_token;
    } else $this->meli = new Meli(APP_ID, SECRET_KEY, $this->access_token,$this->refresh_token);
  }
}
 ?>
