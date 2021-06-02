<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aspiran extends CI_Controller
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
		$this->load->view('Templates/aspiran/header', $data);
		$this->load->view('aspiran/index');
		$this->load->view('Templates/aspiran/footer');
	}

	public function tambah()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'TAMBAH BARANG';
		$this->form_validation->set_rules('namlat', 'Nama Alat', 'required');
		$this->form_validation->set_rules('noser', 'Nomor Seri Alat', 'required');
		$this->form_validation->set_rules('jumlat', 'Jumlah Alat', 'numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Templates/aspiran/header', $data);
			$this->load->view('aspiran/Tambah');
			$this->load->view('Templates/aspiran/footer');
		} else {
			$this->load->model('Aspiran_model');
			$this->session->set_flashdata('flash', 'Ditambahkan!');
			$upload = $this->Aspiran_model->upload();
			if ($upload['result'] == "success") { // Jika proses upload sukses
				// Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
				$this->Aspiran_model->tambahalat($upload);
				redirect('Aspiran/index');
			}
		}
	}

	public function data()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'DATA BARANG';
		$this->load->model('Aspiran_model');
		$data['alat'] = $this->Aspiran_model->dataalat();
		$this->load->view('Templates/aspiran/header', $data);
		$this->load->view('aspiran/Data', $data);
		$this->load->view('Templates/aspiran/footer');
	}
	public function riwayat()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'RIWAYAT';
		$this->load->model('Aspiran_model');
		$data['hasil'] = $this->Aspiran_model->riwayatalat();
		$this->load->view('Templates/aspiran/header', $data);
		$this->load->view('aspiran/riwayat', $data);
		$this->load->view('Templates/aspiran/footer');
	}

	public function hapus($id_alat)
	{
		$this->load->model('Aspiran_model');
		$this->Aspiran_model->hapusalat($id_alat);
		$this->session->set_flashdata('flash', 'dihapus');
		redirect('Aspiran/index');
	}
	public function ubah($id_alat)
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'UBAH BARANG';
		$this->load->model('Aspiran_model');
		$data['alat'] = $this->Aspiran_model->detailalat($id_alat);
		$data['jenlat'] = ['Sekali Pakai', 'Tidak Sekali Pakai'];
		$data['konlat'] = ['Baik', 'Rusak'];
		$this->form_validation->set_rules('namlat', 'Nama Alat', 'required');
		$this->form_validation->set_rules('noser', 'Nomor Seri Alat', 'required');
		$this->form_validation->set_rules('jumlat', 'Jumlah Alat', 'numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Templates/aspiran/header', $data);
			$this->load->view('aspiran/ubah', $data);
			$this->load->view('Templates/aspiran/footer');
		} else {
			$this->load->model('Aspiran_model');
			$this->session->set_flashdata('flash', 'Diubah!');
			$upload = $this->Aspiran_model->upload();
			if ($upload['result'] == "success") { // Jika proses upload sukses
				// Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
				$this->Aspiran_model->ubahalat($upload);
				redirect('Aspiran/index');
			}
		}
	}
	public function laporan()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'Laporan';
		$this->load->model('Aspiran_model');
		$data['hasil'] = $this->Aspiran_model->laporan();
		$this->load->view('Templates/aspiran/header', $data);
		$this->load->view('aspiran/laporan', $data);
		$this->load->view('Templates/aspiran/footer');
	}
	public function setuju($id_peminjaman)
	{
		$this->_sendemail();
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'PERSETUJUAN';
		$this->load->model('Aspiran_model');
		$data['alat'] = $this->Aspiran_model->pinjamalat($id_peminjaman);
		$peminjaman = [
			'tanggal_peminjaman' => time(),
			"status_peminjaman" => 'Dipinjam'
		];
		$this->db->where('id_peminjaman', $id_peminjaman);
		$this->db->update('peminjaman', $peminjaman);
		$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Sudah diSetujui.</div>');
		redirect('Aspiran/index');
		session_start();
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
		$this->email->to('naufalsaidhus09@gmail.com');
		$this->email->subject('TERIMA KASIH');
		$this->email->message('Silakan Ambil Alat dan Kembalikan di  <a href="' . base_url() . 'Auth/index' .  '">SINI</a>');
		if ($this->email->send()) {

			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}
	private function _sendemaill()
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
		$this->email->to('naufalsaidhus09@gmail.com');
		$this->email->subject('Sudah Disetujui');
		$this->email->message('Terima Kasih Sudah Mengembalikan Alat');
		if ($this->email->send()) {

			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}
	public function kembali($id_peminjaman)
	{
		$this->_sendemaill();
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'PENGEMBALIAN';
		$this->load->model('Aspiran_model');
		$data['alat'] = $this->Aspiran_model->pinjamalat($id_peminjaman);
		$konlat = $this->input->post('konlat');
		$this->form_validation->set_rules('konlat', 'Kondisi Alat', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Templates/aspiran/header', $data);
			$this->load->view('Aspiran/kembali', $data);
			$this->load->view('Templates/aspiran/footer');
		} else {
			$peminjaman = [
				'tanggal_pengembalian' => time(),
				"status_peminjaman" => 'Dikembalikan',
			];
			$this->db->set('status', 'Tersedia');
			$this->db->set('konlat', $konlat);
			$this->db->update('alat');
			$this->db->where('id_peminjaman', $id_peminjaman);
			$this->db->update('peminjaman', $peminjaman);
			$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Sudah Dikembalikan.</div>');
			redirect('Aspiran/index');
			session_start();
		}
	}
}
