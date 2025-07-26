<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Ambil semua data barang
    public function get_all_barang() {
        return $this->db->get('tb_barang')->result();
    }

    // Ambil data barang berdasarkan ID
    public function get_barang_by_id($id) {
        return $this->db->get_where('tb_barang', ['id' => $id])->row();
    }

    // Tambah barang baru
    public function tambah_barang($data) {
        return $this->db->insert('tb_barang', $data);
    }

    // Update data barang
    public function update_barang($id, $data) {
        return $this->db->update('tb_barang', $data, ['id' => $id]);
    }

    // Hapus barang
    public function hapus_barang($id) {
        return $this->db->delete('tb_barang', ['id' => $id]);
    }

    // Ambil barang bawaan penghuni
    public function get_barang_bawaan_penghuni($id_penghuni) {
        $this->db->select('b.*, bb.id as id_barang_bawaan');
        $this->db->from('tb_barang b');
        $this->db->join('tb_brng_bawaan bb', 'b.id = bb.id_barang');
        $this->db->where('bb.id_penghuni', $id_penghuni);
        return $this->db->get()->result();
    }

    // Tambah barang bawaan penghuni
    public function tambah_barang_bawaan($data) {
        return $this->db->insert('tb_brng_bawaan', $data);
    }

    // Hapus barang bawaan penghuni
    public function hapus_barang_bawaan($id) {
        return $this->db->delete('tb_brng_bawaan', ['id' => $id]);
    }

    // Hapus semua barang bawaan penghuni
    public function hapus_semua_barang_bawaan($id_penghuni) {
        return $this->db->delete('tb_brng_bawaan', ['id_penghuni' => $id_penghuni]);
    }
} 