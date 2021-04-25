<?php
    $title = "Doctor Profile | GUNI HMS";
    $page_name = "doctor_profile";

    include_once '../config/db.php';
    include_once '../models/DoctorMaster.php';
    include_once '../models/Gender.php';
    include_once '../models/DoctorCredential.php';
    include_once '../models/DoctorQualification.php';
    include_once '../models/DepartmentMaster.php';

    session_start();
    $user_name= $_SESSION["DOCTOR_USERNAME"];
    
    if (isset($INPUT['submit'])) {
        
        // doctor Master Table (doctor_master)
        $dname = $INPUT['dname'];
        $user_name = $INPUT['user-name'];
        $dob = $INPUT['dob'];
        $gender = $INPUT['gender']; //This have gender id of gender_master table
        
        $master_payload = array(
            "fullname" => $dname,
            "user_name" => $user_name,
            "dob" => $dob,
            "gender" => $gender
        );
        
        $doctor_master = new DoctorMaster();
        $doctor_master -> update($master_payload);
        
        // doctor credentials table (doctor_cred)
        
        $password = $INPUT['password'];
        
        $cred_payload = array(
            "u_name" => $user_name,
            "password" => $password
        );
        
        $cred_instance = new DoctorCredential();
        $cred_instance -> update($cred_payload);
        
        // Doctor Qualification Table (doctor_master)
        $user_name = $INPUT['user-name'];
        $education = $INPUT['education'];
        $experience = $INPUT['experience'];
        $d_id = $INPUT['d_id'];
            
        $qualification_payload = array(
            "user_name" => $user_name,
            "education" => $education,
            "experience" => $experience,
            "d_id" => $d_id
        );
            
        $doctor_qualification = new DoctorQualification();
        $doctor_qualification -> update($qualification_payload);

        init_doctor_session($user_name, $password);
        echo '<script>alert("Profile updated successfuly")</script>';
    }
    // Gender Data Fetching
    $gender= new Gender();
    $gender_list= $gender->find();

    // Department Data Fetching
    $department= new DepartmentMaster();
    $department_list= $department->find();

    // Master Table Data Fetching
    $doctor_master = new DoctorMaster();
    $master_list = $doctor_master->find_by_uname($user_name);

    // Credential Info Table Data Fetching
    $doctor_credential = new DoctorCredential();
    $credential_list = $doctor_credential->find_by_uname($user_name);

    // Qualification Info Table Data Fetching
    $doctor_qualification = new DoctorQualification();
    $qualification_list = $doctor_qualification->find_by_uname($user_name);
    
    echo"$user_name";
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
                    <label class="mt" for="dname">Personal Details</label>
                    <input name="dname" type="text" value="<?php echo($master_row->dname);?>" placeholder="Full Name"/>
                    <h6 class="label">Date of birth</h6>
                    <input name="dob" readonly type="date" readonly value="<?php echo($master_row->dob);?>" placeholder="Date of birth"/>
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

                    <?php foreach($qualification_list as $qualification_row): ?>
                    <label class="mt">Qualification</label>
                    <input name="education" type="text" value="<?php echo($qualification_row->education);?>" placeholder="Password"/>
                    <input name="experience" type="text" value="<?php echo($qualification_row->experience);?>" placeholder="Confirm Password"/>
                    <?php endforeach; ?>
                    
                    <?php foreach($qualification_list as $qualification_row): ?>
                        <?php $department_active= $qualification_row->d_id ?>
                    <?php endforeach; ?>
                    <select name="department">
                        <option value="">Select Department</option>
                        <?php foreach($department_list as $department_row): ?>
                            <option <?php if($department_row->id==$department_active){ echo("selected");} ?> value="<?php echo($department_row->id);?>"><?php echo($department_row->dept); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <?php foreach($credential_list as $credential_row): ?>
                    <label class="mt" for="username">Credentials</label>
                    <input name="user-name" type="text" value="<?php echo($credential_row->user_name);?>" placeholder="Username"/>
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

        // validate doctor name
        const nameInput = form['dname'];
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
        
        // Validate doctor phone number
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
        const user_nameInput = form['user-name'];
        if (user_nameInput.value.length === 0) {
            alert("Require user name");
            user_nameInput.focus();
            return false;
        }
        else if (user_nameInput.value.length <= 8) {
            alert("Username length must be more than 8 characters");
            user_nameInput.focus();
            return false;
        }
        else if (usernameExp.test(user_nameInput.value) === false) {
            alert("Invalid user name");
            user_nameInput.focus();
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
