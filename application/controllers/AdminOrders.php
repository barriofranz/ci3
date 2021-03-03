<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class AdminOrders extends CI_Controller {

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
		$this->load->model('orders_model');
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


        $records = $this->orders_model->getAllOrdersForDashboard();
        $fields = $this->orders_model->getFields();

        $primaryKey = $this->orders_model->primaryKey;
        $maskFields = $this->maskFields($fields);

        foreach ($records as &$rec) { // parse idcustomer
            $rec['id_customer'] = $rec['firstname']  . ' ' .  $rec['lastname'];
        }

        $data = [
            'primaryKey' => $primaryKey,
            'maskFields' => $maskFields,
            'fields' => $fields,
            'records' => $records,
            'controller' => 'adminOrders',
        ];

		$this->load->view('header');
		$this->load->view('admin/adminList', $data);
		$this->load->view('footer');


	}


	public function maskFields($fields)
	{
		$maskedFields = [];
		foreach ($fields as $field) {
			switch ($field) {
				case 'id_order' : $nf = 'ID Order'; break;
				case 'id_customer' : $nf = 'Customer'; break;
				case 'total_paid' : $nf = 'Order Total'; break;
				case 'created_at' : $nf = 'Date Created'; break;
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

		$records = $this->orders_model->getAllOrdersForDashboard($id);
        if(!isset($records[0])) {
            redirect('adminDashboard');
        }
        $record = $records[0];
		$fields = $this->orders_model->getFields();
		$orderDetails = $this->orders_model->getOrderDetailById($id);
        $primaryKey = $this->orders_model->primaryKey;

        $customer = $this->customers_model->getCustomerById($record['id_customer']);
        $record['customerName'] = $customer->firstname . ' ' . $customer->lastname;


		$data = [
            'primaryKey' => $primaryKey,
            'fields' => $fields,
            'record' => $record,
            'orderDetails' => $orderDetails,
			'id' => $id,
        ];
		// echo '<pre>';print_r($product);echo '</pre>';die();
		$this->load->view('header');
		$this->load->view('admin/adminOrderView', $data);
		$this->load->view('footer');
	}
}
