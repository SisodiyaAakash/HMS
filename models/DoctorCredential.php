<?php
    require_once("../lib/pdo.php");
    
    class DoctorCredential
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
            $query = "SELECT * FROM doctor_cred;";

            $this->db->query($query);

            return $this->db->resultset();
        }
        
        /**
         * @param user_name - User name
         * @return array
         */
        public function find_by_uname ($user_name) {
            $query = "SELECT * FROM doctor_cred WHERE user_name = '$user_name'";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function create ($data) {
            $query = "INSERT INTO doctor_cred(user_name, password) VALUES (:user_name, :password)";

            $password = $data['password'];

            // encrypt password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $this -> db -> query($query);

            $this -> db -> bind('user_name', $data['user_name']);
            $this -> db -> bind('password', $hash);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function update ($data) {
            $query = "UPDATE doctor_cred
                        SET user_name= :user_name, password= :password 
                        Where user_name= :user_name";

            $password = $data['password'];

            // encrypt password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $this -> db -> query($query);

            $this -> db -> bind('user_name', $data['user_name']);
            $this -> db -> bind('password', $hash);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
?>