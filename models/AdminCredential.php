<?php
    require_once("../lib/pdo.php");

    class AdminCredential
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
            $query = "SELECT * FROM admin_cred;";

            $this->db->query($query);

            return $this->db->resultset();
        }
        
        /**
         * @param user_name - User name
         * @return array
         */
        public function find_by_uname ($user_name) {
            $query = "SELECT * FROM admin_cred WHERE u_name = '$user_name'";

            $this->db->query($query);

            return $this->db->resultset();
        }

                /**
         * @param user_name - User name
         * @param password - Password
         * @return array
         */
        public function find_by_uname_password ($user_name, $password) {
            $query = "SELECT * FROM admin_cred WHERE u_name = '$user_name' AND password = '$password'";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function create ($data) {
            $query = "INSERT INTO admin_cred(u_name, password) VALUES (:u_name, :password)";

            $password = $data['password'];

            // encrypt password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $this -> db -> query($query);

            $this -> db -> bind('u_name', $data['u_name']);
            $this -> db -> bind('password', $hash);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
?>