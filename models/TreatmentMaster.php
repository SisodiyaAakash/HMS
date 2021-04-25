<?php
    require_once("../lib/pdo.php");
    
    class TreatmentMaster
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
            $query = "SELECT * FROM treatment_master;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param d_id - Department ID 
         * @return array
         */
        public function find_with_department()
        {
            $query = "SELECT t.id, t.treatment, d.dept 
                        FROM treatment_master t, department_master d
                        WHERE t.d_id=d.id";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function find_by_doctor()
        {
            $query = "SELECT t.id, t.treatment, d.dept 
                        FROM treatment_master t, department_master d
                        WHERE t.d_id=d.id";

            $this->db->query($query);

            return $this->db->resultset();
        }
        
        public function create ($data) {
            $query = "INSERT INTO treatment_master(treatment, d_id) 
                    VALUES (:treatment, :d_id)";

            $this -> db -> query($query);

            $this -> db -> bind('treatment', $data['treatment']);
            $this -> db -> bind('d_id', $data['d_id']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>