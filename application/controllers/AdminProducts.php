<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class AdminProducts extends CI_Controller {

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


        $products = $this->product_model->getProducts();
        $data = [
            'products' => $products,
        ];
		$this->load->view('header');
		$this->load->view('admin/adminProducts', $data);
		$this->load->view('footer');


	}


    public function deleteProduct()
    {

        $getVal = $this->input->get('id_product');
        $getValArr = explode('_',$getVal);
        $id_product = $getValArr[0];
        $location = $getValArr[1];

        $this->product_model->deleteProduct($id_product);

        header('Location: '.$location);


    }

	public function addProduct()
    {
        $data = [
			'product' => [],
            'idProduct' => 0,
        ];
		$this->load->view('header');
		$this->load->view('admin/adminProductsForm', $data);
		$this->load->view('footer');


    }


	public function editProduct()
    {
		$id_product = $this->input->get('id_product');

		$product = $this->product_model->getProductById($id_product);

        $data = [
            'product' => $product,
			'idProduct' => $id_product,
        ];
		// echo '<pre>';print_r($product);echo '</pre>';die();
		$this->load->view('header');
		$this->load->view('admin/adminProductsForm', $data);
		$this->load->view('footer');
    }

	public function saveProduct()
	{
		$name = $this->input->post('name');
		$desc = $this->input->post('desc');
		$price = $this->input->post('price');
		$id_product = $this->input->post('id_product');

		if($id_product == 0) {
			$data = [
				'name' => $name,
				'desc' => $desc,
				'price' => $price,
			];
			$products = $this->product_model->insertProduct($data);
		} else {
			$data = [
				'name' => $name,
				'desc' => $desc,
				'price' => $price,
			];
			$products = $this->product_model->updateProduct($id_product, $data);
		}

		header('Location: adminProducts');
	}


	public function viewProduct()
	{
		$id_product = $this->input->get('id_product');

		$product = $this->product_model->getProductById($id_product);

		$data = [
            'product' => $product,
			'idProduct' => $id_product,
			'viewMode' => 1,
        ];
		// echo '<pre>';print_r($product);echo '</pre>';die();
		$this->load->view('header');
		$this->load->view('admin/adminProductsForm', $data);
		$this->load->view('footer');
	}
}
