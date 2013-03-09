<?php
$xs=0;
foreach ($query as $datas)
{
$data = $datas->total;
$date = $datas->date_submitted;
$date_submitted = explode("-",$date);

if ($date_submitted[1] == "01")
{
	$date_submitted[1] = "Jan";
}
elseif ($date_submitted[1] == "02")
{
	$date_submitted[1] = "Feb";
}
elseif ($date_submitted[1] == "03")
{
	$date_submitted[1] = "Mar";
}
elseif ($date_submitted[1] == "04")
{
	$date_submitted[1] = "Apr";
}
elseif ($date_submitted[1] == "05")
{
	$date_submitted[1] = "May";
}
elseif ($date_submitted[1] == "06")
{
	$date_submitted[1] = "Jun";
}
elseif ($date_submitted[1] == "07")
{
	$date_submitted[1] = "Jul";
}
elseif ($date_submitted[1] == "08")
{
	$date_submitted[1] = "Aug";
}
elseif ($date_submitted[1] == "09")
{
	$date_submitted[1] = "Sep";
}
elseif ($date_submitted[1] == "10")
{
	$date_submitted[1] = "Oct";
}
elseif ($date_submitted[1] == "11")
{
	$date_submitted[1] = "Nov";
}
elseif ($date_submitted[1] == "12")
{
	$date_submitted[1] = "Dec";
}
$d[$xs] = $date_submitted[1]." ".$date_submitted[2].", ".$date_submitted[0];

 $xs++;
 $datass.="$data,";
 $date_s.="$d";
}

$totals=substr($datass, 0, -1);
$sub_total = explode(',',$totals);
$no_input = "'No Ovitrap Index in this Month'";
if ($totals == null)
{
     $totals = "0";
     $weeks = "$no_input";
}

?>


<?php
foreach ($region_id as $city_names)
{
	$naming = $city_names->city_name;
}
if ($_GET['startmonth'] == "1")
{
	$_GET['m_startmonth'] = "Jan";
}
elseif ($_GET['startmonth'] == "2")
{
	$_GET['m_startmonth'] = "Feb";
}
elseif ($_GET['startmonth'] == "3")
{
	$_GET['m_startmonth'] = "Mar";
}
elseif ($_GET['startmonth'] == "4")
{
	$_GET['m_startmonth'] = "Apr";
}
elseif ($_GET['startmonth'] == "5")
{
	$_GET['m_startmonth'] = "May";
}
elseif ($_GET['startmonth'] == "6")
{
	$_GET['m_startmonth'] = "Jun";
}
elseif ($_GET['startmonth'] == "7")
{
	$_GET['m_startmonth'] = "Jul";
}
elseif ($_GET['startmonth'] == "8")
{
	$_GET['m_startmonth'] = "Aug";
}
elseif ($_GET['startmonth'] == "9")
{
	$_GET['m_startmonth'] = "Sep";
}
elseif ($_GET['startmonth'] == "10")
{
	$_GET['m_startmonth'] = "Oct";
}
elseif ($_GET['startmonth'] == "11")
{
	$_GET['m_startmonth'] = "Nov";
}
elseif ($_GET['startmonth'] == "12")
{
	$_GET['m_startmonth'] = "Dec";
}
if ($_GET['endmonth'] == "1")
{
	$_GET['m_endmonth'] = "Jan";
}
elseif ($_GET['endmonth'] == "2")
{
	$_GET['m_endmonth'] = "Feb";
}
elseif ($_GET['endmonth'] == "3")
{
	$_GET['m_endmonth'] = "Mar";
}
elseif ($_GET['endmonth'] == "4")
{
	$_GET['m_endmonth'] = "Apr";
}
elseif ($_GET['endmonth'] == "5")
{
	$_GET['m_endmonth'] = "May";
}
elseif ($_GET['endmonth'] == "6")
{
	$_GET['m_endmonth'] = "Jun";
}
elseif ($_GET['endmonth'] == "7")
{
	$_GET['m_endmonth'] = "Jul";
}
elseif ($_GET['endmonth'] == "8")
{
	$_GET['m_endmonth'] = "Aug";
}
elseif ($_GET['endmonth'] == "9")
{
	$_GET['m_endmonth'] = "Sep";
}
elseif ($_GET['endmonth'] == "10")
{
	$_GET['m_endmonth'] = "Oct";
}
elseif ($_GET['endmonth'] == "11")
{
	$_GET['m_endmonth'] = "Nov";
}
elseif ($_GET['endmonth'] == "12")
{
	$_GET['m_endmonth'] = "Dec";
}
for ($x=0; $x<=(count($sub_total) - 1);$x++)
{
	if ($sub_total[$x] != "0" && $sub_total[$x] <= "5")
	{
		$t[$x] = '<b style="color:gray;font-weight:bold">'.$d[$x].'</b>';
	}
	elseif ($sub_total[$x] <= "19.9" && $sub_total[$x] >= "5")
	{
		$t[$x] = '<b style="color:gray;font-weight:bold">'.$d[$x].'</b>';
	}
	elseif ($sub_total[$x] <= "39.9" && $sub_total[$x] >= "20")
	{
		$t[$x] = '<b style="color:gray;font-weight:bold">'.$d[$x].'</b>';
	}
	elseif ($sub_total[$x] >= "40")
	{
		$t[$x] = '<b style="color:gray;font-weight:bold">'.$d[$x].'</b>';
	}
	$data_weeks = $t[$x];
$datasss.= "'$data_weeks',";
$xx = substr($datasss, 0, -1);
	$xi++;
	
	}
?>
<html>
<head>
	
	<script type="text/javascript">
		$(function(){
			$('a[rel*=facebox]').facebox({
				loadingImage : '<?php echo base_url(); ?>assets/src/loading.gif',
				closeImage   : '<?php echo base_url(); ?>assets/src/closelabel.png'
			});
		});$('a[rel*=facebox]').live("mousedown", function() { 
    $(this).unbind('click');
    $(this).facebox();
			});
	</script>
	<a href='index.php/viewers/graph_data_bar?id=<?php echo $this->input->get('id'); ?>startmonth=<?php echo $this->input->get('startmonth') ?>&endmonth=<?php echo $this->input->get('endmonth')?>&year=<?php echo $this->input->get('year') ?>&region_id=<?php echo $this->input->post('cities') ?>' rel="facebox"><b>Bar Graph</b></a> -
	
	<a href='index.php/viewers/graph_data?id=<?php echo $this->input->get('id'); ?>&startmonth=<?php echo $this->input->get('startmonth') ?>&endmonth=<?php echo $this->input->get('endmonth')?>&year=<?php echo $this->input->get('year') ?>&region_id=<?php echo $this->input->post('cities') ?>' rel="facebox"><b style='color: red;font-size: 14px;'>LINE GRAPH</b></a>
	<script type="text/javascript">
		$(function() {
			var $this = $('.marker-info');
			var orvitraps = $.map($this.attr('data-orvitraps').split(','), function(val) {
				return parseInt(val, 10);
			});
			
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'highchart'+$this.attr('data-id'),
					type: 'line',
					marginRight: 20,
					marginLeft: 59,
					marginBottom: 50
				},
				title: {
					text: $this.attr('data-name')+' <?php echo $naming; ?>',
					x: -20 //center
				},
					subtitle: {
					text: 'As of <?php echo $_GET['m_startmonth'].' - '.$_GET['m_endmonth'].' '.$_GET['year']; ?>',
					x: -20
				},
				
				xAxis: {
					
					
					categories: [<?php echo $xx; ?>]
				},
				yAxis: {
					title: {
						text: 'Ovitrap Index'
					},
					 plotBands : [
				{
                    from : .01,
                    to : 19.9,
                    color : '#86B404'
                },
				{
					from : 20,
					to : 39.9,
					color : '#D7DF01'
				},
				{
                    from : 40,
                    to : 1000,
                    color : '#DF0101'
				}],
					plotLines: [{
						value: 0,
						width: 2,
						color: '#000'
					}]
				},
				
				tooltip: {
					formatter: function() {
						
						return '<b>' +this.y + '</b>' + '';
					}
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true,
							style: {
                            fontWeight: 'bold',
							color: 'black',
                            fontSize: '14px'
							}
						},
						enableMouseTracking: true
						}
					},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'top',
					x: -20,
					y: 600,
					borderWidth: 0
				},
				
				series: [{
					name: ' ',
					data: [<?php echo $totals; ?> ]
					}]
				});
			});
			</script>
</head>
<body>
	<div id="highchart<?php echo $id ?>" style="width:120%; height: 450px" class="marker-info" data-name="<?php echo $name ?>" data-id="<?php echo $id ?>" data-orvitraps="<?php echo $orvitraps ?>" data-month="<?php echo $month ?>" data-year="<?php echo $year ?>"></div>
</body>
</html>
