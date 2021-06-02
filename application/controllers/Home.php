<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
		$data['judul'] = 'SELAMAT DATANG';
		$this->load->view('Templates/header', $data);
		$this->load->view('Home/index');
		$this->load->view('Templates/footer');
	}
}
