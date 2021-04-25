<?php
    require_once("../lib/pdo.php");
    
    class MedicineMaster
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
            $query = "SELECT * FROM medicine_master;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function create ($data) {
            $query = "INSERT INTO medicine_master(medicine, used_for) 
                    VALUES (:medicine, :used_for)";

            $this -> db -> query($query);

            $this -> db -> bind('medicine', $data['medicine']);
            $this -> db -> bind('used_for', $data['used_for']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>