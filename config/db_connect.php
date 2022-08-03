<?php
    $conn = mysqli_connect('localhost', 'muri', 'admin','pizza');
    if(!$conn){
        echo 'Connection error '.mysqli_connect_error();
    }
?>