<?php
    $title= "All Prescription Records | GUNI HMS";
    $page_name= "prescription";

    include_once '../config/db.php';
    include_once '../models/PrescriptionRecord.php';

    session_start();
    $user_name= $_SESSION["ADMIN_USERNAME"];

    // prescription record
    $prescription_record = new PrescriptionRecords();
    $prescription_record_list = $prescription_record->find_for_admin();
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
        <!-- Treatment Records -->
        <table>
          <thead>
            <tr>
                <td class="center" colspan="6">Presciption Records</td>
            </tr>

            <tr>
              <th>Patient Name</th>
              <th>Doctor Name</th>
              <th>Appointment ID</th>
              <th>Treatment ID</th>
              <th>Medicine</th>
              <th>Dosage</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($prescription_record_list as $prescription_row): ?>
            <tr>
              <td><?php echo ($prescription_row->fullname); ?></td>
              <td><?php echo ($prescription_row->dname); ?></td>
              <td><?php echo ($prescription_row->ap_id); ?></td>
              <td><?php echo ($prescription_row->tr_id); ?></td>
              <td><?php echo ($prescription_row->medicine); ?></td>
              <td><?php echo ($prescription_row->dosage); ?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
