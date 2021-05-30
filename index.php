<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMD Checker</title>
    <!-- Bootstrap & jQuery -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- My Own JS -->
    <script src="<?=getLastestVersion("myscript.js")?>"></script>
    <!-- My Own CSS -->
    <link rel="stylesheet" href="<?=getLastestVersion("mystyle.css")?>">
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h1>SIMD Checker</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Check By Post Code</h2>
                    </div>
                    <div class="card-body text-right">
                        <input type="text" name="postCode" id="postCode" class="form-control" placeholder="Enter Post Code">
                        <button class="btn btn-primary mt-3" id="submit-pc">Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Search By Address</h2>
                    </div>
                    <div class="card-body text-right">
                        <input type="text" name="addr" id="addr" class="form-control" placeholder="Enter (A Part of) Address">
                        <button class="btn btn-primary mt-3" id="submit-addr">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" id="result">
            <div class="card-header">
                <h2 id="result-pc">Result</h2>
            </div>
            <div class="card-body" id="result-body">
            </div>
        </div>   
    </div>
</body>
</html>
<?php

function getLastestVersion(string $fileName){
    return file_exists($fileName)?$fileName."?".filemtime($fileName):"";
}

?>