<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_model extends CI_Model{

	public function register_restaurant(){
		$restaurant_name = strip_tags(trim($this->input->post('full_name')));
		$email = strip_tags(trim($this->input->post('email')));
		$address = strip_tags(trim($this->input->post('address')));
		$password = strip_tags(trim($this->input->post('password')));
		$food_choice = strip_tags(trim($this->input->post('food_choice')));
		$data = array(
			'full_name' => $restaurant_name,
			'address' => $address,
			'email' => $email,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'is_restaurant' => 1
		);
		return $this->db->insert('users', $data);
	}

	public function add_menu_item(){
		$item_name = strip_tags(trim($this->input->post('item_name')));
		$type = strip_tags(trim($this->input->post('type')));
		$price = (float) strip_tags(trim($this->input->post('price')));
		$data = array(
			'item_name' => $item_name,
			'type' => $type,
			'price' => $price,
			'restaurant_id' => $this->session->userdata('uid')
		);
		return $this->db->insert('items', $data);
	}

	public function get_menu_items($name = false, $type = false){
		if($this->session->userdata('uid')){
			$get_user = $this->user_model->get_user_details($this->session->userdata('uid'));
			$user_food_choice = ($get_user['food_choice']=='veg'?'veg':null);
		}else{
			$user_food_choice = null;
		}
		$name = strip_tags(trim($name));
		$type = strip_tags(trim($type));
		if(!empty($name)&&!empty($type)){
			$this->db->select('price, restaurant_id');
			$query = $this->db->get_where('items', array('item_name' => $name, 'type' => $type));
			if($query){
				return $query->result_array();
			}else{
				return false;
			}
		}
		$this->db->distinct();
		$this->db->select('item_name, type');
		if($user_food_choice){
			$query = $this->db->get_where('items', array('type' => $user_food_choice));
		}else{
			$query = $this->db->get('items');
		}
		if($query){
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function get_orders(){
		$query = $this->db->get_where('orders', array('restaurant_id' => $this->session->userdata('uid')));
		if($query){
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function get_restaurant($rid){
		$rid = strip_tags(trim($rid));
		$this->db->select('full_name, address');
		$query = $this->db->get_where('users', array('is_restaurant' => 1, 'id' => $rid));
		if($query){
			return $query->row_array();
		}else{
			return false;
		}
	}
	
}