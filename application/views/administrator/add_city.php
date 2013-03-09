<?php session_start();
foreach ($user_information as $data)
?>
<?php if ($data->username == null)
{
redirect(base_url(). 'index.php/administrator/login_process');
}
?>
<?php
foreach($school_data as $school_info)
?>
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
function showUser(str)
{
if (str=="")
{
    document.getElementById("txtHint").innerHTML="";
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","<?php echo base_url();?>index.php/administrator/get_school_info_insert_format?cities="+str,true);
xmlhttp.send();
}
//Region Info
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
xmlhttp.open("GET","<?php echo base_url();?>index.php/administrator/get_region_info_data_for_region?region="+region,true);
xmlhttp.send();
}
</script>
<tr>
<td colspan="2" class="td_top td_bottom" align="center"><h3 style="font-family:sans-serif;">ADD NEW CITY FOR REGION</h3></td>
</tr>
<tr align="center">
<td colspan="2" class="td_top">
<body class="body">
<form id="theform" method="post" action="<?php echo base_url(); ?>index.php/administrator/add_city">
<table width="100%" cellpadding="1" cellspacing="0">
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">Region :</td>
<td class="td_top td_bottom td_left td_right">
<select name="region" id="regions" style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<option value="">- Select Region -</option>
<?php
foreach($region as $region_data)
{
?>
<option value="<?php echo $region_data->id; ?>"><?php echo $region_data->regions_name; ?></option>
<?php
}
?>
</select>
</td>
</tr>
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">Name of City :</td>
<td class="td_top td_bottom td_left td_right"><input type="text" name="city" size="50">
</td></tr>
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">Latitude :</td>
<td class="td_top td_bottom td_left td_right"><input type="text" name="latitude" size="30">
</td></tr>
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">Longitude :</td>
<td class="td_top td_bottom td_left td_right"><input type="text" name="longitude" size="30">
</td></tr>
</table>
<div id="authors"></div>
<table width="100%" cellpadding="1" cellspacing="0">
   <tr><td class="td_top td_bottom td_left td_right" align="left"><input type="submit" class="submits" name="submit" value=" Submit " onclick="return confirm('Are you sure you want to save all the details?');"></td>
</tr>
</table>
<input type="hidden" name="user_id" value="<?php echo $user_information[0]->id; ?>">
</form>
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
</script>
<br><br>
</td>
</tr><tr>
<td colspan="2" align="center" style="border-top:hidden;">Copyright 2012 DOST - Philippine Council for Health Research Development </td>
</tr>
</table>
</body>
</html>
