<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 *
 * @extends CI_Model
 */
class Orders_model extends CI_Model {

	public $primaryKey = 'id_order';

	public function __construct()
	{

		parent::__construct();
		$this->load->database();

	}
	
	public function getAllOrdersForDashboard($id = 0)
	{
		$this->db->from('orders');
		$this->db->join('customers', 'orders.id_customer = customers.id_customer', 'left');
		$this->db->order_by('orders.created_at', 'DESC');
		// echo '<pre>';print_r($id);echo '</pre>';die();
		if($id != 0) {
			$this->db->where('orders.id_order', $id);
		}

		return $this->db->get()->result_array();

	}



	public function saveOrder($data)
	{

		$data = array(
			'id_customer' => (int)$data['id_customer'],
			'id_currency' => (int)$data['id_currency'],
			'current_state' => (int)$data['current_state'],
			'total_products' => (float)$data['total_products'],
			'total_shipping' => (float)$data['total_shipping'],
			'total_paid' => $data['total_paid'],
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);

		$this->db->insert('orders', $data);

		return $this->db->insert_id();
	}

	public function updateOrder($id, $data)
	{

		$datas = array(
			'id_customer' => (int)$data['id_customer'],
			'id_currency' => (int)$data['id_currency'],
			'current_state' => (int)$data['current_state'],
			'total_products' => (float)$data['total_products'],
			'total_shipping' => (float)$data['total_shipping'],
			'total_paid' => $data['total_paid'],
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);

		$this->db->set($datas);
		$this->db->where('id_order', $id);
		$this->db->update('orders', $data);

		return $this->db->insert_id();
	}

	public function saveOrderDetail($data)
	{
		$data = array(
			'id_order' => (int)$data['id_order'],
			'id_product' => (int)$data['id_product'],
			'quantity' => (int)$data['quantity'],
			'product_name' => $data['product_name'],
			'unit_price' => (float)$data['unit_price'],
			'total_price' => (float)$data['total_price'],
		);

		$this->db->insert('order_detail', $data);

		return $this->db->insert_id();
	}

	public function deleteOrderDetailByIdOrder($id)
	{
		$this->db->where('id_order', $id);
		$this->db->delete('order_detail');
	}


	public function deleteOrder($id)
	{
		$this->db->where('id_order', $id);
		$this->db->delete('orders');
	}

	public function getOrderById($id)
	{
		$this->db->from('orders');
		$this->db->where('id_order', $id);

		return $this->db->get()->result_array();
	}

	public function getOrderDetailById($id)
	{
		$this->db->from('order_detail');
		$this->db->where('id_order', $id);

		return $this->db->get()->result_array();

	}

	public function getCustomersOrder($id_customer)
	{
		$this->db->from('orders');
		$this->db->where('id_customer', $id_customer);

		return $this->db->get()->result_array();

	}

	public function getFields()
	{
		$fields = $this->db->list_fields('orders');
		return $fields;
	}
}
