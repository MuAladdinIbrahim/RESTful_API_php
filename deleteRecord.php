<?php
require "dbclass.php";
$db = new DbLab();
$del=$db->deleteUser($_GET["name"]);
var_dump($_GET["name"]);
header("location:lab4php.php");

