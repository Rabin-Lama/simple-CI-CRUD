<?php
	defined('BASEPATH') OR exit("Error");

	class User extends CI_Model {
		
		public function auth($data) {
			$query = $this->db
						  ->select('username')
						  ->where($data)
						  ->get('login');

			return $query->result();
		}

		public function select() {
			$query = $this->db->get('product');
			
			return $query->result();
		}

		public function select_where($id) {
			$query = $this->db
						  ->select('*')
						  ->where('id', $id)
						  ->get('product');

			return $query->result();
		}

		public function insert($data) {
			$this->db->insert('product', $data);
		}

		public function delete($id) {
			$this->db->where('id', $id);
			$this->db->delete('product');
		}

		public function update($data, $id) {
			$this->db->where('id', $id);
			$this->db->update('product', $data);
		}
	}