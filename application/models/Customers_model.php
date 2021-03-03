<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 *
 * @extends CI_Model
 */
class Customers_model extends CI_Model {

	public $primaryKey = 'id_customer';

	public function __construct() {

		parent::__construct();
		$this->load->database();

	}

	public function getCustomerById($id)
	{

		$this->db->from('customers');
		$this->db->where('id_customer', $id);
		return $this->db->get()->row();

	}

	public function getCustomers()
	{
		$this->db->from('customers');
		return $this->db->get()->result_array();
	}

	public function getFields()
	{
		$fields = $this->db->list_fields('customers');
		return $fields;
	}


}
