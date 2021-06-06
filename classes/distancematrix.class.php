<?php

class DistanceMatrix extends CUrl{
    private $row = [];

    public function curl($origins, $destinations){
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origins&destinations=$destinations&mode=walking&key=$this->key";
        $response = $this->run($url);
        // var_dump($response);
        return $this->setRow($response['rows'][0]);
    }

    private function setRow($row){
        return $this->row = $row;
    }

    public function getDuration(){
        if(isset($this->row["elements"][0]["duration"]["text"])){
            return $this->row["elements"][0]["duration"]["text"];
        } else {
            return false;
        }
    }
}