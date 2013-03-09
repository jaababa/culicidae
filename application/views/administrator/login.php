<tr>
<td colspan="2" class="td_top td_bottom" align="center">Welcome to Dengue Database. Please login to proceed. </td>
</tr>
<tr align="center">
<td colspan="2" class="td_top">
<?php echo $message; ?>
<body class="body">
<form method="post" action="<?php echo base_url(); ?>index.php/administrator/login_process">
<table width="40%" cellpadding="1" cellspacing="0">
<tr>
<td class="td_top td_bottom td_left td_right" align="right" style="border: 1px solid dodgerblue;">Username :</td>
<td style="border: 1px solid dodgerblue; border-left:hidden;"><input type="text" name="username" size="30">
</tr>
<tr>
<td class="td_top td_bottom td_left td_right" align="right" style="border: 1px solid dodgerblue;border-top:hidden;">Password :</td>
<td style="border: 1px solid dodgerblue; border-left:hidden;border-top:hidden;"><input type="password" size="30" name="password">
</tr>
<tr>
<td class="td_top td_bottom td_left td_right" align="right" style="border: 1px solid dodgerblue;border-top:hidden;">&nbsp;</td>
<td style="border: 1px solid dodgerblue; border-left:hidden;border-top:hidden;"><input type="submit" name="login" value="Login">
</tr>
</table>
<br><br>
</td>
</tr>
<tr>
<td colspan="2" align="center" style="border-top:hidden;">Copyright 2012 DOST - Philippine Council for Health Research Development </td>
</tr>
</table>
</form>
</body>
</html>