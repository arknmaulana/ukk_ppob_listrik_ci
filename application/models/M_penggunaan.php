<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penggunaan extends CI_Model {

	// ----------------------------------- Nama Table dan Primary Key
	private $_table = 'penggunaan';
	private $_primaryKey = 'id_penggunaan';

	// ----------------------------------- Rules Penggunaan
	public function rules()
	{
		return [
			[
				'field'=>'meteran_awal',
				'label'=>'Meteran Awal',
				'rules'=>'required|greater_than[0]|callback_checkMeteran'
			],
			[
				'field'=>'meteran_akhir',
				'label'=>'Meteran Akhir',
				'rules'=>'required|greater_than[0]|callback_checkMeteran'
			],
			[
				'field'=>'bulan',
				'label'=>'Bulan',
				'rules'=>'required|greater_than[0]|callback_checkPenggunaan'
			],
			[
				'field'=>'tahun',
				'label'=>'Tahun',
				'rules'=>'required|greater_than[0]|callback_checkPenggunaan'
			],
		];
	}

	// ----------------------------------- Message Error Penggunaan
	public function message()
	{
		return array(
			'meteran_awal' => form_error('meteran_awal'),
			'meteran_akhir' => form_error('meteran_akhir'),
			'bulan' => form_error('bulan'),
			'tahun' => form_error('tahun'),
		);
	}

	// ----------------------------------- Get Data By id_user
	public function getByIdUser($id)
	{
		return $this->db->join('user','user.id_user=penggunaan.id_pelanggan')
						->join('tarif','tarif.id_tarif=user.id_tarif')
						->where('id_pelanggan', $id)->get($this->_table)->result();
	}

	// ----------------------------------- Insert Data
	public function add($object)
	{
		return $this->db->insert($this->_table, $object);
	}

	// ----------------------------------- Update Data By Primary Key
	public function update($id,$object)
	{
		return $this->db->where($this->_primaryKey, $id)->update($this->_table,$object);
	}

	
	// ----------------------------------- Get Data untuk home pelanggan
	// ----------------------------------- Get Data Unpaid
	public function getUnpaid($id)
	{
		return $this->db->where('pg_status',0)
						->where('id_pelanggan',$id)->get($this->_table)->result();
	}
	// ----------------------------------- Get Data Pending
	public function getPending($id)
	{
		return $this->db->where('pg_status',1)
						->where('id_pelanggan',$id)->get($this->_table)->result();
	}
	// ----------------------------------- Get Data Lunas
	public function getLunas($id)
	{
		return $this->db->where('pg_status',2)
						->where('id_pelanggan',$id)->get($this->_table)->result();
	}
	// ----------------------------------- Get Data Ditolak
	public function getDitolak($id)
	{
		return $this->db->where('pg_status',3)
						->where('id_pelanggan',$id)->get($this->_table)->result();
	}
	// ----------------------------------- End

	// ----------------------------------- Get count data untuk tabel verifikasi
	public function getCountVerifikasi()
	{
		return $this->db->where('pg_status',1)->from($this->_table)->count_all_results();
	}

	// ----------------------------------- Get count data by Id
	public function getCountById($id)
	{
		return $this->db->where('id_pelanggan',$id)->from($this->_table)->count_all_results();
	}

	// ----------------------------------- Get all data untuk tabel verifikasi
	public function getPenggunaanVerifikasi($limit,$start)
	{
		return $this->db->join('user','user.id_user=penggunaan.id_pelanggan')
						->join('tarif','tarif.id_tarif=user.id_tarif')
						->where('pg_status',1)->get($this->_table,$limit,$start)->result();
	}

	public function getLaporanSuccess()
	{
		return $this->db->join('penggunaan','penggunaan.id_penggunaan=pembayaran.id_penggunaan')
						->join('user','user.id_user=pembayaran.id_admin')
						->where('status_pembayaran',1)
						->get('pembayaran')->result();
	}

}

/* End of file M_penggunaan.php */
/* Location: ./application/models/M_penggunaan.php */