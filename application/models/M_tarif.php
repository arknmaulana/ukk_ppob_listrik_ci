<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tarif extends CI_Model {

	private $_table = 'tarif';
	private $_primaryKey = 'id_tarif';

	public function rules()
	{
		return [
			[
				'field'=>'daya',
				'label'=>'Daya',
				'rules'=>'required|callback_checkDaya'
			],
			[
				'field'=>'perkwh',
				'label'=>'Per/KWH',
				'rules'=>'required|greater_than[0]'
			],
		];
	}

	public function message()
	{
		return array(
			'daya' => form_error('daya'),
			'perkwh' => form_error('perkwh'),
		);
	}

	public function getSelect()
	{
		return $this->db->get($this->_table)->result();
	}

	public function getAll($limit,$start)
	{
		return $this->db->get($this->_table, $limit, $start)->result();
	}

	public function getCount()
	{
		return $this->db->from($this->_table)->count_all_results();
	}

	public function getById($id)
	{
		return $this->db->where($this->_primaryKey, $id)->get($this->_table)->row();
	}

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

/* End of file M_tarif.php */
/* Location: ./application/models/M_tarif.php */