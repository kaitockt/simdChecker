<?php

class FindPlace extends CUrl {
    private $fields = ["name", "geometry", "place_id"];
    private $res = [];

    public function curl($origin, $input){
        $input = str_replace(" ", "+", $input);
        $url = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=$input&inputtype=textquery&fields=".implode(",", $this->fields)."&locationbias=point:$origin&key=$this->key";
        $response = $this->run($url);

        if(isset($response['candidates']) && count($response['candidates']) > 0){
            return $this->setRes($response['candidates'][0]);
        }
    }

    private function setRes(array $res){
        return $this->res = $res;
    }

    public function getLat(){
        return $this->res['geometry']['location']['lat'];
    }

    public function getLng(){
        return $this->res['geometry']['location']['lng'];
    }
}