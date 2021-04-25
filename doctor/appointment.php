<?php
  $title = "My Appointments | GUNI HMS";
  $page_name = "appointment";

  include_once '../config/db.php';
  include_once '../models/AppointmentMaster.php';
  include_once '../models/AppointmentStatus.php';

  session_start();
  $user_name= $_SESSION["DOCTOR_USERNAME"];
  
  // Appointment
  $appointment_master = new AppointmentMaster();
  $appointment_list = $appointment_master->find_by_doctor($user_name);
?>
<!DOCTYPE html>
<html>
  <?php
include_once 'comps/head.php';
?>
  <body>
  <style>
    textarea{
      width: 95%;
      height: auto;
      display: block;
      overflow: hidden;
    }
    textarea ::placeholder{
      text-align: center;
    }
  </style>

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
                <th>Contact No</th>
                <th>Reason</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th colspan="2">Notify Message</th>
                <th class="hide"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo ($appointment_row->fullname); ?></td>
                <td><?php echo ($appointment_row->phone); ?></td>
                <td><?php echo ($appointment_row->reason); ?></td>
                <td><?php echo ($appointment_row->ap_date); ?></td>
                <td><?php echo ($appointment_row->ap_time); ?></td>
                <td colspan="2">
                  <textarea type="text" placeholder="Write Notify Message" rows="4">The appointment will be at <?php echo ($appointment_row->ap_time); ?>
                  </textarea>
                </td>
                <td>
                  <a href="#">Approve</a>
                  <hr />
                  <a href="#">Disapprove</a>
                </td>
              </tr>
            </tbody>
          </table>
          <?php endif;?>

          <?php if ($appointment_row->ap_date < date("Y-m-d")): ?>
          <table>
            <thead>
              <tr>
                <td class="center" colspan="6">Appointment History</td>
              </tr>
              <tr>
              <th>Patient Name</th>
              <th>Contact No</th>
              <th>Reason</th>
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
              <td><?php echo ($appointment_row->ap_date); ?></td>
              <td><?php echo ($appointment_row->ap_time); ?></td>
              <td><?php echo ($appointment_row->status); ?></td>
            </tr>
            </tbody>
          </table>
        <?php endif;?>
      <?php endforeach;?>
      </div>
    </div>
  </body>
</html>