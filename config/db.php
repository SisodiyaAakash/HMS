<?php
    $con=mysqli_connect("localhost","root","","hms");

    if (mysqli_connect_errno($con))
    {
        echo "Database connection problem please check database connection : " . mysqli_connect_error();
    }
?>