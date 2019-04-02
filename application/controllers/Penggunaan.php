<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penggunaan extends CI_Controller {

	private $_url='penggunaan';

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id')) redirect('auth','refresh');
		if ($this->session->userdata('user_level')!= 1)redirect('home','refresh');
		$this->load->model('m_user','user');
		$this->load->model('m_penggunaan','penggunaan');
	}

	public function index()
	{
		$data['tittle'] = 'PPOB | Penggunaan';
		$data['header'] = 'Penggunaan';
		$data['header_small'] = 'Penggunaan';
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/penggunaan/index';
		$config['total_rows'] = $this->user->getCountPelanggan();
		$config['per_page'] =3;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';		
		
		$this->pagination->initialize($config);		
		$data['start'] = $this->uri->segment(3,0);
		$data['dataAll'] = $this->user->getAllPelangganValid($config['per_page'],$data['start']);
		$data['pagination'] = $this->pagination->create_links();			
		$data['dataBulan'] = [
			['id' =>1,'bulan' =>'Januari'],
			['id' =>2,'bulan' =>'Februari'],
			['id' =>3,'bulan' =>'Maret'],
			['id' =>4,'bulan' =>'April'],
			['id' =>5,'bulan' =>'Mei'],
			['id' =>6,'bulan' =>'Juni'],
			['id' =>7,'bulan' =>'Juli'],
			['id' =>8,'bulan' =>'Agustus'],
			['id' =>9,'bulan' =>'September'],
			['id' =>10,'bulan' =>'Oktober'],
			['id' =>11,'bulan' =>'November'],
			['id' =>12,'bulan' =>'Desember'],
		];
		$data['dataTahun'] = array(
			2017,2018,2019
		);
		$this->load->view('page/penggunaan/index',$data);
	}

	public function detail()
	{
		$id = $this->input->get('id_user');
		if ($id&&$this->penggunaan->getByIdUser($id)) {
			$data['tittle'] = 'PPOB | Detail Penggunaan';
			$data['header'] = 'Detail Penggunaan';
			$data['header_small'] = 'Penggunaan';	
			$data['dataAll'] = $this->penggunaan->getByIdUser($id);			
			$data['dataBulan'] = array(
				1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
			);
			$data['dataTahun'] = array(
				2017=>2017,2018=>2018,2019=>2019
			);
			$this->load->view('page/penggunaan/detail',$data);	
		}
		else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect($this->_url,'refresh');
		}
	}

	public function validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->penggunaan->rules());
		$data['token'] = $this->security->get_csrf_hash();
		if (!$this->form_validation->run()) {
			$data['error_msg'] = $this->penggunaan->message();
		} else {			
			$data_pelanggan = $this->user->getPelangganById($this->input->post('id_user'));			
			$biaya = ($this->input->post('meteran_akhir')-$this->input->post('meteran_awal'))*$data_pelanggan->perkwh;
	        $biaya_admin = (5/100)*$biaya;
	        $total_bayar = $biaya + $biaya_admin;

			$object = array(
				'id_pelanggan' => $this->input->post('id_user'),
				'meteran_awal' => $this->input->post('meteran_awal'),	
				'meteran_akhir' => $this->input->post('meteran_akhir'),		
				'bulan' => $this->input->post('bulan'),		
				'tahun' => $this->input->post('tahun'),	
				'biaya_admin' => $biaya_admin,
				'total_bayar' => $total_bayar,
				'pg_status' => 0,	
			);
			$this->penggunaan->add($object);
			$data['modalSuccessMessage'] = 'Data Berhasil ditambahkan';
			$data['success']=true;
		}
		echo json_encode($data);
	}

	public function checkMeteran()
	{
		if ($this->input->post('meteran_awal') && $this->input->post('meteran_akhir')) {
			if ($this->input->post('meteran_awal')>$this->input->post('meteran_akhir')) {
				$this->form_validation->set_message('checkMeteran','Input Meteran Salah');
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
	}

	public function checkPenggunaan()
	{
		if ($this->input->post('bulan') && $this->input->post('tahun')) {
			$data = $this->db->where('id_pelanggan',$this->input->post('id_user'))->where('bulan',$this->input->post('bulan'))->where('tahun',$this->input->post('tahun'))->get('penggunaan');			
			if ($data->num_rows()>0) {
				$this->form_validation->set_message('checkPenggunaan','Penggunaan Sudah Ada');
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
	}
}

/* End of file Penggunaan.php */
/* Location: ./application/controllers/Penggunaan.php */