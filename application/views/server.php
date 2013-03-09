<?php extract($_POST);
	if($match == "starts")
	$like = " like '".$data."%' ";
	$query1 = "select *,school_info.id as s_id from school_info,regions_data,regions_info where school_info.regions_data_id=regions_data.id and regions_info.id=regions_data.regions_info_id and school_name ".$like." limit 10";
	$result1 = $this->db->query($query1);
	foreach($result1->result() as $rows)
	{
		if($getId == 1) $list .= $rows->s_id."-";
		$list .= ucfirst(str_replace('-', '~', $rows->school_name)).", ".$rows->city_name."|";
		}
		// send all collected data to the client
		$list = substr($list,0,-1);
		echo $list;
?>	   
