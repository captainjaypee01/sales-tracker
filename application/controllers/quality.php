<?php
Class Quality extends CI_Controller 
{
	
	function Quality()
	{
		parent::__construct();
		
		if($this->session->userdata('SINGTEL.user_type') != 'quality')
		{
			redirect(base_url().'login', 'refresh');
		}
		$this->load->model('Quality_model');
		$this->load->model('Manager_model');
		$this->load->library('session');
		$this->load->helper('date');
		
		date_default_timezone_set("Asia/Manila");
	}
	
	function index()
	{
		//$this->load->view('template2');
		redirect(base_url().'quality/sales/', 'refresh');
	}
	
	function sales($sdate_unix = NULL)
	{
		if($this->input->post('mdate')) {
			
			$date = strtotime($this->input->post('mdate'));
			
			redirect(base_url().'quality/sales/'.$date, 'refresh');
			
		}
		
		if(NULL == $sdate_unix) {
			//get current date
			$format = 'DATE_RFC1123';
			
			$sdate_unix = time();
			
			$sdate_human = unix_to_human($sdate_unix);
			
		}
		
		$team_stats = $this->Quality_model->get_sale_list($sdate_unix);
		
		$date = mdate("%Y-%m-%d", $sdate_unix);
		
		$data = array('team_stats' => $team_stats, 'date' => $date);
		
		//load view
		$this->load->view(
			'template/main', 
			array(
				'content'=>'quality/sales', 
				'location' => 'QA / Sales', 
				'data' => $data,
				'menu' => array(
					'Logout' => 'login/logout', 
				)
			)
		);
		
		//$this->load->view('quality/default', array('data' => $data));
	}
	
	function export_excel($sdate_unix = NULL)
	{
		if(NULL == $sdate_unix) {
			//get current date
			$format = 'DATE_RFC1123';
			
			$sdate_unix = time();
		}
		$generate_excel = $this->Quality_model->generate_excel($sdate_unix);
		
		$this->load->library('ExportExcel', array('filename' => "Singtel_Sales_File-{$sdate_unix}.xls"));
		
		$this->exportexcel->setHeadersAndValues($generate_excel['report_header'],$generate_excel['report_values']);
		
		$this->exportexcel->GenerateExcelFile();
	}
}