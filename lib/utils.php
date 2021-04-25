<?php
   
   include_once '../models/AdminCredential.php';
   include_once '../models/DoctorCredential.php';
   include_once '../models/PatientCredential.php';
   include_once '../lib/common.php';

   /**
    * @param string $user_name - User name
    * @return void
    */
   function init_admin_session ($user_name, $password) {
      // if (session_status() != PHP_SESSION_ACTIVE) {
         $admin_cred = new AdminCredential();

         $data = $admin_cred -> find_by_uname ($user_name)[0];

         $password_verified = verify_password($password, $data -> password);

         // Anonymous patient
         if ($data === FALSE || $password_verified == FALSE) {
            http_response_code(500);
            echo("<script>alert('Incorrect username or password');</script>");
            return;
         }

         session_start();

         $_SESSION['AUTH'] = TRUE;
         $_SESSION['AUTH_USER_TYPE'] = "admin";
         $_SESSION['ADMIN_USERNAME'] = $data -> u_name;
      // }
   }

   function init_doctor_session ($user_name, $password) {
      // if (session_status() != PHP_SESSION_ACTIVE) {
         $doctor_cred = new DoctorCredential();

         $data = $doctor_cred -> find_by_uname ($user_name)[0];

         $password_verified = verify_password($password, $data -> password);

         // Anonymous patient
         if ($data === FALSE || $password_verified == FALSE) {
            http_response_code(500);
            echo("<script>alert('Incorrect username or password');</script>");
            return;
         }

         session_start();

         $_SESSION['AUTH'] = TRUE;
         $_SESSION['AUTH_USER_TYPE'] = "doctor";
         $_SESSION['DOCTOR_USERNAME'] = $data -> user_name;
      // }
   }

   function init_patient_session ($user_name, $password) {
      // if (session_status() != PHP_SESSION_ACTIVE) {
         $patient_cred = new PatientCredential();

         $data = $patient_cred -> find_by_uname ($user_name)[0];

         $password_verified = verify_password($password, $data -> password);

         // Anonymous patient
         if ($data === FALSE || $password_verified == FALSE) {
            http_response_code(500);
            echo("<script>alert('Incorrect username or password');</script>");
            return;
         }

         session_start();

         $_SESSION['AUTH'] = TRUE;
         $_SESSION['AUTH_USER_TYPE'] = "patient";
         $_SESSION['PATIENT_USERNAME'] = $data -> u_name;
      // }
   }
?>