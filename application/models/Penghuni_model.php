<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghuni_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Ambil semua data penghuni
    public function get_all_penghuni() {
        return $this->db->get('tb_penghuni')->result();
    }

    // Ambil penghuni yang masih aktif (belum keluar)
    public function get_aktif_penghuni() {
        $this->db->where('tgl_keluar IS NULL');
        return $this->db->get('tb_penghuni')->result();
    }

    // Ambil data penghuni berdasarkan ID
    public function get_penghuni_by_id($id) {
        return $this->db->get_where('tb_penghuni', ['id' => $id])->row();
    }

    // Tambah penghuni baru
    public function tambah_penghuni($data) {
        return $this->db->insert('tb_penghuni', $data);
    }

    // Update data penghuni
    public function update_penghuni($id, $data) {
        return $this->db->update('tb_penghuni', $data, ['id' => $id]);
    }

    // Hapus penghuni
    public function hapus_penghuni($id) {
        return $this->db->delete('tb_penghuni', ['id' => $id]);
    }

    // Cek apakah no KTP sudah ada
    public function cek_no_ktp($no_ktp, $id = null) {
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('no_ktp', $no_ktp);
        return $this->db->get('tb_penghuni')->num_rows() > 0;
    }

    // Update tanggal keluar penghuni
    public function keluar_penghuni($id, $tgl_keluar) {
        return $this->db->update('tb_penghuni', ['tgl_keluar' => $tgl_keluar], ['id' => $id]);
    }
} 