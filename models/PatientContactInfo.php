<?php
    require_once("../lib/pdo.php");
    
    class PatientContactInfo
    {
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        /**
         * @return array
         */
        public function find() {
            $query = "SELECT * FROM pat_contact_info;";

            $this->db->query($query);

            return $this->db->resultset();
        }

        public function find_for_update($user_name) {
            $query = "SELECT d.id, d.sid 
                        FROM state_master s, pat_contact_info pc, dist_master d 
                        WHERE d.id= pc.dist_id AND s.id=d.sid AND pc.user_name= '$user_name'";

            $this->db->query($query);

            return $this->db->resultset();
        }
        /**
         * @param user_name - User name
         * @return array
         */
        public function find_by_uname ($user_name) {
            $query = "SELECT * FROM pat_contact_info WHERE user_name = '$user_name'";

            $this->db->query($query);

            return $this->db->resultset();
        }


        public function create ($data) {
            $query = "INSERT INTO pat_contact_info(user_name, phone, address_line, city_village, dist_id) VALUES (:user_name, :phone, :address_line, :city_village, :dist_id)";

            $this -> db -> query($query);

            $this -> db -> bind('user_name', $data['user_name']);
            $this -> db -> bind('phone', $data['phone']);
            $this -> db -> bind('address_line', $data['address_line']);
            $this -> db -> bind('city_village', $data['city_village']);
            $this -> db -> bind('dist_id', $data['dist_id']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function update ($data) {
            $query = "UPDATE pat_contact_info
                        SET user_name= :user_name, phone= :phone, address_line= :address_line, city_village= :city_village, dist_id= :dist_id
                        WHERE user_name= :user_name";

            $this -> db -> query($query);

            $this -> db -> bind('user_name', $data['user_name']);
            $this -> db -> bind('phone', $data['phone']);
            $this -> db -> bind('address_line', $data['address_line']);
            $this -> db -> bind('city_village', $data['city_village']);
            $this -> db -> bind('dist_id', $data['dist_id']);

            if ($this -> db -> execute()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
}
?>