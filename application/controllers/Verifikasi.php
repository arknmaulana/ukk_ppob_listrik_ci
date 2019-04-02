<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id')) redirect('auth','refresh');
		if ($this->session->userdata('user_level')!= 1)redirect('home','refresh');
		$this->load->model('m_penggunaan','guna');
		$this->load->model('m_pembayaran','bayar');
	}

	public function index()
	{
		$data['tittle'] = 'PPOB | Verifikasi';
		$data['header'] = 'Verifikasi';
		$data['header_small'] = 'Verifikasi';
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/verifikasi/index';
		$config['total_rows'] = $this->guna->getCountVerifikasi();
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
		$data['dataAll'] = $this->guna->getPenggunaanVerifikasi($config['per_page'],$data['start']);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('page/verifikasi/index',$data);
	}

	public function validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$data['token'] = $this->security->get_csrf_hash();
		if (!$this->form_validation->run()) {
			$data['error_msg'] = array('status'=>form_error('status'));
		} else {
			if ($this->input->post('status')== 2 OR $this->input->post('status') == 3) {
				if ($this->input->post('status')==2) {
					$object_pembayaran = array(
						'status_pembayaran' => 1,
						'id_admin' => $this->session->userdata('user_id')
					);
					$aa = $this->bayar->getByIdPenggunaan($this->input->post('id_penggunaan'));
					$this->bayar->update($aa->id_pembayaran,$object_pembayaran);
				}
				$object_penggunaan = array(
					'pg_status' => $this->input->post('status'), 
				);
				$this->guna->update($this->input->post('id_penggunaan'),$object_penggunaan);
			}
			$data['modalSuccessMessage'] = 'Data Berhasil diubah';
			$data['success']=true;
		}
		echo json_encode($data);
	}

}

/* End of file Verifikasi.php */
/* Location: ./application/controllers/Verifikasi.php */