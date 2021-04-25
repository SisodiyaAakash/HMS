<?php
    include_once '../config/db.php';
    include_once '../models/Gender.php';
    include_once '../models/BloodGroup.php';
    include_once '../models/StateMaster.php';
    include_once '../models/PatientMaster.php';
    include_once '../models/PatientCredential.php';
    include_once '../models/PatientContactInfo.php';
    include_once '../lib/utils.php';

    $title= "Registration | GUNI HMS";
    $page_name= "Registration";
    
    $INPUT = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    if (isset($INPUT['submit'])) {
        
        // Patient Master Table (patient_master)
        $full_name = $INPUT['pat-name'];
        $uname = $INPUT['user-name'];
        $dob = $INPUT['dob'];
        $gend = $INPUT['gender']; //This have gender id of gender_master table
        $bg = $INPUT['bloodgrp']; //This have the bloodgroup ID data of bg_master table
        $pr_dieases = (isset($INPUT['allergy']))? $INPUT['allergy']: NULL; 
        // $aadhar = $INPUT['aadhar']; 
        
        $master_payload = array(
            "fullname" => $full_name,
            "user_name" => $uname,
            "dob" => $dob,
            "gender" => $gend,
            "bg_id" => $bg,
            "pd" => $pr_dieases,
            "aadhar" => NULL
        );
        
        $patient_master = new PatientMaster();
        $patient_master -> create($master_payload);
        
        // Patient credentials table (patient_cred)
        
        $password = $INPUT['password'];
        
        $cred_payload = array(
            "u_name" => $uname,
            "password" => $password
        );
        
        $cred_instance = new PatientCredential();
        $cred_instance -> create($cred_payload);

        // // Patient contact information table (pat_contact_info)
        $phone = $INPUT['pat-phone'];
        $state_name = $INPUT['state']; //This have the state id of state_master table
        $district = $INPUT['dist']; //This have district id of dist_master table
        $adr_line = $INPUT['adr-line']; 
        $vil_city = $INPUT['vil-city'];

        $contact_payload = array(
            "user_name"=> $uname,
            "phone" => $phone,
            "dist_id" => $district,
            "address_line" => $adr_line,
            "city_village" => $vil_city
        );
        
        $contact_instance = new PatientContactInfo();
        $contact_instance -> create($contact_payload);

        init_patient_session($uname, $password);

        header("Location: /patient/dashboard.php");
    }

    // Gender Data Fetching
    $gender= new Gender();
    $gender_list= $gender->find();

    // Bloodgroup Data Fetching
    $blood_group= new BloodGroup();
    $bg_list= $blood_group->find();    
    
    // State Master Data Fetching
    $states= new StateMaster();
    $state_list= $states->find();  
?>
<!DOCTYPE html>
<html>
<?php include_once '../comps/head.php'; ?>
<body>
    <?php include_once '../comps/header.php'; ?>
    <main>
        <div class="container">
            <div class="form-container contact-form">
                <form name="reg-form" method="post" class="contact" onsubmit="return validateform();">
                    <h2 class="heading">Appointment Form</h2>

                    <label class="mt" for="fname">Personal Details</label>
                    <input name="pat-name" type="text" placeholder="Full Name"/>
                    <input name="pat-phone" type="tel" placeholder="Contact No"/>
                    <h6 class="label">Date of birth</h6>
                    <input name="dob" type="date" placeholder="Date of birth"/>

                    <select name="gender">
                        <option selected value="">Select Gender</option>
                        <?php foreach($gender_list as $gender_row): ?>
                            <option value="<?php echo($gender_row->id);?>"><?php echo($gender_row->gender); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label class="mt" for="state">Address</label>
                    <select name="state" id="state-input">
                        <option selected value="">Select State</option>
                        <?php foreach($state_list as $state_row): ?>
                            <option value="<?php echo($state_row->id);?>"><?php echo($state_row->state_name); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <select name="dist" id="district_input">
                        <option selected value="">Select District</option>
                        <?php foreach($district_list as $dist_row): ?>
                            <option value="<?php echo($dist_row->id);?>"><?php echo($dist_row->district); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <textarea name="adr-line" type="text" placeholder="House No, Street Name" rows="2"></textarea>

                    <input name="vil-city" type="text" placeholder="Village/City"/>

                    <label class="mt" for="username">Credentials</label>
                    <input name="user-name" type="text" placeholder="Username"/>
                    <input name="password" type="password" placeholder="Password"/>
                    <input name="conf-pass" type="password" placeholder="Confirm Password"/>

                    <label class="mt" for="bloodgrp">Health Status</label>
                    <select name="bloodgrp">
                        <option value="" selected>Blood group</option>
                        <?php foreach($bg_list as $bg_row): ?>
                            <option value="<?php echo($bg_row->id);?>"><?php echo($bg_row->bgname); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input name="allergy" type="text" placeholder="Past/Permenanent Disease/Allergy"/>

                    <button name="submit" type="submit" id="submit" value="submit">Register Now</button>

                    <p class="redirect">
                        Existing User! <a href="login.php">Login Now</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>

<script>
    // Anni and Shubham I use Ajax functionality here to get district dropdown without reloading
    async function getDistrictList (stateId) {
        const url = `/api/district.php?state_id=${stateId}`;

        try {
            const response = await fetch(url);
            const data = await response.json();
            return data;
        }
        catch (error) {
            console.error(error);
            alert("Error while getting District list");
        }

        return null;
    }

    document.getElementById('state-input').addEventListener('change', async function (event) {
        const stateId = event.target.value;

        if (!stateId) {
            alert("Something went wrong! can't get state id");
            return;
        }

        const districtList = await getDistrictList(stateId);

        if (!Array.isArray(districtList)) {
            alert("Can't get valid district information");
            return;
        }

        // insert district rows to district dropdown
        const districtInput = document.getElementById('district_input');

        const optionList = Array.from(districtInput.children);

        // remove current options
        optionList.map(option => {
            if (option.value !== '') {
                option.remove();
            }
        })
        
        districtList.forEach((district, index) => {
            const option = document.createElement('option');
            option.value = district.id;
            option.setAttribute('data-state-id', district.sid);
            option.setAttribute('data-dist-id', district.id);
            option.textContent = district.district;

            districtInput.appendChild(option);
        })
    })

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

    // document.forms['reg-form'].addEventListener('submit', validateform);
    // Validation Script
    function validateform(event)
    {
        const form = document.forms['reg-form'];

        if (!form) {
            alert("Can't find form");
            return;
        }

        // validate patient name
        const nameInput = form['pat-name'];
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
        
        // Validate patient phone number
        const phoneInput = form['pat-phone'];
        if (phoneInput.value.length === 0) {
            alert("Require contact number");
            phoneInput.focus();
            return false;
        }
        else if (phoneInput.value.length > 10){
            alert("Invalid contact number");
            phoneInput.focus();
            return false;
        }
        else if (numericExp.test(phoneInput.value) === false) {
            alert("Invalid contact number");
            phoneInput.focus();
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

        // Validate State
        const stateInput = form['state'];
        if (stateInput.value == "") {
            alert("Select state");
            stateInput.focus();
            return false;
        }

        // Validate district
        const distInput = form['dist'];
        if (distInput.value == "") {
            alert("Select district");
            distInput.focus();
            return false;
        }

        // Validate address line 
        const adrLineInput = form['adr-line'];
        if (adrLineInput.value.length === 0) {
            alert("Require house no or street name");
            adrLineInput.focus();
            return false;
        }
        else if (adrLineInput.value.length < 10) {
            alert("Require detailed address line");
            adrLineInput.focus();
            return false;
        }

        // Validate Village or City name
        const vilCityInput = form['vil-city'];
        if (vilCityInput.value.length === 0) {
            alert("Require village or city name");
            vilCityInput.focus();
            return false;
        }
        else if (vilCityInput.value.length >= 40) {
            alert("Your village or city name is too long");
            vilCityInput.focus();
            return false;
        }
        else if (alphaspaceExp.test(vilCityInput.value) === false) {
            alert("Invalid village or city name");
            vilCityInput.focus();
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

        // Validate Blood group
        const bgInput = form['bloodgrp'];
        if (bgInput.value === "") {
            alert("Select blood group");
            bgInput.focus();
            return false;
        }

        // Validate allergy
        const allergyInput = form['allergy'];
        if (allergyInput.value.length >= 40) {
            alert("Past/Permanent Disease or allergy name is too long");
            allergyInput.focus();
            return false;
        }
        return true;
    }
</script>
</html>