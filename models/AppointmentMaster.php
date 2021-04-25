<?php
    require_once("../lib/pdo.php");
    
    class AppointmentMaster
    {
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        
        /**
         * @return array
         */
        public function find()
        {
            $query = "SELECT * FROM appointment_master;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function find_for_admin() {
            $query = "SELECT p.fullname, pc.phone, d.dname, dp.dept, am.reason, am.ap_date, am.ap_time, a_s.status 
            FROM patient_master p, pat_contact_info pc, doctor_master d, appointment_master am, appointment_status a_s, doctor_qualification dq, department_master dp
            WHERE p.user_name = pc.user_name AND dq.d_id=dp.id AND p.user_name = am.patient_uname AND d.user_name = dq.user_name AND am.doct_uname=d.user_name AND a_s.id=am.id";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param user_name - User name
         * @return array
         */
        public function find_by_uname ($patient_uname) {
            $query = "SELECT d.dname, dp.dept, am.reason, am.ap_date, am.ap_time, a_s.status 
                        FROM doctor_master d, department_master dp, appointment_master am, appointment_status a_s, doctor_qualification dq, patient_master p 
                        WHERE am.doct_uname=d.user_name AND dq.d_id=dp.id AND d.user_name = dq.user_name AND a_s.id=am.id AND am.patient_uname=p.user_name AND p.user_name= '$patient_uname'";
            
            // $query = "SELECT d.dname, dp.dept, am.reason, am.ap_date, am.ap_time, a_s.status 
            //         FROM doctor_master d, department_master dp, appointment_master am, appointment_status a_s, doctor_qualification dq, patient_master p 
            //         INNER JOIN d ON am.user_name= d.user_name
            //         INNER JOIN p ON am.patient_uname= p.user_name 
            //         INNER JOIN am ON a_s.id= am.id 
            //         INNER JOIN dp ON dq.d_id= dp.id 
            //         INNER JOIN d ON dq.user_name= dp.user_name 
            //         WHERE p.user_name= '$patient_uname'";
            
            $this->db->query($query);

            return $this->db->resultset();
        }
        
        /**
         * @param doct_uname - Doctor username
         * @return array
         */
        public function find_by_doctor ($doct_uname) {
             
            $query = "SELECT am.id, p.fullname, pc.phone, am.reason, am.ap_date, am.ap_time, a_s.status 
                        FROM patient_master p, pat_contact_info pc, appointment_master am, doctor_master d, appointment_status a_s
                        WHERE p.user_name = pc.user_name AND p.user_name = am.patient_uname AND d.user_name = am.doct_uname AND am.id = a_s.id AND d.user_name = '$doct_uname'";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function create ($data) {
            $query = "INSERT INTO appointment_master(patient_uname, ap_date, ap_time, doct_uname, reason) 
                    VALUES (:patient_uname, :ap_date, :ap_time, :doct_uname, :reason)";

            $stmt= $this -> db -> query($query);
            
            $this -> db -> bind('patient_uname', $data['patient_uname']);
            $this -> db -> bind('ap_date', $data['ap_date']);
            $this -> db -> bind('ap_time', $data['ap_time']);
            $this -> db -> bind('doct_uname', $data['doct_uname']);
            $this -> db -> bind('reason', $data['reason']);
            
            $result=$this -> db -> execute();
            
            // $lastId = $stmt->fetchColumn();
            
            $id = $this -> db -> lastInsertId();
            
            if ($result) {
                return $id;
            } else {
                return FALSE;
            }
        }
}
?>