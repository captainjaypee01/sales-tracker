		<div class="clearFix"></div>
		<div class="contentBody">
			<div class="contentTitle">Search Record</div>
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
		        	<form action="" method="post">
		        		<div class="frm_heading"><span>Search Record</span></div>
		        		<div class="frm_inputs">
			        		<table class="form_tbl">
			        			<tr>
									<td>Phone:</td>
									<td><input type="text" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" /></td>
								</tr>
								<tr>
									<td>Lead Base:</td>
									<td><?php echo form_dropdown('campaign',$campaigns,isset($_POST['campaign']) ? $_POST['campaign'] : ''); ?></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" name="search" id="search" value="Search" /></td>
								</tr>
			        			<?php if (validation_errors()) : ?>
								<tr>
									<td>
										
									</td>
									<td>
										<?php echo validation_errors(); ?>
									</td>
								</tr>
								<?php endif;?>
								<?php if (isset($error)) : ?>
								<tr>
									<td>
										
									</td>
									<td>
										<?php echo $error; ?>
									</td>
								</tr>
								<?php endif;?>
			        		</table>
		        		</div>
		        	</form>
        		</div>
        		<?php if(isset($result)) : ?>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Result - <?php echo $result['prompt']; ?></span></div>
	        		<div class="frm_inputs">
	        		<?php echo isset($result['html']) ? $result['html'] : '';?>
	        		</div>
        		</div>
        		<?php if($result['create_record'] !== FALSE) : ?>
        		<div class="manage_menu"><a href="<?php echo base_url().'agent/add/'.$_POST['phone'].'/'.$_POST['campaign']; ?>" class="button_add">Create New for <?php echo $_POST['campaign']; ?></a></div>
        		<?php endif;?>
        		<?php endif;?>
        		<div class="clearFix"></div>
        		<div class="frm_container">
	        		<div class="frm_heading"><span>Sales Today</span></div>
	        		<div class="frm_inputs">
		        		<?php if($sales) : ?>
		        		<table class="tablesorter">
							<thead>
								<tr>
									<th>Phone</th>
									<th>Customer Name</th>
									<th>Campaign</th>
									<th>QA Remark</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($sales->result() as $row): ?>
								<tr>
									<td><?php echo $row->phone_no; ?></td>
									<td><?php echo $row->app_name; ?></td>
									<td><?php echo $row->campaign; ?></td>
									<td><?php echo $this->Quality_model->get_code_name($row->qa_code); ?></td>
									<td><a href="<?php echo base_url(); ?>agent/view/<?php echo $row->id;?>" target="_blank">view info</a> | <a href="<?php echo base_url(); ?>agent/export_pdf/<?php echo $row->id;?>" target="_blank">Preview PDF</a></td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
		        		<?php else : ?>
		        		No record found.
		        		<?php endif; ?>
	        		</div>
        		</div>
	        </div>
	        <div class="clearFix"></div>
		</div>