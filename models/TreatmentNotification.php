<?php
    require_once("../lib/pdo.php");
    
    class TreatmentNotification
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
            $query = "SELECT * FROM treatment_notification;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        // /**
        //  * @param id - Treatment ID 
        //  * @return array
        //  */
        public function find_by_id($id)
        {
            $query = "SELECT * FROM treatment_notification WHERE id= '$id';";

            $this->db->query($query);

            return $this->db->resultset();
        }
        
        public function create ($data) {
            $query = "INSERT INTO treatment_notification(id, notification) 
                    VALUES (:dept)";

            $this -> db -> query($query);

            $this -> db -> bind('id', $data['id']);
            $this -> db -> bind('notification', $data['notification']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>