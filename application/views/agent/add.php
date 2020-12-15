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
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Basic Info</span></div>
	        		<div class="frm_inputs">
	        			<table class="info_view">
		        			<tr>
		        				<td>Agent:</td>
		        				<td><?php echo $this->session->userdata('SINGTEL.username'); ?></td>
		        			</tr>
		        			<tr>
		        				<td>Phone Number:</td>
		        				<td><?php echo $this->uri->segment(3); ?></td>
		        			</tr>
		        			<tr>
		        				<td>Lead Base:</td>
		        				<td><?php echo $this->uri->segment(4); ?></td>
		        			</tr>
		        		</table>
	        		</div>
        		</div>
	        	<form action="" method="post">
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Customer Info</span></div>
		        		<div class="frm_inputs">
		        			<table class="form_tbl">
			        			<tr>
			        				<td>Applicant Name:</td>
			        				<td><input type="text" name="app_name" value="<?php echo set_value('app_name'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>NRIC:</td>
			        				<td><input type="text" name="NRIC" value="<?php echo set_value('NRIC'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>DEL Number:</td>
			        				<td><input type="text" name="ADSL_NO" value="<?php echo set_value('ADSL_NO'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Mobile Number:</td>
			        				<td><input type="text" name="mobile_no" value="<?php echo set_value('mobile_no'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Alt Number:</td>
			        				<td><input type="text" name="alt_no" value="<?php echo set_value('alt_no'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>IPTV Number:</td>
			        				<td><input type="text" name="IPTV_NO" value="<?php echo set_value('IPTV_NO'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Date of Birth:</td>
			        				<td><input type="text" name="dob" value="<?php echo set_value('dob'); ?>" /></td>
			        			</tr>
			        		</table>
		        		</div>
	        		</div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Secondary Contact Information</span></div>
		        		<div class="frm_inputs">
		        			<table class="form_tbl">
			        			<tr>
			        				<td>NRIC:</td>
			        				<td><input type="text" name="snd_nric" value="<?php echo set_value('snd_nric'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Date of Birth:</td>
			        				<td><input type="text" name="snd_dob" value="<?php echo set_value('snd_dob'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Email Address:</td>
			        				<td><input type="text" name="snd_email" value="<?php echo set_value('snd_email'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Contact Number:</td>
			        				<td><input type="text" name="snd_contact" value="<?php echo set_value('snd_contact'); ?>" /></td>
			        			</tr>
			        		</table>
		        		</div>
	        		</div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Product Info</span></div>
		        		<div class="frm_inputs">
		        			<table class="form_tbl">
                                <tr>
                                    <td>Plan Option:</td>
                                    <td><?php echo form_dropdown('plan_option',$dropdown['plan_option'],set_value('plan_option')); ?></td>
                                </tr>
                                <tr>
                                    <td>Existing Internet Speed:</td>
                                    <td><input type="text" name="existing_internet_speed" value="<?php echo set_value('existing_internet_speed'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>New Internet Speed:</td>
                                    <td><input type="text" name="new_internet_speed" value="<?php echo set_value('new_internet_speed'); ?>" /></td>
								</tr>
								<tr>
									<td>TV Pack</td>
									<td>
										<select class="js-example-basic-multiple" name="tv_pack[]" multiple="multiple">
											
										</select>
									</td>
								</tr>
                                <tr>
                                    <td>Existing Pack:</td>
                                    <td><input type="text" name="existing_pack" value="<?php echo set_value('existing_pack'); ?>" /></td>
                                </tr>
		        				<tr>
			        				<td>Existing Pack ARPU:</td>
                                    <td><input type="text" name="existing_pack_arpu" value="<?php echo set_value('existing_pack_arpu'); ?>" /></td>
			        			</tr>
                                <tr>
                                    <td>Package Offer:</td>
                                    <td><input type="text" name="package_offer" value="<?php echo set_value('package_offer'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>New Pack ARPU:</td>
                                    <td><input type="text" name="new_pack_arpu" value="<?php echo set_value('new_pack_arpu'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>ARPU Difference:</td>
                                    <td><input type="text" name="arpu_difference" value="<?php echo set_value('arpu_difference'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>DVR:</td>
                                    <td><input type="text" name="dvr" value="<?php echo set_value('dvr'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Singtel TV Go:</td>
                                    <td><input type="text" name="singtel_tv_go" value="<?php echo set_value('singtel_tv_go'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Family Protection:</td>
                                    <td><input type="text" name="family_protection" value="<?php echo set_value('family_protection'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Security Suit (WinOS):</td>
                                    <td><input type="text" name="security_suit_winos" value="<?php echo set_value('security_suit_winos'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Security Suit (MacOS):</td>
                                    <td><input type="text" name="security_suite_macos" value="<?php echo set_value('security_suite_macos'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Tier:</td>
                                    <td><input type="text" name="tier" value="<?php echo set_value('tier'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Order ID:</td>
                                    <td><input type="text" name="order_id" id="order_id" value="<?php echo set_value('order_id'); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Cause of Pending:</td>
                                    <td><input type="text" name="cause_of_pending" id="cause_of_pending" value="<?php echo set_value('cause_of_pending'); ?>" /></td>
                                </tr>
			        		</table>
		        		</div>
	        		</div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Other Info</span></div>
		        		<div class="frm_inputs">
		        			<table class="form_tbl">
		        				<tr>
			        				<td>Appointment Booking: </td>
			        				<td><input style="width: 20px;" type="radio" name="appointment_booking" value="y" >Yes</input><br /><input style="width: 20px;"  type="radio" name="appointment_booking" value="n" >No</input></td>
			        			</tr>
		        				<tr>
			        				<td>Resolve Sale: </td>
			        				<td><input style="width: 20px;" type="radio" name="resolve_sale" value="y" >Yes</input><br /><input style="width: 20px;"  type="radio" name="resolve_sale" value="n" >No</input></td>
			        			</tr>
		        				<tr>
			        				<td>Call ID:</td>
			        				<td><input type="text" name="call_id" value="<?php echo set_value('call_id'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Call Remarks:</td>
			        				<td><textarea rows="4" cols="50" name="notes"><?php echo set_value('notes'); ?></textarea></td>
			        			</tr>
			        			<tr>
			        				<td></td>
			        				<td><input type="submit" name="submit_record" value="Submit" /></td>
			        			</tr>
			        			<?php if (validation_errors()) : ?>
								<tr>
									<td>
									</td>
									<td>
										<?php echo validation_errors(); ?>
									</td>
								</tr>
								<?php endif; ?>
			        		</table>
		        		</div>
	        		</div>
	        		<div>
		        		<input type="hidden" name="agent_id" value="<?php echo $this->session->userdata('SINGTEL.username'); ?>" />
		        		<input type="hidden" name="phone_no" value="<?php echo $this->uri->segment(3); ?>" />
		        		<input type="hidden" name="campaign" value="<?php echo $this->uri->segment(4); ?>" />
	        		</div>
        		</form>
	        </div>
			<div class="clearFix"></div>
			
			<script type="text/javascript">
				var jsonLink = "<?php echo base_url(); ?>assets/json/tv-list.json";
				var list = [];
                var cause_of_pending = $("#cause_of_pending");
                var order_id = $("#order_id");
                //disabled by default
                cause_of_pending.prop('disabled', true);
                var value = $.trim(order_id.val());
                if(value.length>0){
                    //change action
                    cause_of_pending.prop('disabled', false);
                }

                //enable cause_of_pending when order_id is not empty
                order_id.on("input",function(e){
                    cause_of_pending.prop('disabled', true);
                    var value = $.trim($(this).val());
                    if(value.length>0){
                        //change action
                        cause_of_pending.prop('disabled', false);
                    }
                });
				
				$(document).ready(function() {
					
					$.getJSON(jsonLink, function(data){
						list = data.data;
						console.log(list);
						$('.js-example-basic-multiple').select2({								
							theme: "classic",
							data:list,
						});
					}).error(function(){
						console.log('error');
					})
				});
            </script>
		</div>