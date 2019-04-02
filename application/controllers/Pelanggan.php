<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	// -----------------------------------
	private $_url='pelanggan';

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id')) redirect('auth','refresh');
		if ($this->session->userdata('user_level')!= 1)redirect('home','refresh');
		$this->load->model('m_user','user');
		$this->load->model('m_tarif','tarif');
	}

	public function index()
	{
		$data['tittle'] = 'PPOB | Pelanggan';
		$data['header'] = 'Crud Pelanggan';
		$data['header_small'] = 'Pelanggan';
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/pelanggan/index';
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
		$data['dataAll'] = $this->user->getAllPelanggan($config['per_page'],$data['start']);
		$data['pagination'] = $this->pagination->create_links();		
		$data['dataTarif'] = $this->tarif->getSelect();
		$data['status'] = array(
			0 => 'Tidak Aktif', 
			1 => 'Aktif', 		
		);
		$this->load->view('page/pelanggan/index',$data);
	}

	public function validate()
	{
		if ($this->input->post('ganti_status_submit')) {
			if ($this->input->post('id_user')!==$this->session->userdata('user_id')) {
				if ($this->input->post('ganti_status')==0 OR $this->input->post('ganti_status')==1) {
					$object = array('status' => $this->input->post('ganti_status'));
					$this->user->update($this->input->post('id_user'),$object);
				}
			}
			redirect($this->_url,'refresh');
		}else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules($this->user->rulesPelanggan());
			$data['token'] = $this->security->get_csrf_hash();
			if (!$this->form_validation->run()) {
				$data['error_msg'] = $this->user->messagePelanggan();
			} else {			
				$password=null;
				if ($this->user->getPelangganById($this->input->post('id_user'))) {
					$password = $this->user->getPelangganById($this->input->post('id_user'))->password;
				}
				$object = array(
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'password' => $password ?: password_hash($this->input->post('password'),PASSWORD_DEFAULT),
					'nomor_kwh' => $this->input->post('nomor_kwh'),
					'alamat' => $this->input->post('alamat'),
					'id_tarif' => $this->input->post('id_tarif'),
					'level' => 3,
					'status' => 1,
				);
				if ($this->input->post('id_user')) {
					$this->user->update($this->input->post('id_user'),$object);
					$data['modalSuccessMessage'] = 'Data Berhasil diubah';
				}else{
					$this->user->add($object);
					$data['modalSuccessMessage'] = 'Data Berhasil ditambahkan';
				}
				$data['success']=true;
			}
			echo json_encode($data);
		}
	}

	public function delete()
	{
		$id = $this->input->post('id_user');
		if ($this->user->getPelangganById($id)->status!=="2") {
			if ($this->user->drop($id)) {
				$this->session->set_flashdata('success', 'Data Berhasil Dihapus');
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Dihapus');
			}
		}else{
			$this->session->set_flashdata('error', 'Akun Masih Login');
		}				
		redirect($this->_url,'refresh');
	}

	public function checkUsername($str)
	{
		$id = $this->input->post('id_user');
		$data = $this->db->where('username', $str)->get('user')->num_rows();
		$data2= $this->db->where('id_user',$id)->get('user')->row();
		$this->form_validation->set_message('checkUsername','Username sudah dipakai');
		if ($id) {
			if ($data) {
				if ($data2->username==$str) {
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
		}else{
			if ($data) {
				return false;
			}else{
				return true;
			}
		}
	}

	public function checkNomorKWH($str)
	{
		$id = $this->input->post('id_user');
		$data = $this->db->where('nomor_kwh', $str)->get('user')->num_rows();
		$data2= $this->db->where('id_user',$id)->get('user')->row();
		$this->form_validation->set_message('checkNomorKWH','Nomor KWH sudah dipakai');
		if ($id) {
			if ($data) {
				if ($data2->nomor_kwh==$str) {
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
		}else{
			if ($data) {
				return false;
			}else{
				return true;
			}
		}
	}

}

/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */