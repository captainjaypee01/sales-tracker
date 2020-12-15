<?php
Class Quality_model extends CI_Model
{
	function Quality_model()
	{
		parent::__construct();
	}
	
	function get_sale_list($sdate_unix)
	{
		//extract date
		$date = mdate("%Y-%m-%d", $sdate_unix);
		
		$stats = $this->db->get_where('trck_sales', array('appt_date >=' => $date.' 00:00:00', 'appt_date <=' => $date.' 23:59:59'));
		
		return $stats;
	}
	
	function generate_excel($sdate_unix)
	{
		
		$sales = $this->get_sale_list($sdate_unix);
		
		$field_count = $sales->num_fields(); 
		
		$fields = $sales->list_fields();
		
		$row_count = $sales->num_rows();
		
		$this->session->set_userdata(array('report_header' => $fields));
		
		//Print rows in excel
		$j = 0;
		$session_value = array();
		foreach ($sales->result() as $row)
		{
			for ($i = 0; $i < $field_count; ++$i) {
				$field_name = $fields[$i];
				$session_value[$j][$i] = $row->$field_name." ";
			}
			$j++;
		}
		
		return array('report_header' => $fields, 'report_values' => $session_value);
	}
	
	function get_codes()
	{
		$this->db->order_by('code');
		$query = $this->db->get('trck_qa_codes');
		$codes = array("" => "");
		foreach ($query->result() as $row) {
			$codes[$row->id] = $row->code.' - '.$row->dispo;
		}
		
		return $codes;
	}
	
	function get_code_name($id)
	{
		$query = $this->db->get_where('trck_qa_codes', array('id' => $id));
		
		if($query->num_rows() > 0) {
			$result = $query->row();
			
			return $result->dispo. ' - ' .$result->code;
		}
		
		return FALSE;
	}
}