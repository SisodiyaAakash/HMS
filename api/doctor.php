<?php 
    $d_id = $_GET['d_id'];

    require_once("../models/DoctorMaster.php");

    if (isset($d_id) && !empty($d_id)) {
        $doctor = new DoctorMaster();
        $doctor_list = $doctor -> find_by_department($d_id);

        header('Content-Type: application/json');

        echo(json_encode($doctor_list));
    }
?>