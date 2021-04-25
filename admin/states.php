<?php
    $title= "States | GUNI HMS";
    $page_name= "states";
    
    include_once '../config/db.php';
    include_once '../models/stateMaster.php';

    // session_start();
    $INPUT = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (isset($INPUT['submit'])) {

        // Doctor Master Table (doctor_master)
        $state = $INPUT['state'];

        $master_payload = array(
            "state" => $state
        );
        
        $state_master = new stateMaster();
        $state_master -> create($master_payload);

        echo '<script>alert("New state added successfully")</script>';
    }
    // state Data Fetching
    $state_master = new StateMaster();
    $state_list = $state_master->find();
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
        <h2 class="heading">State Records</h2>
        <div class="form-flex">
            <form name="state-form" method="post" class="contact" onsubmit="return validateform();">
                <h2 class="heading">Add New State</h2>
                <input name="state" type="text" placeholder="State Name"/>
                <button name="submit" type="submit" id="submit" value="submit">Add state</button>
            </form>
        </div>

        <div class="desktop-hide">
            <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- Doctors lists-->
        <table>
          <thead>
            <tr>
              <td class="center" colspan="3">State List</td>
            </tr>
            <tr>
              <th>ID</th>
              <th>State Name</th>
              <th class="hide"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($state_list as $state_row): ?>
            <tr>
              <td><?php echo ($state_row->id); ?></td>
              <td><?php echo ($state_row->state_name); ?></td>
              <td><a href="#"><?php echo ($state_row->state_name); ?>'s Districts</a></td>
            </tr>
          </tbody>
            <?php endforeach;?>
        </table>
      </div>
    </div>
  </body>
  <script>
      // document.forms['state-form'].addEventListener('submit', validateform);
      // Validation Script
      function validateform(event)
      {
          const form = document.forms['state-form'];

          if (!form) {
              alert("Can't find form");
              return;
          }

          // validate state name
          const nameInput = form['state'];
          if (nameInput.value.length === 0) {
              alert("Require state name");
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