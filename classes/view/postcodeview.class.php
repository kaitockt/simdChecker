<?php

class PostCodeView extends PostCode {
    public function showSimdByPostCode($pc){
        $rows = $this->getSimdByPostCode($pc);
        if(count($rows) > 0){
            //get the first row only
            $row = $rows[0];
            return array(
                "rank" => $row["simdrank"],
                "income" => $row["income"],
                "employment" => $row["employment"],
                "education" => $row["education"],
                "health" => $row["health"],
                "access" => $row["access"],
                "crime" => $row["crime"],
                "housing" => $row["housing"]
            );
        }
    }
}