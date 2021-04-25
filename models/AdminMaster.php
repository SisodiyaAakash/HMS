<?php
    require_once("../lib/pdo.php");
    
    class AdminMaster
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
            $query = "select * from admin_master where user_name != 'sakam.admin';";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param user_name - User name
         * @return array
         */
        public function find_by_uname ($user_name) {
            $query = "SELECT * FROM admin_master WHERE user_name = '$user_name' ORDER BY fname";

            $this->db->query($query);

            return $this->db->resultset();
        }
        
        public function create ($data) {
            $query = "INSERT INTO admin_master(user_name, fname)  
                    VALUES (:user_name,:fname)";
            $this -> db -> query($query);

            $this -> db -> bind('user_name', $data['user_name']);
            $this -> db -> bind('fname', $data['fname']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function update ($data) {
            $query = "UPDATE admin_master
                        SET user_name= :user_name, fname= :fname
                        WHERE user_name= :user_name";
            $this -> db -> query($query);

            $this -> db -> bind('user_name', $data['user_name']);
            $this -> db -> bind('fname', $data['fname']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
?>