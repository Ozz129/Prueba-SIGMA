<?php
include('conx_bd.php');

$sql = "INSERT INTO contacts (name, email, state, city) VALUES 
('".$_POST['name']."','".$_POST['email']."','".$_POST['department']."','". utf8_decode($_POST['city'])."')";

if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
  }
  
  $mysqli->close();
