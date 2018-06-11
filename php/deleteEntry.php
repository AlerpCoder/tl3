<?php
include_once("db_link.php");

$result = $_POST;

delete_entry($result['id']);

header("Location:../index.php");