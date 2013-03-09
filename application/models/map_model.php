<?php 
class Map_model extends CI_Model { 
    function __construct() 
    { 
        parent::__construct(); 
    }
    function get_coordinates() 
    {
        $return = array(); 
        $this->db->select("school_info.regions_data_id,regions_data.id as ids,school_info.id,city_name,school_name,latitude,longitude,date_submitted,ovitrap"); 
        $this->db->from("school_info,regions_data");
        $this->db->where("school_info.regions_data_id = regions_data.id");
        $query = $this->db->get(); 
        if ($query->num_rows()>0)
        { 
            $result = $query->result();
            foreach ($result as $row) { 
                array_push($return, $row); 
            } 
        } 
        return $return; 
    }
    function get_orvitrap_sum() 
    {

        $return = array(); 
        $this->db->select("total as total_orvitrap,orvitrap_details.id,school_info.id"); 
        $this->db->from("orvitrap_details,school_info");
        $this->db->where("orvitrap_details.id = school_info.id");
        $query = $this->db->get(); 
        if ($query->num_rows()>0) { 
            foreach ($query->result() as $rows) { 
                array_push($return, $rows); 
            } 
        } 
        return $return; 
    }
      function select_region()
	{
		$sql = "select id,regions_name from regions_info";
		$query = $this->db->query($sql);
		return $query->result();
            	
        }
        function select_region_data()
	{
		$sql = "select id,regions_info_id,city_name from regions_data where regions_info_id='1' order by city_name";
		$query = $this->db->query($sql);
		return $query->result();
	}
        function get_coordinates_by_city() 
    {
        $return = array(); 
        $this->db->select("school_info.regions_data_id,regions_data.id,school_info.id,city_name,school_name,latitude,longitude,date_submitted,ovitrap"); 
        $this->db->from("school_info,regions_data");
        $this->db->where("school_info.regions_data_id = regions_data.id and regions_data_id ='".$this->input->post('cities')."'");
        $query = $this->db->get(); 
        if ($query->num_rows()>0)
        { 
            $result = $query->result();
            foreach ($result as $row) { 
                array_push($return, $row); 
            } 
        } 
        return $return; 
    }
    function school_info($city_info)
	{
		$sql = "select * from school_info where regions_data_id='$city_info' order by school_name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
    function get_school_info_id()
	{
		
		$sql1 = "select * from school_info where id='".$this->input->post('school_id')."'";
		$querys = $this->db->query($sql1);
		return $querys->result();
	}
    function get_region_per_school()
	{
	    $sql1 = $this->db->query("select * from school_info where id='".$this->input->post('school_id')."'");	
		if ($sql1->num_rows() == 0)
        {
	    echo "<script>alert('No Resullt Was Found..')</script>";
	    echo "<script>location.href='../../index.php'</script>";
	}
	else
	{
		
		foreach ($sql1->result() as $region_id)
		{
		    $regions_id = $region_id->regions_data_id;
		}
		
		$sql = "select * from regions_data where id='$regions_id'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	}
        function get_region_data()
	{
		$sql = "select * from regions_data where id='".$this->input->post('cities')."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_region($region_info)
	{
		$sql = "select * from regions_data where regions_info_id='$region_info'";
		$query = $this->db->query($sql);
		return $query->result();
	}
} 
?>