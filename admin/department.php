<?php
    $title= "Departments | GUNI HMS";
    $page_name= "department";
    
    include_once '../config/db.php';
    include_once '../models/DepartmentMaster.php';

    // session_start();
    $INPUT = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (isset($INPUT['submit'])) {

        // Doctor Master Table (doctor_master)
        $department = $INPUT['dept'];

        $master_payload = array(
            "dept" => $department
        );
        
        $department_master = new DepartmentMaster();
        $department_master -> create($master_payload);

        echo '<script>alert("New department added successfully")</script>';
    }
    // department Data Fetching
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
        <h2 class="heading">Department Records</h2>
        <form name="department-form" method="post" class="contact" onsubmit="return validateform();">
          <h2 class="heading">Add New Department</h2>
          <input name="dept" type="text" placeholder="Department Name"/>
          <button name="submit" type="submit" id="submit" value="submit">Add department</button>
        </form>

        <div class="desktop-hide">
            <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- Doctors lists-->
        <table>
          <thead>
            <tr>
              <td class="center" colspan="2">Department List</td>
            </tr>
            <tr>
              <th>ID</th>
              <th>Department Name</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($department_list as $department_row): ?>
            <tr>
              <td><?php echo ($department_row->id); ?></td>
              <td><?php echo ($department_row->dept); ?></td>
            </tr>
          </tbody>
            <?php endforeach;?>
        </table>
      </div>
    </div>
  </body>
  <script>
      // document.forms['department-form'].addEventListener('submit', validateform);
      // Validation Script
      function validateform(event)
      {
          const form = document.forms['department-form'];

          if (!form) {
              alert("Can't find form");
              return;
          }

          // validate department name
          const nameInput = form['dept'];
          if (nameInput.value.length === 0) {
              alert("Require department name");
              nameInput.focus();
              return false;
          }
          else if (alphaspaceExp.test(nameInput.value) === false) {
              alert("Invalid name");
              nameInput.focus();
              return false;
          }
          return true;
      }
  </script>
</html>