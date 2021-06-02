<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_model
{


    public function dataalat()
    {
        return $this->db->get('alat')->result_array();
    }

    public function detailalat($id_alat)
    {
        return $this->db->get_where('alat', ['id_alat' => $id_alat])->row_array();
        $this->db->select('*');
        $this->db->from('alat');
        $this->db->join('keranjang', 'keranjang.alat_id=alat.id_alat');
        $this->db->join('user', 'user.id_tabel=alat.id_alat');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function keranjang()
    {
        $this->db->select('*');
        $this->db->from('alat');
        $this->db->join('keranjang', 'keranjang.alat_id=alat.id_alat');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function persetujuan()
    {
        $this->db->select('*');
        $this->db->from('alat');
        $this->db->join('peminjaman', 'peminjaman.id_alat_peminjaman=alat.id_alat');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function batalalat($alat_id)
    {
        $this->db->set('status', 'Tersedia');
        $this->db->where('id_alat', $alat_id);
        $this->db->update('alat');
        $this->db->where('alat_id', $alat_id);
        $this->db->delete('keranjang');
    }
    public function md($id)
    {
        $this->db->select('*');
        $this->db->from('alat');
        $this->db->join('peminjaman', 'peminjaman.id_alat_peminjaman=alat.id_alat');
        $this->db->join('user', 'user.id_user=alat.id_alat');
        $this->db->where('.id_siswa');
        $query = $this->db->get();
        return $query->result_array();
    }
}
