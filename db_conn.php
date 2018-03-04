<?php

$mysqli = new mysqli('localhost', 'tblan', '159357Qaz', 'tblan');

if (mysqli_connect_errno()) {
    echo "Connect failed:" . mysqli_connect_errno();
    exit();
}
?>
