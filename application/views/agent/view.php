		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">View Record</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<ul>
					<li><a href="<?php echo base_url().'agent'; ?>">Search</a></li>
					<li><a href="<?php echo base_url(); ?>agent/calculator">Calculator</a></li>
					<li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
				</ul>
	        </div>
	        <div class="rightcontentBody">
	        	<?php if($result['agent_id'] == $this->session->userdata('SINGTEL.username')) : ?>
	        	<div class="manage_menu"><a href="<?php echo base_url().'agent/edit/'.$result['id']; ?>" class="button_edit">Edit</a> <a href="<?php echo base_url().'agent/form/'.$result['id']; ?>" class="button_edit" target="_blank">Application Form</a></div>
	        	<?php endif; ?>
        		<div class="frm_container">
        			<?php echo $this->session->flashdata('prompt'); ?>
	        		<div class="frm_heading"><span>Basic Info</span></div>
	        		<div class="frm_inputs">
	        			<table class="info_view">
		        			<tr>
		        				<td>Agent:</td>
		        				<td><?php echo $result['agent_id']; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Phone Number</td>
		        				<td><?php echo $result['phone_no']; ?></td>
		        			</tr>
		        			<tr>
		        				<td>Lead Base:</td>
		        				<td><?php echo $result['campaign']; ?></td>
		        			</tr>
		        		</table>
	        		</div>
        		</div>
	        	<form action="" method="post">
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Customer Info</span></div>
		        		<div class="frm_inputs">
		        			<table class="info_view">
			        			<tr>
			        				<td>Applicant Name:</td>
			        				<td><?php echo $result['app_name']; ?></td>
			        			</tr>
			        			<tr>
			        				<td>NRIC:</td>
			        				<td><?php echo $result['NRIC']; ?></td>
			        			</tr>
			        			<tr>
			        				<td>DEL Number:</td>
			        				<td><?php echo $result['ADSL_NO']; ?></td>
			        			</tr>
			        			<tr>
			        				<td>Mobile Number:</td>
			        				<td><?php echo $result['mobile_no']; ?></td>
			        			</tr>
			        			<tr>
			        				<td>Alt Number:</td>
			        				<td><?php echo $result['alt_no']; ?></td>
			        			</tr>
			        			<tr>
			        				<td>IPTV Number:</td>
			        				<td><?php echo $result['IPTV_NO']; ?></td>
			        			</tr>
			        			<tr>
			        				<td>Date of Brith:</td>
			        				<td><?php echo $result['dob']; ?></td>
			        			</tr>
			        		</table>
		        		</div>
	        		</div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Secondary Contact Information</span></div>
		        		<div class="frm_inputs">
		        			<table class="info_view">
			        			<tr>
			        				<td>NRIC:</td>
			        				<td><?php echo $result['snd_nric']; ?></td>
			        			</tr>
			        			<tr>
			        				<td>Date of Brith:</td>
			        				<td><?php echo $result['snd_dob']; ?></td>
			        			</tr>
			        			<tr>
			        				<td>Email Address:</td>
			        				<td><?php echo $result['snd_email']; ?></td>
			        			</tr>
			        			<tr>
			        				<td>Contact Number:</td>
			        				<td><?php echo $result['snd_contact']; ?></td>
			        			</tr>
			        		</table>
		        		</div>
	        		</div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Product Info</span></div>
		        		<div class="frm_inputs">
		        			<table class="info_view">
			        			<tr>
			        				<td>Plan Option:</td>
			        				<td><?php echo $result['plan_option']; ?></td>
			        			</tr>
                                <tr>
                                    <td>Existing Internet Speed:</td>
                                    <td><?php echo $result['existing_internet_speed']; ?></td>
                                </tr>
                                <tr>
                                    <td>New Internet Speed:</td>
                                    <td><?php echo $result['new_internet_speed']; ?></td>
								</tr>
                                <tr>
                                    <td>TV Pack:</td>
                                    <td><?php echo $result['tv_pack']; ?></td>
								</tr>
								
                                <tr>
                                    <td>Existing Pack:</td>
                                    <td><?php echo $result['existing_pack']; ?></td>
                                </tr>
                                <tr>
                                    <td>Existing Pack ARPU:</td>
                                    <td><?php echo $result['existing_pack_arpu']; ?></td>
                                </tr>
                                <tr>
                                    <td>Package Offer:</td>
                                    <td><?php echo $result['package_offer']; ?></td>
                                </tr>
                                <tr>
                                    <td>New Pack ARPU:</td>
                                    <td><?php echo $result['new_pack_arpu']; ?></td>
                                </tr>
                                <tr>
                                    <td>ARPU Difference:</td>
                                    <td><?php echo $result['arpu_difference']; ?></td>
                                </tr>
                                <tr>
                                    <td>DVR:</td>
                                    <td><?php echo $result['dvr']; ?></td>
                                </tr>
                                <tr>
                                    <td>Singtel TV Go:</td>
                                    <td><?php echo $result['singtel_tv_go']; ?></td>
                                </tr>
                                <tr>
                                    <td>Family Protection:</td>
                                    <td><?php echo $result['family_protection']; ?></td>
                                </tr>
                                <tr>
                                    <td>Security Suit (WinOS):</td>
                                    <td><?php echo $result['security_suit_winos']; ?></td>
                                </tr>
                                <tr>
                                    <td>Security Suit (MacOS):</td>
                                    <td><?php echo $result['security_suite_macos']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tier:</td>
                                    <td><?php echo $result['tier']; ?></td>
                                </tr>
                                <tr>
                                    <td>Order ID:</td>
                                    <td><?php echo $result['order_id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Cause of Pending:</td>
                                    <td><?php echo $result['cause_of_pending']; ?></td>
                                </tr>
			        		</table>
		        		</div>
	        		</div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Other Info</span></div>
		        		<div class="frm_inputs">
		        			<table class="info_view">
		        				<tr>
			        				<td>Appointment Booking:</td>
			        				<td><?php echo ($result['appointment_booking'] == 'y' ? 'Yes' : 'No'); ?></td>
			        			</tr>
		        				<tr>
			        				<td>Resolve Sale:</td>
			        				<td><?php echo ($result['resolve_sale'] == 'y' ? 'Yes' : 'No'); ?></td>
			        			</tr>
			        			<tr>
			        				<td>Call ID:</td>
			        				<td><?php echo $result['call_id']; ?></td>
			        			</tr>
			        			<tr>
			        				<td>Call Remarks:</td>
			        				<td><?php echo $result['notes']; ?></td>
			        			</tr>
			        		</table>
		        		</div>
	        		</div>
        		</form>
	        </div>
	        <div class="clearFix"></div>
		</div>