<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */

class Cart extends CI_Controller {



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



	public function addProductToCart()
	{
		$id_cart = $this->session->userdata('id_cart');

		$getVal = $this->input->get('id_product');
		$getValArr = explode('_',$getVal);
		$id_product = $getValArr[0];
		$location = $getValArr[1];

		if($id_cart > 0){
			$cartProduct = $this->cart_model->checkCartProductExist($id_cart, $id_product);
			if( empty($cartProduct) ) {
				$data = [
					'id_cart' => $id_cart,
					'id_product' => $id_product,
				];
			 	$this->cart_model->addToCart($data);
			} else {

				$id = $cartProduct->id_cart_product;
				$qty = $cartProduct->quantity + 1;
				$this->cart_model->updateCartProduct($id, $qty);
			}
		}else {
			$id_user = $this->session->userdata('user_id');
			$data = ['id_customer' => $id_user];
			$id_cart = $this->cart_model->createCart($data);
			$this->session->set_userdata('id_cart',$id_cart);

			$cartProduct = $this->cart_model->checkCartProductExist($id_cart, $id_product);
			if( empty($cartProduct) ) {
				$data = [
					'id_cart' => $id_cart,
					'id_product' => $id_product,
				];
			 	$this->cart_model->addToCart($data);
			} else {

				$id = $cartProduct->id_cart_product;
				$qty = $cartProduct->quantity + 1;
				$this->cart_model->updateCartProduct($id, $qty);
			}

		}


		header('Location: '.$location);
	}


	public function minusProductToCart()
	{
		$id_cart = $this->session->userdata('id_cart');

		$getVal = $this->input->get('id_product');
		$getValArr = explode('_',$getVal);
		$id_product = $getValArr[0];
		$location = $getValArr[1];

		if($id_cart > 0){

			$cartProduct = $this->cart_model->checkCartProductExist($id_cart, $id_product);
			if( empty($cartProduct) ) {
				// cant
			} else {
				$id = $cartProduct->id_cart_product;
				$qty = $cartProduct->quantity - 1;

				if($qty > 0) {
					$this->cart_model->updateCartProduct($id, $qty);
				} else {
					$this->cart_model->removeCartProduct($id);
				}

			}
		}else {
			$id_user = $this->session->userdata('user_id');
			$data = ['id_customer' => $id_user];
			$id_cart = $this->cart_model->createCart($data);
			$this->session->set_userdata('id_cart',$id_cart);
		}


		header('Location: '.$location);
	}




}
