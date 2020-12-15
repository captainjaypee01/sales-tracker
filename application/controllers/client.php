<?php
Class Client extends CI_Controller 
{
	
	function Client()
	{
		parent::__construct();
		
		if($this->session->userdata('SINGTEL.user_type') != 'client')
		{
			redirect(base_url().'login', 'refresh');
		}
		
		$this->load->model('Manager_model');
		$this->load->model('Quality_model');
		$this->load->model('Client_model');
		
		$this->load->helper('date');
		
		date_default_timezone_set("Asia/Manila");
	}
	
	function index() {
		redirect(base_url().'client/stats/', 'refresh');
	}
	
	function stats($sdate_unix = NULL)
	{
		if($this->input->post('mdate')) {
			
			$date = strtotime($this->input->post('mdate'));
			
			redirect(base_url().'client/stats/'.$date, 'refresh');
			
		}
		
		if(NULL == $sdate_unix) {
			//get current date
			$format = 'DATE_RFC1123';
			
			$sdate_unix = time();
			
			$sdate_human = unix_to_human($sdate_unix);
			
		}
		
		$approved_sales = $this->Client_model->get_sales($sdate_unix);
		
		$date = mdate("%Y-%m-%d", $sdate_unix);
		
		$data = array('date' => $date, 'date_unix' => $sdate_unix, 'sales' => $approved_sales);
		
		//load view
		$this->load->view(
			'template/main', 
			array(
				'content'=>'client/stats',
				'location' => 'Client / Approved Sales', 
				'data' => $data,
				'menu' => array(
					'Logout' => 'login/logout', 
				)
			)
		);
	}
}