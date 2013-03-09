<html>
<head>
<title>DOST - NOLTS</title>

<head>
	<link rel="icon" href="<?php echo base_url(); ?>assets/images/dengue.ico" type="image/ico" />
<style>
table{margin:-7px -9px 0px;}
.index_input { border: 1px solid dodgerBlue; padding: 2px; }
#draggable
    {
	position: absolute;
	z-index:2;
        width: 10%;
        padding: 0.5em;
        box-shadow: 1px 1px 20px #888888;
        opacity: 0.8;
        font-family: sans-serif;
        font-weight: bold;
        border-radius:10px 10px 10px 10px;
        background-color: #F8F7DF;
	left:100px;
	top:90px;
	cursor: move;
    }

#draggable-desc
    {
	position: absolute;
	z-index:2;
        width:10%;
        padding: 0.5em;
        box-shadow: 1px 1px 20px #888888;
        opacity: 0.8;
        font-family: sans-serif;
        font-weight: bold;
        border-radius:10px 10px 10px 10px;
        background-color: #F8F7DF;
	left:80.3%;
	top:14.4%;
	cursor: move;
    }

    #containment-wrapper { width: 100%; height:90%; position: absolute;}
.fixed
    {
	position:fixed;
	width: 100%;
	top: 0;
    }
#map_canvas,#list_of_schools,body
  {
	margin:-.6% 0 0 0;
  }
</style>
<head>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/autoSuggest.css" />
<script src="<?php echo base_url();?>assets/lib/jquery.js" type="text/javascript"></script>
 <script src="<?php echo base_url();?>assets/lib/jquery.autoSuggest.js"></script>
 <script language="javascript">
  <?php
  $pluginConf = "";
  if(isset($_GET) && count($_GET) > 0){
	   extract($_GET);
  if($limit == "")	$limit = "100";
  if($width == "150")	$width = "150";
$pluginConf = '
$(function() {
  $("#inputBox").autoSuggest({
	ajaxFilePath	 : "'.base_url().'index.php/viewers/footer", 
	ajaxParams       : "dummydata=dummyData",
	autoFill	 : "'.$autofill.'",
	iwidth		 : "'.$width.'",
	opacity		 : "0.9",
	ilimit		 : "'.$limit.'",
	idHolder	 : "id-holder",
	match		 : "'.$match.'"
  });
});';	
   } else {
 $pluginConf = '
  $(function() {
	$("#inputBox").autoSuggest({
		ajaxFilePath	 : "'.base_url().'index.php/viewers/footer",
		ajaxParams	 : "dummydata=dummyData", 
		autoFill	 : false, 
		iwidth		 : "40",
		opacity		 : "0.9",
		ilimit		 : "10",
		idHolder	 : "id-holder",
		match		 : "starts"
	});
  }); ';
 } 
  echo $pluginConf; 
 ?>
 </script> 
<script src="<?php echo base_url(); ?>assets/lib/script.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/popup_style.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style/screen.css" type="text/css" media="screen, projection">
<!--[if IE]><link rel="stylesheet" href="<?php echo base_url(); ?>css/ie.css" type="text/css" media="screen, projection"><![endif]-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
 <script>
	$(function() {
        $( "#draggable" ).draggable({ containment: "#containment-wrapper", scroll: false });
    });
 </script>
 <script>
    $(function() {
        $( "#draggable-desc" ).draggable({ containment: "#containment-wrapper", scroll: false });
    });
    </script>
</head>
<html>
<body onload="initialize()">
	<div class="fixed">
<table border="0" height="8%" width="100%" style="padding-top:-4%;z-index:600;position: absolute;background: scroll 0 0" cellpadding="0" cellspacing="0">
<tr style="background-color:#282929; margin: -10;">
<td style="border-color: #282929; text-align: left;" width="1%"><img src="<?php echo base_url(); ?>assets/images/dost_logo.png" width="40" height="40"></td>
<td style="border-color: #282929; text-align: left;" width="1%"><img src="<?php echo base_url(); ?>assets/images/doh_logo.png" width="40" height="40"></td>
<td style="border-color: #282929; text-align: left;" width="1%"><img src="<?php echo base_url(); ?>assets/images/dilg_logo.png" width="40" height="40"></td>
<td style="border-color: #282929; text-align: left;" width="1%"><img src="<?php echo base_url(); ?>assets/images/deped_logo.png" width="40" height="40"></td>
<td style="font-size: 15px;color: white; font-weight:bold;text-align: left;text-shadow: 0px 0px 0px" width="75%" id="title">Dengue Vector Surveillance Website Nationwide</td>
<td align="right" width="1%"><button type='button' name='submit' class='button positive' id='about'>ABOUT</button></td>
<!--<td><button type='button' name='submit' class='button positive' id='school_list'>LIST OF ALL SCHOOLS</button></td>-->
<!--<td><button type='button' name='submit' class='button positive' id='specific_school_search'>SPECIFIC SCHOOL</button></td>-->
<td align="right" width="1%"><button type='submit' name='submit' class='button positive' id='button'>SEARCH</button></td>
<td align="right" colspan="5" style="display: none;" id="td"><button type='submit' class='button positive' id="back">BACK TO MAP</button></td>
</tr>
</table>
	</div>
<div id="school_search" style="display: none;">
	
	<br><br><br><br>
<table style="margin-top:4%;position: fixed;top: 0%;vertical-align: middle;" cellpadding="0" cellspacing="0">
<tr>
		<td>
			<b>School Name :</b> <input type="text" name="country" placeholder="Search Specific School (School Name)" id="inputBox" size="70" AUTOCOMPLETE="OFF" class="index_input">   
			<form method="post" action="<?php echo base_url() ?>index.php/viewers/specific_school_search">
			<input type="hidden" name="school_id" id="id-holder">
					<input type="submit" name="submit" value="SUBMIT" id="s" style="display: none;">

	   </form>
	</td>
	</tr>
</table>
</div>
<!--popup content-->
	<div id="popupContainer" class="hidden">
        <h2>Search Data</h2>
        <a id="close" class="hidden" title="close popup"></a>
        <form method="post" action="<?php echo base_url(); ?>index.php">
        <table width="80%" cellpadding="0" cellspacing="0">
        </tr>
        <tr>
        <td style="text-align: right;">Month-Year : </td>
        <td>
        <?php $month = date('m'); ?>
        <select name="startmonth" class="index_input">
        <option value="01" <?php if ($month == "04") echo "selected"; ?>>Jan</option>
        <option value="02" <?php if ($month == "05") echo "selected"; ?>>Feb</option>
        <option value="03" <?php if ($month == "06") echo "selected"; ?>>Mar</option>
        <option value="04" <?php if ($month == "07") echo "selected"; ?>>Apr</option>
        <option value="05" <?php if ($month == "08") echo "selected"; ?>>May</option>
        <option value="06" <?php if ($month == "09") echo "selected"; ?>>Jun</option>
        <option value="07" <?php if ($month == "10") echo "selected"; ?>>Jul</option>
        <option value="08" <?php if ($month == "11") echo "selected"; ?>>Aug</option>
        <option value="09" <?php if ($month == "12") echo "selected"; ?>>Sep</option>
        <option value="10" <?php if ($month == "01") echo "selected"; ?>>Oct</option>
        <option value="11" <?php if ($month == "02") echo "selected"; ?>>Nov</option>
        <option value="12" <?php if ($month == "03") echo "selected"; ?>>Dec</option>
        </select> - 
        <select name="endmonth" class="index_input">
        <option value="01" <?php if ($month == "01") echo "selected"; ?>>Jan</option>
        <option value="02" <?php if ($month == "02") echo "selected"; ?>>Feb</option>
        <option value="03" <?php if ($month == "03") echo "selected"; ?>>Mar</option>
        <option value="04" <?php if ($month == "04") echo "selected"; ?>>Apr</option>
        <option value="05" <?php if ($month == "05") echo "selected"; ?>>May</option>
        <option value="06" <?php if ($month == "06") echo "selected"; ?>>Jun</option>
        <option value="07" <?php if ($month == "07") echo "selected"; ?>>Jul</option>
        <option value="08" <?php if ($month == "08") echo "selected"; ?>>Aug</option>
        <option value="09" <?php if ($month == "09") echo "selected"; ?>>Sep</option>
        <option value="10" <?php if ($month == "10") echo "selected"; ?>>Oct</option>
        <option value="11" <?php if ($month == "11") echo "selected"; ?>>Nov</option>
        <option value="12" <?php if ($month == "12") echo "selected"; ?>>Dec</option>
        </select> -
        <select name="year" class="index_input">
	    <?php
	    for($x=date('Y');$x>=2012;$x--)
	    {
                echo "<option>".$x."</option>";
	    }
	    ?>
        </select>
        </td>
        </tr>
        <tr>
        <td style="text-align: right;">Region : </td>
        <td><select name="region" id="regions"  class="index_input">
        <option value="0">All Regions</option>
        <option value="1">National Capital Region</option>
        </select>
        </td>
        </tr>
        <tr id="ncr_data" style="display: none;">
        <td style="text-align: right;">City : </td>
        <td><select name="cities"  class="index_input">
        <?php
         foreach ($regions_info_data as $region_data)
        {
        ?>
        <option value="<?php echo $region_data->id; ?>"><?php echo $region_data->city_name; ?></option>
        <?php
        }
        ?>
        </select>
        </td>
        </tr>
        <tr>
        <td><button type='submit' name='submit' class='button positive' id='button' style=" color: #003366;border: #009900;border-style: solid;border-width: 1px;">SUBMIT</button></td>
        </tr>
        </table>
        </form>
	</div>
		<div id="overlayEffect">
    </div>
	<div id="containment-wrapper">
	<div id="draggable" class="ui-widget-content">
    <table  style="font-size: 14px;" cellpadding="0">
        <tr>
            <td style="font-size: 16px;font-weight: bold;" colspan="4">LEGEND</td>
        </tr>
        <tr>
            <td width="6%"><a href="#" rel="facebox"><img src="<?php echo base_url();?>assets/images/google_maps_pin_gray.png"></a></td>
	    <td valign="middle" width="5%"> = </td>
	    <td valign="middle" align="left">No data</td>
	    </tr>
        <tr>
            <td width="6%"><img src="<?php echo base_url();?>assets/images/google_maps_pin_green.png"></td>
	    <td valign="middle" width="5%"> = </td>
	    <td valign="middle" align="left">Safe</td>
	    </tr>
        <tr>
            <td width="6%"><img src="<?php echo base_url();?>assets/images/google_maps_pin_yellow.png"></td>
	    <td valign="middle" width="5%"> = </td>
	    <td valign="middle" align="left">Warning</td>
	    </tr>
        <tr>
            <td width="6%"><img src="<?php echo base_url();?>assets/images/google_maps_pin_red.png"></td>
	    <td valign="middle" width="5%"> = </td>
	    <td valign="middle" align="left">Alert</td>
	    </tr>
    </table>
</div>
<!--
<div id="draggable-desc" class="ui-widget-content">
    <table  style="font-size: 14px;" cellpadding="0">
	    <tr>
            <td colspan="3"><br><b>DOST Ovicidal / Larvicidal Trap in Schools Nationwide</b><br><br>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo.</td>
	    </tr>
    </table>
</div>
-->
</div>
</body>
<?php
$x=1;
foreach ($region_info as $rows)
{
    $region_name[$x] = $rows->regions_name;
    $id[$x] = $rows->id;
    $x++;
}
?>
<br><br><br>
<table id="about_content" cellpadding="0" cellspacing="0" style="display: none;position: absolute; background-color: white;">
<tr><td style="padding:50px;">
<br><br><br>
<b>ABOUT</b><br><br>

<b>Introduction</b><br><br>

<p>This program is a joint partnership between the Department of Science and Technology (DOST), Department of Education (DepEd), Department of Health (DOH), Department of Interior and Local government (DILG) to install the DOST OL-Traps for Aedes Mosquito nationwide and help reduce dengue cases and control dengue transmission.<p>

<p>The urgent need to support the government's program in reducing the incidence of the country's dengue cases are the main reasons for creating this partnership for the DOST Ovicidal/Larvicidal (O/L) Trap System Nationwide Roll Out. </p>
<p>This undertaking is covered by a Memorandum of Agreement (MOA) of the above mentioned Government Agencies under the acronym ABKD (Aksyon Barangay Kontra Dengue) which was signed on August 25, 2011 in Barangay Bagbag, Quezon City to jointly undertake in the pursuit of addressing the pressing concern on the prevalence of dengue.  The MOA is an inter-agency cooperation strategy for intensifying anti-dengue drive.  Through this MOA, the Department of Science and Technology (DOST) agrees to support by: <br><br>

1. Setting up of an early warning system in monitoring the mosquito population<br>
2. Promoting, assisting and undertaking scientific and technological research and <br>
development on dengue; and <br>
3. Pursuing transfer of technology which ameliorate the standards of dengue 
interventions or mitigate the impact of disease<br>
</p>
<p>With the above-mentioned support by DOST, the department through the leadership of Secretary Mario G. Montejois continually seeking ways to address the problem of dengue.The Industrial Technology Development Institute, in cooperation with the Philippine Council for Health Research and Development, also of the DOST, developed the Ovicidal/Larvicidal (OL) Trap, a three-component system that attracts the Aedes mosquitoes then kills the eggs and larvae.The developed DOST ovi/larvicidal trap system is a device used to control the  Aedes mosquito population. It can monitor control and detect Aedes mosquito populations thus acting as an early warning signal to pre-empt any impending dengue outbreaks.  Aside from being used as a surveillance for Aedesmosquito, the ovitrap is lethal to the eggs due to the  developed natural based larvicide which is incorporated on the oviposition substrate. Autocidalovitrap allows laying of eggs but prevents adult emergence thus reduces the Aedesmosquito densities.</p>

<p>The developed ovi/larvicidal mosquito trap offers a simple, cheap and efficient tool for surveillance and control of mosquito.</p>

<p>To further strengthen the government's campaign to reduce the number of dengue cases and transmission of the virus, DOST spearheaded the program of deploying the DOST OL- Trap Kits to all schools nationwide in collaboration with DepEd, DOH and DILG. Under this program there are three components involved.  </p>
<p>
These are as follow:<br><br>

1.	Provision of 1 Million Ovi/Larvicidal Trap Kits for Aedes Mosquito for Distribution to public elementary and secondary schools thru the Department of Education which involves deployment, training, and monitoring of OL Traps in School-Based OL Trap Roll-Out. <br>

2.	Dengue Early Warning System (DEWS)<br>

3.	Communicating Anti-Dengue Measures: The OL Trap Information and 
Education Campaign.<br>
</p>
<p>
Component 1 which is primarily the provision of  1 million OL Trap kits, provision of 6 months supply OL pellets and ovipaddles  involves deployment, installation of O/L trap, monitoring of dengue cases and OL index by the DOST Regional Offices in partnership with the Department of Education and Department of Health.  Other activities are training and capacity building of educators, teachers, school principals, nurses, barangay health workers, and any other entity deem necessary and appropriate.<br><br>
Component 2 will be the Dengue Early Warning System (DEWS). This component will make use of the DOST developed O/L trap for the mosquito density population in the selected schools in the National Capital Region initially and later to be rolled out in the different regions.    Side by side with the entomological density determination a sub-study will be undertaken to determine the proportion of true dengue from those clinically diagnosed as dengue. It will also seek to determine the relative abundance of dengue serotypes isolated from the true dengue cases.  <br><br>
Component 3 is to strengthen the government's efforts in curbing the dengue problem by increasing the awareness on and appreciation of the OL trap system among these population segments: teachers, parents, students, and the community through Information and education Campaign activities<br><br>
</p>
<p>
Description<br><br>
	The website is about the OL Trap mosquito indices monitored from the different schools per town/city per region nationwide using the DOST OL Trap system. Mosquito indices are uploaded weekly per school and trend/results can be seen in the website.  Mosquito indices is a measurement of mosquito eggs in specified geographic locations which, in turn, reflects the distribution of Aedes mosquitoes, the vector for dengue. These are then classified into four different categories with actions to be taken.  The DOH shall then issue a public advisory where areas are high risk of dengue outbreak.
</p>
<p>
Reference:<br>
A. V. Briones, A. Garbo, E. Casa, H. Bion, N. E. Almanzor,  S. T. Bernardo,  2012. Effects of Aqueous Extract and Pelletized Form of Piper Nigrum L. on the Oviposition Behavior of Aedes Aegypti Mosquitoes and Its Larvicidal Activity in Autocidal Ovitraps,  Acta Medica Philippina, Vol. 46, No. 3  Jul-Sep.
</p>
</td></tr>
</table>
<table id="list_of_schools" cellpadding="0" cellspacing="0" style="display: none;position: absolute; background-color: white;">
        <?php
        for ($p=0;$p<=$x;$p++)
        {
            echo "<tr id='region_$p'><td style='font-size:20px;'>".$region_name[$p]."</td></tr>";
            $querys = mysql_query("select * from regions_data where regions_info_id ='".$p."' order by city_name ASC");
            $s=0;
            while($rowss = mysql_fetch_array($querys))
            {
                echo "<tr id='city_$s'><td style='font-size:30px;color-red;'><button type='submit' class='button positive' id='calo$s'>".$rowss['city_name']."</button></td></tr>";
             $id[$s] = $rowss['id'];
            
                 $queryss = mysql_query("select * from school_info where regions_data_id ='".$id[$s]."' order by school_name ASC");
	   $count = 1;
	   echo "<tr><td><table id='city_info_$s' style='border:1px solid;width:100%;display:none;' cellpading='0' cellspacing='0'>";
            while($rowsss = mysql_fetch_array($queryss))
            {
                if ($count % 3 == 1)
                {
                echo "<tr></tr>";
                }
            echo "<td align='left' style='width:30%;'>".$rowsss['school_name']."</td>";
	    
            $count++;
            }
	    echo "</table></td></tr>";
             $s++;
	        }
        }
?>
</table>
</html>
<script>
$('#regions').live("change", function(){
    var selected = $(this).val();
    if(selected == '1'){
      $('#ncr_data').show();
    }
    else
    {
      $('#ncr_data').hide();
    }
    if(selected == '2'){
      $('#region1').show();
    }
    else
    {
      $('#region1').hide();
    }
});
   $("#school_list").live('click',function(){
	$("#button").hide();
	$("#school_list").hide();
	$("#containment-wrapper").hide();
	$("#about").hide();
	$("#user_guide").hide();
	$("#map_canvas").hide();
	$("#specific_school_search").hide();
	$(".load").hide();
	$("#hide_search").hide();
	$("#td").show();
	$("#school_search").hide();
	$("#about_content").hide();
	$("#list_of_schools").show();
	$("#specific_school_search").attr('id','hide_search');
	$("#hide_search").attr('id','specific_school_search');
	$('.body_map_canvas').attr('class','xx');
	$('#title').attr('width','80%');
});
$("#about").live('click',function(){
	$("#button").hide();
	$("#school_list").hide();
	$("#containment-wrapper").hide();
	$("#about").hide();
	$("#user_guide").hide();
	$("#map_canvas").hide();
	$("#specific_school_search").hide();
	$(".load").hide();
	$("#hide_search").hide();
	$("#td").show();
	$("#school_search").hide();
	$("#list_of_schools").hide();
	$("#about_content").show();
	$("#specific_school_search").attr('id','hide_search');
	$("#hide_search").attr('id','specific_school_search');
	$('.body_map_canvas').attr('class','xx');
	$('#title').attr('width','80%');
});
   $("#back").live('click',function()
		   {
	$("#button").show();
	$("#school_list").show();
	$("#containment-wrapper").show();
	$("#td").hide();
	$(".load").show();
	$("#about").show();
	$("#user_guide").show();
	$("#specific_school_search").show();
	$("#map_canvas").show();
	$("#list_of_schools").hide();
	$("#about_content").hide();
	$("#hide_search").show();
	$('.xx').attr('class','body_map_canvas');
	$('#title').attr('width','50%');
	
});
   $("#specific_school_search").live('click',function()
				     {
	$("#school_search").show("fast");
	$("#specific_school_search").attr('id','hide_search');
	
});
   
   $("#hide_search").live('click',function()
				     {
	$("#school_search").hide("fast");
	$("#hide_search").attr('id','specific_school_search');
	
});
   
   $("#calo0").live('click',function(){
	$("#city_info_0").hide("slow");
	$('#calo0').attr('id','caloo0');
});
   $("#caloo0").live('click',function(){
	$("#city_info_0").show("slow");
	$('#caloo0').attr('id','calo0');
});
   $('#inputBox').bind('keypress', function(e) {
        if(e.keyCode==13){
	 setTimeout(function() {
                $('#s').trigger('click');
  }, 1000);
  e.preventDefault();
        }
});
$("#inputBox").change(function(event)
		      {
	 setTimeout(function() {
                $('#s').trigger('click');
  }, 1000);
});
</script>
