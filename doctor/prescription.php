<?php
    $title= "My Prescribed Records | GUNI HMS";
    $page_name= "prescription";

    include_once '../config/db.php';
    include_once '../models/AppointmentMaster.php';
    include_once '../models/TreatmentMaster.php';
    include_once '../models/TreatmentRecords.php';
    include_once '../models/MedicineMaster.php';
    include_once '../models/PrescriptionRecord.php';

    session_start();
    $user_name= $_SESSION["DOCTOR_USERNAME"];

    $INPUT = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (isset($INPUT['submit'])) {
        // // prescription Records table (prescription_record)
        $ap_id = $INPUT['appointment'];
        $tr_id = $INPUT['treatment'];
        $medicine_id = $INPUT['medicine'];
        $dosage = $INPUT['dosage'];
        $note = $INPUT['note'];
  
        $prescription_payload = array(
            "d_uname" => $user_name,
            "ap_id" => $ap_id,
            "tr_id" => $tr_id,
            "medicine_id" => $medicine_id,
            "dosage" => $dosage,
            "note" => $note
        );
  
        $prescription_instance = new PrescriptionRecords();
        $prescription_instance->create($prescription_payload);
        
        echo '<script>alert("Prescribed medicine successfuly")</script>';
    }
    
    // appointment
    $appointment_master = new AppointmentMaster();
    $appointment_list = $appointment_master->find_by_doctor($user_name);
    
    // treatment
    $medicine_master = new MedicineMaster();
    $medicine_list = $medicine_master->find();
    
    // treatment
    $treatment_record = new TreatmentRecords();
    $treatment_record_list = $treatment_record->find_by_doctor($user_name);
    
    // prescription record
    $prescription_record = new PrescriptionRecords();
    $prescription_record_list = $prescription_record->find_by_doctor($user_name);
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
        <form name="treatment" method="post" action="" class="contact">
          <h2 class="heading">Prescribe Medicine</h2>
          
          <select name="appointment" id="">
            <option selected value="NULL">Select Appointment</option>
            <?php foreach ($appointment_list as $appointment_row): ?>
              <option value="<?php echo ($appointment_row->id); ?>"><?php echo ($appointment_row->fullname); ?>'s appointment on <?php echo ($appointment_row->ap_date); ?></option>
            <?php endforeach;?>
          </select>

          <select name="treatment" id="">
            <option selected value="NULL">Select Treatment</option>
            <?php foreach ($treatment_record_list as $treatment_record_row): ?>
              <option value="<?php echo ($treatment_record_row->id); ?>"><?php echo ($treatment_record_row->fullname); ?>'s treatment on <?php echo ($treatment_record_row->start_date); ?></option>
            <?php endforeach;?>
          </select>

          <select name="medicine" id="">
            <option selected value="">Select Medicine</option>
            <?php foreach ($medicine_list as $medicine_row): ?>
              <option value="<?php echo ($medicine_row->id); ?>"><?php echo ($medicine_row->medicine); ?></option>
            <?php endforeach;?>
          </select>
 
          <input name="dosage" type="text" placeholder="Dosage (Ex: 1-0-1)" />
          <input name="note" type="text" placeholder="Note" />

          <button  name="submit" id="submit" value="submit" type="submit">Prescribe Medicine</button>
        </form>

        <div class="desktop-hide">
          <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- Treatment Records -->
        <table>
          <thead>
            <tr>
                <td class="center" colspan="3">Presciption Records</td>
            </tr>

            <tr>
              <th>Appointment ID</th>
              <th>Treatment ID</th>
              <th>Medicine</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($prescription_record_list as $prescription_row): ?>
            <tr>
              <td><?php echo ($prescription_row->ap_id); ?></td>
              <td><?php echo ($prescription_row->tr_id); ?></td>
              <td><?php echo ($prescription_row->medicine); ?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
