<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
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
		$this->load->view('Templates/guru/header', $data);
		$this->load->view('guru/index');
		$this->load->view('Templates/guru/footer');
	}

	public function data()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'DATA BARANG';
		$this->load->model('Guru_model');
		$data['alat'] = $this->Guru_model->dataalat();
		$this->load->view('Templates/guru/header', $data);
		$this->load->view('guru/Data', $data);
		$this->load->view('Templates/guru/footer');
	}
	public function hapus($id_alat)
	{
		$this->load->model('Guru_model');
		$this->Guru_model->hapusalat($id_alat);
		$this->session->set_flashdata('flash', 'dihapus');
		redirect('Guru/index');
	}
	public function persetujuan()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'PERSETUJUAN';
		$this->load->model('Guru_model');
		$data['hasil'] = $this->Guru_model->persetujuan();
		$this->load->view('Templates/guru/header', $data);
		$this->load->view('guru/persetujuan', $data);
		$this->load->view('Templates/guru/footer');
	}
	public function setuju($id_peminjaman)
	{
		$this->_sendemail();
		$this->_sendemaill();
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'PERSETUJUAN';
		$this->load->model('Guru_model');
		$data['hasil'] = $this->Guru_model->pinjamalat($id_peminjaman);
		$peminjaman = [
			'status_peminjaman' => "Menunggu Persetujuan Dari Aspiran/Kapbeng"
		];
		$this->db->where('id_peminjaman', $id_peminjaman);
		$this->db->update('peminjaman', $peminjaman);
		$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Sudah diSetujui.</div>');
		redirect('Guru/index');
		session_start();
	}
	public function laporan()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'Laporan';
		$this->load->model('Guru_model');
		$data['hasil'] = $this->Guru_model->laporan();
		$this->load->view('Templates/guru/header', $data);
		$this->load->view('guru/laporan', $data);
		$this->load->view('Templates/guru/footer');
	}

	public function tolak($id_peminjaman)
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$this->load->model('Guru_model');
		$this->Guru_model->tolakalat($id_peminjaman);
		$this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Sudah Ditolak.</div>');
		redirect('Guru/index');
	}
	public function laporanl()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['judul'] = 'PERSETUJUAN';
		$this->load->model('Guru_model');
		$data['hasil'] = $this->Guru_model->persetujuan();
		$this->load->view('Templates/guru/header', $data);
		$this->load->view('guru/laporanl', $data);
		$this->load->view('Templates/guru/footer');
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
		$this->email->to('aspiransmk09@gmail.com');
		$this->email->subject('Pinjam Barang');
		$this->email->message('ADA SISWA YANG MEMINJAM BARANG! Silakan Login <a href="' . base_url() . 'Auth/index' .  '">Login</a>');
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
		$this->email->to('kapbengsmk09@gmail.com');
		$this->email->subject('Pinjam Barang');
		$this->email->message('ADA SISWA YANG MEMINJAM BARANG! Silakan Login <a href="' . base_url() . 'Auth/index' .  '">Login</a>');
		if ($this->email->send()) {

			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}
}
