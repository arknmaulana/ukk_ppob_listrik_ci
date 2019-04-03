<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarif extends CI_Controller {

	private $_url='tarif';

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id')) redirect('auth','refresh');
		if ($this->session->userdata('user_level')!= 1)redirect('home','refresh');
		$this->load->model('m_tarif','tarif');
	}

	public function index()
	{
		$data['tittle'] = 'PPOB | Tarif';
		$data['header'] = 'Crud Tarif';
		$data['header_small'] = 'Tarif';
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'pelanggan/index';
		$config['total_rows'] = $this->tarif->getCount();
		$config['per_page'] =4;
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
		$data['dataAll'] = $this->tarif->getAll($config['per_page'],$data['start']);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('page/tarif/index',$data);
	}

	public function validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->tarif->rules());
		$data['token'] = $this->security->get_csrf_hash();
		if (!$this->form_validation->run()) {
			$data['error_msg'] = $this->tarif->message();
		} else {			
			$object = array(
					'daya' => $this->input->post('daya'),
					'perkwh' => $this->input->post('perkwh') 
				);
			if ($this->input->post('id_tarif')) {
				$this->tarif->update($this->input->post('id_tarif'),$object);
				$data['modalSuccessMessage'] = 'Data Berhasil diubah';
			}else{
				$this->tarif->add($object);
				$data['modalSuccessMessage'] = 'Data Berhasil ditambahkan';
			}
			$data['success']=true;
		}
		echo json_encode($data);
	}

	public function delete()
	{
		$id = $this->input->post('id_tarif');
		if ($this->tarif->getById($id)) {
			if ($this->tarif->drop($id)) {
				$this->session->set_flashdata('success', 'Data Berhasil Dihapus');
			}else{
				$this->session->set_flashdata('error', 'Data Gagal Dihapus');
			}
		}
		redirect($this->_url,'refresh');
	}

	public function checkDaya($str)
	{
		$id = $this->input->post('id_tarif');
		$data = $this->db->where('daya', $str)->get('tarif')->num_rows();
		$data2= $this->db->where('id_tarif',$id)->get('tarif')->row();
		$this->form_validation->set_message('checkDaya','Daya sudah ada');
		if ($id) {
			if ($data) {
				if ($data2->daya==$str) {
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

/* End of file Tarif.php */
/* Location: ./application/controllers/Tarif.php */