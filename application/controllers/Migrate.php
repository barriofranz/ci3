<?php

class Migrate extends CI_Controller
{
	public function index()
	{
		$this->load->library("migration");

		$this->migration->version(0);
		$this->migration->version(1);


	}

}
