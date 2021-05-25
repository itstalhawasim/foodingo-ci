<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	public function login(){
		if($this->session->userdata('uid')){
			redirect('page/index');
		}
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/head');
			$this->load->view('users/login');
			$this->load->view('templates/footer');
		}else{
			$email = strip_tags(trim($this->input->post('email')));
			$password = strip_tags(trim($this->input->post('password')));
			$user_id = $this->user_model->login($email, $password);
			if($user_id->id){
				$user_data = array(
					'uid' => $user_id->id,
					'name' => $user_id->full_name,
					'cart_items' => array(),
					'is_restaurant' => $user_id->is_restaurant,
				);
				$this->session->set_userdata($user_data);
				redirect('page/index');
			}else{
				$this->session->set_flashdata('login_status', array(
					'type'  => "danger",
					'message' => 'Email or password is invalid.'
				));
				redirect('user/login');
			}		
		}
	}

	public function logout(){
		if(!$this->session->userdata('uid')){
			redirect('user/login');
		}
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('uid');
		$this->session->unset_userdata('is_restaurant');
		$this->session->unset_userdata('cart_items');
		$this->session->unset_userdata('cart_restaurant');
		$this->session->set_flashdata('login_status', array(
			'type'  => "primary",
			'message' => 'You have successfully logged out.'
		));
		redirect('user/login');
	}

	public function register(){
		if($this->session->userdata('uid')){
			redirect('page/index');
		}
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_user_exists');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('food_choice', 'Food Choice', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/head');
			$this->load->view('users/register');
			$this->load->view('templates/footer');
		}else{
			if($this->user_model->register_user()){
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

	public function check_user_exists($email){
		$this->form_validation->set_message('check_user_exists', 'Email is already registered, please recheck.');
		if($this->user_model->check_user_exists($email)){
			return true;
		} else {
			return false;
		}
	}

	public function add_cart(){
		if(!$this->session->userdata('uid')){
			redirect('user/login');
		}
		if($this->session->userdata('is_restaurant')){
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('uid');
			$this->session->unset_userdata('is_restaurant');
			$this->session->set_flashdata('login_status', array(
				'type'  => "primary",
				'message' => 'Please login to access this page.'
			));
			redirect('user/login');
		}
		$item_name = strip_tags(trim($this->input->post('item_name')));
		$price = strip_tags(trim($this->input->post('price')));
		$restaurant = strip_tags(trim($this->input->post('restaurant')));
		if($this->session->userdata('cart_restaurant') && $restaurant != $this->session->userdata('cart_restaurant')){
			$this->session->unset_userdata('cart_items');
			$this->session->unset_userdata('cart_restaurant');
			$this->session->set_flashdata('order_status', array(
				'type'  => "success",
				'message' => "Please order items from the same restaurant only."
			));
			redirect('food_menu');
		}
		$this->session->set_userdata('cart_restaurant', $restaurant);
		$new_cart_item = array($item_name => $price);
		$old_cart_items =  $this->session->userdata('cart_items');
		$old_cart_items[] = $new_cart_item;
		$this->session->set_userdata('cart_items', $old_cart_items);
		redirect('food_menu');
	}

	public function place_order(){
		if(!$this->session->userdata('uid')){
			redirect('user/login');
		}
		if($this->session->userdata('is_restaurant')){
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('uid');
			$this->session->unset_userdata('is_restaurant');
			$this->session->set_flashdata('login_status', array(
				'type'  => "primary",
				'message' => 'Please login to access this page.'
			));
			redirect('user/login');
		}
		if($this->user_model->place_order()){
			$this->session->unset_userdata('cart_items');
			$this->session->set_flashdata('order_status', array(
				'type'  => "success",
				'message' => "Order successfully placed, bon appétit!"
			));
			redirect('food_menu');
		}else{
			$this->session->set_flashdata('order_status', array(
				'type'  => "danger",
				'message' => "An error occured, Order was not placed."
			));
			redirect('food_menu');
		}	
	}
}
