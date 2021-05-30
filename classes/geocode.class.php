<?php

class Geocode extends Curl{
    private $lat = "";
    private $lng = "";
    private $res = [];

    public function curl(string $input){
        $input = str_replace(" ", "+", $input);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$input&key=$this->key";
        $response = $this->run($url);

        if(isset($response['results']) && count($response["results"]) > 0){
            return $this->setRes($response["results"][0]);
        } else {
            return false;
        }
    }

    public function setRes(array $res){
        return $this->res = $res;
    }

    public function getLat(){
        return $this->res["geometry"]["location"]["lat"];
    }

    public function getLng(){
        return $this->res["geometry"]["location"]["lng"];
    }
}