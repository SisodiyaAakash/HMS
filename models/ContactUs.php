<?php
    require_once("../lib/pdo.php");
    
    class ContactUs
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
            $query = "SELECT * FROM contact_us;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function create ($data) {
            $query = "INSERT INTO contact_us(fname, email, message)  
                    VALUES (:fname, :email, :message)";

            $this -> db -> query($query);

            $this -> db -> bind('fname', $data['fname']);
            $this -> db -> bind('email', $data['email']);
            $this -> db -> bind('message', $data['message']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>