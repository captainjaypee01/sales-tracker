<?php
Class Record_model extends CI_Model {
	function Record_model() {
		parent::__construct();
	}

	function search($phone, $campaign, $agent) {
		
		//search thru phone
		$search = $this->db->get_where('trck_sales', array('phone_no' => $phone));
		
		if($search->num_rows() > 0) {
			//check if same campaign
			$search_campaign = $this->db->get_where('trck_sales', array('phone_no' => $phone, 'campaign' => $campaign));
			if($search_campaign->num_rows() > 0) {
				//check if same agent
				$search_agent = $this->db->get_where('trck_sales', array('phone_no' => $phone, 'campaign' => $campaign, 'agent_id' => $agent));
				if($search_agent->num_rows() > 0) {
					//goto view record
					$row = $search_agent->row();
					redirect("/agent/view/{$row->id}");
				} else {
					$row = $search_campaign->row();
					return array(
						'prompt' => "<span class='prompt'>Sorry, record already tagged as sale($row->agent_id)</span>",
						'create_record' => FALSE
					);
					//prompt SORRY THIS RECORD WAS ALREADY TAGGED AS SALE BY $row->agent_id
				}
			} else {
				//create html table for the result
				$html = '<table class="tablesorter" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th class="{sorter: false}">Phone</th>
			        				<th>Campaign</th>
			        				<th>Agent</th>
			        				<th>Date</th>
			        				<th>Action</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        	';
				foreach($search->result() as $row) {
					$action = '<a href="'.base_url().'agent/view/'.$row->id.'">VIEW</a>';
					$action .= ($row->agent_id == $agent) ? ' - <a href="'.base_url().'agent/edit/'.$row->id.'">EDIT</a>' : '';
					$html .= '<tr><td>'.$row->phone_no.'</td><td>'.$row->campaign.'</td><td>'.$row->agent_id.'</td><td>'.$row->appt_date.'</td><td>'.$action.'</td></tr>';
				}
				$html .= '</tbody></table>';
				return array(
					'prompt' => "<span class='prompt'>Record found in other campaign</span>",
					'html' => $html,
					'create_record' => TRUE
				);
			}
		} else {
			return array(
				'prompt' => "<span class='prompt'>No record found</span>",
				'create_record' => TRUE
			);
			//prompt NO RECORD FOUND, CREATE NEW FOR $campaign?
		}
	}

	function add($param = array()) {
		$this->db->set('appt_date', 'NOW()', FALSE);

		if(isset($param['prod_offer']) AND is_array($param['prod_offer'])) {
			$param['prod_offer'] = implode("/", $param['prod_offer']);
		}

		$insert = $this->db->insert('trck_sales', $param);
		
		if ($insert) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	
	function edit($param = array(), $id) {
		$this->db->set('last_update', 'NOW()', FALSE);
		
		if(isset($param['prod_offer']) AND is_array($param['prod_offer'])) {
			$param['prod_offer'] = implode("/", $param['prod_offer']);
		}

		$update = $this->db->update('trck_sales', $param, array('id' => $id));
		
		if ($update) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function view($id) {
		$info = $this -> db -> get_where('trck_sales', array('id' => $id));
		
		if($info) {
			return $info;
		} else {
			return FALSE;
		}
	}
	
	function get_answers($sale_id) {
		$answers = $this -> db -> get_where('trck_form_mcs', array('sale_id' => $sale_id));
		
		if($answers->num_rows() > 0) {
			return $answers;
		} else {
			return FALSE;
		}
	}

	function update($id, $data) {
		//$this->db->set('last_update', 'NOW()', FALSE);
		//$info = array('app_name' => $data['app_name'], 'actv_date' => $data['actv_date'], 'appt_time' => $data['appt_time'], 'ADSL_NO' => $data['ADSL_NO'], 'mobile_no' => $data['mobile_no'], 'inst_add' => $data['inst_add'], 'NRIC' => $data['NRIC'], 'notes' => $data['notes'], 'dob' => $data['dob'],'last_update_by' => $this->session->userdata('SINGTEL.username'));
		
		//$this -> db -> where('id', $id);
		//$this -> db -> update('trck_sales', $info);
		
		$this->db->set('last_update', 'NOW()', FALSE);
		
		$update = $this->db->update('trck_sales', $data, array('id' => $id));
		
		if ($update) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function update_qa($id, $data) {
		if($data['qa_code'] == 21) {
			$this->db->set('qa_approved_date', 'NOW()', FALSE);
		}
		$this->db->set('last_update', 'NOW()', FALSE);
		
		$info = array('qa_code' => $data['qa_code'], 'qa_remarks' => $data['remarks'], 'last_update_by' => $this->session->userdata('SINGTEL.username'), 'qa_verifier' => $this->session->userdata('SINGTEL.username'));

		$this -> db -> where('id', $id);
		$update = $this -> db -> update('trck_sales', $info);
		
		if($update) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	function save_answers($sale_id, $phone_no, $param = array()) {
		//delete the answers first for specified sale_id
		$this->db->delete('trck_form_mcs', array('sale_id' => $sale_id));
		
		if(count($param) > 0) {
			//insert all selected radio box
			$update = $this->db->insert('trck_form_mcs', $param);
			if(!$update) {
				return FALSE;
			}
		}
		
		return TRUE;
	}
	
	function agent_sales($agent, $sdate_unix)
	{
		//extract date
		$date = mdate("%Y-%m-%d", $sdate_unix);
		
		$stats = $this->db->get_where('trck_sales', array('appt_date >=' => $date.' 00:00:00', 'appt_date <=' => $date.' 59:59:59', 'agent_id' => $agent));
		
		if($stats->num_rows() > 0) {
			return $stats;
		}
		
		return FALSE;
	}

	function create_chkbox($name, $price, $is_checked = 0, $text = "", $img_override = FALSE)
	{
		//test if $img_override is TRUE. $img_override tells whether to use check image instead of checkbox
		if($img_override) {
			$base_url = base_url();
			$checked = $is_checked == 1 ? "leftchecked":"leftunchecked";
			
			$text = !empty($text) ? $text:"";
			
			$chkbox = "
				<div class='container'>
				        <div class='$checked'>
				            
				        </div>
				        <div class='right'>
				            $price
				        </div>
				</div>
				<div class='small_txt'>
					$text
				</div>
			";
			
			echo $chkbox;
		} else {
			$checked = $is_checked == 1 ? "checked='checked'":"";
			
			$text = !empty($text) ? "<br /> <span class='small_txt'>$text</span>":"";
			
			$chkbox = "<input type='checkbox' name='$name' value='1' $checked />$price $text";
			
			echo $chkbox;
		}
	}
	
	function verified($sale_id, $tag = 0) {
		if(isset($sale_id)) {
			$this->db->set('tl_approved_date', 'NOW()', FALSE);
		
			$update = $this->db->update('trck_sales', array('tl_approved' => $tag, 'tl_approved_by' => $this->session->userdata('SINGTEL.username')), array('id' => $sale_id));
			
			if ($update) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
	
	function delete($sale_id) {
		$delete = $this->db->delete('trck_sales', array('id' => $sale_id));
		$delete2 = $this->db->delete('trck_form_mcs', array('sale_id' => $sale_id));
		if($delete AND $delete2) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function prep_prices($groups = NULL) {

		$items = (object) array();
		$details = array();
		//get all content items per customer type
		$this->db->select("trck_calc_customers.name as 'cust_name', trck_calc_items.value as 'item_name', trck_calc_item_customer_prices.price");
		$this->db->from('trck_calc_item_customer_prices');
		$this->db->join('trck_calc_items', 'trck_calc_item_customer_prices.item_id = trck_calc_items.id');
		$this->db->join('trck_calc_customers', 'trck_calc_item_customer_prices.customer_id = trck_calc_customers.id');
		$this->db->where('trck_calc_items.type', 'content');

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			foreach ($query->result() as $item) {
				$cust_name = $item->cust_name;
				$item_name = $item->item_name;
				$items->$cust_name->$item_name->price = (float)$item->price;
				
			}
		}

		//discounts
		$this->db->select("trck_calc_customers.name as 'cust_name', trck_calc_items.value as 'item_name', trck_calc_discount_types.name as 'discount_name', trck_calc_item_customer_discounts.*");
		$this->db->from('trck_calc_item_customer_discounts');
		$this->db->join('trck_calc_items', 'trck_calc_item_customer_discounts.item_id = trck_calc_items.id');
		$this->db->join('trck_calc_customers', 'trck_calc_item_customer_discounts.customer_id = trck_calc_customers.id');
		$this->db->join('trck_calc_discount_types', 'trck_calc_item_customer_discounts.discount_id = trck_calc_discount_types.id');
		$this->db->join('trck_calc_discount_groups', 'trck_calc_item_customer_discounts.group_id = trck_calc_discount_groups.id');
		$this->db->where('trck_calc_items.type', 'content');
		$this->db->order_by('trck_calc_customers.name, trck_calc_items.name, trck_calc_discount_groups.order, trck_calc_item_customer_discounts.id');


		if($groups !== NULL AND isset($groups['id'])) {
			$this->db->where_in('trck_calc_item_customer_discounts.group_id', $groups['id'] );
		}

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			
			//var init
			$cust_name = '';
			$item_name = '';
			$discounts = array();

			foreach ($query->result() as $item) {
				//var_dump($item);
				//var_dump($cust_name . ' - ' . $item->cust_name . ' / ' . $item_name . ' - ' . $item->item_name);
				if($cust_name == $item->cust_name AND $item_name == $item->item_name) {
					array_push($discounts, array('type' => $item->discount_name, 'value' => $item->value, 'duration' => $item->duration));

					$cust_name = $item->cust_name;
					$item_name = $item->item_name;
				} else {

					if($cust_name != '' AND $item_name != '') {

						$items->$cust_name->$item_name->discount = $discounts;

						$discounts = array();
					}

					$cust_name = $item->cust_name;
					$item_name = $item->item_name;

					array_push($discounts, array('type' => $item->discount_name, 'value' => $item->value, 'duration' => $item->duration));
				}
			}

			$items->$cust_name->$item_name->discount = $discounts;
		}

		//get all customer types
		//$customers = $this->db->get('trck_calc_customers');
		//$items->groups = $groups['id'];

		return $items;
	}

	function prep_stbs($groups = NULL) {

		$items = (object)array();
		$details = array();
		//get all content items per customer type
		$this->db->select("trck_calc_customers.name as 'cust_name', trck_calc_items.value as 'item_name', trck_calc_item_customer_prices.price");
		$this->db->from('trck_calc_item_customer_prices');
		$this->db->join('trck_calc_items', 'trck_calc_item_customer_prices.item_id = trck_calc_items.id');
		$this->db->join('trck_calc_customers', 'trck_calc_item_customer_prices.customer_id = trck_calc_customers.id');
		$this->db->where('trck_calc_items.type', 'stb');

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			foreach ($query->result() as $item) {
				$cust_name = $item->cust_name;
				$item_name = $item->item_name;
				$items->$cust_name->$item_name->price = (float)$item->price;
			}
		}

		//get all customer types
		//$customers = $this->db->get('trck_calc_customers');
		//$items->groups = $groups['id'];
	
		return $items;
	}

	function prep_bundle($groups = NULL) {

		$items = (object)array();
		$details = array();
		//get all content items per customer type
		$this->db->select("trck_calc_customers.name as 'cust_name', trck_calc_items.value as 'item_name', trck_calc_item_customer_prices.price");
		$this->db->from('trck_calc_item_customer_prices');
		$this->db->join('trck_calc_items', 'trck_calc_item_customer_prices.item_id = trck_calc_items.id');
		$this->db->join('trck_calc_customers', 'trck_calc_item_customer_prices.customer_id = trck_calc_customers.id');
		$this->db->where('trck_calc_items.type', 'bundle');

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			foreach ($query->result() as $item) {
				$cust_name = $item->cust_name;
				$item_name = $item->item_name;
				$items->$cust_name->$item_name->price = (float)$item->price;
			}
		}

		//get all customer types
		//$customers = $this->db->get('trck_calc_customers');
		//$items->groups = $groups['id'];
		
		return $items;
	}

}
