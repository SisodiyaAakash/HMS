<?php
    $title = "Patient Dashboard | GUNI HMS";
    $page_name = "dashboard";

    include_once '../config/db.php';
    include_once '../models/DepartmentMaster.php';
    include_once '../models/AppointmentMaster.php';
    include_once '../models/AppointmentStatus.php';    
    include_once '../models/PatientMaster.php';    

    session_start();
    $p_username= $_SESSION["PATIENT_USERNAME"];

        // Department Data Fetching
    $department_master = new DepartmentMaster();
    $department_list = $department_master->find();

    // Appointment 
    $appointment_master = new AppointmentMaster();
    $appointment_list = $appointment_master->find_by_uname($p_username);

    //Patient details fetching
    $patient_data = new PatientMaster();
    $patient_data_list = $patient_data->find_by_uname($p_username);
?>
<!DOCTYPE html>
<html>
    <?php
        include_once 'comps/head.php';
    ?>
  <body>
    <style>
        .msg-container{
            display: flex;
            flex-wrap: wrap;
        }
        .notify-card{
            margin: 12px;
            cursor: pointer;
            width: 30%;
            border: 1px solid #45474D;
            border-radius: 12px;
        }
        .adhar{
            width: 40%;
            height: 100px;
        }
        .notify-card:hover{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .notify-card .appointment-info{
            border-bottom: 1px solid #223E54;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 0.5rem;
            color: #223E54;
            font-size: calc(15px + 0.4vw);
        }
        .notify-card .msg{
            font-size: calc(10px + 0.4vw);
            padding: 0.5rem;
            color: #45474D;
        }
        @media screen and (max-width: 800px){
            .notify-card{
                width: 90%;
                margin-left: auto;
                margin-right: auto;
            }   
        }
    </style>
    <?php
        include_once 'comps/header.php';
    ?>
    <div class="pagearea">
        <div class="container">
            <div class="msg-container">
                <div class="notify-card">
                    <div class="appointment-info">
                        From Dr.Aakash Sisodiya
                        <br />
                        Date: 30 April 2021 at 2:30:00
                    </div>
                    <div class="msg">
                        Sorry we unable to consult you right now due to lack of resources now. Please wait for a week if possible.
                    </div>
                </div>

                <?php foreach($patient_data_list as $patient_data_row): ?>
                    <?php if($patient_data_row->aadhar==""): ?>
                        <div class="notify-card adhar">
                            <div class="appointment-info">
                                From HMS System
                            </div>
                            <div class="msg">
                                Please register your adhar number.
                            </div>
                        </div>
                    <?php endif;?>
                <?php endforeach; ?>

            </div>
            <div class="desktop-hide">
            <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- upcoming appointments -->
        <table>
          <thead>
            <tr>
              <td class="center" colspan="7">Upcoming Appointments</td>
            </tr>
            <tr>
              <th>Doctor</th>
              <th>Department</th>
              <th>Reason</th>
              <th>Appointment Date</th>
              <th>Appointment Time</th>
              <th>Status</th>
              <th class="hide"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($appointment_list as $appointment_row): ?>
            <tr>
              <td><?php echo($appointment_row->dname);?></td>
              <td><?php echo($appointment_row->dept); ?></td>
              <td><?php echo($appointment_row->reason);?></td>
              <td><?php echo($appointment_row->ap_date);?></td>
              <td><?php echo($appointment_row->ap_time);?></td>
              <td><?php echo($appointment_row->status);?></td>
              <td>
                <a href="#">View Report</a>
                <hr />
                <a href="#">Delete Appointment</a>
              </td>
            </tr>
          </tbody>
            <?php endforeach; ?>
        </table>
        </div>
    </div>
</body>
</html>
