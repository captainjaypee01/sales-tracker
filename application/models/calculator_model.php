<?php
Class Calculator_model extends CI_Model {

	public function get_items($type = NULL) {
		$this->db->select('*');
		$this->db->from('trck_calc_items');

		if($type !== NULL) {
			$this->db->where(array('type'=>$type));
		}

		$this->db->order_by('name');

		$items = $this->db->get();
		
		return $items;
	}


	public function get_cust_type() {
		$this->db->select('*');
		$this->db->from('trck_calc_customers');
		
		$contents = $this->db->get();
		
		return $contents;
	}


	public function get_bundles() {
		$bundles = $this->db->get('trck_calc_customers');

		return $bundles;
	}

	public function get_discount_types() {
		$discount_types = $this->db->get('trck_calc_discount_types');

		return $discount_types;
	}

	public function get_discount_groups($selected = NULL) {
		$this->db->select('*');
		$this->db->from('trck_calc_discount_groups');

		if($selected !== NULL) {
			$this->db->where(array('selected'=>$selected));
		}
		
		$this->db->order_by('selected', 'DESC');

		$discount_groups = $this->db->get();

		return $discount_groups;
	}

	public function get_prices($content_id) {
		$this->db->select('trck_calc_items.name AS "item", trck_calc_customers.name AS "customer", trck_calc_item_customer_prices.*');
		$this->db->from('trck_calc_item_customer_prices');
		$this->db->join('trck_calc_items', 'trck_calc_item_customer_prices.item_id = trck_calc_items.id');
		$this->db->join('trck_calc_customers', 'trck_calc_item_customer_prices.customer_id = trck_calc_customers.id');
		$this->db->where('trck_calc_items.id', $content_id);
	
		$prices = $this->db->get();

		$prices_list = array();
		foreach ($prices->result() as $row_prices) {
			$prices_list[$row_prices->customer] = $row_prices->price;
		}

		return $prices_list;
	}

	public function get_discounts($content_id, $group_id) {
		$this->db->select('trck_calc_items.name AS "item", trck_calc_customers.name AS "customer", trck_calc_customers.label AS "label", trck_calc_discount_types.name as "discount", trck_calc_item_customer_discounts.*');
		$this->db->from('trck_calc_item_customer_discounts');
		$this->db->join('trck_calc_items', 'trck_calc_item_customer_discounts.item_id = trck_calc_items.id');
		$this->db->join('trck_calc_customers', 'trck_calc_item_customer_discounts.customer_id = trck_calc_customers.id');
		$this->db->join('trck_calc_discount_types', 'trck_calc_item_customer_discounts.discount_id = trck_calc_discount_types.id');
		$this->db->where('trck_calc_item_customer_discounts.group_id', $group_id);
		$this->db->where('trck_calc_items.id', $content_id);
	
		$discounts = $this->db->get();

		return $discounts;
	}


	public function add_discount_group($data) {
		$insert = $this->db->insert('trck_calc_discount_groups',
			array(
				'name' => $data['discount_group_name'],
				'order' => 2,
				'selected' => $data['discount_group_selected']
			)
		);

		if($insert) {
			return TRUE;
		}

		return FALSE;

	}

	public function add_customer_type($data) {
		$insert = $this->db->insert('trck_calc_customers',
			array(
				'name' =>  url_title($data['customer_type_name'], 'dash', true),
				'label' => strtoupper($data['customer_type_label'])		
			)
		);

		$id = $this->db->insert_id();
		$query = $this->db->get('trck_calc_items');

		foreach ($query->result() as $row)
		{
			$this->db->insert('trck_calc_item_customer_prices',
				array(
					'item_id' => $row->id,
					'customer_id' => $id,
					'price' => '0'
				)
			);
		}

		if($insert) {
			return TRUE;
		}

		return FALSE;

	}


	public function add_item($data) {
		$insert = $this->db->insert('trck_calc_items',
			array(
				'name' => $data['item_name'],
				'value' => url_title($data['item_name'], 'dash', true),
				'type' => $data['item_type']
			)
		);
		//get auto generated id
		$content_id = $this->db->insert_id();
		$query = $this->db->get('trck_calc_customers');

		foreach ($query->result() as $row)
		{
			$this->db->insert('trck_calc_item_customer_prices',
				array(
					'item_id' => $content_id,
					'customer_id' => $row->id,
					'price' => $data[$row->name . '_price']
				)
			);
		}
		
		if($insert) {
			return $content_id;
		}

		return FALSE;
	}
	

	public function update_customer_type($data) {
		//update item name
		$update = $this->db->update('trck_calc_customers',
			array(
				'name' => url_title($data['ecustomer_type_name'], 'dash', true),
				'label' => $data['ecustomer_type_label']
			),
			array(
				'id' => $data['eitem_id']
			)
		);

		return $update;
	}

	public function update_item($data) {
		//update item name
		$update1 = $this->db->update('trck_calc_items',
			array(
				'name' => $data['item_name'],
				'value' => url_title($data['item_name'], 'dash', true)
			),
			array(
				'id' => $data['id']
			)
		);

		$query = $this->db->get('trck_calc_customers');
		
		foreach ($query->result() as $row)
		{
			$update2 = $this->db->update('trck_calc_item_customer_prices',
				array(
					'price' => $data[$row->name . '_price']
				),
				array(
					'item_id' => $data['id'],
					'customer_id' => $row->id
				)
			);
		}

		return $update1 AND $update2;
	}

	public function add_discount($data) {

		$insert = $this->db->insert('trck_calc_item_customer_discounts', $data);

		if($insert) {
			return TRUE;
		}

		return FALSE;
	}
	
	public function delete_discount($id) {
		$delete = $this->db->delete('trck_calc_item_customer_discounts', array('id' => $id));

		return $delete;
	}

	public function delete_customer_type($id) {
		$delete1 = $this->db->delete('trck_calc_customers', array('id' => $id));
		$delete2 = $this->db->delete('trck_calc_item_customer_prices', array('customer_id' => $id));
		
		return $delete1 AND $delete2;
	}

	public function get_discount_detail($id) {
		$discount = $this->db->get_where('trck_calc_item_customer_discounts', array('id' => $id));
		
		return $discount;
	}

	public function update_discount($data) {
		//update content name
		$update = $this->db->update('trck_calc_item_customer_discounts',
			array(
				'value' => $data['value'],
				'duration' => $data['duration']
			),
			array(
				'id' => $data['id']
			)
		);

		return $update;
	}

	public function update_discount_group($data) {
		//update content name
		$update = $this->db->update('trck_calc_discount_groups',
			array(
				'name' => $data['discount_group_name']
			),
			array(
				'id' => $data['id']
			)
		);

		return $update;
	}
	
	public function delete_item($id) {
		$delete1 = $this->db->delete('trck_calc_item_customer_discounts', array('item_id' => $id));
		$delete2 = $this->db->delete('trck_calc_item_customer_prices', array('item_id' => $id));
		$delete3 = $this->db->delete('trck_calc_items', array('id' => $id));

		return $delete1 AND $delete2 AND $delete3;
	}

	public function delete_discount_group($id) {
		$delete = $this->db->delete('trck_calc_discount_groups', array('id' => $id));

		return $delete;
	}


	/**
	 * generate discount label
	 * @param  [type] $discount [description]
	 * @return [type]           [description]
	 */
	public function get_promotion_detail($discount) {
		$discount_string = "";
		$ctype = $discount->label;

		//test what kind of discount
		if($discount->discount == 'percent') {
			//value string
			$discount_string .= $discount->value*100 . '% off for ';

			//duration string
			$discount_string .= $discount->duration . ' months';

			//customer type string
			$discount_string .= '(' . $ctype . ')';
		} elseif($discount->discount == 'fixed') {
			//value string
			$discount_string .= $discount->value . '$ off for ';

			//duration string
			$discount_string .= $discount->duration . ' months';

			//customer type string
			$discount_string .= '(' . $ctype . ')';
		} elseif($discount->discount == 'free') {
			//duration string
			$discount_string .= $discount->duration . ' months FREE';

			//customer type string
			$discount_string .= '(' . $ctype . ')';
		} elseif($discount->discount == 'stb') {
			//value string
			$discount_string .= $discount->value*100 . '% off for ';

			//duration string
			$discount_string .= $discount->duration . ' months in STB';

			//customer type string
			$discount_string .= '(' . $ctype . ')';
		}

		return '<li>' . $discount_string . ' - (<a href="" class="delete_discount" title="Delete Discount" id="disc_'.$discount->id.'">X</a>)(<a href="" class="edit_discount" title="Edit Discount" id="disc_e_'.$discount->id.'">#</a>)</li>';
	}
}