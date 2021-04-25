<?php
    require_once("../lib/pdo.php");
    
    class Gender
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
            $query = "SELECT * FROM gender_master;";

            $this->db->query($query);

            return $this->db->resultset();
        }
}
?>