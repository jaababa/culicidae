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
  /*this is what we want the div to look like
    when it is not showing*/
  div.loading-invisible{
    /*make invisible*/
    display:none;
  }

  /*this is what we want the div to look like
    when it IS showing*/
  div.loading-visible{
    /*make visible*/
    display:block;

    /*position it 200px down the screen*/
    position:absolute;
    top:45%;
    left: 45%;
    width: 2%;
    text-align:center;

    /*in supporting browsers, make it
      a little transparent*/
    background:#fff;
    filter: alpha(opacity=75); /* internet explorer */
    -khtml-opacity: 0.75;      /* khtml, old safari */
    -moz-opacity: 0.75;       /* mozilla, netscape */
    opacity: 0.75;           /* fx, safari, opera */
    border-top:1px solid #ddd;
    border-bottom:1px solid #ddd;
  }
  
</style>

</head>
<script type="text/javascript">
  document.getElementById("loading").className = "loading-visible";
  var hideDiv = function(){document.getElementById("loading").className = "loading-invisible";};
  var oldLoad = window.onload;
  var newLoad = oldLoad ? function(){hideDiv.call(this);oldLoad.call(this);} : hideDiv;
  window.onload = newLoad;
</script>
	<body>
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
xmlhttp.open("GET","<?php echo base_url();?>index.php/administrator/get_region_info_data?region="+region,true);
xmlhttp.send();
}
</script>
<tr>
<td colspan="2" class="td_top td_bottom" align="center"><h3 style="font-family:sans-serif;">INSERT OVITRAP INDEX</h3></td>
</tr>
<tr align="center">
<td colspan="2" class="td_top">

	
<body class="body">
<form id="theform" method="post" action="<?php echo base_url(); ?>index.php/administrator/add_index">
<table width="100%" cellpadding="1" cellspacing="0">
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right td_top" align="right" width="15%">Date Collected:</td>
<td class='td_bottom td_left td_right td_top'>
<input id="datepicker1" type="text" class="date_submit" name="date_submitted" style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
</td>
</tr>
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">Region :</td>
<td class="td_top td_bottom td_left td_right">
<select name="region" id="regions" onchange="Region(this.value)" style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<option value="0">- Select Region -</option>
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
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold; display: none;" id="city_title">
<td class="td_top td_bottom td_left td_right" align="right">City :</td>
<td class="td_top td_bottom td_left td_right">
	
<div id="RegionData">
<img src="<?php echo base_url(); ?>assets/images/small_loading.gif"></div>
</td></tr>
</table>
<div id="txtHint"></div>
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