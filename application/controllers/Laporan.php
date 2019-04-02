<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	private $_url='laporan';

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id')) redirect('auth','refresh');
		if ($this->session->userdata('user_level')==3)redirect('home','refresh');
		$this->load->model('m_penggunaan','guna');
	}

	public function index()
	{
		$data['tittle'] = 'PPOB | Laporan';
		$data['header'] = 'Generate Laporan';
		$data['header_small'] = 'Laporan';
		$this->load->view('page/laporan/index', $data);
	}

	public function detail()
	{
		$data['tittle'] = 'Laporan Lunas PPOB Listrik '.date('d-m-y-h:i:s');
		$data['header'] = 'Generate Laporan';
		$data['header_small'] = 'Laporan';
		$data['dataLaporan'] = $this->guna->getLaporanSuccess();
		$this->load->view('page/laporan/detail', $data);
	}
}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */