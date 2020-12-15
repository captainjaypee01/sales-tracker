		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">View Sales</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<ul>
					<li><a href="<?php echo base_url().'quality/sales'; ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
				</ul>
	        </div>
	        <div class="rightcontentBody">
        		<div class="frm_container">
        			<?php echo $this->session->flashdata('prompt'); ?>
	        		<div class="frm_heading"><span>Team Stats</span></div>
	        		<div class="frm_inputs">
	        			<table class="info_view">
		        			<tr>
		        				<td>Date:</td>
		        				<td><?php echo $data['date'];?></td>
		        			</tr>
		        			<tr>
		        				<td>Total Sales</td>
		        				<td><?php echo $data['team_stats']->num_rows();?></td>
		        			</tr>
		        		</table>
	        		</div>
        		</div>
	        	<form action="" method="post">
	        		<div class="frm_container">
		        		<div class="frm_heading"><span>Change Date</span></div>
		        		<div class="frm_inputs">
		        			<table class="info_view">
			        			<tr>
			        				<td>Date:</td>
			        				<td><input type="text" name="mdate" id="mdate" class="datepicker" value="<?php echo $data['date'];?>" /><input type="submit" name="go" id="go" value="GO" /></td>
			        			</tr>
			        		</table>
		        		</div>
	        		</div>
        		</form>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Export</span></div>
	        		<div class="frm_inputs">
		        		<table>
							<tr>
								<td></td>
								<td style="padding: 0; margin: 0;"><a href="<?php echo base_url(); ?>quality/export_excel/<?php echo $this->uri->segment(3); ?>" ><img src="<?php echo base_url();?>includes/images/Excel-Logo.jpg" alt="Excel"/> &nbsp;<span style="position: absolute; margin-top: 8px;">Excel File</span></a></td>
							</tr>
						</table>
	        		</div>
        		</div>
        		<?php if(isset($data['team_stats'])) : ?>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Sales List</span></div>
	        		<div class="frm_inputs">
		        		<table class="tablesorter">
							<thead>
								<tr>
									<th>Phone</th>
									<th>NRIC</th>
									<th>Agent</th>
									<th>Campaign</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data['team_stats']->result() as $row): ?>
								<tr>
									<td><?php echo $row->phone_no; ?></td>
									<td><?php echo $row->NRIC; ?></td>
									<td><?php echo $row->agent_id; ?></td>
									<td><?php echo $row->campaign; ?></td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
	        		</div>
        		</div>
        		<?php endif; ?>
	        </div>
	        <div class="clearFix"></div>
		</div>