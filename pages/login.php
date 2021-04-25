<?php
    include_once '../config/db.php';
    include_once '../models/PatientCredential.php';
    include_once '../lib/utils.php';

    $title= "Patient Login | GUNI HMS";
    $page_name= "Login";

    $INPUT = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (isset($INPUT['submit'])) {

        $uname = $INPUT['user-name'];
        $password = $INPUT['password'];

        $cred_payload = array(
            "u_name" => $uname,
            "password" => $password
        );

        init_patient_session($uname, $password);

        header("Location: /patient/dashboard.php");
        $patient_cred= new PatientCredential();
        $cred_list= $patient_cred->find_by_uname_password($uname, $password);
    }
?>
<!DOCTYPE html>
<html>
<?php
    include_once '../comps/head.php';
?>
<body>
    <style>
        .form-container{
            margin-top: 8rem;
        }
    </style>
    <?php
        include_once '../comps/header.php';   
    ?>
    <main>
        <div class="container">
            <div class="form-container">
                <form method="post" name="login-form" action="" class="contact" onsubmit="return validateform();">
                    <h2 class="heading">Login Form</h2>
                    <input name="user-name" type="text" placeholder="Username"/>
                    <input name="password" type="password" placeholder="Password">
                    <button id="submit" value="submit" name="submit" type="submit">Login Now</button>

                    <p class="redirect">
                        New User! <a href="registration.php">Register Now</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
<script src="../files/validate.js"></script>
<script>
    // const regForm = document.forms['login-form'];

    // if (regForm) {
    //     regForm.addEventListener('submit', validateform);
    // }

    // Validation Script
    function validateform(event)
    {
        event.preventDefault();
        const form = document.forms['login-form'];

        if (!form) {
            alert("Can't find form");
            return;
        }

        // Validation script
        const uNameInput = form['user-name'];
        if (uNameInput.value.length === 0) {
            alert("Require user name");
            return false;
        }
        else if (uNameInput.value.length <= 8) {
            alert("Username length must be more than 8 characters");
            return false;
        }
        else if (usernameExp.test(vilCityInput.value) === false) {
            alert("Invalid user name");
            return false;
        }

        const passInput = form['password'];
        if (passInput.value.length === 0) {
            alert("Require password");
            return false;
        }
        if (passInput.value.length <= 8) {
            alert("Password length must be more than 8 character");
            return false;
        }

        return true;
    }
</script>
</html>