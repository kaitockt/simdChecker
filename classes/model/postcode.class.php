<?php

class PostCode extends Dbh {
    protected function getSimdByPostCode($postCode){
        $sql = "SELECT d.* FROM datazone AS d INNER JOIN postcode AS p
                ON d.code = p.dz WHERE p.code = ?;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$postCode]);
        return $stmt->fetchAll();
    }
}