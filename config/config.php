<?php

ob_start(); // turns on output buffering
session_start(); // starts the session

$timezone = date_default_timezone_set("Europe/London");

$con = mysqli_connect("localhost", "root", "", "piconom_final"); // connection variable

if(mysqli_connect_errno()){
  echo "Failed to connect: " . mysqli_connect_errno();
}

?>