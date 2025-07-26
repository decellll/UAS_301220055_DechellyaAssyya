<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Ambil semua tagihan
    public function get_all_tagihan() {
        $this->db->select('t.*, kp.id_kamar, kp.id_penghuni, k.nomor as nomor_kamar, p.nama as nama_penghuni');
        $this->db->from('tb_tagihan t');
        $this->db->join('tb_kmr_penghuni kp', 't.id_kmr_penghuni = kp.id');
        $this->db->join('tb_kamar k', 'kp.id_kamar = k.id');
        $this->db->join('tb_penghuni p', 'kp.id_penghuni = p.id');
        $this->db->order_by('t.bulan', 'DESC');
        return $this->db->get()->result();
    }

    // Ambil tagihan berdasarkan bulan
    public function get_tagihan_by_bulan($bulan) {
        $this->db->select('t.*, kp.id_kamar, kp.id_penghuni, k.nomor as nomor_kamar, p.nama as nama_penghuni');
        $this->db->from('tb_tagihan t');
        $this->db->join('tb_kmr_penghuni kp', 't.id_kmr_penghuni = kp.id');
        $this->db->join('tb_kamar k', 'kp.id_kamar = k.id');
        $this->db->join('tb_penghuni p', 'kp.id_penghuni = p.id');
        $this->db->where('t.bulan', $bulan);
        return $this->db->get()->result();
    }

    // Ambil tagihan berdasarkan ID
    public function get_tagihan_by_id($id) {
        $this->db->select('t.*, kp.id_kamar, kp.id_penghuni, k.nomor as nomor_kamar, p.nama as nama_penghuni');
        $this->db->from('tb_tagihan t');
        $this->db->join('tb_kmr_penghuni kp', 't.id_kmr_penghuni = kp.id');
        $this->db->join('tb_kamar k', 'kp.id_kamar = k.id');
        $this->db->join('tb_penghuni p', 'kp.id_penghuni = p.id');
        $this->db->where('t.id', $id);
        return $this->db->get()->row();
    }

    // Tambah tagihan
    public function tambah_tagihan($data) {
        return $this->db->insert('tb_tagihan', $data);
    }

    // Update tagihan
    public function update_tagihan($id, $data) {
        return $this->db->update('tb_tagihan', $data, ['id' => $id]);
    }

    // Hapus tagihan
    public function hapus_tagihan($id) {
        return $this->db->delete('tb_tagihan', ['id' => $id]);
    }

    // Generate tagihan untuk bulan tertentu
    public function generate_tagihan($bulan) {
        // Ambil semua penghuni aktif
        $this->db->select('kp.*, k.harga as harga_kamar');
        $this->db->from('tb_kmr_penghuni kp');
        $this->db->join('tb_kamar k', 'kp.id_kamar = k.id');
        $this->db->where('kp.tgl_keluar IS NULL');
        $penghuni_aktif = $this->db->get()->result();

        $tagihan_dibuat = 0;
        foreach ($penghuni_aktif as $penghuni) {
            // Cek apakah sudah ada tagihan untuk bulan ini
            $this->db->where('id_kmr_penghuni', $penghuni->id);
            $this->db->where('bulan', $bulan);
            if ($this->db->get('tb_tagihan')->num_rows() == 0) {
                // Hitung total barang bawaan
                $this->db->select('SUM(b.harga) as total_barang');
                $this->db->from('tb_brng_bawaan bb');
                $this->db->join('tb_barang b', 'bb.id_barang = b.id');
                $this->db->where('bb.id_penghuni', $penghuni->id_penghuni);
                $barang = $this->db->get()->row();
                $total_barang = $barang->total_barang ? $barang->total_barang : 0;

                // Total tagihan = harga kamar + total barang
                $total_tagihan = $penghuni->harga_kamar + $total_barang;

                $data_tagihan = [
                    'bulan' => $bulan,
                    'id_kmr_penghuni' => $penghuni->id,
                    'jml_tagihan' => $total_tagihan
                ];

                if ($this->tambah_tagihan($data_tagihan)) {
                    $tagihan_dibuat++;
                }
            }
        }
        return $tagihan_dibuat;
    }

    // Ambil tagihan yang belum lunas
    public function get_tagihan_belum_lunas() {
        $this->db->select('t.*, kp.id_kamar, kp.id_penghuni, k.nomor as nomor_kamar, p.nama as nama_penghuni');
        $this->db->from('tb_tagihan t');
        $this->db->join('tb_kmr_penghuni kp', 't.id_kmr_penghuni = kp.id');
        $this->db->join('tb_kamar k', 'kp.id_kamar = k.id');
        $this->db->join('tb_penghuni p', 'kp.id_penghuni = p.id');
        $this->db->where('t.id NOT IN (SELECT DISTINCT id_tagihan FROM tb_bayar WHERE status = "lunas")', NULL, FALSE);
        return $this->db->get()->result();
    }

    // Ambil tagihan yang terlambat bayar (lebih dari 10 hari)
    public function get_tagihan_terlambat() {
        $this->db->select('t.*, kp.id_kamar, kp.id_penghuni, k.nomor as nomor_kamar, p.nama as nama_penghuni');
        $this->db->from('tb_tagihan t');
        $this->db->join('tb_kmr_penghuni kp', 't.id_kmr_penghuni = kp.id');
        $this->db->join('tb_kamar k', 'kp.id_kamar = k.id');
        $this->db->join('tb_penghuni p', 'kp.id_penghuni = p.id');
        $this->db->where('t.id NOT IN (SELECT DISTINCT id_tagihan FROM tb_bayar WHERE status = "lunas")', NULL, FALSE);
        $this->db->where('t.bulan <=', date('Y-m', strtotime('-10 days')));
        return $this->db->get()->result();
    }

    // Ambil pembayaran berdasarkan tagihan
    public function get_pembayaran_by_tagihan($id_tagihan) {
        $this->db->where('id_tagihan', $id_tagihan);
        $this->db->order_by('tgl_bayar', 'ASC');
        return $this->db->get('tb_bayar')->result();
    }

    // Tambah pembayaran
    public function tambah_pembayaran($data) {
        return $this->db->insert('tb_bayar', $data);
    }

    // Update status pembayaran
    public function update_status_pembayaran($id_tagihan) {
        // Hitung total pembayaran
        $this->db->select('SUM(jml_bayar) as total_bayar');
        $this->db->where('id_tagihan', $id_tagihan);
        $total_bayar = $this->db->get('tb_bayar')->row()->total_bayar;

        // Ambil jumlah tagihan
        $tagihan = $this->get_tagihan_by_id($id_tagihan);

        if ($total_bayar >= $tagihan->jml_tagihan) {
            // Update status menjadi lunas
            $this->db->where('id_tagihan', $id_tagihan);
            $this->db->update('tb_bayar', ['status' => 'lunas']);
        }
    }
} 