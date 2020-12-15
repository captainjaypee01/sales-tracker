<?php
Class Client_model extends CI_Model
{
	function Client_model()
	{
		parent::__construct();
	}
	
	
	function get_sales($sdate_unix)
	{
		//extract date
		$date = mdate("%Y-%m-%d", $sdate_unix);
		
		$sales = $this->db->get_where('trck_sales', array('qa_code' => 21, 'qa_approved_date >=' => $date.' 00:00:00', 'qa_approved_date <=' => $date.' 59:59:59'));
		
		return $sales;
	}
	
}