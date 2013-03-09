  <?php session_start();
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
foreach ($user_information as $data)
?>
<html>
<head>
<noscript>
  <meta http-equiv="refresh" content="0; url=<?php echo base_url(); ?>index.php/administrator/javascript/" />
</noscript>
<title>DENGUE DATABASE</title>
<link href="<?php echo base_url(); ?>assets/style/administrator.css" media="screen" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/lib/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/date_picker/libraries/syntaxhighlighter/public/javascript/XRegExp.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/date_picker/libraries/syntaxhighlighter/public/javascript/shCore.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/date_picker/libraries/syntaxhighlighter/public/javascript/shLegacy.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/date_picker/libraries/syntaxhighlighter/public/javascript/shBrushJScript.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/date_picker/public/javascript/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/date_picker/public/javascript/functions.js"></script>
        <script type="text/javascript">
            SyntaxHighlighter.defaults['toolbar'] = false;
            SyntaxHighlighter.all();
        </script>
</head>
<table border="1" width="60%" cellpadding="10" cellspacing="0" class="table">
<tr align="center">
<td class="header td_left" width="80%">Philippine Council for Health Research Development<br>Dengue Trap Project</td>
<td class="td_right"><img src="<?php echo base_url(); ?>assets/images/pchrd_logo.png" width="60%" height="10%"></td>
</tr>
<tr>
<td colspan="2" class="td_top" style="background-color:#FFF5EE; font-family: sans-serif;font-size: 12px;font-weight:bold;">&nbsp;
<?php if ($data->username != null)
{
    echo "<div style='float:right;'>
			<a href='".base_url()."index.php/administrator/homepage/'>Search</a> -
			<a href='".base_url()."index.php/administrator/add_index'>Ovitrap Index</a> - 
			<a href='".base_url()."index.php/administrator/add_school'>Add New Schools</a> - 
			<a href='".base_url()."index.php/administrator/manage_school'>Manage Schools</a> - 
			<a href='".base_url()."index.php/administrator/add_user'>Add User</a> -
			<a href='".base_url()."index.php/administrator/add_city'>Add City</a> -
			<a href='".base_url()."index.php/administrator/update_password'>Update Password</a> - 
			<a href='".base_url()."index.php/administrator/logout'>Logout</a></div>";
    echo "<br><br><div style='float:right;'>You Are Logged in as : ".$data->lastname.", ".$data->firstname." ".$data->middleinitial."</div>";
}
?>
</td>
</tr>
