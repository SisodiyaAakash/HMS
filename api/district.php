<?php 
    $state_id = $_GET['state_id'];

    include_once "../models/District.php";

    if (isset($state_id) && !empty($state_id)) {
        $district = new District();
        $district_list = $district -> find_by_state($state_id);

        header('Content-Type: application/json');

        echo(json_encode($district_list));
    }
?>