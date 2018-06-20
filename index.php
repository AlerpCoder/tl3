<?php
include_once("php/quotes.php");
include_once("php/db_link.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Der Lauftracker</title>
    <meta charset="utf-8">

    <!-- Logo: Silk Icons http://www.famfamfam.com/lab/icons/silk/ -->
    <link rel="icon" href="logo.png" type="image/png">

    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <style>
        html {
            overflow-y: scroll;
        }
    </style>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
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
            <li class="nav-item active">
                <a class="nav-link" href="#">Startseite<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="statistik.php">Statistik</a>
            </li>
        </ul>

    </div>
</nav>
<div class="container-fluid bg-secondary text-center text-light">
    <h4 class="p-3 font-weight-bold">
        <?php
        echo $quotes[rand(0, count($quotes) - 1)] ?>
    </h4>
</div>
<div class="m-5">
    <h3 class="text-center font-weight-bold">Neuen Lauf eintragen</h3>

    <form action="php/addEntry.php" method="POST">
        <div class="form-group">
            <label for="date">Datum</label>
            <input type="date" class="form-control" id="date" name="date" aria-describedby="dateHelp"
                   placeholder="tt.mm.jjjj"
                   required>
        </div>
        <div class="form-group">
            <label for="duration">Dauer</label>
            <input type="number" class="form-control" id="duration" name="duration" aria-describedby="durationHelp"
                   placeholder="Dauer"
                   required>
            <small id="durationHelp" class="form-text text-muted">Einheit: Minuten</small>
        </div>
        <div class="form-group">
            <label for="route">Strecke</label>
            <input type="number" class="form-control" id="route" name="route" aria-describedby="routeHelp"
                   placeholder="Distanz"
                   required>
            <small id="routeHelp" class="form-text text-muted">Einheit: Kilometer (km)</small>
        </div>
        <button type="submit" class="btn btn-primary">Eintragen</button>
    </form>
</div>
<div class="m-5">
    <h3 class="text-center font-weight-bold">Bisherige Läufe</h3>
    <div class="row">
        <?php
        $result = get_all_entries();
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['ID'];
            $date = $row['Datum'];
            $duration = $row['Dauer'];
            $route = $row['Distanz'];
            echo "
            <div class='col-sm-6'>
                <div class='card m-3'>
                    <div class='card-body'>
                        <dl>
                            <dt>Datum</dt>
                            <dd>" . $date . "</dd>
                             <dt>Dauer</dt>
                            <dd>" . $duration . " Minuten</dd>
                             <dt>Distanz</dt>
                            <dd>" . $route . " km</dd>
                             <dt>Geschwindigkeit - Pace</dt>
                            <dd> " . round(($route / ($duration / 60)), 2) . " km/h - " . round(($duration / $route), 2) . " Min/km</dd>
                        </dl>
                        <form action='php/deleteEntry.php' method='POST'>
                            <input type='hidden' name='id' value='" . $id . "'>
                            <input type='submit' value='L&ouml;schen' class='btn btn-danger'>
                        </form>
                    </div>
                </div>
            </div>  
                    ";
        }
        ?>

    </div>
</div>
</body>
</html>
