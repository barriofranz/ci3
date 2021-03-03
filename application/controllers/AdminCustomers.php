<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class AdminCustomers extends CI_Controller {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('user_model');
		$this->load->model('customers_model');

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if ($_SESSION['loginMode'] == 1) {

			} else {
   				redirect('dashboard');
   			}
   		} else {
   			redirect('login');
   		}
	}


	public function index() {


        $records = $this->customers_model->getCustomers();
        $fields = $this->customers_model->getFields();
        $primaryKey = $this->customers_model->primaryKey;
        $maskFields = $this->maskFields($fields);
        $data = [
            'primaryKey' => $primaryKey,
            'maskFields' => $maskFields,
            'fields' => $fields,
            'records' => $records,
		    'controller' => 'adminCustomers',
        ];
		// echo '<pre>';print_r($records);echo '</pre>';die();
		// echo '<pre>';print_r($fields);echo '</pre>';die();
		$this->load->view('header');
		$this->load->view('admin/adminList', $data);
		$this->load->view('footer');


	}


	public function maskFields($fields)
	{
		$maskedFields = [];
		foreach ($fields as $field) {
			switch ($field) {
				case 'id_customer' : $nf = 'ID Customer'; break;
				case 'firstname' : $nf = 'First name'; break;
				case 'lastname' : $nf = 'Last name'; break;
				case 'address' : $nf = 'Address'; break;
				default : $nf = false; break;
			}
			if( $nf !== false){
	             $maskedFields[$field] = $nf;
            }
		}

		return $maskedFields;
	}

	public function viewRecord()
	{
		$id = $this->input->get('id');

		$customer = $this->customers_model->getCustomerById($id);
		$fields = $this->customers_model->getFields();
        $primaryKey = $this->customers_model->primaryKey;
        $maskFields = $this->maskFields($fields);

		$data = [
            'primaryKey' => $primaryKey,
            'maskFields' => $maskFields,
            'fields' => $fields,
            'record' => $customer,
			'id' => $id,
        ];
		// echo '<pre>';print_r($product);echo '</pre>';die();
		$this->load->view('header');
		$this->load->view('admin/adminView', $data);
		$this->load->view('footer');
	}
}
