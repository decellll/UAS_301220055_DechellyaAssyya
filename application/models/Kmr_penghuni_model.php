<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kmr_penghuni_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Ambil semua data kamar penghuni
    public function get_all_kmr_penghuni() {
        $this->db->select('kp.*, k.nomor as nomor_kamar, k.harga as harga_kamar, p.nama as nama_penghuni, p.no_hp');
        $this->db->from('tb_kmr_penghuni kp');
        $this->db->join('tb_kamar k', 'kp.id_kamar = k.id');
        $this->db->join('tb_penghuni p', 'kp.id_penghuni = p.id');
        $this->db->order_by('kp.tgl_masuk', 'DESC');
        return $this->db->get()->result();
    }

    // Ambil data kamar penghuni yang aktif
    public function get_aktif_kmr_penghuni() {
        $this->db->select('kp.*, k.nomor as nomor_kamar, k.harga as harga_kamar, p.nama as nama_penghuni, p.no_hp');
        $this->db->from('tb_kmr_penghuni kp');
        $this->db->join('tb_kamar k', 'kp.id_kamar = k.id');
        $this->db->join('tb_penghuni p', 'kp.id_penghuni = p.id');
        $this->db->where('kp.tgl_keluar IS NULL');
        return $this->db->get()->result();
    }

    // Ambil data berdasarkan ID
    public function get_kmr_penghuni_by_id($id) {
        $this->db->select('kp.*, k.nomor as nomor_kamar, k.harga as harga_kamar, p.nama as nama_penghuni, p.no_hp');
        $this->db->from('tb_kmr_penghuni kp');
        $this->db->join('tb_kamar k', 'kp.id_kamar = k.id');
        $this->db->join('tb_penghuni p', 'kp.id_penghuni = p.id');
        $this->db->where('kp.id', $id);
        return $this->db->get()->row();
    }

    // Tambah data kamar penghuni
    public function tambah_kmr_penghuni($data) {
        return $this->db->insert('tb_kmr_penghuni', $data);
    }

    // Update data kamar penghuni
    public function update_kmr_penghuni($id, $data) {
        return $this->db->update('tb_kmr_penghuni', $data, ['id' => $id]);
    }

    // Hapus data kamar penghuni
    public function hapus_kmr_penghuni($id) {
        return $this->db->delete('tb_kmr_penghuni', ['id' => $id]);
    }

    // Cek apakah kamar sudah terisi
    public function cek_kamar_terisi($id_kamar) {
        $this->db->where('id_kamar', $id_kamar);
        $this->db->where('tgl_keluar IS NULL');
        return $this->db->get('tb_kmr_penghuni')->num_rows() > 0;
    }

    // Cek apakah penghuni sudah menempati kamar
    public function cek_penghuni_aktif($id_penghuni) {
        $this->db->where('id_penghuni', $id_penghuni);
        $this->db->where('tgl_keluar IS NULL');
        return $this->db->get('tb_kmr_penghuni')->num_rows() > 0;
    }

    // Keluar dari kamar (update tgl_keluar)
    public function keluar_kamar($id, $tgl_keluar) {
        return $this->db->update('tb_kmr_penghuni', ['tgl_keluar' => $tgl_keluar], ['id' => $id]);
    }

    // Pindah kamar
    public function pindah_kamar($id_penghuni, $id_kamar_baru, $tgl_masuk) {
        // Keluar dari kamar lama
        $this->db->where('id_penghuni', $id_penghuni);
        $this->db->where('tgl_keluar IS NULL');
        $this->db->update('tb_kmr_penghuni', ['tgl_keluar' => date('Y-m-d')]);

        // Masuk ke kamar baru
        $data = [
            'id_kamar' => $id_kamar_baru,
            'id_penghuni' => $id_penghuni,
            'tgl_masuk' => $tgl_masuk,
            'tgl_keluar' => NULL
        ];
        return $this->db->insert('tb_kmr_penghuni', $data);
    }
} 