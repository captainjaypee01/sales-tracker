		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">Add Record</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<ul>
					<li><a href="<?php echo base_url().'agent'; ?>">Search</a></li>
					<li><a href="<?php echo base_url(); ?>agent/calculator">Calculator</a></li>
					<li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
				</ul>
	        </div>
	        <div class="rightcontentBody">
	        	<form action="" method="post">
	        	<div class="manage_menu"><a href="<?php echo base_url().'agent/view/'.$result['id']; ?>" class="button_edit">Back</a> <input type="submit" name="submit_form" value="Save" class="button_edit" /></div>
        		<div class="frm_container">
        			<?php echo $this->session->flashdata('prompt'); ?>
	        		<div class="frm_heading"><span>Customer's Particulars</span></div>
	        		<div class="frm_inputs">
	        			<table class="info_view">
		        			<tr>
		        				<td>Name:</td>
		        				<td><?php echo $result['app_name']; ?></td>
		        			</tr>
		        			<tr>
		        				<td>NRIC:</td>
		        				<td><?php echo $result['NRIC']; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Date of Birth:</td>
		        				<td><?php echo $result['dob']; ?></td>
		        			</tr>
		        			<tr>
		        				<td>IPTV No:</td>
		        				<td><?php echo $result['IPTV_NO']; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Telephone</td>
		        				<td><?php echo $result['phone_no']; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Mobile</td>
		        				<td><?php echo $result['mobile_no']; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Agent:</td>
		        				<td><?php echo $result['agent_id']; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Campaign:</td>
		        				<td><?php echo $result['campaign']; ?></td>
		        			</tr>
		        		</table>
	        		</div>
        		</div>
        		<?php echo $form; ?>
        		<div>
	        		<input type="hidden" name="sale_id" value="<?php echo $result['id']; ?>" />
	        		<input type="hidden" name="phone_no" value="<?php echo $result['phone_no']; ?>" />
        		</div>
        		</form>
	        </div>
	        <div class="clearFix"></div>
		</div>
		<script>
		
			function uncheck(selector) {
				var group_name = $(selector).attr('name');
	    		var group_id = group_name.split('_');
	    		$('input[id^="pack_' + group_id[0] + '"]:radio').prop('checked', false);
	    		$('input[id^="pack_' + group_id[0] + '"]:radio').prop('disabled', true);
			}
			
			function enable(selector) {
				var group_name = $(selector).attr('name');
	    		var group_id = group_name.split('_');
	    		$('input[id^="pack_' + group_id[0] + '"]:radio').prop('disabled', false);
			}
			
			$('input[id^="promo_"]:radio').each(function(){
			    var group_name = $(this).attr('name');
    			var group_id = group_name.split('_');
    			if($(this).attr('checked') == 'checked') {
    				$('input[id^="pack_' + group_id[0] + '"]:radio').prop('checked', false);
    				$('input[id^="pack_' + group_id[0] + '"]:radio').prop('disabled', true);
    			} else {
    				$('input[id^="pack_' + group_id[0] + '"]:radio').prop('disabled', false);
    			} 
			});

			$("input:radio").dblclick( function () { 
				$(this).prop('checked', false);
			});
			
    		$('input[id^="promo_"]:radio').dblclick(function(){
    			enable($(this));
    		});
    		
    		$('input[id^="promo_"]:radio').click(function(){
    			uncheck($(this));
    		});
    	</script>