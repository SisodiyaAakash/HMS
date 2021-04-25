<?php
    $title = "Admin Profile | GUNI HMS";
    $page_name = "admin_profile";

    include_once '../config/db.php';
    include_once '../models/AdminMaster.php';
    include_once '../models/AdminCredential.php';

    session_start();
    $uname= $_SESSION["ADMIN_USERNAME"];
    
    if (isset($INPUT['submit'])) {
        
        // admin Master Table (admin_master)
        $f_name = $INPUT['admin-name'];
        $uname = $INPUT['user-name'];
        
        $master_payload = array(
            "fname" => $f_name,
            "user_name" => $uname,
        );
        $admin_master = new adminMaster();
        $admin_master -> update($master_payload);
        
        // admin credentials table (admin_cred)
        $password = $INPUT['password'];
        $cred_payload = array(
            "u_name" => $uname,
            "password" => $password
        );
        $cred_instance = new adminCredential();
        $cred_instance -> update($cred_payload);
        
        init_admin_session($uname, $password);
        echo '<script>alert("Profile updated successfuly")</script>';
    }
    $admin_master = new adminMaster();
    $master_list = $admin_master->find_by_uname($uname);

    // Contact Info Table Data Fetching
    $admin_credential = new adminCredential();
    $credential_list = $admin_credential->find_by_uname($uname);

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
        <div class="form-container contact-form">
                <form name="admin-profile" method="post" class="contact" onsubmit="return validateform();">
                    <h2 class="heading">Update Your Profile</h2>
                    
                    <?php foreach($master_list as $master_row): ?>
                    <input name="admin-name" type="text" value="<?php echo($master_row->fname);?>" placeholder="Full Name"/>
                    <?php endforeach; ?>

                    <?php foreach($credential_list as $credential_row): ?>
                    <label class="mt" for="username">Credentials</label>
                    <input name="user-name" type="text" value="<?php echo($credential_row->u_name);?>" placeholder="Username"/>
                    <input name="password" type="password" value="<?php echo($credential_row->password);?>" placeholder="Password"/>
                    <input name="conf-pass" type="password" value="<?php echo($credential_row->password);?>" placeholder="Confirm Password"/>
                    <?php endforeach; ?>

                    <button name="submit" type="submit" id="submit" value="submit">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="../files/validate.js"></script>
<script>
    // document.forms['admin-profile'].addEventListener('submit', validateform);
    // Validation Script
    function validateform(event)
    {
        const form = document.forms['admin-profile'];

        if (!form) {
            alert("Can't find form");
            return;
        }

        // validate admin name
        const nameInput = form['admin-name'];
        if (nameInput.value.length === 0) {
            alert("Require full name");
            nameInput.focus();
            return false;
        }
        else if (alphaspaceExp.test(nameInput.value) === false) {
            alert("Invalid name");
            nameInput.focus();
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
    }
</script>
</html>
