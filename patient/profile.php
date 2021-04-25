<?php
    $title = "Patient Profile | GUNI HMS";
    $page_name = "patient_profile";

    include_once '../config/db.php';
    include_once '../models/PatientMaster.php';
    include_once '../models/PatientCredential.php';
    include_once '../models/PatientContactInfo.php';
    include_once '../models/StateMaster.php';
    include_once '../models/Gender.php';

    session_start();
    $p_username= $_SESSION["PATIENT_USERNAME"];
    
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
        $patient_master -> update($master_payload);
        
        // Patient credentials table (patient_cred)
        
        $password = $INPUT['password'];
        
        $cred_payload = array(
            "u_name" => $uname,
            "password" => $password
        );
        
        $cred_instance = new PatientCredential();
        $cred_instance -> update($cred_payload);
        
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
        $contact_instance -> update($contact_payload);
        
        init_patient_session($uname, $password);
        echo '<script>alert("Profile updated successfuly")</script>';
    }
    // Gender Data Fetching
    $gender= new Gender();
    $gender_list= $gender->find();
    
    // State Master Data Fetching
    $states= new StateMaster();
    $state_list= $states->find();
    // Master Table Data Fetching
    $patient_master = new PatientMaster();
    $master_list = $patient_master->find_by_uname($p_username);

    // Contact Info Table Data Fetching
    $patient_contact = new PatientContactInfo();
    $contact_list = $patient_contact->find_by_uname($p_username);
    $contact_active_list = $patient_contact->find_for_update($p_username);

    // Contact Info Table Data Fetching
    $patient_credential = new PatientCredential();
    $credential_list = $patient_credential->find_by_uname($p_username);

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
                <form name="reg-form" method="post" class="contact" onsubmit="return validateform();">
                    <h2 class="heading">Update Your Profile</h2>
                    
                    <?php foreach($master_list as $master_row): ?>
                    <label class="mt" for="fname">Personal Details</label>
                    <input name="pat-name" type="text" value="<?php echo($master_row->fullname);?>" placeholder="Full Name"/>
                    <h6 class="label">Date of birth</h6>
                    <input name="dob" readonly type="date" value="<?php echo($master_row->dob);?>" placeholder="Date of birth"/>
                    <?php endforeach; ?>

                    <?php foreach($contact_list as $contact_row): ?>
                    <input name="pat-phone" type="tel" value="<?php echo($contact_row->phone);?>" placeholder="Contact No"/>
                    <?php endforeach; ?>

                    <?php foreach($master_list as $master_row): ?>
                        <?php $gender_active= $master_row->gender ?>
                    <?php endforeach; ?>
                    <select name="gender">
                        <option value="">Select Gender</option>
                        <?php foreach($gender_list as $gender_row): ?>
                            <option <?php if($gender_row->id==$gender_active){ echo("selected");} ?> value="<?php echo($gender_row->id);?>"><?php echo($gender_row->gender); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <?php foreach($master_list as $master_row): ?>
                    <label class="mt" for="aadhar">Verification Details</label>
                    <input name="aadhar" readonly type="text" value="<?php echo($master_row->aadhar);?>" readonly placeholder="Aadhar number" />
                    <?php endforeach; ?>

                    <label class="mt" for="state">Address</label>
                    <?php foreach($contact_active_list as $contact_active_row): ?>
                        <?php $state_active= $contact_active_row->sid; ?>
                    <?php endforeach; ?>
                    <select name="state" id="state-input">
                        <option value="">Select State</option>
                        <?php foreach($state_list as $state_row): ?>
                            <option <?php if($state_row->id==$state_active){ echo("selected");} ?> value="<?php echo($state_row->id);?>"><?php echo($state_row->state_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <?php foreach($contact_active_list as $contact_active_row): ?>
                        <?php $dist_active= $contact_active_row->id; ?>
                    <?php endforeach; ?>
                    <select name="dist" id="district_input">
                        <option value="">Select District</option>
                        <?php foreach($district_list as $dist_row): ?>
                            <option value="<?php echo($dist_row->id);?>"><?php echo($dist_row->district); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <?php foreach($contact_list as $contact_row): ?>
                    <textarea name="adr-line" type="text" placeholder="House No, Street Name" rows="2"><?php echo($contact_row->address_line);?></textarea>
                    <input name="vil-city" type="text" value="<?php echo($contact_row->city_village);?>" placeholder="Village/City"/>
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
<script>
    var initStateId = "<?php echo($state_active); ?>";
    var initDistId = "<?php echo($dist_active); ?>";
    handleStateChange(initStateId);

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

        await handleStateChange(stateId)
    })
    async function handleStateChange(id){
        if (!id) {
            alert("Something went wrong! can't get state id");
            return;
        }

        const districtList = await getDistrictList(id);

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

            if(district.id==initDistId){
                option.setAttribute("selected","");
            }

            districtInput.appendChild(option);
        })
    }
</script>

<script src="../files/validate.js"></script>
<script>
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
    }
</script>
</html>
