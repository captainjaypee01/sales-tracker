<?php
Class Agent extends CI_Controller {

	public function Agent() {
		parent::__construct();

		if ($this -> session -> userdata('SINGTEL.user_type') != 'agent' AND $this -> session -> userdata('SINGTEL.user_type') != 'quality' AND $this -> session -> userdata('SINGTEL.user_type') != 'manager' AND $this -> session -> userdata('SINGTEL.user_type') != 'client') {
			redirect(base_url() . 'login', 'refresh');
		}

		$this->load->model('Record_model');
		$this->load->model('Quality_model');
		$this->load->model('Calculator_model');

		$this -> load -> helper('date');
		
		date_default_timezone_set("Asia/Manila");
	}
	
	function index() {
		redirect(base_url().'agent/search/', 'refresh');
	}

	function search($sdate_unix = NULL) {
		//date format
		if($this->input->post('mdate')) {
			
			$date = strtotime($this->input->post('mdate'));
			
			redirect(base_url().'agent/search/'.$date, 'refresh');
		}
		
		if(NULL == $sdate_unix) {
			//get current date
			$format = 'DATE_RFC1123';
			
			$sdate_unix = time();
			
			$sdate_human = unix_to_human($sdate_unix);
		}
		$date = mdate("%Y-%m-%d", $sdate_unix);
		
		$sales = $this->Record_model->agent_sales($this->session->userdata('SINGTEL.username'), $sdate_unix);
		
		//check if search button was pressed
		$this->form_validation->set_rules('phone','Phone','trim|required|numeric|xss_clean');
   		$this->form_validation->set_rules('campaign','Campaign','trim|required|xss_clean');
		
		//campaigns listing
		$campaigns = array(
			'WIFI Mesh' => 'WIFI Mesh',
			'PLOOC_GOLD' => 'PLOOC_GOLD',
			'PLOOC_VALUE_PACK' => 'PLOOC_VALUE_PACK',
			'SINGTEL POWER' => 'SINGTEL POWER',
			'GEN_FAM-STARTER_LITE' => 'GEN_FAM-STARTER_LITE',
			'GEN3TRIO-VAR-VALUE' => 'GEN3TRIO-VAR-VALUE',
			'FIBER RECON' => 'FIBER RECON',
			'Fiber Recon 2Gbps' => 'Fiber Recon 2Gbps',
			'Fiber Recon 1Gbps' => 'Fiber Recon 1Gbps',
			'Fiber Recon w Mesh 1Gbps' => 'Fiber Recon w Mesh 1Gbps',
			'CAST Viu Premium wo Contract' => 'CAST Viu Premium wo Contract',
			'CAST Viu Premium w Contract' => 'CAST Viu Premium w Contract',
			'CAST HOOQ wo Contract' => 'CAST HOOQ wo Contract',
			'CAST HOOQ w Contract' => 'CAST HOOQ w Contract'			
		//	'CAST BCC' => 'CAST BCC',
		//	'MUSIC BCC' => 'MUSIC BCC',
		//	'DVR BCC' => 'DVR BCC',
		//	'TV GO BCC' => 'TV GO BCC',
		//	'PL OOC' => 'PL OOC',
		//	'Miohome Migration' => 'Miohome Migration',
		//	'Stdalone SingtelTV ADSL-Migration' => 'Stdalone SingtelTV ADSL-Migration',
		//	'RECON' => 'RECON',
		//	'GEN3 VALUE' => 'GEN3 VALUE',
		//	'GEN3 VARIETY' => 'GEN3 VARIETY',
		//	'GEN3 TRIO' => 'GEN3 TRIO',
		//	'GEN3 STARTER' => 'GEN3 STARTER',
		//	'RECON FIBRE' => 'RECON   FIBRE', 
		//	'RECON CHANNEL' => 'RECON   CHANNEL', 
		//	'TRIO TRIAL' => 'TRIO TRIAL',
		//	'SingtelTV Select' => 'SingtelTV Select'
		);
		
		if($this->form_validation->run() == FALSE)
		{
			//load view
			$this->load->view(
			'template/main', 
			array(
				'campaigns' => $campaigns,
				'sales' => $sales,
				'content'=>'agent/search', 
				'location' => 'Agent / Search', 
				'menu' => array(
					'Logout' => 'login/logout', 
					)
				)
			);
		}else
		{
			$result = $this->Record_model->search($this->input->post('phone'), $this->input->post('campaign'), $this->session->userdata('SINGTEL.username'));
			
			//load view
			$this->load->view(
			'template/main', 
			array(
				'campaigns' => $campaigns,
				'sales' => $sales,
				'content'=>'agent/search', 
				'location' => 'Agent / Search',
				'result' => $result,
				'menu' => array(
					'Logout' => 'login/logout', 
					)
				)
			);
		}
	}

	function add($phone, $campaign) {
		//check first if create_record is TRUE
		$result = $this->Record_model->search($phone, $campaign, $this->session->userdata('SINGTEL.username'));
		
		//product listing
		$product_list = array(
			'' => '',
			'FOR ACQ DEL = MIOTV' => 'FOR ACQ DEL = MIOTV',
			'FOR SNBB = CONTENT PACKS' => 'FOR SNBB = CONTENT PACKS',
			'UPSELL VARIETY PCK = UPSELL CONTENTS' => 'UPSELL VARIETY PCK = UPSELL CONTENTS'
		);
		
		//speed listing
		$speed_list = array(
			'' => '',
			'MIOHOME 6MBPS' => 'MIOHOME 6MBPS',
			'MIOHOME 10MBPS' => 'MIOHOME 10MBPS',
			'MIOHOME 15 MBPS' => 'MIOHOME 15 MBPS',
			'(MIOTV)' => '(MIOTV)'
		);
		
		//SSP listing
		$ssp_list = array(
			'' => '',
			'NEW' => 'NEW',
			'EXISTING' => 'EXISTING'
		);

        //Plan Option listing
        $plan_option_list = array(
            '' => '',
            'Standalone' => 'Standalone',
            'Recontract' => 'Recontract',
            'Bundle change' => 'Bundle change',
            'Migration' => 'Migration (Acquisition)',
            'ADSL Singtel TV Migration' => 'ADSL Singtel TV Migration'
        );
		
		//product offer listing
		$product_offer_list = array(
			'' => '',
			'KABAYAN' => 'KABAYAN',
			'KABAYAN TRIO' => 'KABAYAN TRIO',
			'KAPUSO' => 'KAPUSO',
			'ENTERTAINMENT PACK' => 'ENTERTAINMENT PACK',
			'JINGXUAN PACK' => 'JINGXUAN PACK',
			'UTHAYAM PACK' => 'UTHAYAM PACK',
			'IMBAM PACK' => 'IMBAM PACK',
			'ASTRO PACK' => 'ASTRO PACK',
			'DESI PACK' => 'DESI PACK',
			'KONDATTAM PACK' => 'KONDATTAM PACK',
			'US TV PACK' => 'US TV PACK',
			'DESI MINI PACK' => 'DESI MINI PACK',
			'SPORTS PACK' => 'SPORTS PACK',
			'ULTIMATE PACK' => 'ULTIMATE PACK',
			'EASY JINGXUAN PACK' => 'EASY JINGXUAN PACK',
			'EASY ASTRO PACK' => 'EASY ASTRO PACK',
			'COMBO PACK' => 'COMBO PACK',
			'ASTRO COMBO PACK' => 'ASTRO COMBO PACK',
			'TAMIL COMBO PACK' => 'TAMIL COMBO PACK'
		);
		
		if($result['create_record'] == TRUE) {
			//validate
			$this->form_validation->set_rules('app_name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('NRIC', 'NRIC', 'trim|required|xss_clean');
			$this->form_validation->set_rules('ADSL_NO', 'ADSL Number', 'trim|xss_clean');
			$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|xss_clean');
			$this->form_validation->set_rules('IPTV_NO', 'IPTV Number', 'trim|xss_clean');
			$this->form_validation->set_rules('snd_contact', 'Secondary Contact info', 'trim|xss_clean');
			$this->form_validation->set_rules('snd_nric', 'Secondary Contact NRIC', 'trim|xss_clean');
			$this->form_validation->set_rules('snd_email', 'Secondary Contact Email Address', 'trim|xss_clean');
			$this->form_validation->set_rules('snd_dob', 'Secondary Contact Date of Birth', 'trim|xss_clean');
			$this->form_validation->set_rules('product', 'Product', 'trim|xss_clean');
			$this->form_validation->set_rules('speed', 'Speed', 'trim|xss_clean');
			$this->form_validation->set_rules('SSP', 'SSP', 'trim|xss_clean');
			$this->form_validation->set_rules('inst_add', 'Installation Address', 'trim|xss_clean');
			$this->form_validation->set_rules('actv_date', 'Activation Date', 'trim|xss_clean');
			$this->form_validation->set_rules('appt_time', 'Appointment Time', 'trim|xss_clean');
			$this->form_validation->set_rules('dealer', 'Dealer', 'trim|xss_clean');
			$this->form_validation->set_rules('crd', 'CRD', 'trim|xss_clean');
			$this->form_validation->set_rules('notes', 'Notes', 'trim|xss_clean');
            $this->form_validation->set_rules('plan_option', 'Plan Option', 'trim|required|xss_clean');
            $this->form_validation->set_rules('existing_internet_speed', 'Existing Internet Speed', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_internet_speed', 'New Internet Speed', 'trim|required|xss_clean');
            $this->form_validation->set_rules('existing_pack', 'Existing Pack', 'trim|required|xss_clean');
            $this->form_validation->set_rules('existing_pack_arpu', 'Existing Pack ARPU', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_pack_arpu', 'New Pack ARPU', 'trim|required|xss_clean');
            $this->form_validation->set_rules('arpu_difference', 'ARPU Difference', 'trim|required|xss_clean');
            $this->form_validation->set_rules('dvr', 'DVR', 'trim|required|xss_clean');
            $this->form_validation->set_rules('singtel_tv_go', 'Singtel TV Go', 'trim|required|xss_clean');
            $this->form_validation->set_rules('family_protection', 'Family Protection', 'trim|required|xss_clean');
            $this->form_validation->set_rules('security_suit_winos', 'Security Suit (WinOS)', 'trim|required|xss_clean');
            $this->form_validation->set_rules('security_suite_macos', 'Security Suit (MacOS)', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tier', 'Tier', 'trim|required|xss_clean');
            $this->form_validation->set_rules('package_offer', 'Package Offer', 'trim|required|xss_clean');
            $this->form_validation->set_rules('alt_no', 'Alternate Number', 'trim|xss_clean');
            $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|xss_clean');
            $this->form_validation->set_rules('order_id', 'Order ID', 'trim|xss_clean');
            $this->form_validation->set_rules('cause_of_pending', 'Cause Of Pending', 'trim|xss_clean');

			if($this->form_validation->run() == FALSE)
			{
				//change validation error delimiters
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//load view
				$this->load->view(
				'template/main', 
				array(
					'content'=>'agent/add', 
					'location' => 'Agent / Add Record',
					'result' => $result,
					'dropdown' => array('product' => $product_list,'speed' => $speed_list,'ssp' => $ssp_list,'product_offer' => $product_offer_list,'plan_option' => $plan_option_list),
					'menu' => array(
						'Logout' => 'login/logout', 
						)
					)
				);
			}
			else
			{
				if (isset($_POST['submit_record'])) {
					//destroy submit_borrower from the POST array
					unset($_POST['submit_record']);
					//add borrower
					$insert_id = $this->Record_model->add($_POST);
					if ($insert_id) {
						$this->session->set_flashdata('prompt', '<div><span class="prompt">Record added.</span></div>');
						
						redirect('/agent/view/'.$insert_id, 'refresh');
					}
				}
			}
			
		}
	}

	function view($id) {
		//check if id exist
		$query= $this->Record_model->view($id);
		if($query) {
			//load view
			$this->load->view(
				'template/main', 
				array(
					'content'=>'agent/view', 
					'location' => 'Agent / View Record',
					'result' => $query->row_array(),
					'menu' => array(
						'Logout' => 'login/logout', 
						)
					)
				);
		}
		
	}
	
	function edit($id) {
		//check if id exist
		$query= $this->Record_model->view($id);
		
		//product listing
		$product_list = array(
			'' => '',
			'FOR ACQ DEL = MIOTV' => 'FOR ACQ DEL = MIOTV',
			'FOR SNBB = CONTENT PACKS' => 'FOR SNBB = CONTENT PACKS',
			'UPSELL VARIETY PCK = UPSELL CONTENTS' => 'UPSELL VARIETY PCK = UPSELL CONTENTS'
		);
		
		//speed listing
		$speed_list = array(
			'' => '',
			'MIOHOME 6MBPS' => 'MIOHOME 6MBPS',
			'MIOHOME 10MBPS' => 'MIOHOME 10MBPS',
			'MIOHOME 15 MBPS' => 'MIOHOME 15 MBPS',
			'(MIOTV)' => '(MIOTV)'
		);
		
		//SSP listing
		$ssp_list = array(
			'' => '',
			'NEW' => 'NEW',
			'EXISTING' => 'EXISTING'
		);
		
		//product offer listing
		$product_offer_list = array(
			'' => '',
			'MioTV with 6 months contract' => 'MioTV with 6 months contract',
			'Astro Pack with 12 months contract; 50% off for 3 months' => 'Astro Pack with 12 months contract; 50% off for 3 months',
			'Bharata Pack with 12 months contract; 50% off for 3 months' => 'Bharata Pack with 12 months contract; 50% off for 3 months',
			'Sports Pack with 12 months contract; 50% off for 6 months' => 'Sports Pack with 12 months contract; 50% off for 6 months',
			'Ultimate Pack with 12 months contract; 50% off for 3 months' => 'Ultimate Pack with 12 months contract; 50% off for 3 months',
		);

        //Plan Option listing
        $plan_option_list = array(
            '' => '',
            'Standalone' => 'Standalone',
            'Recontract' => 'Recontract',
            'Bundle change' => 'Bundle change',
            'Migration' => 'Migration (Acquisition)',
            'ADSL Singtel TV Migration' => 'ADSL Singtel TV Migration'
        );
		
		if($query) {
            //validate
            $this->form_validation->set_rules('app_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('NRIC', 'NRIC', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ADSL_NO', 'ADSL Number', 'trim|xss_clean');
            $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|xss_clean');
            $this->form_validation->set_rules('IPTV_NO', 'IPTV Number', 'trim|xss_clean');
            $this->form_validation->set_rules('snd_contact', 'Secondary Contact info', 'trim|xss_clean');
            $this->form_validation->set_rules('snd_nric', 'Secondary Contact NRIC', 'trim|xss_clean');
            $this->form_validation->set_rules('snd_email', 'Secondary Contact Email Address', 'trim|xss_clean');
            $this->form_validation->set_rules('snd_dob', 'Secondary Contact Date of Birth', 'trim|xss_clean');
            $this->form_validation->set_rules('product', 'Product', 'trim|xss_clean');
            $this->form_validation->set_rules('speed', 'Speed', 'trim|xss_clean');
            $this->form_validation->set_rules('SSP', 'SSP', 'trim|xss_clean');
            $this->form_validation->set_rules('inst_add', 'Installation Address', 'trim|xss_clean');
            $this->form_validation->set_rules('actv_date', 'Activation Date', 'trim|xss_clean');
            $this->form_validation->set_rules('appt_time', 'Appointment Time', 'trim|xss_clean');
            $this->form_validation->set_rules('dealer', 'Dealer', 'trim|xss_clean');
            $this->form_validation->set_rules('crd', 'CRD', 'trim|xss_clean');
            $this->form_validation->set_rules('notes', 'Notes', 'trim|xss_clean');
            $this->form_validation->set_rules('plan_option', 'Plan Option', 'trim|required|xss_clean');
            $this->form_validation->set_rules('existing_internet_speed', 'Existing Internet Speed', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_internet_speed', 'New Internet Speed', 'trim|required|xss_clean');
            $this->form_validation->set_rules('existing_pack', 'Existing Pack', 'trim|required|xss_clean');
            $this->form_validation->set_rules('existing_pack_arpu', 'Existing Pack ARPU', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_pack_arpu', 'New Pack ARPU', 'trim|required|xss_clean');
            $this->form_validation->set_rules('arpu_difference', 'ARPU Difference', 'trim|required|xss_clean');
            $this->form_validation->set_rules('dvr', 'DVR', 'trim|required|xss_clean');
            $this->form_validation->set_rules('singtel_tv_go', 'Singtel TV Go', 'trim|required|xss_clean');
            $this->form_validation->set_rules('family_protection', 'Family Protection', 'trim|required|xss_clean');
            $this->form_validation->set_rules('security_suit_winos', 'Security Suit (WinOS)', 'trim|required|xss_clean');
            $this->form_validation->set_rules('security_suite_macos', 'Security Suit (MacOS)', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tier', 'Tier', 'trim|required|xss_clean');
            $this->form_validation->set_rules('package_offer', 'Package Offer', 'trim|required|xss_clean');
            $this->form_validation->set_rules('alt_no', 'Alternate Number', 'trim|xss_clean');
            $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|xss_clean');
            $this->form_validation->set_rules('order_id', 'Order ID', 'trim|xss_clean');
            $this->form_validation->set_rules('cause_of_pending', 'Cause Of Pending', 'trim|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				//change validation error delimiters
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//load view
				$this->load->view(
					'template/main', 
					array(
						'content'=>'agent/edit', 
						'location' => 'Agent / Edit Record',
						'dropdown' => array('product' => $product_list,'speed' => $speed_list,'ssp' => $ssp_list,'product_offer' => $product_offer_list,'plan_option' => $plan_option_list),
						'result' => $query->row_array(),
						'menu' => array(
							'Logout' => 'login/logout', 
						)
					)
				);
			}
			else
			{
				if (isset($_POST['submit_record'])) {
					
					unset($_POST['submit_record']);
					
					$update = $this->Record_model->edit($_POST, $id);
					
					if($update) {
						$this->session->set_flashdata('prompt', '<div><span class="prompt">Record updated.</span></div>');
						
						redirect('/agent/view/'.$id, 'refresh');
					}
				}
			}
		}
	}

	function form($id) {
		//check if id exist in sales table
		$query = $this->Record_model->view($id);
		$query2 = $this->Record_model->get_answers($id);
		
		$answers = $query2 ? $query2->row_array() : "";
		if($query) {
			
			if (isset($_POST['save_form'])) {
				//destroy submit_borrower from the POST array
				unset($_POST['save_form']);
				
				$phone_no = $_POST['phone_no'];
				$sale_id = $_POST['sale_id'];
				
				$save = $this->Record_model->save_answers($sale_id, $phone_no, $_POST);
				
				if($save) {
					$this->session->set_flashdata('prompt', 'Success. Form saved.');
				} else {
					$this->session->set_flashdata('prompt', 'Error. Form not save.');
				}
				
				redirect("/agent/form/{$id}", "refresh");
			} else {
				//load view
				$html = $this->load->view(
					'agent/application_form_mcs', 
					array(
						'info' => $query->row_array(),
						'answers' => $answers
					)
				);
			}
		}
		
		$this->load->helper(array('dompdf', 'file'));
		//pdf_create($html, 'test');
		
	}

	private function create_form($sale_id, $answers = FALSE) {
		//get all pack groups
		$pack_groups = $this->db->get('trck_pack_groups');
		$html = '';
		foreach($pack_groups->result() as $pack_group) {
			//get group's pack promo price
			$group_pack_promo = $this->db->get_where('trck_packs', array('group_id' => $pack_group->id, 'pack_name' => NULL));
			if($group_pack_promo->num_rows() > 0) {
				//check if promo was selected
				$radio_promo_selected = NULL;
				$selected = $this->db->get_where('trck_answers', array('sale_id' => $sale_id, 'pack_group_id' => $pack_group->id, 'pack_id' => 0));
				if($selected->num_rows > 0) {
					$radio_promo_selected = "checked='checked'";
				}
				
				$row = $group_pack_promo->row();
				//create radio box
				$promo_radio = "<input type='radio' {$radio_promo_selected} name='{$pack_group->id}_0' id='promo_{$pack_group->id}' value='{$row->price_promo}' />";
				$promo_price = "- {$promo_radio}\${$row->price_promo}";
			} else {
				$promo_price = '';
			}
			
			$html .= "
				<div class='frm_container'>
	        		<div class='frm_heading'><span>{$pack_group->group_name} {$promo_price}</span></div>
	        		<div class='frm_inputs'>
			";
			
			$html .= "	
						<table class='tablesorter' cellspacing='1'>
			        		<thead>
			        			<tr>
			        				<th class='{sorter: false}'>Pack Name</th>
			        				<th>Type</th>
			        				<th>Per Month</th>
			        				<th>12 Months</th>
			        				<th>18 Months</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        	";
			//get all packs per group
			$packs = $this->db->get_where('trck_packs', array('group_id' => $pack_group->id));
			if($packs->num_rows() > 0) {
				foreach($packs->result() as $pack) {
					if($pack->pack_name != NULL OR $pack->pack_name != '') {
						$radio1_selected = NULL;
						$radio2_selected = NULL;
						$radio3_selected = NULL;
						if(isset($answers[$pack_group->id][$pack->id])) {
							$radio1_selected = $answers[$pack_group->id][$pack->id] == $pack->price_monthly ? "checked='checked'" : '';
							$radio2_selected = $answers[$pack_group->id][$pack->id] == $pack->price_monthly_12 ? "checked='checked'" : '';
							$radio3_selected = $answers[$pack_group->id][$pack->id] == $pack->price_monthly_18 ? "checked='checked'" : '';
						}
						
						//check each choices if there is a value
						$radio1 = $pack->price_monthly > 0 ? "<input type='radio' {$radio1_selected} name='{$pack_group->id}_{$pack->id}' id='pack_{$pack_group->id}_{$pack->id}_{$pack->price_monthly}' value='{$pack->price_monthly}'/> \$" : "";
						$radio2 = $pack->price_monthly_12 > 0 ? "<input type='radio' {$radio2_selected} name='{$pack_group->id}_{$pack->id}' id='pack_{$pack_group->id}_{$pack->id}_{$pack->price_monthly_12}' value='{$pack->price_monthly_12}'/> \$" : "";
						$radio3 = $pack->price_monthly_18 > 0 ? "<input type='radio' {$radio3_selected} name='{$pack_group->id}_{$pack->id}' id='pack_{$pack_group->id}_{$pack->id}_{$pack->price_monthly_18}' value='{$pack->price_monthly_18}'/> \$" : "";
						$html .= "
										<tr>
											<td>{$pack->pack_name}</td>
											<td>{$pack->pack_type}</td>
											<td>{$radio1}{$pack->price_monthly}</td>
											<td>{$radio2}{$pack->price_monthly_12}</td>
											<td>{$radio3}{$pack->price_monthly_18}</td>
										</tr>
						";
					}
				}
			}
			$html .= '</tbody></table>';
			$html .= '
					</div>
        		</div>';
		}
		
		return $html;
	}

	function export_pdf($sale_id) {
		//check if sale id exist
		$info = $this->Record_model->view($sale_id);
		if($info) {
			//get answers
			$answers = $this->Record_model->get_answers($sale_id);
			$answers = $answers ? $answers->row_array() : "";
			
			//load view
			$html = $this->load->view('agent/application_form_mcs_dl', array('info' => $info->row_array(), 'answers' => $answers));
		}
	}
	
	function export_pdf_save($sale_id) {
		//check if sale id exist
		 $info = $this->Record_model->view($sale_id);
		if($info) {
			//get answers
			$answers = $this->Record_model->get_answers($sale_id);
			$answers = $answers ? $answers->row_array() : "";
			//get infos
			$infos = $info->row_array();
			
			//load view
			$this->load->helper(array('dompdf', 'file'));
			
			$html = $this->load->view('agent/application_form_mcs_dl', array('info' => $infos, 'answers' => $answers), TRUE);
			
			pdf_create($html, $infos['NRIC']);
		}
	}

	function calculator() {
		//init
		$selected_groups = array();

		//get contents
		$contents = $this->Calculator_model->get_items('content');
		$stbs = $this->Calculator_model->get_items('stb');
		$bundles = $this->Calculator_model->get_items('bundle');
		$cust_type = $this->Calculator_model->get_cust_type();

		//get discounts with selected = 0 to show in page as radio box
		$discount_groups = $this->Calculator_model->get_discount_groups(0);
		if(isset($_POST['discount']) AND count($_POST['discount']) > 0) {
			$selected_groups = $_POST['discount'];
		}
		//populate selected_groups with selected = 1.. pre select
		$pre_selected_groups = $this->Calculator_model->get_discount_groups(1);
		foreach ($pre_selected_groups->result() as $row) {
			$selected_groups[] = $row->id;
		}

		//var_dump($selected_groups);

		//load view
		$this->load->view(
			'template/main', 
			array(
				'content'=>'agent/calculator', 
				'location' => 'Agent / Calculator',
				'cust_type' => $cust_type,
				'contents' => $contents,
				'stbs' => $stbs,
				'bundles' => $bundles,
				'discount_groups' => $discount_groups,
				'selected_groups' => $selected_groups
			)
		);
	}

	function json_prices() {
		
		$this->output->enable_profiler(FALSE);

		$this->output->set_content_type('application/json')
        	->set_output(json_encode($this->Record_model->prep_prices($_POST)));

        
        /*json_encode($this->Record_model->prep_prices());
        //load view
		$this->load->view(
			'template/main', 
			array(
				'content'=>'agent/json_prices', 
				'location' => 'Agent / Calculator'
				)
			);*/
	}

	function json_stbs() {
		
		$this->output->enable_profiler(FALSE);

		$this->output->set_content_type('application/json')
        	->set_output(json_encode($this->Record_model->prep_stbs($_POST)));

        
        /*json_encode($this->Record_model->prep_prices());
        //load view
		$this->load->view(
			'template/main', 
			array(
				'content'=>'agent/json_prices', 
				'location' => 'Agent / Calculator'
				)
			);*/
	}

	function json_bundle() {
		
		$this->output->enable_profiler(FALSE);

		$this->output->set_content_type('application/json')
        	->set_output(json_encode($this->Record_model->prep_bundle($_POST)));

        
        /*json_encode($this->Record_model->prep_prices());
        //load view
		$this->load->view(
			'template/main', 
			array(
				'content'=>'agent/json_prices', 
				'location' => 'Agent / Calculator'
				)
			);*/
	}

	
}
