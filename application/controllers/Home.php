<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	// ----------------------------------- Function Construct
	// 1. Logika jika belum login
	// 2. Load Model penggunaan dan pembayaran
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id')) redirect('auth','refresh');
		$this->load->model('m_penggunaan','penggunaan');
		$this->load->model('m_pembayaran','pembayaran');
	}

	// ----------------------------------- Function Construct
	// 1. Logika jika belum login
	// 2. Load Model penggunaan dan pembayaran
	public function index()
	{
		if ($this->session->userdata('user_level')==3) {
			$data['dataUnpaid'] = $this->penggunaan->getUnpaid($this->session->userdata('user_id'));
			$data['dataPending'] = $this->penggunaan->getPending($this->session->userdata('user_id'));
			$data['dataLunas'] = $this->penggunaan->getLunas($this->session->userdata('user_id'));
			$data['dataDitolak'] = $this->penggunaan->getDitolak($this->session->userdata('user_id'));
			$data['dataBulan'] = array(
				1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
			);
			$data['dataTahun'] = array(
				2017=>2017,2018=>2018,2019=>2019
			);
			$this->load->view('page/home/pelanggan',$data);
		}else{
			// $data['tittle'] = 'PPOB | Dashboard';
			// $data['header'] = 'Dashboard';
			// $data['header_small'] = 'Dashboard';
			// $this->load->view('page/home/admin',$data);
			if ($this->session->userdata('user_level')==1) {
				redirect('pelanggan','refresh');
			}
			redirect('laporan','refresh');
		}
	}

	public function validate()
	{
		$this->load->library('form_validation');
		$data['token'] = $this->security->get_csrf_hash();				
			$this->load->helper('file');
			$config['upload_path'] = './assets/upload/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']  = '100';
			$config['file_name'] = $this->input->post('id_penggunaan').'-'.time();
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('file')){
				$data['error_msg'] = array('file'=>$this->upload->display_errors());
			}
			else{
				$object = array(
					'id_penggunaan' => $this->input->post('id_penggunaan'),
					'tgl_bayar' =>$this->input->post('tgl_bayar'),
					'status_pembayaran'=>0,
					'bukti_pembayaran' => $this->upload->data('file_name')
				);				
				$object2 = array(
					'pg_status' => 1
				);
				$this->penggunaan->update($this->input->post('id_penggunaan'),$object2);
				$this->pembayaran->add($object);
				$data['modalSuccessMessage'] = 'Data Berhasil diubah';
				$data['success'] = true;
			}
		echo json_encode($data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */