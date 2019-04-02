<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	private $_table = 'user';
	private $_primaryKey = 'id_user';

	public function rulesLogin()
	{
		return [
			[
				'field'=>'username',
				'label'=>'Username',
				'rules'=>'required'
			],
			[
				'field'=>'password',
				'label'=>'Password',
				'rules'=>'required'
			],
		];
	}

	public function messageLogin()
	{
		return array(
			'username' => form_error('username'),
			'password' => form_error('password'),
		);
	}

	public function getLogin($username)
	{
		return $this->db->where('username', $username)->get($this->_table)->row();
	}
	
	// Admin
	public function rulesAdmin()
	{
		return [
			[
				'field'=>'nama',
				'label'=>'Nama',
				'rules'=>'required'
			],
			[
				'field'=>'username',
				'label'=>'Username',
				'rules'=>'required|min_length[5]|callback_checkUsername'
			],
			[
				'field'=>'password',
				'label'=>'Password',
				'rules'=>'required|min_length[5]'
			],
			[
				'field'=>'level',
				'label'=>'Level',
				'rules'=>'required'
			],
		];
	}

	public function messageAdmin()
	{
		return array(
			'nama' => form_error('nama'),
			'username' => form_error('username'),
			'password' => form_error('password'),
			'level' => form_error('level'),
		);
	}

	public function getAllAdmin($limit,$start)
	{
		return $this->db->where('level !=',3)
						->get($this->_table, $limit, $start)->result();
	}

	public function getCountAdmin()
	{
		return $this->db->where('level !=',3)
						->from($this->_table)->count_all_results();
	}

	public function getAdminById($id)
	{
		return $this->db->where('level !=',3)
						->where($this->_primaryKey, $id)->get($this->_table)->row();
	}
	// End Admin

	// Pelanggan
	public function rulesPelanggan()
	{
		return [
			[
				'field'=>'nama',
				'label'=>'Nama',
				'rules'=>'required'
			],
			[
				'field'=>'username',
				'label'=>'Username',
				'rules'=>'required|min_length[5]|callback_checkUsername'
			],
			[
				'field'=>'password',
				'label'=>'Password',
				'rules'=>'required|min_length[5]'
			],
			[
				'field'=>'nomor_kwh',
				'label'=>'Nomor Meter',
				'rules'=>'required|greater_than[0]|min_length[5]|callback_checkNomorKWH'
			],
			[
				'field'=>'alamat',
				'label'=>'Alamat',
				'rules'=>'required|xss_clean'
			],
			[
				'field'=>'id_tarif',
				'label'=>'Daya',
				'rules'=>'required'
			],
		];
	}

	public function messagePelanggan()
	{
		return array(
			'nama' => form_error('nama'),
			'username' => form_error('username'),
			'password' => form_error('password'),
			'nomor_kwh' => form_error('nomor_kwh'),
			'alamat' => form_error('alamat'),
			'id_tarif' => form_error('id_tarif'),
		);
	}

	public function getAllPelanggan($limit,$start)
	{
		return $this->db->join('tarif','tarif.id_tarif=user.id_tarif')
						->where('level',3)
						->get($this->_table, $limit, $start)->result();
	}

	public function getAllPelangganValid($limit,$start)
	{
		return $this->db->join('tarif','tarif.id_tarif=user.id_tarif')
						->where('level',3)
						->where('status !=',0)
						->get($this->_table, $limit, $start)->result();
	}

	public function getCountPelanggan()
	{
		return $this->db->where('level',3)
						->from($this->_table)->count_all_results();
	}

	public function getPelangganById($id)
	{
		return $this->db->join('tarif','tarif.id_tarif=user.id_tarif')
						->where('level',3)
						->where($this->_primaryKey, $id)->get($this->_table)->row();
	}
	// End Pelanggan

	public function add($object)
	{
		return $this->db->insert($this->_table, $object);
	}

	public function update($id,$object)
	{
		return $this->db->where($this->_primaryKey, $id)->update($this->_table,$object);
	}

	public function drop($id)
	{
		return $this->db->where($this->_primaryKey,$id)
						->delete($this->_table);
	}
}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */