<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
	
	public function login($email, $password){
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		$row = ($query)?$query->row_array():false;
		if(($query->num_rows() == 1) && password_verify($password, ($row['password']))){
			return $query->row();
		}else{
			return false;
		}
	}

	public function register_user(){
		$full_name = strip_tags(trim($this->input->post('full_name')));
		$email = strip_tags(trim($this->input->post('email')));
		$address = strip_tags(trim($this->input->post('address')));
		$password = strip_tags(trim($this->input->post('password')));
		$food_choice = strip_tags(trim($this->input->post('food_choice')));
		$data = array(
			'full_name' => $full_name,
			'email' => $email,
			'address' => $address,
			'food_choice' => $food_choice,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'is_restaurant' => 0
		);
		return $this->db->insert('users', $data);
	}

	public function check_user_exists($email){	
		$this->db->select('id');
		$query = $this->db->get_where('users', array('email' => $email));
		if(empty($query->row_array())){
			return true;
		}else{
			return false;
		}
	}

	public function get_user_details($id){	
		$this->db->select('address, full_name, food_choice');
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row_array();
	}

	public function place_order(){
		$user_id = strip_tags(trim($this->session->userdata('uid')));
		$items = strip_tags(trim($this->input->post('items')));
		$total = strip_tags(trim($this->input->post('total')));
		$full_name = strip_tags(trim($this->session->userdata('name')));
		$restaurant_id = strip_tags(trim($this->input->post('restaurant_id')));
		$get_user = $this->get_user_details($user_id);
		$data = array(
			'name' => $full_name,
			'address' => $get_user['address'],
			'items' => $items,
			'total' => $total,
			'restaurant_id' => $restaurant_id
		);
		return $this->db->insert('orders', $data);
	}
	
}