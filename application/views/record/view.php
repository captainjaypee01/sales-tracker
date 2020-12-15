		<?php $result = $data['info']->row_array();?>
		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">View Record</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<ul>
					<li><a href="<?php echo base_url()."{$this->session->userdata('SINGTEL.user_type')}"; ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
				</ul>
	        </div>
	        <div class="rightcontentBody">
	        	<?php echo $this->session->flashdata('prompt'); ?>
	        	<?php if($this->session->userdata('SINGTEL.user_type') == 'quality') : ?>
        		<form action="" method="post">
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>QA Remarks</span></div>
		        		<div class="frm_inputs">
		        			<table class="form_tbl">
		        			<tr>
								<td>Final Disposition:</td>
								<td><?php echo form_dropdown('qa_code',$data['codes'],isset($result['qa_code']) ? $result['qa_code'] : ""); ?></td>
							</tr>
							<tr>
								<td>Remarks:</td>
								<td><textarea name="remarks" rows="6" cols="45"><?php echo $result['qa_remarks'];?></textarea></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="qa_remarks" value="Submit" /> </td>
							</tr>
		        		</table>
		        		</div>
	        		</div>
        		</form>
        		<?php else : ?>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>QA Verification</span></div>
	        		<div class="frm_inputs">
		        		<table class="info_view">
		        			<tr>
								<td>QA Disposition:</td>
								<td><?php echo $this->Quality_model->get_code_name($result['qa_code']); ?></td>
							</tr>
							<tr>
								<td>QA Remarks:</td>
								<td><?php echo $result['qa_remarks'];?></td>
							</tr>
							<tr>
								<td>Verifier:</td>
								<td><?php echo $result['qa_verifier'];?></td>
							</tr>
		        		</table>
	        		</div>
        		</div>
        		<?php endif; ?>
	        	<form action="" method="post">
	        		<?php echo $this->session->userdata('SINGTEL.user_type') != 'quality' ? '<div class="manage_menu">'.($result['tl_approved'] == 1 ? '<input type="submit" name="unverified" value="Mark as Unverified" class="button_edit" />':'<input type="submit" name="verified" value="Mark as Verified" class="button_edit" />')." <a href='".base_url().'record/delete/'.$result['id']."' class='button_edit delete'>DELETE</a></div>":'';?>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Customer Info</span></div>
		        		<div class="frm_inputs">
		        			<table class="form_tbl">
			        			<tr>
									<td>Campaign:</td>
									<td><strong><?php echo $result['campaign'];?></strong></td>
								</tr>
								<tr>
			        				<td>Phone Number</td>
			        				<td><?php echo $result['phone_no']; ?></td>
			        			</tr>
								<tr>
									<td>Application Date:</td>
									<td><?php echo $result['appt_date'];?></td>
								</tr>
								<tr>
			        				<td>Applicant Name:</td>
			        				<td><input type="text" name="app_name" value="<?php echo $result['app_name']; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>NRIC:</td>
			        				<td><input type="text" name="NRIC" value="<?php echo $result['NRIC']; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>DEL Number:</td>
			        				<td><input type="text" name="ADSL_NO" value="<?php echo $result['ADSL_NO']; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Mobile Number:</td>
			        				<td><input type="text" name="mobile_no" value="<?php echo $result['mobile_no']; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Alt Number:</td>
			        				<td><input type="text" name="alt_no" value="<?php echo $result['alt_no']; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>IPTV Number:</td>
			        				<td><input type="text" name="IPTV_NO" value="<?php echo $result['IPTV_NO']; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Date of Birth:</td>
			        				<td><input type="text" name="dob" value="<?php echo $result['dob']; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Secondary Contact:</td>
			        				<td><input type="text" name="snd_contact" value="<?php echo $result['snd_contact']; ?>" /></td>
			        			</tr>
							</table>
		        		</div>
	        		</div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Product Info</span></div>
		        		<div class="frm_inputs">
		        			<table class="form_tbl">
		        				<tr>
			        				<td>Existing Pack:</td>
			        				<td><textarea rows="4" cols="50" name="existing_pack"><?php echo $result['existing_pack']; ?></textarea></td>
			        			</tr>
			        			<tr>
			        				<td>Package Offer:</td>
			        				<td>
			        					<div style='float:left;'>
			        						<?php 
			        							$product_offer = explode('/', $result['prod_offer']);
			        						?>
				        					<select multiple="multiple" name="prod_offer[]" id="prod_offer">
				        						<optgroup label="INTEREST PACKS">
				        							<option value="FML+" <?php echo is_numeric(array_search("FML+", $product_offer))?"selected='selected'":''; ?> >Family+</option>
				        							<option value="JX+" <?php echo is_numeric(array_search("JX+", $product_offer))?"selected='selected'":''; ?> >Jingxuan+</option>
				        							<option value="ISP+" <?php echo is_numeric(array_search("ISP+", $product_offer))?"selected='selected'":''; ?> >Inspirasi+</option>
				        							<option value="KDT+" <?php echo is_numeric(array_search("KDT+", $product_offer))?"selected='selected'":''; ?> >Kondattam+</option>
				        							<option value="DESI+" <?php echo is_numeric(array_search("DESI+", $product_offer))?"selected='selected'":''; ?> >Desi+</option>
				        							<option value="SP+" <?php echo is_numeric(array_search("SP+", $product_offer))?"selected='selected'":''; ?> >Sports+</option>
				        							<option value="CRICKET" <?php echo is_numeric(array_search("CRICKET", $product_offer))?"selected='selected'":''; ?> >Cricket Pack</option>
				        							<option value="USTV" <?php echo is_numeric(array_search("USTV", $product_offer))?"selected='selected'":''; ?> >US TV Pack</option>
			        							</optgroup>
			        							<optgroup label="COMBOS">
				        							<option value="JMC" <?php echo is_numeric(array_search("JMC", $product_offer))?"selected='selected'":''; ?> >Jingxuan Movie Combo </option>
				        							<option value="JX+C" <?php echo is_numeric(array_search("JX+C", $product_offer))?"selected='selected'":''; ?> >Jingxuan+ Combo</option>
				        							<option value="JSC" <?php echo is_numeric(array_search("JSC", $product_offer))?"selected='selected'":''; ?> >Jingxuan Sports Combo</option>
				        							<option value="IMC" <?php echo is_numeric(array_search("IMC", $product_offer))?"selected='selected'":''; ?> >Inspirasi Movie Combo</option>
				        							<option value="ISC" <?php echo is_numeric(array_search("ISC", $product_offer))?"selected='selected'":''; ?> >Inspirasi Sports Combo</option>
				        							<option value="KMC" <?php echo is_numeric(array_search("KMC", $product_offer))?"selected='selected'":''; ?> >Kondattam Movie Combo</option>
				        							<option value="KSC" <?php echo is_numeric(array_search("KSC", $product_offer))?"selected='selected'":''; ?> >Kondattam Sports Combo</option>
				        							<option value="AC" <?php echo is_numeric(array_search("AC", $product_offer))?"selected='selected'":''; ?> >Action Combo</option>
				        							<option value="DCC" <?php echo is_numeric(array_search("DCC", $product_offer))?"selected='selected'":''; ?> >Desi Cricket Combo</option>
			        							</optgroup>
			        							<optgroup label="PREMIUMS">
				        							<option value="JXG" <?php echo is_numeric(array_search("JXG", $product_offer))?"selected='selected'":''; ?> >Jingxuan Gold</option>
				        							<option value="ISPG" <?php echo is_numeric(array_search("ISPG", $product_offer))?"selected='selected'":''; ?> >Inspirasi Gold</option>
				        							<option value="KDTG" <?php echo is_numeric(array_search("KDTG", $product_offer))?"selected='selected'":''; ?> >Kondattam Gold</option>
			        							</optgroup>
			        							<optgroup label="ADD ONS">
				        							<option value="MP" <?php echo is_numeric(array_search("MP", $product_offer))?"selected='selected'":''; ?> >Movie Pack</option>
				        							<option value="CMP" <?php echo is_numeric(array_search("CMP", $product_offer))?"selected='selected'":''; ?> >Chinese Movie Pack</option>
				        						</optgroup>
				        						<optgroup label="BUNDLE CHANGE">
				        							<option value="10MBPS" <?php echo is_numeric(array_search("10MBPS", $product_offer))?"selected='selected'":''; ?> >10MBPS</option>
				        							<option value="15MBPS" <?php echo is_numeric(array_search("15MBPS", $product_offer))?"selected='selected'":''; ?> >15MBPS</option>
				        							<option value="50MBPS" <?php echo is_numeric(array_search("50MBPS", $product_offer))?"selected='selected'":''; ?> >50MBPS</option>
				        							<option value="100MBPS" <?php echo is_numeric(array_search("100MBPS", $product_offer))?"selected='selected'":''; ?> >100MBPS</option>
				        							<option value="150MBPS" <?php echo is_numeric(array_search("150MBPS", $product_offer))?"selected='selected'":''; ?> >150MBPS</option>
				        							<option value="200MBPS" <?php echo is_numeric(array_search("200MBPS", $product_offer))?"selected='selected'":''; ?> >200MBPS</option>
				        							<option value="300MBPS" <?php echo is_numeric(array_search("300MBPS", $product_offer))?"selected='selected'":''; ?> >300MBPS</option>
			        							</optgroup>
				        					</select>
			        					</div>
			        					<div id="selection" style='float:left;margin:3px 0 0 20px;font-size:16px;'></div>
			        				</td>
			        			</tr>
			        			<tr>
			        				<td>SSP:</td>
			        				<td><?php echo form_dropdown('SSP',$dropdown['ssp'],$result['SSP']); ?></td>
			        			</tr>
			        			<tr>
			        				<td>Bundle/Service:</td>
			        				<td><?php echo form_dropdown('bundle_service',array('' => '', 'bundle' => 'Bundle', 'service' => 'Service'),$result['bundle_service']); ?></td>
			        			</tr>
			        			<tr>
			        				<td>Installation Address:</td>
			        				<td><input type="text" name="inst_add" value="<?php echo $result['inst_add']; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>CRD:</td>
			        				<td><input type="text" name="crd" value="<?php echo $result['crd']; ?>" /> <strong>MM/DD/YYYY</strong></td>
			        			</tr>
			        			<tr>
			        				<td>Appointment Time:</td>
			        				<td><input type="text" name="appt_time" value="<?php echo $result['appt_time']; ?>" /> <strong>HH:MM</strong></td>
			        			</tr>
			        		</table>
		        		</div>
	        		</div>
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Other Info</span></div>
		        		<div class="frm_inputs">
		        			<table class="form_tbl">
		        				<tr>
			        				<td>Resolve Sale:</td>
			        				<td><input style="width: 20px;" type="radio" name="resolve_sale" <?php echo ($result['resolve_sale'] == 'y' ? 'checked' : ''); ?> value="y" >Yes</input>
			        					<br />
			        					<input style="width: 20px;"  type="radio" name="resolve_sale" <?php echo ($result['resolve_sale'] == 'n' ? 'checked' : ''); ?>  value="n" >No</input>
			        				</td>
			        			</tr>
		        				<tr>
			        				<td>Call ID:</td>
			        				<td><input type="text" name="call_id" value="<?php echo $result['call_id']; ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td>Call Remarks:</td>
			        				<td><textarea rows="4" cols="50" name="notes"><?php echo $result['notes']; ?></textarea></td>
			        			</tr>
			        			<tr>
									<td></td>
									<td><input type="submit" name="update" value="Update" /></td>
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
        		</form>
	        </div>
	        <div class="clearFix"></div>
	        <script type="text/javascript">
	        	var selection = $("#selection");
		        $( "#prod_offer" )
		        	.multiselect()
		        	.bind("multiselectclick multiselectcheckall multiselectuncheckall", function( event, ui ){
		        		
			        var checkedValues = $.map($(this).multiselect("getChecked"), function( input ){
			            return input.title;
			        });
			        
			        // update the target based on how many are checkedValues
			        selection.html(
			            checkedValues.length
			                ? checkedValues.join('/')
			                : '' 
			        );
			    })
			    .triggerHandler("multiselectclick");
	        </script>
		</div>