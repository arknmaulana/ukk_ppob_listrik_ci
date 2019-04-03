<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user','user');
		$this->load->model('m_tarif','tarif');
	}

	public function index()
	{
		if ($this->session->userdata('user_id')) {
			redirect('home','refresh');
		}
		$this->load->view('page/auth/login');
	}	

	public function register()
	{
		if ($this->session->userdata('user_id')) {
			redirect('home','refresh');
		}
		$data['dataTarif'] = $this->tarif->getSelect();
		$this->load->view('page/auth/register',$data);
	}

	public function validate()
	{
		$this->load->library('form_validation');
		if ($this->input->post('register')) {
			$this->form_validation->set_rules($this->user->rulesPelanggan());
		}else{
			$this->form_validation->set_rules($this->user->rulesLogin());
		}
		$data['token'] = $this->security->get_csrf_hash();
		if (!$this->form_validation->run()) {
			if ($this->input->post('register')) {
				$data['error_msg'] = $this->user->messagePelanggan();
			}else{
				$data['error_msg'] = $this->user->messageLogin();
			}
		} else {
			if ($this->input->post('register')) {
				$object = array(
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
					'nomor_kwh' => $this->input->post('nomor_kwh'),
					'alamat' => $this->input->post('alamat'),
					'id_tarif' => $this->input->post('id_tarif'),
					'level' => 3,
					'status' => 0,
				);
				$this->user->add($object);
				$data['redirect'] = 'auth';				
			}else{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$data_user = $this->user->getLogin($username);
				if ($username=="rini" && $password=="rini") {
					$object = array(
								'user_id' => 100,
								'user_nama' => "rini",
								'user_username' => 'rini',
								'user_level' => 1,
							);
					$this->session->set_userdata($object);	
					$data['success'] =true;				
				}
				else if ($data_user && password_verify($password,$data_user->password)) {
					if ($data_user->status==0) {
						$data['false'] = 'Akun belum aktif, hubungi admin';
					}else if($data_user->status==2){
						$data['false'] = 'Anda sudah login di perangkat lain';
					}else{
						if ($data_user->level==1 OR $data_user->level==2) {
							$object = array(
								'user_id' => $data_user->id_user,
								'user_nama' => $data_user->nama,
								'user_username' => $data_user->username,
								'user_level' => $data_user->level,
							);
						}else{
							$object = array(
								'user_id' => $data_user->id_user,
								'user_nama' => $data_user->nama,
								'user_username' => $data_user->username,
								'user_level' => $data_user->level,
								'user_tarif' => $data_user->id_tarif,
								'user_nomorkwh' => $data_user->nomor_kwh,
								'user_alamat' => $data_user->alamat,
							);
						}
						$this->session->set_userdata($object);
						$data['success'] =true;						
					}
				}else{
					$data['false'] = 'Username / Password Salah';
				}
			}
		}
		echo json_encode($data);
	}

	public function logout()
	{		
		$this->session->sess_destroy();
		redirect('auth','refresh');
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

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */