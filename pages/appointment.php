<?php
    include_once '../config/db.php';
    $title= "Appointment Booking | GUNI HMS";
    $page_name= "Appointment";
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
                <form action="" class="contact">
                    <h2 class="heading">Appointment Booking</h2>
                    
                    <label class="mt" for="fname">Personal Details</label>
                    <input name="fname" type="text" placeholder="Full Name" />
                    <input type="tel" placeholder="Contact No"/>
                    <h6 class="label">Date of birth</h6>
                    <input type="date" placeholder="Date of birth"/>
                    <select>
                        <option selected>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>

                    <label class="mt" for="bloodgrp">Health Status</label>
                    <select name="bloodgrp">
                        <option selected>Select Blood Group</option>
                        <option>A +ve</option>
                        <option>A -ve</option>
                        <option>B +ve</option>
                        <option>B -ve</option>
                        <option>AB +ve</option>
                        <option>AB -ve</option>
                        <option>O +ve</option>
                        <option>O -ve</option>
                    </select>
                    <input type="text" placeholder="Past/Permenanent Disease"/>

                    <label class="mt" for="bloodgrp">Appointment Details</label>
                    <h6 class="label">Appointment Date</h6>
                    <input type="date" placeholder="Appointment Date"/>
                    <h6 class="label">Appointment Time</h6>
                    <input type="time" placeholder="Appointment Time"/>
                    <select name="department">
                        <option selected>Select Department</option>
                        <option>Physician</option>
                        <option>Neurosurgen</option>
                        <option>Nutrition</option>
                        <option>Cardiologist</option>
                    </select>
                    <select name="doctor">
                        <option selected>Select Doctor</option>
                        <option>Dr.Aakash</option>
                        <option>Dr.Aniruddh</option>
                        <option>Dr.Shubham</option>
                    </select>
                    <textarea name="reason" type="text" placeholder="Appointment Reason" rows="3"></textarea>

                    <label class="mt" for="state">Address</label>
                    <select name="state">
                        <option selected>Select State</option>
                        <option>Gujarat</option>
                        <option>Maharastra</option>
                        <option>Madhyapradesh</option>
                    </select>
                    <select>
                        <option selected>Select District</option>
                        <option>Mehsana</option>
                        <option>Ahmedabad</option>
                    </select>
                    <textarea name="add-line1" type="text" placeholder="House No, Street Name" rows="2"></textarea>
                    <input type="text" placeholder="Village/City"/>

                    <label class="mt" for="username">Credentials</label>
                    <input type="text" placeholder="Username"/>
                    <input type="password" placeholder="Password"/>
                    <input type="password" placeholder="Confirm Password"/>


                    <button type="Submit">Book Now</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
