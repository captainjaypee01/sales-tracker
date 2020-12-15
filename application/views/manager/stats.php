		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">View Stats</div>
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
        		<?php if(isset($data['campaign_stats'])) : ?>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Campaign Stats</span></div>
	        		<div class="frm_inputs">
		        		<table class="tablesorter">
							<thead>
								<tr>
									<th>Campaign</th>
									<th>Total Sales</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data['campaign_stats']->result() as $row): ?>
								<tr>
									<td><?php echo $row->campaign;?></td>
									<td><?php echo $this->Manager_model->get_campaign_breakdown($data['date_unix'], $row->campaign); ?></td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
	        		</div>
        		</div>
        		<?php endif; ?>
        		<?php if(isset($data['agent_stats'])) : ?>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Agent Sale Summary</span></div>
	        		<div class="frm_inputs">
		        		<table class="tablesorter">
							<thead>
								<tr>
									<th>Agent ID</th>
									<th>Total Sales</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data['agent_stats']->result() as $row): ?>
								<tr>
									<td><a href="<?php echo base_url(); ?>manager/view_sales/<?php echo $row->username;?>/<?php echo $data['date_unix'];?>" target="_blank"><?php echo $row->username;?></a></td>
									<td><?php echo $row->total;?></td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
	        		</div>
        		</div>
        		<?php endif; ?>
        		<?php if(isset($data['sales'])) : ?>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Agent Sales</span></div>
	        		<div class="frm_inputs">
		        		<table class="tablesorter">
							<thead>
								<tr>
									<th>Phone</th>
									<th>Agent</th>
									<th>Campaign</th>
									<th>Verified</th>
									<th>QA Remark</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data['sales']->result() as $row): ?>
								<tr>
									<td><?php echo $row->phone_no; ?></td>
									<td><?php echo $row->agent_id; ?></td>
									<td><?php echo $row->campaign; ?></td>
									<td><?php echo $row->tl_approved == 1?"Yes":"No"; ?></td>
									<td><?php echo $this->Quality_model->get_code_name($row->qa_code); ?></td>
									<td><a href="<?php echo base_url(); ?>record/view/<?php echo $row->id;?>" target="_blank">view info</a> | <a href="<?php echo base_url(); ?>agent/export_pdf/<?php echo $row->id;?>" target="_blank">Preview PDF</a></td>
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