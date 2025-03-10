<?php
include_once("php/db_link.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Der Lauftracker</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/bootstrap.min.css"/>

    <!-- Logo: Silk Icons http://www.famfamfam.com/lab/icons/silk/ -->
    <link rel="icon" href="logo.png" type="image/png">

    <style>
        html {
            overflow-y: scroll;
        }
    </style>

    <script>
        var all_data = <?php echo json_encode((mysqli_fetch_all(get_all_entries()))); ?>;
    </script>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/d3.v4.js"></script>
    <script type="text/javascript" src="js/mychart.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Der Lauftracker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Startseite</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Statistik <span class=" sr-only">(current)</span></a>
            </li>
        </ul>

    </div>
</nav>
<h2>Scatterplot</h2>

<div class="container">
    <div class="row  justify-content-around">
        <div class="col-sm-12 col-md-8">

            <div id="chart_container">
                <svg class="border border-danger" preserveAspectRatio="xMinYMin" viewBox="0 0 500 500" id="chart"></svg>
                <div>
                </div>
            </div>
        </div>
</body>
</html>