<?php
    require_once("../lib/pdo.php");
    
    class PrescriptionRecords
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
            $query = "SELECT pr.ap_id, pr.tr_id, m.medicine  FROM prescription_record;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function find_for_admin()
        {
            $query = "SELECT DISTINCT d.dname, p.fullname, pr.ap_id, pr.tr_id, m.medicine, pr.dosage 
                        FROM doctor_master d, patient_master p, prescription_record pr, medicine_master m, treatment_records tr, appointment_master am
                        WHERE (d.user_name=pr.d_uname AND p.user_name=tr.p_uname AND pr.tr_id=tr.id AND m.id=pr.medicine_id) OR (d.user_name=pr.d_uname AND p.user_name=am.patient_uname AND pr.ap_id=am.id AND m.id=pr.medicine_id)";

            $this->db->query($query);

            return $this->db->resultset();
        }

        //         SELECT d.dname, pr.ap_id, pr.tr_id, p.fullname, m.medicine, pr.dosage 
        // FROM prescription_record pr, patient_master p, medicine_master m, treatment_records tr, doctor_master d, appointment_master am 
        // WHERE d.user_name=pr.d_uname AND m.id=pr.medicine_id AND tr.p_uname=p.user_name  AND pr.ap_id=am.id OR pr.tr_id=tr.id;

  
        public function find_by_patient($p_uname)
        {
            $query = "SELECT DISTINCT d.dname, p.fullname, pr.ap_id, pr.tr_id, m.medicine, pr.dosage 
                        FROM doctor_master d, patient_master p, prescription_record pr, medicine_master m, treatment_records tr, appointment_master am
                        WHERE (d.user_name=pr.d_uname AND p.user_name=tr.p_uname AND pr.tr_id=tr.id AND m.id=pr.medicine_id AND tr.p_uname='$p_uname') OR (d.user_name=pr.d_uname AND p.user_name=am.patient_uname AND pr.ap_id=am.id AND m.id=pr.medicine_id AND am.patient_uname='$p_uname')";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function find_by_doctor($doct_username)
        {
            $query = "SELECT pr.id, pr.ap_id, pr.tr_id, m.medicine 
                        FROM prescription_record pr, medicine_master m 
                        WHERE pr.medicine_id=m.id AND d_uname= '$doct_username';";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param ap_id - Appointment ID 
         * @return array
         */
        public function find_by_apid($ap_id)
        {
            $query = "SELECT * FROM prescription_record WHERE ap_id= '$ap_id';";

            $this->db->query($query);

            return $this->db->resultset();
        }

        // /**
        //  * @param tr_id - Treatment ID 
        //  * @return array
        //  */
        public function find_by_trid($tr_id)
        {
            $query = "SELECT * FROM prescription_record WHERE tr_id= '$tr_id';";

            $this->db->query($query);

            return $this->db->resultset();
        }
        
        public function create ($data) {
            $query = "INSERT INTO prescription_record(d_uname, ap_id, tr_id, medicine_id, dosage, note) 
                    VALUES (:d_uname, :ap_id, :tr_id, :medicine_id, :dosage, :note)";

            $this -> db -> query($query);

            $this -> db -> bind('d_uname', $data['d_uname']);
            $this -> db -> bind('ap_id', $data['ap_id']);
            $this -> db -> bind('tr_id', $data['tr_id']);
            $this -> db -> bind('medicine_id', $data['medicine_id']);
            $this -> db -> bind('dosage', $data['dosage']);
            $this -> db -> bind('note', $data['note']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
?>