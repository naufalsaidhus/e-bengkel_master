<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_model
{


    public function dataalat()
    {
        return $this->db->get('alat')->result_array();
    }

    public function tambahalat()
    {
        $data = [
            "noser" => $this->input->post('noser', true),
            "loklat" => $this->input->post('loklat', true),
            "namlat" => $this->input->post('namlat', true),
            "konlat" => $this->input->post('konlat', true),
            "jenlat" => $this->input->post('jenlat'),
            "jumlat" => $this->input->post('jumlat', true),
            "ketlat" => $this->input->post('ketlat', true),
            "status" => $this->input->post('status')
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
    public function ubahalat()
    {
        $data = [
            "noser" => $this->input->post('noser', true),
            "loklat" => $this->input->post('loklat', true),
            "namlat" => $this->input->post('namlat', true),
            "konlat" => $this->input->post('konlat', true),
            "jenlat" => $this->input->post('jenlat'),
            "jumlat" => $this->input->post('jumlat', true),
            "ketlat" => $this->input->post('ketlat', true),
            "status" => $this->input->post('status')
        ];
        $this->db->where('id_alat', $this->input->post('id_alat'));
        $this->db->update('alat', $data);
    }
    public function persetujuan()
    {
        $this->db->select('*');
        $this->db->from('alat');
        $this->db->join('peminjaman', 'peminjaman.id_alat_peminjaman=alat.id_alat');
        $this->db->join('user', 'user.id_user=peminjaman.id_siswa');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function laporan()
    {
        $this->db->select('*');
        $this->db->from('alat');
        $this->db->join('laporan', 'laporan.id_alat_laporan=alat.id_alat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function tolakalat($id_peminjaman)
    {
        $this->db->set('status_peminjaman', 'Ditolak Guru');
        $this->db->where('id_peminjaman', $id_peminjaman);
        $this->db->update('peminjaman');
        $this->db->set('status', 'Tersedia');
        $this->db->update('alat');
    }
    public function pinjamalat($id_peminjaman)
    {
        return $this->db->get_where('peminjaman', ['id_peminjaman' => $id_peminjaman])->row_array();
    }
}
