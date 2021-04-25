<?php
    // include_once '../config/db.php';
    include_once '../models/Gender.php';

    function get_gender_list(){
        $gender = new Gender();
        print_r($gender);
    }
    get_gender_list();
?>