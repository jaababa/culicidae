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
<script src="<?php echo base_url();?>assets/validation/validation.js" type="text/javascript"></script>
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
<td colspan="2" class="td_top td_bottom" align="center"><h3 style="font-family:sans-serif;">ADD NEW USER</h3></td>
</tr>
<tr align="center">
<td colspan="2" class="td_top">
	<?php echo $message; ?>
<body class="body">
<form id="theform" method="post" action="<?php echo base_url(); ?>index.php/administrator/update_password">
<input type="hidden" value="<?php echo $data->id; ?>" name="id">
<table width="100%" cellpadding="3 " cellspacing="0" border=0  style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<tr>
<td class="td_top td_bottom td_left td_right td_top" align="right" width="45%">Username :</td>
<td class='td_bottom td_left td_right td_top'>
<input type="username" size="30" id="regions">
</td>
</tr>
<tr>
<td class="td_top td_bottom td_left td_right td_top" align="right">New Password :</td>
<td class='td_bottom td_left td_right td_top'>
<input type="text" name="new_password" size="30" id="required">
</td>
</tr>
<tr>
<td class="td_top td_bottom td_left td_right td_top" align="right">Re - Type Password :</td>
<td class='td_bottom td_left td_right td_top'>
<input type="text" name="retype_password" size="30" id="city">
</td>
</tr>
<tr>
<td class="td_top td_bottom td_left td_right td_top" align="right">User Roles :</td>
<td class='td_bottom td_left td_right td_top'>
<input type="radio" name="user_roles" value="admin" checked="checked">Encoder
<input type="radio" name="user_roles" value="super admin">Administrator
</td>
</tr>
<tr>
<td class="td_top td_bottom td_left td_right" align="right"><input type="submit" class="submits" name="submit" value=" Submit "></td>
</tr>
</table>
</form>
<br><br>
</td>
</tr>
<tr>
<td colspan="2" align="center" style="border-top:hidden;">Copyright 2012 DOST - Philippine Council for Health Research Development </td>
</tr>
</table>
</body>
</html>