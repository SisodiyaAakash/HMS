<?php
    require_once("../lib/pdo.php");
    
    class BloodGroup
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
            $query = "SELECT * FROM bg_master;";

            $this->db->query($query);

            return $this->db->resultset();
        }
}
?>