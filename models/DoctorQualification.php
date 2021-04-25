<?php
    require_once("../lib/pdo.php");
    
    class DoctorQualification
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
            $query = "SELECT * FROM doctor_qualification;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param user_name - User name
         * @return array
         */
        public function find_by_uname ($user_name) {
            $query = "SELECT dq.education, dq.experience, dm.dept, dq.d_id
                        FROM doctor_qualification dq, department_master dm, doctor_master d
                        WHERE dq.d_id= dm.id AND dq.user_name=d.user_name AND dq.user_name = '$user_name'";

            $this->db->query($query);

            return $this->db->resultset();
        }
        public function create ($data) {
            $query = "INSERT INTO doctor_qualification(user_name, education, experience, d_id) 
                    VALUES (:user_name, :education, :experience, :d_id)";

            $this -> db -> query($query);

            $this -> db -> bind('user_name', $data['user_name']);
            $this -> db -> bind('education', $data['education']);
            $this -> db -> bind('experience', $data['experience']);
            $this -> db -> bind('d_id', $data['d_id']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function update ($data) {
            $query = "UPDATE doctor_qualification
                        SET user_name= :user_name, education= :education, experience= :experience, d_id= :d_id 
                        WHERE user_name= :user_name";

            $this -> db -> query($query);

            $this -> db -> bind('user_name', $data['user_name']);
            $this -> db -> bind('education', $data['education']);
            $this -> db -> bind('experience', $data['experience']);
            $this -> db -> bind('d_id', $data['d_id']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>