<?php
$title = "All Appointments | GUNI HMS";
$page_name = "appointment";

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
    <?php
include_once 'comps/header.php';
?>
    <div class="pagearea">
      <div class="container">
        <div class="desktop-hide">
            <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- upcoming appointments -->
        <?php foreach ($appointment_list as $appointment_row): ?>
          <?php if ($appointment_row->ap_date > date("Y-m-d")): ?>
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
            </tbody>
          </table>
          <?php endif;?>

          <?php if ($appointment_row->ap_date < date("Y-m-d")): ?>
            <table>
            <thead>
              <tr>
                <td class="center" colspan="7">Appointments History</td>
              </tr>
              <tr>
                <th>Patient Name</th>
                <th>Patient Contact No</th>
                <th>Reason</th>
                <th>Department</th>
                <th>Doctor Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo ($appointment_row->fullname); ?></td>
                <td><?php echo ($appointment_row->phone); ?></td>
                <td><?php echo ($appointment_row->reason); ?></td>
                <td><?php echo ($appointment_row->dept); ?></td>
                <td><?php echo ($appointment_row->dname); ?></td>
                <td><?php echo ($appointment_row->ap_date); ?></td>
                <td><?php echo ($appointment_row->ap_time); ?></td>
              </tr>
            </tbody>
          </table>
          <?php endif;?>
        <?php endforeach;?>
      </div>
    </div>
  </body>
</html>