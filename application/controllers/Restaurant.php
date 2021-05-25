<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant extends CI_Controller{

	public function register(){
		if($this->session->userdata('uid')){
			redirect('page/index');
		}
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_user_exists');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/head');
			$this->load->view('restaurant/register');
			$this->load->view('templates/footer');
		}else{
			if($this->restaurant_model->register_restaurant()){
				$this->session->set_flashdata('login_status', array(
					'type'  => "success",
					'message' => "Successfully registered, please login now."
				));
				redirect('user/login');
			}else{
				$this->session->set_flashdata('register_status', array(
					'type'  => "danger",
					'message' => "An error occured, Please recheck entered values."
				));
				redirect('user/register');
			}		
		}
	}

	public function add_item(){
		if(!$this->session->userdata('is_restaurant')){
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('uid');
			$this->session->unset_userdata('is_restaurant');
			$this->session->unset_userdata('cart_items');
			$this->session->set_flashdata('login_status', array(
				'type'  => "primary",
				'message' => 'Please login to access this page.'
			));
			redirect('user/login');
		}
		$this->form_validation->set_rules('item_name', 'Item Name', 'required');
		$this->form_validation->set_rules('type', 'Item Type', 'required');
		$this->form_validation->set_rules('price', 'Item Price', 'required');
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/head');
			$this->load->view('restaurant/add_item');
			$this->load->view('templates/footer');
		}else{
			if($this->restaurant_model->add_menu_item()){
				$this->session->set_flashdata('add_item_status', array(
					'type'  => "success",
					'message' => "Item was successfully added."
				));
				redirect('restaurant/add_item');
			}else{
				$this->session->set_flashdata('add_item_status', array(
					'type'  => "danger",
					'message' => "An error occured, Please recheck entered values."
				));
				redirect('restaurant/add_item');
			}		
		}
	}

	public function view_orders(){
		if(!$this->session->userdata('is_restaurant')){
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('uid');
			$this->session->unset_userdata('is_restaurant');
			$this->session->unset_userdata('cart_items');
			$this->session->set_flashdata('login_status', array(
				'type'  => "primary",
				'message' => 'Please login to access this page.'
			));
			redirect('user/login');
		}
		$data['orders'] = $this->restaurant_model->get_orders();
		$this->load->view('templates/head');
		$this->load->view('restaurant/view_orders', $data);
		$this->load->view('templates/footer');
	}

	public function check_user_exists($email){
		$this->form_validation->set_message('check_user_exists', 'Email is already registered, please recheck.');
		if($this->user_model->check_user_exists($email)){
			return true;
		} else {
			return false;
		}
	}

}
