<?php

$mysqli = new mysqli("178.128.146.252", "admin_sigmauser", "pfaDKIJyPF", "admin_sigmatest", 3306);
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

