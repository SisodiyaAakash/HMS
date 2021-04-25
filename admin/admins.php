<?php
    $title= "Admins | GUNI HMS";
    $page_name= "admins";
    
    include_once '../config/db.php';
    include_once '../models/AdminMaster.php';
    include_once '../models/AdminCredential.php';

    // session_start();
    $INPUT = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (isset($INPUT['submit'])) {

        // admin Master Table (admin_master)
        $uname = $INPUT['user-name'];
        $full_name = $INPUT['admin-name'];

        $master_payload = array(
            "fname" => $full_name,
            "user_name" => $uname
        );
        
        $admin_master = new AdminMaster();
        $admin_master -> create($master_payload);
        
        // admin Credential table
        $password = $INPUT['password'];
        $credential_payload = array(
          "u_name" => $uname,
          "password" => $password,
        );

        $admin_cred = new AdminCredential();
        $admin_cred -> create($credential_payload);

        echo '<script>alert("New admin added successfully")</script>';
    }
    // admin
    $admin_master = new adminMaster();
    $admin_list = $admin_master->find();
  ?>
<!adminYPE html>
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
        <h2 class="heading">admins</h2>

        <form name="admin-form" method="post" class="contact" onsubmit="return validateform();">
          <h2 class="heading">Add New admin</h2>
          <input name="admin-name" type="text" placeholder="Full Name"/>
            <br/>
          <input name="user-name" type="text" placeholder="Username"/>
          <input name="password" type="password" placeholder="Password"/>
          <input name="conf-pass" type="password" placeholder="Confirm Password"/>

          <button name="submit" type="submit" id="submit" value="submit">Add Admin</button>
        </form>

        <div class="desktop-hide">
            <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- admins lists-->
        <table>
          <thead>
            <tr>
              <td class="center" colspan="3">GUNI's Admins</td>
            </tr>
            <tr>
              <th>Admin Name</th>
              <th>User Name</th>
              <th class="hide"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($admin_list as $admin_row): ?>
            <tr>
              <td><?php echo ($admin_row->fname);?></td>
              <td><?php echo ($admin_row->user_name); ?></td>
              <td><a href="#">Delete Admin</a></td>
            </tr>
          </tbody>
            <?php endforeach;?>
        </table>
      </div>
    </div>
  </body>
  <script>
      document.forms['admin-form'].addEventListener('submit', validateform);
      // Validation Script
      function validateform(event)
      {
          const form = document.forms['admin-form'];

          if (!form) {
              alert("Can't find form");
              return;
          }

          // validate patient name
          const nameInput = form['admin-name'];
          if (nameInput.value.length === 0) {
              alert("Require admin name");
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