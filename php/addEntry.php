<?php
include_once("db_link.php");

$result = $_POST;

add_entry($result['date'], $result['duration'], $result['route']);

header("Location:../index.php");