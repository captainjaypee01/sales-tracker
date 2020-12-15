<?php
Class Record extends CI_Controller 
{
	
	function Record()
	{
		parent::__construct();
		
		$this->load->model('Quality_model');
		$this->load->model('Manager_model');
		$this->load->model('Record_model');
	}
	
	function view($id)
	{
		if(isset($_POST['update'])) {
			unset($_POST['update']);
			$update = $this->Record_model->update($id, $_POST);
			if($update) {
				$this->session->set_flashdata('prompt', '<div><span class="prompt">Record updated.</span></div>');
				redirect('record/view/'.$id,'refresh');
			}
		}
		
		if(isset($_POST['verified']) OR isset($_POST['unverified'])) {
			$verified = $this->Record_model->verified($id, isset($_POST['verified'])?1:0);
			if($verified) {
				$prompt = isset($_POST['verified'])?'Verified':'Unverified';
				$this->session->set_flashdata('prompt', "<div><span class='prompt'>Record change status to {$prompt}.</span></div>");
				redirect('record/view/'.$id,'refresh');
			}
		}
		
		if(isset($_POST['qa_remarks'])) {
			$this->form_validation->set_rules('qa_code','Final Disposition','trim|xss_clean|required');
			
			if($this->form_validation->run() == FALSE) {
			
				//$this->load->view('template/main', array('content' => 'login/login', 'location' => 'Login'));
			
			} else {
				$update = $this->Record_model->update_qa($id, $_POST);
				
				if($update) {
					$this->session->set_flashdata('prompt', '<div><span class="prompt">Record updated.</span></div>');
				}
			}
			
		}
		
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
		
		$info = $this->Record_model->view($id);
		
		$data = array('info' => $info);
		
		if($this->session->userdata('SINGTEL.user_type') == 'quality') {
			$user_type = 'Quality';
			$data += array('codes' => $this->Quality_model->get_codes());
		} else {
			$user_type = 'Manager';
		}
		
		//load view
		$this->load->view(
			'template/main', 
			array(
				'content'=>'record/view', 
				'location' => "{$user_type} / View Sales", 
				'dropdown' => array('product' => $product_list,'speed' => $speed_list,'ssp' => $ssp_list,'product_offer' => $product_offer_list),
				'data' => $data,
				'menu' => array(
					'Logout' => 'login/logout', 
				)
			)
		);
	}

	function delete($sale_id)
	{
		$delete = $this->Record_model->delete($sale_id);
		
		if($delete) {
			$this->session->set_flashdata('prompt', '<div><span class="prompt">Record deleted.</span></div>');
			redirect('manager/stats/', 'refresh');
		}
	}
}