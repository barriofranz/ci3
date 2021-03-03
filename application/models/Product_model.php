<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 *
 * @extends CI_Model
 */
class Product_model extends CI_Model {

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

	public function getProducts()
	{
		$this->db->from('products');
		return $this->db->get()->result_array();
	}

	public function getProductById($id)
	{
		$this->db->from('products');
		$this->db->where('id_product', $id);
		return $this->db->get()->row();
	}

	public function deleteProduct($id)
	{
		$this->db->where('id_product', $id);
		$this->db->delete('products');
	}


	public function insertProduct($data)
	{
		$this->db->insert('products', $data);

		return $this->db->insert_id();
	}

	public function updateProduct($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id_product', $id);
		$this->db->update('products', $data);

	}
}
