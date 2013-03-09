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

</script>
<tr>
<td colspan="2" class="td_top td_bottom" align="center"><h3 style="font-family:sans-serif;">Edit School</h3></td>
</tr>
<tr align="center">
<td colspan="2" class="td_top">
<body class="body">
<form id="theform" method="post" action="<?php echo base_url(); ?>index.php/administrator/update_school">
<table width="100%" cellpadding="1" cellspacing="0">
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">Region :</td>
<td class="td_top td_bottom td_left td_right">
<input type="hidden" name="region_id" value="<?php echo $school_region[0]->id; ?>">
<?php echo $school_region[0]->regions_name; ?>
</td>
</tr>
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">City :</td>
<td class="td_top td_bottom td_left td_right">
<input type="hidden" name="city_id" value="<?php echo $school_region[0]->city_id; ?>">
<?php echo $school_region[0]->city_name; ?>
</td></tr>
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">Name of School :</td>
<td class="td_top td_bottom td_left td_right"><input type="text" name="school" size="50" value="<?php echo $school_info[0]->school_name; ?>">
</td></tr>
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">Latitude :</td>
<td class="td_top td_bottom td_left td_right"><input type="text" name="latitude" size="30" value="<?php echo $school_info[0]->latitude; ?>">
</td></tr>
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">Longitude :</td>
<td class="td_top td_bottom td_left td_right"><input type="text" name="longitude" size="30" value="<?php echo $school_info[0]->longitude; ?>">
</td></tr>
</table>
<div id="authors"></div>
<table width="100%" cellpadding="1" cellspacing="0">
   <tr><td class="td_top td_bottom td_left td_right" align="left"><input type="submit" class="submits" name="submit" value=" Submit " onclick="return confirm('Are you sure you want to save all the details?');"></td>
</tr>
</table>
<input type="hidden" name="user_id" value="<?php echo $user_information[0]->id; ?>">
<input type="hidden" name="school_id" value="<?php echo $school_info[0]->id; ?>">
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
