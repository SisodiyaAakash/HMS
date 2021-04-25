<?php
    require_once("../lib/pdo.php");
    
    class DoctorMaster
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
            $query = "SELECT * FROM doctor_master;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param user_name - User name
         * @return array
         */
        public function find_by_uname ($user_name) {
            $query = "SELECT * FROM doctor_master WHERE user_name = '$user_name'";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param d_id - User name
         * @return array
         */
        public function find_by_department ($d_id) {
            $query = "SELECT q.d_id, q.user_name, d.dname 
                     FROM doctor_master d, doctor_qualification q 
                     WHERE q.user_name=d.user_name AND q.d_id = '$d_id'
                     ORDER BY d.dname";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @return array
         */
        public function find_doctor_details () {
            $query = "SELECT d.dname, d.dob, dp.dept, dq.education, dq.experience 
                     FROM doctor_master d, department_master dp, doctor_qualification dq 
                     WHERE d.user_name=dq.user_name AND dq.d_id=dp.id
                     ORDER BY d.dname";

            $this->db->query($query);

            return $this->db->resultset();
        }
        
        public function create ($data) {
            $query = "INSERT INTO doctor_master(user_name, dname, dob, gender) 
                    VALUES (:user_name, :dname, :dob, :gender)";

            $this -> db -> query($query);

            $this -> db -> bind('user_name', $data['user_name']);
            $this -> db -> bind('dname', $data['dname']);
            $this -> db -> bind('dob', $data['dob']);
            $this -> db -> bind('gender', $data['gender']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function update ($data) {
            $query = "UPDATE doctor_master
                        SET user_name= :user_name, dname= :dname, dob= :dob, gender= :gender
                        WHERE user_name= :user_name";

            $this -> db -> query($query);

            $this -> db -> bind('user_name', $data['user_name']);
            $this -> db -> bind('dname', $data['dname']);
            $this -> db -> bind('dob', $data['dob']);
            $this -> db -> bind('gender', $data['gender']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>