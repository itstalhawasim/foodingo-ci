<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller
{

	public function index()
	{
		$this->load->view('templates/head');
		$this->load->view('pages/homepage');
		$this->load->view('templates/footer');
	}

	public function about(){
		$this->load->view('templates/head');
		$this->load->view('pages/about');
		$this->load->view('templates/footer');
	}

	public function food_menu(){
		$data['items'] = $this->restaurant_model->get_menu_items();
		$this->load->view('templates/head');
		$this->load->view('pages/food_menu', $data);
		$this->load->view('templates/footer');
	}
}
