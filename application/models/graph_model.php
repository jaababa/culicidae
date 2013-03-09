<?php
class Graph_model extends CI_Model {
	public function get_graphs_only()
	{
		$query = $this->db->query("SELECT * from orvitrap_details, school_info WHERE orvitrap_details.id = school_info.id"); 
        if($query->num_rows()>0)
	{
		foreach ($query->result() as $rows)
		{
			array_push($return, $rows);
			}
			}
			return $return;
			}
	public function get_graph_for($school_id,$months,$years) {
		$this->load->database();
		$query = $this->db->query("SELECT * FROM orvitrap_details WHERE school_id = '$school_id' AND MONTH(date_submitted) = '$months' and YEAR(date_submitted) = '$years'");
		$result = $query->result();
		$orvitraps = array();
		foreach($result as $o)
		{
			$orvitraps[] = $o->total;
		}
		$query = $this->db->query("SELECT * FROM school_info WHERE id = '$school_id'");
		return array('orvitraps'=>implode(',', $orvitraps), 'name'=>$query->row()->school_name, 'month'=>$months, 'year'=>$years, 'id'=>$school_id);
		}
		function select_info($startmonth,$endmonth,$year)
		{
		$sql = "select * from orvitrap_details where school_id = '".$this->input->get('id')."' AND YEAR(date_submitted)='$year' AND MONTH(date_submitted) BETWEEN '$startmonth' AND '$endmonth' group by date_submitted order by date_submitted ASC";
		$query = $this->db->query($sql);
		return $query->result();
		}
		 function get_region_data_id()
	{
		$sql = "select * from regions_data where id='".$this->input->get('region_id')."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
		}
?>