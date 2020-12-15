		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">Lead Search</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<ul>
					<li><a href="<?php echo base_url().'manager/stats'; ?>">Home</a></li>
					<li><a href="<?php echo base_url().'manager/search'; ?>">Lead Search</a></li>
					<li><a href="<?php echo base_url().'manager/prices'; ?>">Manage Calculator</a></li>
					<li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
				</ul>
	        </div>
	        <div class="rightcontentBody">
	        	<form action="" method="post">
		    		<div class="frm_container">
		    			<?php echo $this->session->flashdata('prompt'); ?>
		        		<div class="frm_heading"><span>Lead Search</span></div>
		        		<div class="frm_inputs">
		        			<table class="info_view">
			        			<tr>
			        				<td>Search by:</td>
			        				<td><?php echo form_dropdown('options', $options) ?></td>
			        			</tr>
			        			<tr>
			        				<td>Keyword:</td>
			        				<td><input type="text" name="keyword" value="<?php echo set_value('keyword'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td></td>
			        				<td><input type="submit" name="submit_search" value="Search" /></td>
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
        		<form action="" method="post">
		    		<div class="frm_container">
		        		<div class="frm_heading"><span>Lead Search(Vici)</span></div>
		        		<div class="frm_inputs">
		        			<table class="info_view">
			        			<tr>
			        				<td>NRIC:</td>
			        				<td><input type="text" name="nric" value="<?php echo set_value('nric'); ?>" /></td>
			        			</tr>
			        			<tr>
			        				<td></td>
			        				<td><input type="submit" name="submit_search_vici" value="Search" /></td>
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
        		<?php if(isset($lead_ids)) : ?>
    			<div class="frm_container">
	        		<div class="frm_heading"><span>Result</span></div>
	        		<div class="frm_inputs">
	        			<?php if(count($lead_ids) == 0) : ?>
	        				No Result
	        			<?php else : ?>
	        			<table class="tablesorter">
	        				<thead>
	        					<th>Lead ID</th>
	        					<th>View Info</th>
	        				</thead>
	        				<tbody>
		        			<?php foreach($lead_ids as $row) : ?>
		        				<tr>
		        					<td><?php echo $row->lead_id; ?></td>
		        					<td><a href="http://191.168.3.233/vicidial/admin_modify_lead.php?lead_id=<?php echo $row->lead_id; ?>" target="_blank">http://191.168.3.233/vicidial/admin_modify_lead.php?lead_id=<?php echo $row->lead_id; ?></a></td>
		        				</tr>		
		        			<?php endforeach; ?>
	        				</tbody>
	        			</table>
	        			<?php endif; ?>
	        		</div>
	        	</div>
	        	<div id="info" style="display: none;"></div>
        		<?php endif; ?>
        		<?php if(isset($results)) : ?>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Result</span></div>
	        		<div class="frm_inputs">
	        			<?php if(count($results) == 0) : ?>
	        				No Result
	        			<?php else : ?>
	        			<?php //print_r($results); ?>
	        			<table class="tablesorter">
	        				<thead>
	        					<th>Campaign</th>
	        					<th>Phone</th>
	        					<th>NRIC</th>
	        					<th>Name</th>
	        					<th></th>
	        				</thead>
	        				<tbody>
	        			<?php foreach($results as $result => $row) : ?>
	        				<tr>
	        					<td><?php echo strtoupper(substr($row[0]->campaign, 12, strlen($row[0]->campaign))); ?></td>
	        					<td><?php echo $row[0]->I3_RowID;//var_dump($row[0]); ?></td>
	        					<td><?php 
	        							if(isset($row[0]->CUST_NRIC) AND !empty($row[0]->CUST_NRIC)) {
	        								echo $row[0]->CUST_NRIC;
										} elseif(isset($row[0]->NRIC) AND !empty($row[0]->NRIC)) {
											echo $row[0]->NRIC;
										} elseif(isset($row[0]->CODE2) AND !empty($row[0]->CODE2)) {
											echo $row[0]->CODE2;
										} else {
											echo "N/A";
										}		
	        						?>
	        					</td>
	        					<td><?php 
	        							if(isset($row[0]->CUST_NAME) AND !empty($row[0]->CUST_NAME)) {
	        								echo $row[0]->CUST_NAME;
										} elseif(isset($row[0]->Name) AND !empty($row[0]->Name)) {
											echo $row[0]->Name;
										} elseif(isset($row[0]->Applicant_Name) AND !empty($row[0]->Applicant_Name)) {
											echo $row[0]->Applicant_Name;
										} else {
											echo "N/A";
										}	
	        						?>
	        					</td>
	        					<td><a onclick="showinfo(<?php echo "'{$row[0]->campaign}','{$row[0]->I3_RowID}'"; ?>)" href="#" >complete info</a></td>
	        				</tr>		
	        			<?php endforeach; ?>
	        				</tbody>
	        			</table>
	        			<?php endif; ?>
	        		</div>
	        	</div>
	        	<?php endif; ?>
	        	<div id="info" style="display: none;"></div>
			</div>
       		<div class="clearFix"></div>
		</div>
		<script type="text/javascript">
			function showinfo(campaign, phone) {
				$("#info").empty();
				$("#info").toggle();
				
				$("#info").append("<div class='frm_container'><div class='frm_heading'><span>Lead Info</span></div><div class='frm_inputs'><table class='tablesorter' id='infotable'></table></div></div>");
			
				console.log('<?php echo base_url();?>manager/viewlead/'+campaign+'/'+phone);        
				$.getJSON('<?php echo base_url();?>manager/viewlead/'+campaign+'/'+phone, function(data) {
					$.each(data.calllist, function(i, object) {

					    $.each(object, function(property, value) {
					         $("<tr><td>"+property+"</td><td>"+value+"</td></tr>").appendTo("#infotable");
					    });
					});
				});
				$("#info").append("<div class='frm_container'><div class='frm_heading'><span>Call History</span></div><div class='frm_inputs'><table class='tablesorter' id='historytable'><thead><th>Campaign</th><th>Phone</th><th>Disposition</th><th>Agent</th><th>Date</th><th>Duration</th><th>CallID</th></thead></table></div></div>");
			
				$.getJSON('<?php echo base_url();?>manager/viewlead/'+campaign+'/'+phone, function(data) {          
					$.each(data.history, function(i, object) {
					    //$.each(object, function(property, value) {
					    	
					        $("<tr><td>"+object.campaignname+"</td><td>"+object.i3_identity+"</td><td>"+object.finishcode+"</td><td>"+object.agentid+"</td><td>"+object.callplacedtime+"</td><td>"+object.length+"</td><td>"+object.callid+"</td></tr>").appendTo("#historytable");
					   // });
					});
				});
				return false;
			}
		</script>