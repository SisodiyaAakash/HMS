<?php
    require_once("../lib/pdo.php");
    
    class DayMaster
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
            $query = "SELECT * FROM day_master;";

            $this->db->query($query);

            return $this->db->resultset();
        }
}
?>