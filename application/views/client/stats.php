		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">View Sales</div>
			<div class="clearFix"></div>
			<div class="leftcontentBody">
				<ul>
					<li><a href="<?php echo base_url().'client/stats'; ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
				</ul>
	        </div>
	        <div class="rightcontentBody">
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
        		<?php if(isset($data['sales'])) : ?>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Approved Sales</span></div>
	        		<div class="frm_inputs">
		        		<table class="tablesorter">
							<thead>
								<tr>
									<th>Main Phone</th>
									<th>Agent</th>
									<th>Campaign</th>
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
									<td><?php echo $this->Quality_model->get_code_name($row->qa_code); ?></td>
									<td><a href="<?php echo base_url(); ?>record/view/<?php echo $row->id;?>" target="_blank">view info</a> | <a href="<?php echo base_url(); ?>agent/export_pdf/<?php echo $row->id;?>" target="_blank">Preview PDF</a> | <a href="<?php echo base_url(); ?>agent/export_pdf_save/<?php echo $row->id;?>" target="_blank">Download PDF</a></td>
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