<?php

$conn = mysqli_connect("localhost", "root", "", "ecebook");

if (!$conn){
    echo "Error connecting" . mysqli_connect_error();
}