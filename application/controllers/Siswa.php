<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'SELAMAT DATANG';
		$this->load->view('Templates/siswa/header', $data);
		$this->load->view('siswa/index', $data);
		$this->load->view('Templates/siswa/footer');
	}

	public function profile()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'Profile Saya';
		$this->load->view('Templates/siswa/header', $data);
		$this->load->view('siswa/profile', $data);
		$this->load->view('Templates/siswa/footer');
	}

	public function data()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'DATA BARANG';
		$this->load->model('Siswa_model');
		$data['alat'] = $this->Siswa_model->dataalat();
		$this->load->view('Templates/siswa/header', $data);
		$this->load->view('siswa/Data', $data);
		$this->load->view('Templates/siswa/footer');
	}
	public function edit()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Nama Lengkap', 'required');

		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Ubah Profile';
			$this->load->view('Templates/siswa/header', $data);
			$this->load->view('siswa/edit', $data);
			$this->load->view('Templates/siswa/footer');
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			// Cek Jika Ada Gambar Yang Di Upload
			$upload_image = $_FILES['images']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('images')) {
					$old_image = $data['user']['images'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}


					$new_image = $this->upload->data('file_name');
					$this->db->set('images', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Profil Telah Diubah</div>');
			redirect('siswa/index');
		}
	}

	public function panggiluser()
	{
		$this->load->model('Siswa_model');
		$data['alat'] = $this->Siswa_model->panggiluser();
	}

	public function pinjam($id_alat)
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'PINJAM BARANG';
		$this->load->model('Siswa_model');
		$data['alat'] = $this->Siswa_model->detailalat($id_alat);

		$this->form_validation->set_rules('jumlah_pinjam', 'Jumlah Alat', 'numeric');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Templates/siswa/header', $data);
			$this->load->view('siswa/pinjam', $data);
			$this->load->view('Templates/siswa/footer');
		} else {
			$alat_id = $this->input->post('id_alat');
			$jumlah_pinjam = $this->input->post('jumlah_pinjam', true);
			$user_id = $this->session->userdata('id_user');
			$jumlat = $this->input->post('jumlat');
			$data = [
				'jumlah_pinjam' => htmlspecialchars($this->input->post('jumlah_pinjam', true)),
			];
			if ($jumlah_pinjam) {
				$keranjang = [
					'alat_id' => $alat_id,
					'user_id' => $user_id,
					'jumlah_pinjam' => $jumlah_pinjam,
					"status_keranjang" => 'Dipinjam'

				];
				$this->db->set('jumlat', $jumlat + $jumlah_pinjam);
				$this->db->update('alat');
				$this->db->insert('keranjang', $keranjang);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Barang Telah Di Tambah di Keranjang.</div>');
				redirect('Siswa/index');
			} else {
				$keranjang = [
					'alat_id' => $alat_id,
					'user_id' => $user_id,
					'jumlah_pinjam' => 0,
					"status_keranjang" => 'Dipinjam'

				];
				$this->db->set('status', 'Dipinjam');
				$this->db->where('id_alat', $this->input->post('id_alat'));
				$this->db->update('alat');
				$this->db->insert('keranjang', $keranjang);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Barang Telah Di Tambah di Keranjang.</div>');
				redirect('Siswa/index');
			}
		}
	}

	private function _sendemail()
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'bengkelonline0911@gmail.com',
			'smtp_pass' => 'runningman123',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];
		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('bengkelonline0911@gmail.com', 'Bengkel Online');
		$this->email->to('gurusmk09@gmail.com');
		$this->email->subject('Pinjam Barang');
		$this->email->message('ADA SISWA YANG MEMINJAM BARANG! Silakan Login <a href="' . base_url() . 'Auth/index' .  '">Login</a>');
		if ($this->email->send()) {

			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function keranjang()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'KERANJANG';
		$this->load->model('Siswa_model');
		$data['hasil'] = $this->Siswa_model->keranjang();
		$this->load->view('Templates/siswa/header', $data);
		$this->load->view('siswa/keranjang', $data);
		$this->load->view('Templates/siswa/footer');
	}
	public function kirim($id_alat)
	{
		$this->_sendemail();
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$id_siswa = $this->session->userdata('id_user');
		$data['judul'] = 'PERSETUJUAN';
		$this->load->model('Siswa_model');
		$data['alat'] = $this->Siswa_model->detailalat($id_alat);
		$peminjaman = [
			'id_guru' => 13,
			'id_siswa' => $id_siswa,
			'id_alat_peminjaman' => $id_alat,
			"status_peminjaman" => 'Menunggu Persetujuan Guru'
		];
		$this->db->where('alat_id', $id_alat);
		$this->db->delete('keranjang');
		$this->db->insert('peminjaman', $peminjaman);
		$this->db->set('id_peminjaman_alat');
		$this->db->where('id_alat', $id_alat);
		$this->db->update('alat');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Menunggu Persetujuan Guru.</div>');
		redirect('Siswa/index');
	}

	public function persetujuan()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'PERSETUJUAN';
		$this->load->model('Siswa_model');
		$data['hasil'] = $this->Siswa_model->persetujuan();
		$this->load->view('Templates/siswa/header', $data);
		$this->load->view('siswa/persetujuan', $data);
		$this->load->view('Templates/siswa/footer');
	}

	public function batal($alat_id)
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$id_alat = $this->input->post('id_alat');
		$this->load->model('Siswa_model');
		$this->Siswa_model->batalalat($alat_id);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Barang Telah Di Hapus Dari Keranjang.</div>');
		redirect('Siswa/index');
	}
}
