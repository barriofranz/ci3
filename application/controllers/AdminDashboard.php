<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class AdminDashboard extends CI_Controller {

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
		$this->load->model('product_model');
		$this->load->model('cart_model');
	}


	public function index() {

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if ($_SESSION['loginMode'] == 1) {
				
				$data = [
				];


				$this->load->view('header');
				$this->load->view('admin/adminDashboard', $data);
				$this->load->view('footer');
			} else {
				redirect('dashboard');
			}
		} else {
			redirect('login');
		}

	}


}
