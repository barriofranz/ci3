<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Order extends CI_Controller {

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
		$this->load->model('product_model');
		$this->load->model('customers_model');
		$this->load->model('orders_model');
		$this->load->model('cart_model');

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			if ($_SESSION['loginMode'] == 0) {

			} else {
   				redirect('adminDashboard');
   			}
   		} else {
   			redirect('login');
   		}
	}


	public function orderConfirmation()
	{
		// echo '<pre>';print_r($this->session->userdata());echo '</pre>';die();
		$this->session->unset_userdata('id_cart');
		$data = [];
		$this->load->view('header');
		$this->load->view('order/confirmation', $data);
		$this->load->view('footer');
	}

	public function submitOrder()
	{
		$id_cart = $this->session->userdata('id_cart');
		$cartProducts = [];
		if($id_cart > 0){
			$cartProducts = $this->cart_model->getCartProducts($id_cart);
		} else {
			header('Location: dashboard');
		}
		$orderTotal = $this->cart_model->getOrderTotal();
		$id_customer = $this->session->userdata('user_id');

		$data = [
			'id_customer' => $id_customer,
			'id_cart' => $id_cart,
			'id_currency' => 1,
			'current_state' => 1,
			'total_products' => $orderTotal,
			// 'total_shipping' => $shippingFee,
			'total_paid' => $orderTotal,
		];

		$id_order = $this->orders_model->saveOrder($data);

		foreach($cartProducts as $productLine) {

			$productObj = $this->product_model->getProductById($productLine['id_product']);

			$data = [
				'id_order' => $id_order,
				'id_product' => $productLine['id_product'],
				'quantity' => $productLine['quantity'],
				'product_name' => $productObj->name,
				'unit_price' => $productLine['price'],
				'total_price' =>  (int)$productLine['price'] * (int)$productLine['quantity'],
			];

			$allCustomer = $this->orders_model->saveOrderDetail($data);
		}

		header('Location: orderConfirmation');

	}


	public function checkout()
	{
		// echo '<pre>';print_r($this->session->userdata());echo '</pre>';
		$id_cart = $this->session->userdata('id_cart');
		if($id_cart > 0){
			$cartProducts = $this->cart_model->getCartProducts($id_cart);
		} else {
			header('Location: dashboard');
		}


		$id_customer = $this->session->userdata('user_id');
		$customer = $this->customers_model->getCustomerById($id_customer);

		$cartTotal = 0;
		foreach ($cartProducts as &$cp) {
			$cp['product_total'] = $cp['price'] * $cp['quantity'];
			$cartTotal += $cp['product_total'];
		}

		$data = [
			'cartProducts' => $cartProducts,
			'customer' => $customer,
			'cartTotal' => $cartTotal,

		];
		// echo '<pre>';print_r($data);echo '</pre>';die();
		$this->load->view('header');
		$this->load->view('order/order', $data);
		$this->load->view('footer');
	}

	public function viewOrders()
	{
		$id_customer = $this->session->userdata('user_id');

		$orders = $this->orders_model->getCustomersOrder($id_customer);

		$orderDetails = [];
		foreach ($orders as $odo) {
			$orderDetailObj = $this->orders_model->getOrderDetailById($odo['id_order']);
			$orderDetails[$odo['id_order']] = $orderDetailObj;
		}

		$data = [
			'orders' => $orders,
			'orderDetails' => $orderDetails,
		];

		$this->load->view('header');
		$this->load->view('order/orderlist', $data);
		$this->load->view('footer');

	}






}
