<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Ambil semua data kamar
    public function get_all_kamar() {
        return $this->db->get('tb_kamar')->result();
    }

    // Ambil kamar yang kosong
    public function get_kamar_kosong() {
        $this->db->select('k.*');
        $this->db->from('tb_kamar k');
        $this->db->where('k.id NOT IN (SELECT DISTINCT kp.id_kamar FROM tb_kmr_penghuni kp WHERE kp.tgl_keluar IS NULL)', NULL, FALSE);
        return $this->db->get()->result();
    }

    // Ambil kamar yang terisi
    public function get_kamar_terisi() {
        $this->db->select('k.*, p.nama as nama_penghuni, p.no_hp');
        $this->db->from('tb_kamar k');
        $this->db->join('tb_kmr_penghuni kp', 'k.id = kp.id_kamar');
        $this->db->join('tb_penghuni p', 'kp.id_penghuni = p.id');
        $this->db->where('kp.tgl_keluar IS NULL');
        return $this->db->get()->result();
    }

    // Ambil data kamar berdasarkan ID
    public function get_kamar_by_id($id) {
        return $this->db->get_where('tb_kamar', ['id' => $id])->row();
    }

    // Tambah kamar baru
    public function tambah_kamar($data) {
        return $this->db->insert('tb_kamar', $data);
    }

    // Update data kamar
    public function update_kamar($id, $data) {
        return $this->db->update('tb_kamar', $data, ['id' => $id]);
    }

    // Hapus kamar
    public function hapus_kamar($id) {
        return $this->db->delete('tb_kamar', ['id' => $id]);
    }

    // Cek apakah nomor kamar sudah ada
    public function cek_nomor_kamar($nomor, $id = null) {
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('nomor', $nomor);
        return $this->db->get('tb_kamar')->num_rows() > 0;
    }

    // Ambil status kamar (kosong/terisi)
    public function get_status_kamar($id_kamar) {
        $this->db->where('id_kamar', $id_kamar);
        $this->db->where('tgl_keluar IS NULL');
        return $this->db->get('tb_kmr_penghuni')->num_rows() > 0;
    }
} 