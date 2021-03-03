<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 *
 * @extends CI_Model
 */
class Cart_model extends CI_Model {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		parent::__construct();
		$this->load->database();

	}

	public function createCart($data)
	{
		$data = array(
			'id_customer' => (int)$data['id_customer'],
			'id_currency' => (int)1,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		);

		$this->db->insert('cart', $data);

		return $this->db->insert_id();
	}

	public function addToCart($data)
	{
		$data = array(
			'id_cart' => (int)$data['id_cart'],
			'id_product' => (int)$data['id_product'],
			'quantity' => 1,
		);

		$this->db->insert('cart_product', $data);

		return $this->db->insert_id();
	}

	public function updateCartProduct($id, $qty)
	{
		$data = array(
			'quantity' => (int)$qty,
		);

		$this->db->set($data);
		$this->db->where('id_cart_product', $id);
		$this->db->update('cart_product', $data);

	}

	public function removeCartProduct($id)
	{
		$this->db->where('id_cart_product', $id);
		$this->db->delete('cart_product');
	}

	public function checkCartProductExist($id_cart, $id_product)
	{
		$this->db->from('cart_product');
		$this->db->where('id_cart', $id_cart);
		$this->db->where('id_product', $id_product);
		return $this->db->get()->row();
	}

	public function getCartProducts($id_cart)
	{
		$query = $this->db->query("
			SELECT t2.name, t2.price, t1.quantity, t1.id_product
			FROM cart_product t1
			LEFT JOIN products t2 on t1.id_product = t2.id_product
			WHERE t1.id_cart = " . $id_cart . "
		");
		return $query->result_array();


	}


	public function getOrderTotal()
	{
		$id_cart = $this->session->userdata('id_cart');
		$cartProducts = $this->getCartProducts($id_cart);

		$cartTotal = 0;
		foreach ($cartProducts as &$cp) {
			$cp['product_total'] = $cp['price'] * $cp['quantity'];
			$cartTotal += $cp['product_total'];
		}

		return $cartTotal;
	}
}
