<html>
<head>
	<link href="<?php echo base_url(); ?>assets/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url(); ?>assets/src/facebox.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
	<script type="text/javascript">
		$(function(){
			$('a[rel*=facebox]').facebox({
				loadingImage : '<?php echo base_url(); ?>assets/src/loading.gif',
				closeImage   : '<?php echo base_url(); ?>assets/src/closelabel.png'
			}).live('click', function() {
				var $this = $(this);
				
				if(!$this.data('chart')) {
					jQuery.facebox({ ajax: this.href });
					$this.data('chart', true);
				}
				return false;
			});
		});
	</script>
</head>
<style type="text/css">
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
  .body_map_canvas
  {
	overflow: hidden;
  }
</style>
		<div id="loading" class="loading-invisible">
  <p><img src="<?php echo base_url(); ?>assets/src/loading.gif"></p>
</div>
<script type="text/javascript">
  document.getElementById("loading").className = "loading-visible";
  var hideDiv = function(){document.getElementById("loading").className = "loading-invisible";};
  var oldLoad = window.onload;
  var newLoad = oldLoad ? function(){hideDiv.call(this);oldLoad.call(this);} : hideDiv;
  window.onload = newLoad;
</script>
	<body class="body_map_canvas">
<?php echo $map['js']; ?>
<?php echo $map['html']; ?>
<a href="<?php echo base_url(); ?>index.php/viewers/graph_data" rel="facebox" style="display:none">need this</a>
</body>
</html>
