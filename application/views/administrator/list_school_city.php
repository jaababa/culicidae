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

<tr>
<td colspan="2" class="td_top td_bottom" align="center"><h3 style="font-family:sans-serif;">School list per city</h3></td>
</tr>
<tr align="center">
<td colspan="2" class="td_top">
<body class="body">
<form id="theform" method="post" action="<?php echo base_url(); ?>index.php/administrator/manage_school">
<table width="100%" cellpadding="1" cellspacing="0">
<tr style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<td class="td_top td_bottom td_left td_right" align="right">School name</td>
</tr>

<?php
$i = 1;
foreach($schools as $school)
{
?>
	<tr><td width="4%"><?php echo $i;?></td><td><?php echo $school->school_name; ?></td><td><a href="<?php echo base_url(); ?>index.php/administrator/edit_school?school=<?php echo $school->id;?>">edit</a></td></tr>
<?php
	$i++;
}
?>
</table>

</body>
</html>
