<?php

class PostCodeView extends PostCode {
    public function showSimdByPostCode($pc){
        $rows = $this->getSimdByPostCode($pc);
        if(count($rows) > 0){
            //get the first row only
            $row = $rows[0];
            return array(
                "Total Rank" => $row["simdrank"],
                "Income" => $row["income"],
                "Employment" => $row["employment"],
                "Education" => $row["education"],
                "Health" => $row["health"],
                "Geographic Access" => $row["access"],
                "Crime" => $row["crime"],
                "Housing" => $row["housing"]
            );
        }
    }
}