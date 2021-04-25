<?php
    require_once("../lib/pdo.php");
    
    class TreatmentRecords
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
            $query = "SELECT * FROM treatment_records;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        // /**
        //  * @param d_id - Department ID 
        //  * @return array
        //  */
        // public function find_by_deptid($d_id)
        // {
        //     $query = "SELECT * FROM treatment_records WHERE d_id= '$d_id';";

        //     $this->db->query($query);

        //     return $this->db->resultset();
        // }
        
        /**
         * @param d_uname - Doctor Username 
         * @return array
         */
        public function find_by_doctor($d_uname)
        {
            $query = "SELECT tr.id, p.fullname, tr.description, t.treatment, tr.duration, tr.start_date, tr.start_time, tr.cost
                     FROM patient_master p, treatment_master t, treatment_records tr, doctor_master d
                     WHERE tr.p_uname=p.user_name AND tr.t_id=t.id AND tr.d_uname= d.user_name AND tr.d_uname= '$d_uname';";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function find_by_dept($d_id)
        {
            $query = "SELECT p.fullname, t.treatment, tr.description, tr.duration, tr.start_date, tr.start_time, d.dname, dq.d_id, dm.dept, d.dname 
                     FROM patient_master p, treatment_master t, treatment_records tr, doctor_master d, doctor_qualification dq, department_master dm 
                     WHERE tr.p_uname=p.user_name AND tr.t_id=t.id AND tr.d_uname= d.user_name AND dq.user_name AND dq.d_id= '$d_id';";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function create ($data) {
            
            $query = "INSERT INTO treatment_records(p_uname, t_id, description, duration, start_date, start_time, d_uname, cost) 
                    VALUES (:p_uname, :t_id, :description, :duration, :start_date, :start_time, :d_uname, :cost)";

            $this -> db -> query($query);

            $this -> db -> bind('p_uname', $data['p_uname']);
            $this -> db -> bind('t_id', $data['t_id']);
            $this -> db -> bind('description', $data['description']);
            $this -> db -> bind('duration', $data['duration']);
            $this -> db -> bind('start_date', $data['start_date']);
            $this -> db -> bind('start_time', $data['start_time']);
            $this -> db -> bind('d_uname', $data['d_uname']);
            $this -> db -> bind('cost', $data['cost']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>