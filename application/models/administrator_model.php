<?php

class Administrator_model extends CI_Model
{
	public function login_model($username,$password)
	{
		$sql="select * from dengue_users where username ='".$username."' and password ='".$password."'";
		$query = $this->db->query($sql);  
		return $query->result();
	
	}
	function search_data()
	{
		$query = "SELECT * FROM school_info where regions_data_id='".$this->input->post('cities')."' group by school_name order by school_name ASC";
		$result = $this->db->query($query);
		return $result->result();
	}
	function ovitrap_details_validation()
	{
	$query = "SELECT * FROM orvitrap_details where regions_data_id='".$this->input->post('cities')."' and date_submitted='".$this->input->post('date')."'";
	$result = $this->db->query($query);
	return $result->result();
	}
	
	function insert_city()
	{
		$regions_info_id = $_POST["region"];
		$city_name = $_POST["city"];
		$longitude = $_POST["longitude"];
		$latitude = $_POST["latitude"];
		$sql = "INSERT INTO regions_data(`regions_info_id`, `city_name`, `lat`, `long`, `zoom`) VALUES('$regions_info_id','$city_name','$latitude','$longitude','13')";
		$query = $this->db->query($sql);
	
	}
	
	function insert_school()
	{
		/*
		$fh = fopen("test.txt", "w");
		ob_start();
		var_dump($_POST);
		$data = ob_get_clean();
		fwrite($fh, $data);
		fclose($fh);
		*/
		$regions_data = $_POST["cities"];
		$school_name = $_POST["school"];
		$longitude = $_POST["longitude"];
		$latitude = $_POST["latitude"];
		$user_id = $_POST["user_id"];
		$sql = "INSERT INTO school_info(regions_data_id, school_name, latitude, longitude, encoder_id) VALUES('$regions_data','$school_name','$longitude','$latitude', '$user_id')";
		$query = $this->db->query($sql);
	}
	
	function update_school()
	{
		
		$school_id = $_POST["school_id"];
		$regions_data = $_POST["city_id"];
		$school_name = $_POST["school"];
		$longitude = $_POST["longitude"];
		$latitude = $_POST["latitude"];
		$user_id = $_POST["user_id"];
		$sql = "UPDATE school_info SET regions_data_id = '$regions_data', school_name = '$school_name', latitude = '$latitude', longitude = '$longitude', encoder_id = '$user_id' WHERE id = $school_id";
		$query = $this->db->query($sql);
	}
	
	function get_school_region($id)
	{
		$sql = "SELECT r.id, r.regions_name, rd.city_name, rd.id AS city_id FROM regions_data AS rd
				LEFT JOIN regions_info AS r ON rd.regions_info_id = r.id
				WHERE rd.id = $id";
		$result = $this->db->query($sql);
		return $result->result();
	}

	function get_school($id)
	{
		$sql = "SELECT * FROM school_info where id = $id";
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	function get_region($id)
	{
		$city_id = $_POST["cities"];
		$sql = "SELECT regions_name FROM regions_info where id = $id";
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	function get_city($id)
	{
		$sql = "SELECT city_name FROM regions_data where id = $id";
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	function show_school_city()
	{
		/*
		$fh = fopen("test.txt", "w");
		ob_start();
		var_dump($_POST);
		$data = ob_get_clean();
		fwrite($fh, $data);
		fclose($fh);
		*/

		$regions_data_id = $_POST["cities"];
	
		$sql = "SELECT * FROM school_info WHERE regions_data_id = $regions_data_id ORDER BY school_name ASC";
		$result = $this->db->query($sql);
		return $result->result();
	}
	
	
	function insert_ovitrap_index()
	{
		$x=0;
		foreach ($_POST['ovitrap_index'] as $orvitrap)
		{
			if (!empty($orvitrap))
			{
		$sql = "insert into orvitrap_details values('','".$this->input->post('cities')."','".$_POST['id'][$x]."','".$this->input->post('date_submitted')."','".$_POST['ovitrap_index'][$x]."')";
		$query = $this->db->query($sql);
		//Pag Select ng date sa school info kung iuupdate
		$sql_select_latest_date = $this->db->query("select max(date_submitted) as date_submitted,id,regions_data_id from school_info where id='".$_POST['id'][$x]."' GROUP BY date_submitted");
		foreach ($sql_select_latest_date->result() as $date_validation)
		{
			$date_submitted = $date_validation->date_submitted;
		}
		if ($_POST['date_submitted'] >= $date_submitted)
		{
		$sql1 = "update school_info set date_submitted = '".$_POST['date_submitted']."',ovitrap='".$_POST['ovitrap_index'][$x]."' where id ='".$_POST['id'][$x]."'";
		$query1 = $this->db->query($sql1);
		}
		}
		$x++;
		}
	}
	function update_ovitrap_indeces()
	{
		for($xi=0;$xi<$_POST['count'];$xi++)
		{
			$sql = "update orvitrap_details set total='".$_POST['total_indeces'][$xi]."', date_submitted='".$_POST['date_update_submitted'][$xi]."' where id='".$_POST['id'][$xi]."'";
			$query = $this->db->query($sql);
			
			$sql1 = "update school_info set ovitrap='".$_POST['total_indeces'][$xi]."', date_submitted='".$_POST['date_update_submitted'][$xi]."'  where id='".$_POST['school_id'][$xi]."' and date_submitted='".$_POST['date_submitted'][$xi]."'";
			$query1 = $this->db->query($sql1);
			
			if ($_POST['total_indeces'][$xi] == "0" || $_POST['total_indeces'][$xi] == null)
			{
			$delete = "delete from orvitrap_details where id ='".$_POST['id'][$xi]."'";
			$query2 = $this->db->query($delete);
			
			$select_max_date_from_ovitrap_details =  $this->db->query("select max(date_submitted) as date_submitted from orvitrap_details where school_id ='".$_POST['school_id'][$xi]."'");
			$i = 0;
			foreach ($select_max_date_from_ovitrap_details->result() as $latest_date)
		{
			$get_latest_date[$i] = $latest_date->date_submitted;
			
			$select_total_from_latest_date = $this->db->query("select * from orvitrap_details where date_submitted='".$get_latest_date[$i]."' and school_id ='".$_POST['school_id'][$xi]."'");
			foreach ($select_total_from_latest_date->result() as $latest_total)
			{
				$totals = $latest_total->total;
				
			$set_latest_date = "update school_info set date_submitted='".$get_latest_date[$i]."', ovitrap='$totals' where id='".$_POST['school_id'][$xi]."'";
			$query4 = $this->db->query($set_latest_date);
			}
			
		}
		$i++;
			}
		}
	}
	function update_password()
	{
		$sql = "update dengue_users set password='".md5($this->input->post('new_password'))."' where id ='".$this->input->post('id')."'";
		$query = $this->db->query($sql);
	}
	}
?>
