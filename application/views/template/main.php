<?php 
	//initialization
	$location = isset($location) ? $location : NULL;
	$menu = isset($menu) ? $menu : array();
	$content = isset($content) ? $content : NULL;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Singtel Sales Tracker</title>
<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/fav.ico" />

<!-- General CSS -->
<link type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1-min.js"></script>

<!-- jQuery-UI -->
<link type="text/css" href="<?php echo base_url(); ?>assets/css/ui-lightness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui-1.10.3.custom.min.js"></script>

<!-- Multiselect -->
<link type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.multiselect.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.multiselect.js"></script>

<!-- Table Sorter -->
<link type="text/css" href="<?php echo base_url(); ?>assets/css/tablesorter.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.tablesorter.min.js"></script>

<!-- ScrollTo -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.scrollTo-1.4.3.1-min.js"></script>
<script type="text/javascript">
	var targetUrl;
	$(document).ready(function(){
		$( "#dialog-confirm" ).dialog({
				autoOpen: false,
				resizable: false,
				height:170,
				modal: true,
				buttons: {
					"Delete record": function() {
						window.location.href = targetUrl;
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		$( ".delete" ).click(function(e){
			e.preventDefault();
			targetUrl = $(this).attr("href");
			$( "#dialog-confirm" ).dialog( "open" );
		});
		$( '.button_edit' ).button({ icons: {primary:'ui-icon-pencil'} });
		$( '.button_add' ).button({ icons: {primary:'ui-icon-plus'} });
		$( '.button_back' ).button({ icons: {primary:'ui-icon-triangle-1-w'} });
		$( '.button_cart' ).button({ icons: {primary:'ui-icon-cart'} });
		$( '.tablesorter' ).tablesorter({widgets: ['zebra']}); //make table sortable
		$( '.datepicker' ).datepicker({ dateFormat: 'yy-mm-dd' }); //make datepicker
		//$( '.tablesorter' ).tablesorterPager({container: $(".pager")}); //paginate
		
	});
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</head>
<body>
	<div id="content">
		<div id="contentHeader">
			<div style="width: 1286px; margin: auto;">
				<div id="nslogo"></div>
				<div id="appTitle">Singtel Sales Tracker</div>
				<?php isset($_SESSION['lend_user']) ? $this->load->view('template/top-menu') : FALSE; //load top menus on user login ?>
			</div>
		</div>
		<div id="navMenu">
			<?php $this->load->view('template/location', array('location' => $location)); //load location ?>
		</div>
		
		<?php isset($data) ? $this->load->view($content, $data) : $this->load->view($content); //load page content ?>
		<div class="clearFix"></div>
		<div id="contentFooter">Copyright 2012. Northstar Solutions, Inc. All
			Rights Reserved.
		</div>
	</div>
	<div id="dialog-confirm" title="Delete Record Confirmation">
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These record will be permanently deleted and cannot be recovered. Are you sure?</p>
	</div>
</body>
</html>
