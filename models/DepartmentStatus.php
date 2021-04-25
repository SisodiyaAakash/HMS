<?php
    require_once("../lib/pdo.php");
    
    class DepartmentStatus
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
            $query = "SELECT * FROM department_status;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param d_id - Department ID 
         * @return array
         */
        public function find_by_deptid($d_id)
        {
            $query = "SELECT * FROM department_status WHERE d_id= '$d_id';";

            $this->db->query($query);

            return $this->db->resultset();
        }
        
        public function create ($data) {
            $query = "INSERT INTO department_status(d_id, dept_status) 
                    VALUES (:d_id, :dept_status)";

            $this -> db -> query($query);

            $this -> db -> bind('d_id', $data['d_id']);
            $this -> db -> bind('dept_status', $data['dept_status']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function update ($data) {
            $query = "UPDATE department_status
                     SET dept_status= $data[dept_status]
                     WHERE d_id= $data[d_id])";

            $this -> db -> query($query);

            $this -> db -> bind(dept_status, $data[dept_status]);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>