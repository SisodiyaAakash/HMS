<?php
    $title= "Treatment Records | GUNI HMS";
    $page_name= "treatment";

    include_once '../config/db.php';
    include_once '../models/PatientMaster.php';
    include_once '../models/TreatmentMaster.php';
    include_once '../models/TreatmentRecords.php';

    session_start();
    $user_name= $_SESSION["DOCTOR_USERNAME"];
  
    $INPUT = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (isset($INPUT['submit'])) {
        // // Treatment Records table (treatment_record)
        $p_uname = $INPUT['patient'];
        $t_id = $INPUT['treatment'];
        $description = $INPUT['treatmentdesc'];
        $duration = $INPUT['duration'];
        $start_date = $INPUT['treatmentdate'];
        $start_time = $INPUT['treatmenttime'];
        $cost = $INPUT['cost'];
  
        $treatment_record_payload = array(
            "p_uname" => $p_uname,
            "t_id" => $t_id,
            "description" => $description,
            "duration" => $duration,
            "start_date" => $start_date,
            "start_time" => $start_time,
            "d_uname" => $doct_uname,
            "cost" => $cost
        );
  
        $treatment_record_instance = new TreatmentRecords();
        $treatment_record_instance->create($treatment_record_payload);
        
        echo '<script>alert("Added treatment record successfuly")</script>';
    }
    // patient
    $patient_master = new PatientMaster();
    $patient_list = $patient_master->find();

    // treatment
    $treatment_master = new treatmentMaster();
    $treatment_list = $treatment_master->find_by_doctor($user_name);

    // treatment
    $treatment_record = new TreatmentRecords();
    $treatment_record_list = $treatment_record->find_by_doctor($user_name);
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
          <h2 class="heading">Add New Treatment Record</h2>
          
          <select name="patient" id="">
            <option value="">Select Patient</option>
            <?php foreach ($patient_list as $patient_row): ?>
              <option value="<?php echo ($patient_row->user_name); ?>"><?php echo ($patient_row->fullname); ?></option>
            <?php endforeach;?>
          </select>

          <select name="treatment" id="">
            <option value="">Select Treatment</option>
            <?php foreach ($treatment_list as $treatment_row): ?>
              <option value="<?php echo ($treatment_row->id); ?>"><?php echo ($treatment_row->treatment); ?></option>
            <?php endforeach;?>
          </select>
          <textarea name="treatmentdesc" placeholder="Treatment Description" id="" rows="3">We have to give body massage due to back swelling</textarea>
          
          <input value="3" name="duration" type="number" placeholder="Treatment Duration" />

          <h6 class="label">Treatment Date</h6>
          <input value="2021-05-25" name="treatmentdate" type="date" placeholder="Date" />

          <h6 class="label">Treatment Time</h6>
          <input value="05:50" name="treatmenttime" type="time" placeholder="Treatment Time" />

          <input value="1500" name="cost" type="number" placeholder="Treatment Cost" />

          <button  name="submit" id="submit" value="submit" type="submit">Add Treatment Record</button>
        </form>

        <div class="desktop-hide">
          <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- Treatment Records -->
        <h4 class="center">Recent Treatment Records</h4>
        <table>
          <thead>
            <tr>
              <th>Patient Name</th>
              <th>Treatment Description</th>
              <th>Treatment</th>
              <th>Treatment Duration</th>
              <th>Date</th>
              <th>Time</th>
              <th>Cost</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($treatment_record_list as $treatment_record_row): ?>
            <tr>
              <td><?php echo ($treatment_record_row->fullname); ?></td>
              <td><?php echo ($treatment_record_row->description); ?></td>
              <td><?php echo ($treatment_record_row->treatment); ?></td>
              <td><?php echo ($treatment_record_row->duration); ?></td>
              <td><?php echo ($treatment_record_row->start_date); ?></td>
              <td><?php echo ($treatment_record_row->start_time); ?></td>
              <td><?php echo ($treatment_record_row->cost); ?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>

        <!-- Treatment History -->
        <!-- <h4 class="center">Treatment Record History</h4>
        <table>
          <thead>
            <tr>
              <th>Treatment Description</th>
              <th>Treatment</th>
              <th>Treatment Duration</th>
              <th>Date</th>
              <th>Time</th>
              <th>Cost</th>
              <th class="hide"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                Recover the right side body paralysis due to high blood pressure
              </td>
              <td>Physical Therapy</td>
              <td>14 Days</td>
              <td>08 April 2021</td>
              <td>3:00:00</td>
              <td>3:00:00</td>
              <td>
                <a href="#">Delete Record</a>
              </td>
            </tr>
            <tr>
              <td>
                Recover the right side body paralysis due to high blood pressure
              </td>
              <td>Physical Therapy</td>
              <td>14 Days</td>
              <td>08 April 2021</td>
              <td>3:00:00</td>
              <td>3:00:00</td>
              <td>
                <a href="#">Delete Record</a>
              </td>
            </tr>
          </tbody>
        </table> -->
      </div>
    </div>
  </body>
</html>
