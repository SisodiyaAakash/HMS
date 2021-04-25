<?php
  $title = "My Appointments | GUNI HMS";
  $page_name = "appointment";

  include_once '../config/db.php';
  include_once '../models/DepartmentMaster.php';
  include_once '../models/AppointmentMaster.php';
  include_once '../models/AppointmentStatus.php';

  session_start();
  // $p_username= $_SESSION["patient_uname"];
  $p_username= $_SESSION["PATIENT_USERNAME"];

  $INPUT = filter_var_array($_POST, FILTER_SANITIZE_STRING);
  if (isset($INPUT['submit'])) {
      // // Patient appointment table (appointment)
      $ap_date = $INPUT['appointment-date'];
      $ap_time = $INPUT['appointment-time'];
      $doct_uname = $INPUT['doctor'];
      $reason = $INPUT['reason'];

      $appointment_payload = array(
          "patient_uname" => $p_username,
          "ap_date" => $ap_date,
          "ap_time" => $ap_time,
          "doct_uname" => $doct_uname,
          "reason" => $reason,
      );

      $appointment_instance = new AppointmentMaster();
      $id=$appointment_instance->create($appointment_payload);

      $appoint_status_payload = array(
        "id" => $id
      );

      $appoint_status_instance = new AppointmentStatus();
      $appoint_status_instance->create($appoint_status_payload);
      
      echo '<script>alert("Appointment booked successfuly")</script>';
  }
  // Department Data Fetching
  $department_master = new DepartmentMaster();
  $department_list = $department_master->find();

  // Appointment 
  $appointment_master = new AppointmentMaster();
  $appointment_list = $appointment_master->find_by_uname($p_username);
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
        <div class="appointment-form">
          <form name="appointment-form" method="post" class="contact" onsubmit="return validateform();">
            <h2 class="heading">Book an appointment</h2>

            <label class="mt" for="appointment-date">Appointment Details</label>
                    <h6 class="label">Appointment Date</h6>
                    <input name="appointment-date" type="date" id="appointment-date-input" placeholder="Appointment Date"/>
                    <h6 class="label">Appointment Time</h6>
                    <input name="appointment-time" type="time" placeholder="Appointment Time"/>

                    <select name="department" id="department-input">
                        <option value="" selected>Select Department</option>
                        <?php foreach ($department_list as $department_row): ?>
                            <option value="<?php echo ($department_row->id); ?>"><?php echo ($department_row->dept); ?></option>
                        <?php endforeach;?>
                    </select>
                    <select name="doctor" id="doctor_input">
                        <option value="" selected>Select Doctor</option>
                        <?php foreach ($doctor_list as $doctor_row): ?>
                            <option value="<?php echo ($doctor_row->id); ?>"><?php echo ($doctor_row->dept); ?></option>
                        <?php endforeach;?>
                    </select>

                    <textarea name="reason" type="text" placeholder="Appointment Reason" rows="3"></textarea>
                    <button name="submit" type="submit" id="submit" value="submit">Book Now</button>
          </form>
        </div>

        <div class="desktop-hide">
            <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- upcoming appointments -->
        <?php foreach($appointment_list as $appointment_row): ?>
          <?php if ($appointment_row->ap_date > date("Y-m-d")): ?>
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
          </table>
          <?php endif;?>

          <?php if ($appointment_row->ap_date < date("Y-m-d")): ?>
            <table>
              <thead>
                <tr>
                  <td class="center" colspan="7">Appointment History</td>
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
            </table>
          <?php endif;?>
        <?php endforeach; ?>
      </div>
    </div>
  </body>
  <script>
    // Anni and Shubham I use Ajax functionality here to get doctors dropdown without reloading
    async function getDoctorList (departmentId) {
        const url = `/api/doctor.php?d_id=${departmentId}`;

        try {
            const response = await fetch(url);
            const data = await response.json();
            return data;
        }
        catch (error) {
            console.error(error);
            alert("Error while getting Doctor list");
        }

        return null;
    }

    document.getElementById('department-input').addEventListener('change', async function (event) {
        const departmentId = event.target.value;
        const doctorList = await getDoctorList(departmentId);

        if (!Array.isArray(doctorList)) {
            alert("Can't get valid doctor information");
            return;
        }

        // insert doctor rows to doctor dropdown
        const doctorInput = document.getElementById('doctor_input');

        const doptionList = Array.from(doctorInput.children);

        // remove current options
        doptionList.map(option => {
            if (option.value !== '') {
                option.remove();
            }
        })

        doctorList.forEach((doctor, index) => {
            const option = document.createElement('option');
            option.value = doctor.user_name;
            option.setAttribute('data-department-id', doctor.d_id);
            option.setAttribute('data-doct-uname', doctor.user_name);
            option.textContent = doctor.dname;

            doctorInput.appendChild(option);
        })
    })
</script>


<script src="../files/validate.js"></script>
<script>
    function getSystemDate () {
        const time = new Date();
        let dd = time.getDate() + 1,
              mm = String(time.getMonth() + 1),
              yyyy = time.getFullYear();

        if (mm.length === 1) {
            mm = '0'.concat(mm);
        }

        const dateString = [yyyy, mm, dd].join('-');
        return dateString;
    }
    const appointmentDateInput = document.getElementById("appointment-date-input");
    const systemDate = getSystemDate();
    appointmentDateInput.min = systemDate;

    // document.forms['appointment-form'].addEventListener('submit', validateform);
    // Validation Script
    function validateform(event)
    {
      const form = document.forms['appointment-form'];
      if (!form) {
          alert("Can't find form");
          return;
      }

      // Validate appointment date
      const appointmentDateInput = form['appointment-date'];
      if (appointmentDateInput.value == "") {
          alert("Require appointment date");
          appointmentDateInput.focus();
          return false;
      }

      // Validate appointment time
      const appointmentTimeInput = form['appointment-time'];
      if (appointmentTimeInput.value == "") {
        alert("Require appointment time");
        appointmentTimeInput.focus();
        return false;
      }

      // Validate department
      const departmentInput = form['department'];
      if (departmentInput.value == "") {
          alert("Select department");
          departmentInput.focus();
          return false;
      }

      // Validate doctor
      const doctorInput = form['doctor'];
          if (doctorInput.value == "") {
          alert("Select doctor");
          doctorInput.focus();
          return false;
      }

      // Validate appointment reason
      const reasonInput = form['reason'];
      if (reasonInput.value.length === 0) {
          alert("Require reason");
          reasonInput.focus();
          return false;
      }
      return true;
    }
</script>
</html>