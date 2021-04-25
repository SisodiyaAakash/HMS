<?php
    require_once("../lib/pdo.php");
    
    class AppointmentStatus
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
            $query = "SELECT * FROM appointment_status;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        /**
         * @param id - Appointment id
         * @return array
         */
        public function find_by_id ($id) {
            $query = "SELECT * FROM appointment_status WHERE id = '$id'";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function create ($data) {
            $query = "INSERT INTO appointment_status(id, status)
                    VALUES (:id, 'Pending')";

            $this -> db -> query($query);

            $this -> db -> bind('id', $data['id']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function update ($data) {
            $query = "UPDATE appointment_status
                     SET status= $data[status], notify_message=$data[notify_message]
                     WHERE id= $data[id])";

            $this -> db -> query($query);

            $this -> db -> bind(status, $data[status]);
            // $this -> db -> bind(status, $data[status]);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>