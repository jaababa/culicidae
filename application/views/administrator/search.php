<?php session_start();
foreach ($user_information as $data)
?>
<?php if ($data->username == null)
{
redirect(base_url(). 'index.php/administrator/login_process');
}
?>
<html>
<head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/date_picker/public/css/reset.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/date_picker/public/css/zebra_datepicker.css" type="text/css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/date_picker/libraries/syntaxhighlighter/public/css/shCoreDefault.css">
<script src="<?php echo base_url();?>assets/validation/validation.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/number.js" type="text/javascript"></script>
<style type="text/css">
.needsfilled 
{
	border: 2px solid red;
	background-color: #FFFFf0;
	color: red;
}
input,select
{
    border :1px solid gray;
}
</style>
</head>
<script>
function showData(strs)
{
if (strs=="")
{
    document.getElementById("txtHints").innerHTML="";
    return;
}
    if (window.XMLHttpRequest)
{
// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{
// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
    document.getElementById("txtHints").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","<?php echo base_url();?>index.php/administrator/get_school_data_inserted?school_id="+strs,true);
xmlhttp.send();
}
function Region(region)
{
if (region=="")
{
    document.getElementById("RegionData").innerHTML="";
    return;
}
    if (window.XMLHttpRequest)
{
// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{
// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
    document.getElementById("RegionData").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","<?php echo base_url();?>index.php/administrator/get_region_info_data?region="+region,true);
xmlhttp.send();
}

</script>
<tr>
<td colspan="2" class="td_top td_bottom" align="center"><h3 style="font-family:sans-serif;">SEARCH</h3></td>
</tr>
<tr align="center">
<td colspan="2" class="td_top">
<body class="body">
<form id="theform" method="post" action="<?php echo base_url(); ?>index.php/administrator/get_search_data">
<table width="100%" cellpadding="1" cellspacing="0">
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right td_top" align="right" width="15%">Date Collected :</td>
<td class='td_bottom td_left td_right td_top'>
<input id="datepicker1" type="text" name="date" value="<?php echo $this->input->post('date'); ?>" style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
</td>
</tr>
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">Region :</td>
<td class="td_top td_bottom td_left td_right">
<select name="region" id="regions" onchange="Region(this.value)" style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<option value="0">- Select Region -</option>
<?php
if ($data->user_role == "1")
{
foreach($region as $region_data)
{
?>
<option value="<?php echo $region_data->id; ?>"><?php echo $region_data->regions_name; ?></option>
<?php
}
}
elseif ($data->user_role == "2")
{
	echo '<option value="1">National Capital Region (NCR)</option>';
}
elseif ($data->user_role == "3")
{
	echo '<option value="3">Region 1</option>';
}
?>
</select>
</td>
</tr>

<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold; display: none;" id="city_title">
<td class="td_top td_bottom td_left td_right" align="right">City :</td>
<td class="td_top td_bottom td_left td_right">
	
<div id="RegionData"></div>
</td></tr>
<tr>
<td class="td_top td_bottom td_left td_right" align="right"><input type="submit" class="submits" name="submit" value=" Submit "></td>
</tr>
</table>
</form>

<form  id="updateform" method="post" action="<?php echo base_url(); ?>index.php/administrator/update_searched_data">
<?php foreach ($city_name as $name)
if ($name->city_name != null)
{
echo'
<table border="1" width="100%"  style="border: 1px solid dodgerblue;" cellspacing="0" cellpadding="0">
<tr>
<td style="font-size:20px;font-family:san-serif;border: 1px solid dodgerblue;" align="center" colspan="3">Search Results for '.$name->city_name.' </td>
</tr>
<tr style="border: 1px solid dodgerblue;">
<td align="center" width="60%" style="border: 1px solid dodgerblue;"><b>Schools</b></td>
<td align="center" style="border: 1px solid dodgerblue;"><b>All Indeces</b></td>
<td align="center" style="border: 1px solid dodgerblue;"><b>Date Collected</b></td>
</tr>';
?>
<?php
$x=0;
foreach ($inf as $row)
{
    $school[$x] = $row->school_name;
    $rank[$x] = $row->id;
    $x++;
}

$count = count($rank);
for ($x=0;$x<=$count;$x++)
{
    $query1 = "SELECT * FROM orvitrap_details where school_id='".$rank[$x]."' and date_submitted='".$this->input->post('date')."'";
    $result1 = $this->db->query($query1);
    foreach($result1->result() as $rows)
{
   
?>
<tr align="center">
<td style="border: 1px solid dodgerblue;text-align: left;"><?php echo $school[$x]; ?></td>
<td style="border: 1px solid dodgerblue;text-align: center;"><input style="width:70px;font-weight:bold" type="text" onKeyPress="return numbersonly(this, event)" value="<?php echo $rows->total; ?>" name="total_indeces[]"></td>
<td style="border: 1px solid dodgerblue;text-align: center;"><input style="width:85px;font-weight:bold" type="text" id="datepicker_search<?php echo $x; ?>"  name="date_update_submitted[]" value='<?php echo $rows->date_submitted; ?>'></td>
<input type='hidden' name="date_submitted[]" value='<?php echo $rows->date_submitted; ?>'>
<?php $school_id = count($rows->school_id);
$total += $school_id;
?>
<input type='hidden' name="school_id[]" value='<?php echo $rows->school_id; ?>'>
<input type='hidden' name="id[]" value='<?php echo $rows->id; ?>'>
</tr>
<?php
}
}
?>
<input type="hidden" name="count" value="<?php echo $total; ?>">
<tr>
    <td style="border: 1px solid dodgerblue;" colspan="3" align="left">
    <input type="submit" class="submits_data" value="Update" name="update"></td>
</tr>
</form>
<?php
}
?>
<script>
		$(document).ready(function() {
for (i=0; i<=<?php echo $count; ?>; i++)
  {
    $("#datepicker_search"+i).Zebra_DatePicker();
  }
});
</script>
<script>
	
	<?php
	for ($x=0;$x<=13;$x++)
	{
	?>
$('#regions').live("change", function(){
    var selected = $(this).val();
    if(selected == '<?php echo $x; ?>'){
      $('#school').hide();
    }
    if(selected == '0')
    {
      $('#city_title').hide();
    }
    else
    {
	$('#city_title').show();
    }
});
<?php
}
?>
$('#city').live("change", function(){
    var selected = $(this).val();
    if(selected == "x")
    {    
      $('#txtHint').hide();
      $('#school_label').hide();
      var select = jQuery('#schools');
      select.val(jQuery('option:first', select).val());
    }
    else
    {
     $('#txtHint').show();
     $('#school_label').show();
    }
});

</script>
<br><br>
</td>
</tr><tr>
<td colspan="2" align="center" style="border-top:hidden;">Copyright 2012 DOST - Philippine Council for Health Research Development </td>
</tr>
</table>
</body>
</html>