<?php
Class Manager extends CI_Controller 
{
	
	function Manager()
	{
		parent::__construct();
		
		if($this->session->userdata('SINGTEL.user_type') != 'manager')
		{
			redirect(base_url().'login', 'refresh');
		}
		
		$this->load->model('Manager_model');
		$this->load->model('Quality_model');
		$this->load->model('Calculator_model');
		
		$this->load->helper('date');
		
		date_default_timezone_set("Asia/Manila");
	}
	
	function index() {
		redirect(base_url().'manager/stats/', 'refresh');
	}
	
	
	function stats($sdate_unix = NULL)
	{
		if($this->input->post('mdate')) {
			
			$date = strtotime($this->input->post('mdate'));
			
			redirect(base_url().'manager/stats/'.$date, 'refresh');
			
		}
		
		if(NULL == $sdate_unix) {
			//get current date
			$format = 'DATE_RFC1123';
			
			$sdate_unix = time();
			
			$sdate_human = unix_to_human($sdate_unix);
			
		}
		
		$all_sales = $this->Manager_model->get_sales($sdate_unix);
		
		$team_stats = $this->Manager_model->get_team_stats($sdate_unix);
		
		$agent_stats = $this->Manager_model->get_agent_stats($sdate_unix);
		
		$campaign_stats = $this->Manager_model->get_campaign_stats($sdate_unix);
		
		$date = mdate("%Y-%m-%d", $sdate_unix);
		
		$data = array('team_stats' => $team_stats, 'agent_stats' => $agent_stats, 'date' => $date, 'date_unix' => $sdate_unix, 'campaign_stats' => $campaign_stats, 'sales' => $all_sales);
		
		//load view
		$this->load->view(
			'template/main', 
			array(
				'content'=>'manager/stats', 
				'location' => 'Manager / Agent Stats', 
				'data' => $data,
				'menu' => array(
					'Logout' => 'login/logout', 
				)
			)
		);
		
		//$this->load->view('manager/default', array('data' => $data));
	}
	
	function view_sales($agent, $sdate_unix)
	{
		if($this->input->post('mdate')) {
			
			$sdate_unix = strtotime($this->input->post('mdate'));
			
		}
		
		$agent_sales = $this->Manager_model->agent_sales($agent, $sdate_unix);
		
		$date = mdate("%Y-%m-%d", $sdate_unix);
		
		$data = array('sales' => $agent_sales, 'date' => $date, 'agent_id' => $agent);
		
		//load view
		$this->load->view(
			'template/main', 
			array(
				'content'=>'manager/view_sales', 
				'location' => 'Manager / View Sales', 
				'data' => $data,
				'menu' => array(
					'Logout' => 'login/logout', 
				)
			)
		);
	}
	
	function search()
	{
		if(isset($_POST['submit_search_vici'])) {
			//validations
			$this->form_validation->set_rules('nric','NRIC','trim|required|xss_clean');

			if($this->form_validation->run() == FALSE)
			{
				//$query = $this->db->get('NSI_SINGTEL_FIC_0.dbo.lastdispo');
				
				//echo $query->num_rows();
				//dropdown options
				$options = array('phone' => 'Phone', 'nric' => 'NRIC', 'name' => 'Customer Name');
				//load view
				$this->load->view(
					'template/main', 
					array(
						'content'=>'manager/search',
						'options' => $options
					)
				);
			} else {
				$nric = $this->input->post('nric');

				//connect to vici db server
				$vici = $this->load->database('vici', TRUE);

				$query = $vici->query("CALL search_nric('$nric')");

				//dropdown options
				$options = array('phone' => 'Phone', 'nric' => 'NRIC', 'name' => 'Customer Name');
				//load view
				$this->load->view(
					'template/main', 
					array(
						'content'=>'manager/search',
						'options' => $options,
						'lead_ids' => $query->result()
					)
				);
			}
		} else {
			//validations
			$this->form_validation->set_rules('options','Search by','trim|required|xss_clean');
	   		$this->form_validation->set_rules('keyword','Keyword','trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				//$query = $this->db->get('NSI_SINGTEL_FIC_0.dbo.lastdispo');
				
				//echo $query->num_rows();
				//dropdown options
				$options = array('phone' => 'Phone', 'nric' => 'NRIC', 'name' => 'Customer Name');
				//load view
				$this->load->view(
					'template/main', 
					array(
						'content'=>'manager/search',
						'options' => $options
					)
				);
			} else {
				$keywords = $this->input->post('keyword');
				$option = $this->input->post('options');
				
				//connect to mssql server
				$results = array();
				$helix = $this->load->database('helix', TRUE);
				
				//get all singtel campaigns
				$campaigns = $helix->query("SELECT name FROM master..sysdatabases WHERE name like 'NSI_SINGTEL%' and crdate >= '01/01/2014 12:00AM'");

				//generate query string for each campaigns
				foreach($campaigns->result() as $row) {
					$databases[] = $row->name;
				}

				$helix->close();

				foreach($databases as $key=>$campaign){
					//create WHERE statement based on $option
					switch($option) {
						case 'phone':
							$where = "WHERE I3_RowID = '$keywords'";
							break;
						case 'nric':
							//get nric fields
							/*$query = $helix->query("
								SELECT $campaign.dbo.syscolumns.name
								FROM $campaign.dbo.sysobjects
									JOIN $campaign.dbo.syscolumns ON $campaign.dbo.sysobjects.id = $campaign.dbo.syscolumns.id
								WHERE $campaign.dbo.sysobjects.xtype='U'
									AND $campaign.dbo.sysobjects.name = 'Calllist'
									AND ($campaign.dbo.syscolumns.name like '%NRIC%'
									OR $campaign.dbo.syscolumns.name = 'CODE2')
							");*/
							$helix = $this->load->database('helix', TRUE);
							$query = $helix->query("
								SELECT $campaign.dbo.syscolumns.name
								FROM $campaign.dbo.sysobjects
									JOIN $campaign.dbo.syscolumns ON $campaign.dbo.sysobjects.id = $campaign.dbo.syscolumns.id
								WHERE $campaign.dbo.sysobjects.xtype='U'
									AND $campaign.dbo.sysobjects.name = 'Calllist'
									AND $campaign.dbo.syscolumns.name like '%NRIC%'
							");
							
							$where = "WHERE ";
							foreach($query->result() as $row) {
								$where .= "{$row->name} = '$keywords' OR ";
							}
							
							$where = substr($where, 0, strlen($where) - 3);
							$helix->close();
							break;
						case 'name':
							$helix = $this->load->database('helix', TRUE);
							//get name fields
							$query = $helix->query("
								SELECT $campaign.dbo.syscolumns.name
								FROM $campaign.dbo.sysobjects
									JOIN $campaign.dbo.syscolumns ON $campaign.dbo.sysobjects.id = $campaign.dbo.syscolumns.id
								WHERE $campaign.dbo.sysobjects.xtype='U'
									AND $campaign.dbo.sysobjects.name = 'Calllist'
									AND $campaign.dbo.syscolumns.name like '%name%'
							");
							
							$where = "WHERE ";
							foreach($query->result() as $row) {
								$where .= "{$row->name} = '$keywords' OR ";
							}
							
							$where = substr($where, 0, strlen($where) - 3);
							$helix->close();
							break;
					}
					
					$helix = $this->load->database('helix', TRUE);
					$query = $helix->query("
						SELECT TOP 1 '$campaign' as campaign,*
						FROM $campaign.dbo.Calllist
						$where
					");

					if($query->num_rows() != 0) {
						$results[] = $query->result();
					}

					$helix->close();
				}
				
				//dropdown options
				$options = array('phone' => 'Phone', 'nric' => 'NRIC', 'name' => 'Customer Name');
				//load view
				$this->load->view(
					'template/main', 
					array(
						'content'=>'manager/search',
						'options' => $options,
						'results' => $results
					)
				);
			}
		}
	}
	
	function viewlead($campaign, $phone) {
		$this->output->enable_profiler(FALSE);
		$results = array();
		//connect database
		$helix = $this->load->database('helix', TRUE);
		
		$calllist = $helix->query("
			SELECT *
			FROM $campaign.dbo.Calllist
			WHERE I3_RowID = '$phone'
		");
		$results['calllist'] = $calllist->result();
		$helix->close();
		$helix = $this->load->database('helix', TRUE);
		$history = $helix->query("
			SELECT *
			FROM $campaign.dbo.I3_{$campaign}_CH0
			WHERE I3_RowID = '$phone'
			ORDER BY callplacedtime
		");
		$results['history'] = $history->result();
		$helix->close();

		$this->load->view(
				'manager/view_lead', 
				array(
					'results' => $results
				)
			);
		
		echo json_encode($results);
	}

	

	function prices() {
		//get contents
		$contents = $this->Calculator_model->get_items('content');

		//get bundles
		$bundles = $this->Calculator_model->get_bundles();

		//get discount types
		$discount_types = $this->Calculator_model->get_discount_types();

		//get discount groups
		$discount_groups = $this->Calculator_model->get_discount_groups();

		//get customer type
		$cust_type = $this->Calculator_model->get_cust_type();

		$this->load->view(
			'template/main', 
				array(
					'content' => 'manager/prices',
					'contents' => $contents,
					'bundles' => $bundles,
					'cust_type' => $cust_type,
					'discount_types' => $discount_types,
					'discount_groups' => $discount_groups
				)
			);
	}

	/**
	 * This will generate price table for AJAX request
	 */
	function content_prices_table() {
		$this->output->enable_profiler(FALSE);
		//get contents
		$contents = $this->Calculator_model->get_items('content');

		//get customer type
		$cust_type = $this->Calculator_model->get_cust_type();

		//get discount groups
		$discount_groups = $this->Calculator_model->get_discount_groups();

		$this->load->view(
			'manager/prices_table',
				array(
					'contents' => $contents,
					'cust_type' => $cust_type,
					'discount_groups' => $discount_groups
				)
			);
	}


	function stb_prices_table() {
		$this->output->enable_profiler(FALSE);
		//get contents
		$contents = $this->Calculator_model->get_items('stb');

		//get discount groups
		$discount_groups = $this->Calculator_model->get_discount_groups();

		//get customer type
		$cust_type = $this->Calculator_model->get_cust_type();

		$this->load->view(
			'manager/prices_table',
				array(
					'contents' => $contents,
					'cust_type' => $cust_type,
					'discount_groups' => $discount_groups
				)
			);
	}


	function bundle_prices_table() {
		$this->output->enable_profiler(FALSE);
		//get contents
		$contents = $this->Calculator_model->get_items('bundle');

		//get discount groups
		$discount_groups = $this->Calculator_model->get_discount_groups();

		//get customer type
		$cust_type = $this->Calculator_model->get_cust_type();

		$this->load->view(
			'manager/prices_table',
				array(
					'contents' => $contents,
					'cust_type' => $cust_type,
					'discount_groups' => $discount_groups
				)
			);
	}


	function add_item() {
		$this->output->enable_profiler(FALSE);
		//validations
		$this->form_validation->set_rules('item_type','Item Type','trim|required|xss_clean');
		$this->form_validation->set_rules('item_name','Item Name','trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		} else {
			//add new content entry
			$add = $this->Calculator_model->add_item($_POST);

			if($add !== FALSE) {
				echo $add;
			} else {
				echo 'Failed';
			}
		}
	}


	function add_discount_group() {
		$this->output->enable_profiler(FALSE);
		//validations
		$this->form_validation->set_rules('discount_group_name','Discount Group Name','trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		} else {
			//add new content entry
			$add = $this->Calculator_model->add_discount_group($_POST);

			if($add) {
				echo 'Success';
			} else {
				echo 'Failed';
			}
		}
	}

	function add_customer_type() {
		$this->output->enable_profiler(FALSE);
		//validations
		$this->form_validation->set_rules('customer_type_name','Customer Type Name','trim|required|xss_clean');
		$this->form_validation->set_rules('customer_type_label','Label','trim|required|xss_clean');

		
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		} else {
			//add new content entry
			$add = $this->Calculator_model->add_customer_type($_POST);

			if($add) {
				echo 'Success';
			} else {
				echo 'Failed';
			}
		}
	}


	function get_content($content_name) {
		$this->output->enable_profiler(FALSE);
		
		$content = $this->Calculator_model->view_content($content_name);

		return $content;
	}
	
	function update_item() {
		$this->output->enable_profiler(FALSE);
		//validations
		$this->form_validation->set_rules('item_name','Item Name','trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		} else {
			//update item
			$update = $this->Calculator_model->update_item($_POST);

			if($update) {
				echo 'Success';
			} else {
				echo 'Failed';
			}
		}
	}

	function update_customer_type() {
		$this->output->enable_profiler(FALSE);
		//validations
		$this->form_validation->set_rules('ecustomer_type_name','Customer Type Name','trim|required|xss_clean');
		$this->form_validation->set_rules('ecustomer_type_label','Label','trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		} else {
			//update item
			$update = $this->Calculator_model->update_customer_type($_POST);

			if($update) {
				echo 'Success';
			} else {
				echo 'Failed';
			}
		}
	}

	function add_discount() {
		$this->output->enable_profiler(FALSE);
		//validations
		$this->form_validation->set_rules('item_id','Content','trim|required|xss_clean');
		$this->form_validation->set_rules('group_id','Group','trim|required|xss_clean');
		$this->form_validation->set_rules('customer_id','Bundle','trim|required|xss_clean');
		$this->form_validation->set_rules('discount_id','Discount','trim|required|xss_clean');
		$this->form_validation->set_rules('value','Value','trim|required|xss_clean');
		$this->form_validation->set_rules('duration','Duration','trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		} else {
			//add new content entry
			$add = $this->Calculator_model->add_discount($_POST);

			if($add) {
				echo 'Success';
			} else {
				echo 'Failed';
			}
		}
	}

	function delete_discount() {
		$delete = $this->Calculator_model->delete_discount($_POST['id']);

		if($delete) {
			echo 'Success';
		} else {
			echo 'Failed';
		}
	}

	function delete_customer_type() {
		$delete = $this->Calculator_model->delete_customer_type($_POST['id']);

		if($delete) {
			echo 'Success';
		} else {
			echo 'Failed';
		}
	}



	function get_discount() {
		$this->output->enable_profiler(FALSE);

		$discount = $this->Calculator_model->get_discount_detail($_POST['id']);


		if($discount) {
			echo json_encode($discount->row());
		} else {
			echo 'Failed';
		}
	}

	function update_discount() {
		$this->output->enable_profiler(FALSE);
		//validations
		$this->form_validation->set_rules('value','Value','trim|required|xss_clean');
		$this->form_validation->set_rules('duration','Duration','trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		} else {
			//var_dump($_POST);
			//update discount
			$update = $this->Calculator_model->update_discount($_POST);

			if($update) {
				echo 'Success';
			} else {
				echo 'Failed';
			}
		}
	}

	function update_discount_group() {
		$this->output->enable_profiler(FALSE);
		//validations
		$this->form_validation->set_rules('discount_group_name','Discount Group Name','trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		} else {
			//var_dump($_POST);
			//update discount
			$update = $this->Calculator_model->update_discount_group($_POST);

			if($update) {
				echo 'Success';
			} else {
				echo 'Failed';
			}
		}
	}
	
	function delete_item() {
		$delete = $this->Calculator_model->delete_item($_POST['id']);

		if($delete) {
			echo 'Success';
		} else {
			echo 'Failed';
		}
	}

	function delete_discount_group() {
		$delete = $this->Calculator_model->delete_discount_group($_POST['id']);

		if($delete) {
			echo 'Success';
		} else {
			echo 'Failed';
		}
	}

}