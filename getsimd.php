<?php
    // $input = "EH16 5PS";
    $input = $_GET['pc'];

    include_once 'includes/autoload.inc.php';
    $dbh = new Dbh();
    $pcv = new PostCodeView();
    $fp = new FindPlace();
    $dm = new DistanceMatrix();

    // $res["Post Code"] = $_GET['pc'];
    $res["Post Code"] = $input;
    $res["ranks"] = $pcv->showSimdByPostCode($input);

    if(!isset($_GET['lat']) || !isset($_GET['lng'])){
        //if geometry is not found yet, find it now
        $geocode = new Geocode();

        //get api key
        $key = file_get_contents("apikey.txt", true);
        $geocode->curl($input, $key);
        $lat = $geocode->getLat();
        $lng = $geocode->getLng();
    } else {
        $lat = $_GET['lat'];
        $lng = $_GET['lng'];
    }

    //list cloest point of interests
    // $pois = ["Bus Stop", "Lidl", "Sainsbury", "Aldi", "Costco", "Iceland", "Bar", "School", "Hotel"];
    $pois =[
        "Bus Stop",
        // "Lidl",
        // "Tesco",
        // "Sainsbury",
        // "Bar",
        // "School",
        // "Hotel"
    ];
    $origin = $lat.",".$lng;
    // $toBus = distanceToClosest($origin, 'bus stop');
    // $res["poi"]["Bus Stop"] = $toBus;
    foreach($pois as $poi){
        $res["poi"][$poi] = distanceToClosest($origin, $poi);
    }

    echo json_encode($res);

    function distanceToClosest($origin, $type){
        global $fp, $dm;
        $fp->curl($origin, $type);
        $destination = $fp->getLat().",".$fp->getLng();
        $dm->curl($origin, $destination);
        return $dm->getDuration();
    }