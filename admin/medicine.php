<?php
    $title= "Doctors | GUNI HMS";
    $page_name= "medicine";
    
    include_once '../config/db.php';
    include_once '../models/MedicineMaster.php';

    // session_start();
    $INPUT = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (isset($INPUT['submit'])) {

        // Doctor Master Table (doctor_master)
        $medicine = $INPUT['medicine'];
        $used_for = $INPUT['purpose'];

        $master_payload = array(
            "medicine" => $medicine,
            "used_for" => $used_for
        );
        
        $medicine_master = new MedicineMaster();
        $medicine_master -> create($master_payload);

        echo '<script>alert("New medicine added successfully")</script>';
    }
    // Medicine Data Fetching
    $medicine_master = new MedicineMaster();
    $medicine_list = $medicine_master->find();
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
        <h2 class="heading">Medicine Records</h2>
        <form name="medicine-form" method="post" class="contact" onsubmit="return validateform();">
          <h2 class="heading">Add New Medicine</h2>
          <input name="medicine" type="text" placeholder="Medicine Name"/>
          <input name="purpose" type="text" placeholder="Used for"/>
          <button name="submit" type="submit" id="submit" value="submit">Add Medicine</button>
        </form>

        <div class="desktop-hide">
            <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- Doctors lists-->
        <table>
          <thead>
            <tr>
              <td class="center" colspan="2">Medicine List</td>
            </tr>
            <tr>
              <th>Medicine Name</th>
              <th>Used for</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($medicine_list as $medicine_row): ?>
            <tr>
              <td><?php echo ($medicine_row->medicine); ?></td>
              <td><?php echo ($medicine_row->used_for); ?></td>
            </tr>
          </tbody>
            <?php endforeach;?>
        </table>
      </div>
    </div>
  </body>
  <script>
      // document.forms['medicine-form'].addEventListener('submit', validateform);
      // Validation Script
      function validateform(event)
      {
          const form = document.forms['medicine-form'];

          if (!form) {
              alert("Can't find form");
              return;
          }

          // validate medicine name
          const nameInput = form['medicine'];
          if (nameInput.value.length === 0) {
              alert("Require medicine name");
              nameInput.focus();
              return false;
          }
          else if (alphanumericspaceExp.test(nameInput.value) === false) {
              alert("Invalid name");
              nameInput.focus();
              return false;
          }

          // validate purpose
          const purposeInput = form['purpose'];
          if (purposeInput.value.length === 0) {
              alert("Require purpose / used for what?");
              purposeInput.focus();
              return false;
          }
          else if (alphanumericspaceExp.test(purposeInput.value) === false) {
              alert("Invalid name");
              purposeInput.focus();
              return false;
          }
          return true;
      }
  </script>
</html>