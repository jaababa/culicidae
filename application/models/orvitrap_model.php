<?php

class Orvitrap_model extends CI_Model {
	public function get_orvitraps_only() {
		$return = array(); 
        $this->db->select("total as total_orvitrap,orvitrap_details.id,school_info.id"); 
        $this->db->from("orvitrap_details,school_info");
        $this->db->where("orvitrap_details.id = school_info.id");
        //$query = $this->db->query("
        //	SELECT * from orvitrap_details, 
        //"); 
        if ($query->num_rows()>0) { 
            foreach ($query->result() as $rows) { 
                array_push($return, $rows); 
            } 
        } 
        return $return; 
	}
}

?>
