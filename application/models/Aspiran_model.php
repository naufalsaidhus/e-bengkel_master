<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aspiran_model extends CI_model
{


    public function dataalat()
    {
        return $this->db->get('alat')->result_array();
    }
    public function upload()
    {
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']  = '2048';
        $config['remove_space'] = TRUE;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('input_gambar')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
    public function tambahalat($upload)
    {
        $data = [
            "noser" => $this->input->post('noser', true),
            'image' => $upload['file']['file_name'],
            "loklat" => $this->input->post('loklat', true),
            "namlat" => $this->input->post('namlat', true),
            "konlat" => $this->input->post('konlat', true),
            "jenlat" => $this->input->post('jenlat'),
            "jumlat" => $this->input->post('jumlat', true),
            "ketlat" => $this->input->post('ketlat', true),
            "status" => 'Tersedia'
        ];
        $this->db->insert('alat', $data);
    }
    public function hapusalat($id_alat)
    {
        $this->db->where('id_alat', $id_alat);
        $this->db->delete('alat');
    }
    public function detailalat($id_alat)
    {
        return $this->db->get_where('alat', ['id_alat' => $id_alat])->row_array();
    }
    public function pinjamalat($id_peminjaman)
    {
        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('alat', 'alat.id_alat=peminjaman.id_alat_peminjaman');
        $this->db->where('id_peminjaman', $id_peminjaman);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function ubahalat($upload)
    {
        $data = [
            "noser" => $this->input->post('noser', true),
            'image' => $upload['file']['file_name'],
            "loklat" => $this->input->post('loklat', true),
            "namlat" => $this->input->post('namlat', true),
            "konlat" => $this->input->post('konlat', true),
            "jenlat" => $this->input->post('jenlat'),
            "jumlat" => $this->input->post('jumlat', true),
            "ketlat" => $this->input->post('ketlat', true),
            "status" => 'Tersedia'
        ];
        if ($upload) {
            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }
        $this->db->where('id_alat', $this->input->post('id_alat'));
        $this->db->update('alat', $data);
    }
    public function laporan()
    {
        $this->db->select('*');
        $this->db->from('alat');
        $this->db->join('peminjaman', 'peminjaman.id_alat_peminjaman=alat.id_alat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function riwayatalat()
    {
        $this->db->select('*');
        $this->db->from('alat');
        $this->db->join('peminjaman', 'peminjaman.id_alat_peminjaman=alat.id_alat');
        $this->db->join('user', 'user.id_user=peminjaman.id_siswa');
        $query = $this->db->get();
        return $query->result_array();
    }
}
