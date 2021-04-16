<?php
    include_once '../config/db.php';
    $title= "Registration | GUNI HMS";
    $page_name= "Login";

    // Insert and other commands from here
    if (isset($_POST['submit'])) {
        $sql = "INSERT INTO patient_mst(u_name, pname, gend, dob, allergy, blood_gr) values($_POST[u_name],$_POST[pat_name], $_POST[gender], $_POST[dob], $_POST[allergy], $_POST[bloodgrp])";
        if ($qsql = mysqli_query($con, $sql)) {
            echo "<script>alert('You are registered successfully. Your Login Id is $_POST[u_name] and password is ********');</script>";
            $insid = mysqli_insert_id($con);
        } 
        else {
            echo mysqli_error($con);
        }
    }
?>
<!DOCTYPE html>
<html>
<?php
    include_once '../comps/head.php';
?>
<body>
    <?php
        include_once '../comps/header.php';
    ?>
    <main>
        <div class="container">
            <div class="form-container contact-form">
                <form method="post" action="" class="contact" name="reg-form">
                    <h2 class="heading">Registration Form</h2>

                    <label class="mt" for="fname">Personal Details</label>
                    <input name="pat-name" type="text" placeholder="Full Name"/>
                    <input name="pat-phone" type="tel" placeholder="Contact No"/>
                    <h6 class="label">Date of birth</h6>
                    <input name="dob" type="date" placeholder="Date of birth"/>
                    
                    
                    <select name="gender">
                        <option selected value="Null">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>

                    <label class="mt" for="state">Address</label>
                    <select name="state">
                        <option selected>Select State</option>
                        <option>Gujarat</option>
                        <option>Maharastra</option>
                        <option>Madhyapradesh</option>
                    </select>

                    <select name="dist">
                        <option selected>Select District</option>
                        <option>Mehsana</option>
                        <option>Ahmedabad</option>
                    </select>

                    <textarea name="add-line" type="text" placeholder="House No, Street Name" rows="2"></textarea>

                    <input name="vil-city" type="text" placeholder="Village/City"/>

                    <label class="mt" for="username">Credentials</label>
                    <input name="user-name" type="text" placeholder="Username"/>
                    <input name="password" type="password" placeholder="Password"/>
                    <input name="conf-pass" type="password" placeholder="Confirm Password"/>

                    <label class="mt" for="bloodgrp">Health Status</label>
                    
                    <select name="bloodgrp">
                        <option value="bn" selected>Blood group</option>
                        <option value="b1">A +ve</option>
                        <option value="b2">A -ve</option>
                        <option value="b3">B +ve</option>
                        <option value="b4">B -ve</option>
                        <option value="b5">AB +ve</option>
                        <option value="b6">AB -ve</option>
                        <option value="b7">O +ve</option>
                        <option value="b8">O -ve</option>
                    </select>

                    <input name="allergy" type="text" placeholder="Past/Permenanent Disease/Allergy"/>

                    <button name="submit" type="Submit">Register Now</button>

                    <p class="redirect">
                        Existing User! <a href="login.php">Login Now</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
