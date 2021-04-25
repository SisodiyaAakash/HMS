<?php
    $title= "Doctors | GUNI HMS";
    $page_name= "doctors";
    
    include_once '../config/db.php';
    include_once '../models/DoctorMaster.php';
    include_once '../models/Gender.php';
    include_once '../models/DepartmentMaster.php';
    include_once '../models/DoctorMaster.php';
    include_once '../models/DoctorCredential.php';
    include_once '../models/DoctorQualification.php';

    // session_start();
    $INPUT = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (isset($INPUT['submit'])) {

        // Doctor Master Table (doctor_master)
        $uname = $INPUT['user-name'];
        $full_name = $INPUT['doct-name'];
        $dob = $INPUT['dob'];
        $gend = $INPUT['gender']; //This have gender id of gender_master table

        $master_payload = array(
            "dname" => $full_name,
            "user_name" => $uname,
            "dob" => $dob,
            "gender" => $gend,
        );
        
        $doctor_master = new DoctorMaster();
        $doctor_master -> create($master_payload);
        
        // Doctor Credential table
        $password = $INPUT['password'];
        $credential_payload = array(
          "user_name" => $uname,
          "password" => $password,
        );

        $doctor_cred = new DoctorCredential();
        $doctor_cred -> create($credential_payload);

        // Doctor Qualification table
        $education = $INPUT['education']; 
        $experience = $INPUT['experience']; 
        $d_id = $INPUT['department'];

        $qualify_payload = array(
          "user_name" => $uname,
          "education" => $education,
          "experience" => $experience,
          "d_id" => $d_id
        );
        
        $doctor_cred = new DoctorQualification();
        $doctor_cred -> create($qualify_payload);

        echo '<script>alert("New doctor added successfully")</script>';
    }

    // Gender Data Fetching
    $gender= new Gender();
    $gender_list= $gender->find();

    // doctor
    $doctor_master = new DoctorMaster();
    $doctor_list = $doctor_master->find_doctor_details();

    // Department Data Fetching
    $department_master = new DepartmentMaster();
    $department_list = $department_master->find();
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
        <h2 class="heading">Doctors</h2>

        <form name="doctor-form" method="post" class="contact" onsubmit="return validateform();">

          <h2 class="heading">Add New Doctor</h2>
          <input name="doct-name" type="text" placeholder="Full Name"/>
          
          <h6 class="label">Date of birth</h6>
          <input name="dob" type="date" placeholder="Date of birth"/>

          <select name="gender">
            <option selected value="">Select Gender</option>
            <?php foreach($gender_list as $gender_row): ?>
              <option value="<?php echo($gender_row->id);?>"><?php echo($gender_row->gender); ?></option>
            <?php endforeach; ?>
          </select>

          <select name="department" id="department-input">
            <option value="" selected>Select Department</option>
            <?php foreach ($department_list as $department_row): ?>
              <option value="<?php echo ($department_row->id); ?>"><?php echo ($department_row->dept); ?></option>
            <?php endforeach;?>
          </select>
          <input name="education" type="text" placeholder="Qualification"/>
          <input name="experience" type="text" placeholder="Experience"/>
                    
          <label class="mt" for="username">Credentials</label>
          <input name="user-name" type="text" placeholder="Username"/>
          <input name="password" type="password" placeholder="Password"/>
          <input name="conf-pass" type="password" placeholder="Confirm Password"/>
          <button name="submit" type="submit" id="submit" value="submit">Add Doctor</button>
        </form>

        <div class="desktop-hide">
            <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- Doctors lists-->
        <table>
          <thead>
            <tr>
              <td class="center" colspan="5">GUNI's Expert Doctors</td>
            </tr>
            <tr>
              <th>Doctor Name</th>
              <th>DOB</th>
              <th>Department</th>
              <th>Qualification</th>
              <th>Experience</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($doctor_list as $doctor_row): ?>
            <tr>
              <td><?php echo ($doctor_row->dname); ?></td>
              <td><?php echo ($doctor_row->dob); ?></td>
              <td><?php echo ($doctor_row->dept); ?></td>
              <td><?php echo ($doctor_row->education); ?></td>
              <td><?php echo ($doctor_row->experience);?> Years</td>
            </tr>
          </tbody>
            <?php endforeach;?>
        </table>
      </div>
    </div>
  </body>
  <script>
      // document.forms['doctor-form'].addEventListener('submit', validateform);
      // Validation Script
      function validateform(event)
      {
          const form = document.forms['doctor-form'];

          if (!form) {
              alert("Can't find form");
              return;
          }

          // validate patient name
          const nameInput = form['doct-name'];
          if (nameInput.value.length === 0) {
              alert("Require doctor name");
              nameInput.focus();
              return false;
          }
          else if (alphaspaceExp.test(nameInput.value) === false) {
              alert("Invalid name");
              nameInput.focus();
              return false;
          }
  
          // Validate Date of birth
          const dobInput = form['dob'];
          if (dobInput.value == "") {
              alert("Require date of birth");
              dobInput.focus();
              return false;
          }

          // Validate Gender
          const genderInput = form['gender'];
          if (genderInput.value == "") {
              alert("Select gender");
              genderInput.focus();
              return false;
          }

          // Validate department
          const departmentInput = form['department'];
          if (departmentInput.value == "") {
              alert("Select department");
              departmentInput.focus();
              return false;
          }
          
          // Validate user name 
          const uNameInput = form['user-name'];
          if (uNameInput.value.length === 0) {
              alert("Require user name");
              uNameInput.focus();
              return false;
          }
          else if (uNameInput.value.length <= 8) {
              alert("Username length must be more than 8 characters");
              uNameInput.focus();
              return false;
          }
          else if (usernameExp.test(uNameInput.value) === false) {
              alert("Invalid user name");
              uNameInput.focus();
              return false;
          }

          // Validate password
          const passInput = form['password'];
          if (passInput.value.length === 0) {
              alert("Require password");
              passInput.focus();
              return false;
          }
          if (passInput.value.length <= 8) {
              alert("Password length must be more than 8 character");
              passInput.focus();
              return false;
          }

          // Validate confirm password
          const confPassInput = form['conf-pass'];
          if (confPassInput.value.length === 0) {
              alert("Require confirm password");
              confPassInput.focus();
              return false;
          }
          else if (confPassInput.value !== passInput.value) {
              alert("Confirm password is different from password");
              confPassInput.focus();
              return false;
          }
          return true;
      }
  </script>
</html>