<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Dashboard extends CI_Controller {

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
			if ($_SESSION['loginMode'] == 0) {
				// echo '<pre>';print_r($this->session->userdata());echo '</pre>';die();
				$allOrders = $this->orders_model->getAllOrdersForDashboard(0);

				$id_cart = $this->session->userdata('id_cart');

				$allProducts = $this->product_model->getProducts();

				$cartProducts = [];
				if($id_cart > 0){
					$cartProducts = $this->cart_model->getCartProducts($id_cart);
				}

				$cartTotal = 0;
				foreach ($cartProducts as &$cp) {

					$cp['product_total'] = $cp['price'] * $cp['quantity'];
					$cartTotal += $cp['product_total'];
				}

				// echo '<pre>';print_r($cartProducts);echo '</pre>';
				// echo '<pre>';print_r($cartTotal);echo '</pre>';die();
				$data = [
					'allProducts' => $allProducts,
					'id_cart' => ($id_cart ? $id_cart : null),
					'cartProducts' => $cartProducts,
					'cartTotal' => $cartTotal,
				];


				$this->load->view('header');
				$this->load->view('dashboard/dashboard', $data);
				$this->load->view('footer');
			} else {
				redirect('adminDashboard');
			}
		} else {
			redirect('login');
		}

	}

	

}
