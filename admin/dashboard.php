<?php
    $title= "Admin Dashboard | GUNI HMS";
    $page_name= "dashboard";

    include_once '../config/db.php';
    include_once '../models/AppointmentMaster.php';
    include_once '../models/AppointmentStatus.php';

    // session_start();
    // Appointment
    $appointment_master = new AppointmentMaster();
    $appointment_list = $appointment_master->find_for_admin();
?>
<!DOCTYPE html>
<html>
<?php
    include_once 'comps/head.php';
?>
<body>
    <style>
        .card-dashboard{
            display:flex;
            flex-direction:column;
            max-width: 250px;
            padding: 1rem;
            border-radius: 18px;
        }
        .card-dashboard:hover{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .card-dashboard svg{
            margin-left: auto;
            margin-right: auto;
        }
        .card-dashboard h2{
            font-size:25px;
            text-align:center;
        }
    </style>
    <?php
      include_once 'comps/header.php';
    ?>
    <div class="pagearea">
        <div class="container">
            <table>
                <thead>
                <tr>
                    <td class="center" colspan="8">Upcoming Appointments</td>
                </tr>
                <tr>
                    <th>Patient Name</th>
                    <th>Patient Contact No</th>
                    <th>Reason</th>
                    <th>Department</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($appointment_list as $appointment_row): ?>
                <tr>
                    <td><?php echo ($appointment_row->fullname); ?></td>
                    <td><?php echo ($appointment_row->phone); ?></td>
                    <td><?php echo ($appointment_row->reason); ?></td>
                    <td><?php echo ($appointment_row->dept); ?></td>
                    <td><?php echo ($appointment_row->dname); ?></td>
                    <td><?php echo ($appointment_row->ap_date); ?></td>
                    <td><?php echo ($appointment_row->ap_time); ?></td>
                    <td><?php echo ($appointment_row->status); ?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            
            <div class="card-container">
                <a href="addtreatment.php">
                    <div class="card-dashboard">
                        <svg width="200" height="150" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 420.8 420.8" style="enable-background: new 0 0 420.8 420.8" xml:space="preserve">
                            <path
                            d="M413.6,204H378c14.8-33.6,13.2-60.8,7.6-79.2c-9.6-32.8-42-68.4-90-68.4c-12.8,0-25.6,2.4-38.8,7.2
                                    C234,72,218.8,81.2,212,86c-6.8-4.8-21.6-14-44.8-22.4c-13.2-4.8-26.4-7.2-38.8-7.2c-48,0-80.4,35.6-90,68.4
                                    c-5.6,19.6-7.6,49.2,11.2,86.4H6.4c-3.6,0-6.4,2.8-6.4,6.4c0,3.6,2.8,6.4,6.4,6.4h50.8c2,3.6,4.4,7.2,7.2,10.8
                                    c41.6,60,132,125.2,148.4,129.2v0.4c0,0,0.4,0,0.8-0.4c0.4,0,0.8,0,1.2,0v-0.4c14-6.8,100.8-62.8,146.4-129.2c4.4-6,8-12,11.2-18
                                    h42c3.6,0,6.4-2.8,6.4-6.4C420.8,206.4,417.2,204,413.6,204z M349.6,227.6c-42.4,62-120.4,112-137.2,122.8
                                    c-17.2-10.8-94.8-61.2-137.6-122.8c-0.8-1.2-1.6-2.4-2.4-3.6h58.8c2.4,0,4.8-1.2,6-3.6l26.8-52.8l42,107.6c0.8,2.4,3.6,4,6,4
                                    c0,0,0,0,0.4,0c2.8,0,5.2-2,6-4.8l36.8-126l19.6,63.6c0.8,2.4,2.8,4,5.2,4.4c2.4,0.4,4.8-0.8,6.4-2.8l15.6-22.8l13.2,22.4
                                    c1.2,2,3.2,3.2,5.6,3.2h36C354.4,220.4,352,224,349.6,227.6z M364,204h-39.2l-16.4-28c-1.2-2-3.2-3.2-5.6-3.2
                                    c-2.4,0-4.4,0.8-5.6,2.8l-13.6,20l-22-71.6c-0.8-2.8-3.6-4.4-6.4-4.8c-2.8,0-5.6,2-6.4,4.8l-37.2,128.4l-40.4-103.2
                                    c-0.8-2.4-3.2-4-5.6-4c-2.8,0-4.8,1.2-6,3.6l-31.6,62H64.4c-16-29.2-20.4-57.2-13.2-82.4c8.4-28.4,36-58.8,77.6-58.8
                                    c11.2,0,22.8,2.4,34.4,6.4c29.2,10.8,44.8,23.2,45.2,23.2c2.4,2,5.6,2,8,0c0,0,15.6-12.4,45.2-23.2c11.6-4.4,23.2-6.4,34.4-6.4
                                    c41.2,0,69.2,30.4,77.6,58.8C380.4,151.6,376.8,177.2,364,204z"
                            />
                        </svg>
                        <h2>Add Treatment Type</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
