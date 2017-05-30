<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		parent:: __construct();

		$this->load->model('user');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login() {
		$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
			);
		$username = $this->user->auth($data);
		$this->session->set_userdata('username', $username[0]->username);

		if(empty($this->session->userdata('username'))) {
			$this->session->set_userdata('error', '<p style="color:red;">Login error!</p>');
			redirect('/');
		} else {
			redirect('welcome/dashboard');
		}
	}

	public function dashboard() {
		if(empty($this->session->userdata('username'))) {
			$this->session->set_userdata('error', '<p style="color:red;">Login error!</p>');
			redirect('/');
		}

		$data['products'] = $this->user->select();
		//print_r($products);
		$this->load->view('dashboard', $data);
	}

	public function create() {
		if(empty($this->session->userdata('username'))) {
			$this->session->set_userdata('error', '<p style="color:red;">Login error!</p>');
			redirect('/');
		}

		$data = array(
				'name' => $this->input->post('name'),
				'price' => $this->input->post('price')
			);

		$this->user->insert($data);
		
		redirect('welcome/dashboard');

	}

	public function edit() {
		if(empty($this->session->userdata('username'))) {
			$this->session->set_userdata('error', '<p style="color:red;">Login error!</p>');
			redirect('/');
		}

		$id = $this->uri->segment(3);
		$data['products'] = $this->user->select();
		$data['product'] = $this->user->select_where($id);

		$this->load->view('dashboard', $data);
	}

	public function update() {
		if(empty($this->session->userdata('username'))) {
			$this->session->set_userdata('error', '<p style="color:red;">Login error!</p>');
			redirect('/');
		}

		$id = $this->input->post('hidden_id');
		$data = array(
				'name' => $this->input->post('name_update'),
				'price' => $this->input->post('price_update')
			);

		$this->user->update($data, $id);

		redirect('welcome/dashboard');
	}

	public function delete() {
		if(empty($this->session->userdata('username'))) {
			$this->session->set_userdata('error', '<p style="color:red;">Login error!</p>');
			redirect('/');
		}

		$id = $this->uri->segment(3);
		$this->user->delete($id);

		redirect('welcome/dashboard');
	}

	public function logout() {
		$this->session->unset_userdata();
		$this->session->sess_destroy();
		redirect('/');
	}
}
