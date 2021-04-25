<?php
    require_once("../lib/pdo.php");
    
    class DepartmentMaster
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
            $query = "SELECT * FROM department_master;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param d_id - Department ID 
         * @return array
         */
        public function find_by_deptid($d_id)
        {
            $query = "SELECT * FROM department_master WHERE d_id= '$d_id';";

            $this->db->query($query);

            return $this->db->resultset();
        }
        
        public function create ($data) {
            $query = "INSERT INTO department_master(dept) 
                    VALUES (:dept)";

            $this -> db -> query($query);

            $this -> db -> bind('dept', $data['dept']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>