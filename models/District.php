<?php
    require_once("../lib/pdo.php");
    
    class District
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
            $query = "SELECT * FROM dist_master;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param state_id - State id
         * @return array
         */
        public function find_by_state ($state_id) {
            $query = "SELECT * FROM dist_master WHERE sid = '$state_id' ORDER BY district;";

            $this -> db -> query($query);

            return $this -> db -> resultset();
        }
        
        public function create ($data) {
            $query = "INSERT INTO dist_master(sid, district) 
                    VALUES (:sid, :district)";

            $this -> db -> query($query);

            $this -> db -> bind('sid', $data['sid']);
            $this -> db -> bind('district', $data['district']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>