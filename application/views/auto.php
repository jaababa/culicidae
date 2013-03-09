<html>
 
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/style/autoSuggest.css" />
<script src="<?php echo base_url();?>assets/lib/jquery.js" type="text/javascript"></script>
 <script src="<?php echo base_url();?>assets/lib/jquery.autoSuggest.js"></script>
 <script language="javascript">
  <?php
  $pluginConf = "";
  if(isset($_GET) && count($_GET) > 0){
	   extract($_GET);
  if($limit == "")	$limit = "100";
  if($width == "100")	$width = "100";
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
 <body>
   <center>
 
 
	  <div class="page">
	   <div class="tab" id="demo"> 
					<div class="contents">
						
						School Name : 
							<input type="text" name="country" id="inputBox" size="40" AUTOCOMPLETE="OFF" >   
							  <form method="get" action="google.php?id=<?php echo $_GET['ids']; ?>">
							<input type="text" name="ids" id="id-holder" size="10">
							 <input type="submit" name="submit" value="SUBMIT" id="s" style="display: none;">
						<br><br>
					</div>
				</div>
	   
	   </form>
<script>
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