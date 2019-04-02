<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembayaran extends CI_Model {

	// ----------------------------------- Nama Table dan Primary Key
	private $_table = 'pembayaran';
	private $_primaryKey = 'id_pembayaran';	

	// ----------------------------------- Update
	public function update($id,$object)
	{
		return $this->db->where($this->_primaryKey, $id)->update($this->_table,$object);
	}

	// ----------------------------------- Add ke pembayaran
	public function add($object)
	{
		return $this->db->insert('pembayaran', $object);
	}

	// ----------------------------------- Get Pembayaran By Id_penggunaan ordered yang terbaru

	public function getByIdPenggunaan($id)
	{
		return $this->db->where('id_penggunaan', $id)->order_by($this->_primaryKey,'desc')->get($this->_table)->row();
	}
}

/* End of file M_pembayaran.php */
/* Location: ./application/models/M_pembayaran.php */