<?php
    // $input = "EH16 5PS";
    $input = $_GET['pc'];

    include 'includes/autoload.inc.php';
    $dbh = new Dbh();
    $pcv = new PostCodeView();

    echo json_encode($pcv->showSimdByPostCode($input));