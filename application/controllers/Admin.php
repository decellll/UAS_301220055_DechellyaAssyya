<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load database dan session
        $this->load->database();
        $this->load->library('session');
        
        // Load models
        $this->load->model('Penghuni_model');
        $this->load->model('Kamar_model');
        $this->load->model('Barang_model');
        $this->load->model('Kmr_penghuni_model');
        $this->load->model('Tagihan_model');
    }

    public function index() {
        $data['title'] = 'Dashboard Admin';
        
        // Statistik
        $data['total_penghuni'] = count($this->Penghuni_model->get_aktif_penghuni());
        $data['total_kamar'] = count($this->Kamar_model->get_all_kamar());
        $data['kamar_kosong'] = count($this->Kamar_model->get_kamar_kosong());
        $data['tagihan_belum_lunas'] = count($this->Tagihan_model->get_tagihan_belum_lunas());
        $data['tagihan_terlambat'] = count($this->Tagihan_model->get_tagihan_terlambat());
        
        // Data untuk dashboard
        $data['kamar_kosong_list'] = $this->Kamar_model->get_kamar_kosong();
        $data['tagihan_terlambat_list'] = $this->Tagihan_model->get_tagihan_terlambat();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }

    // ========== PENGHUNI ==========
    public function penghuni() {
        $data['title'] = 'Data Penghuni';
        $data['penghuni'] = $this->Penghuni_model->get_all_penghuni();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/penghuni/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_penghuni() {
        if ($this->input->post()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'no_ktp' => $this->input->post('no_ktp'),
                'no_hp' => $this->input->post('no_hp'),
                'tgl_masuk' => $this->input->post('tgl_masuk')
            ];

            if ($this->Penghuni_model->cek_no_ktp($data['no_ktp'])) {
                $this->session->set_flashdata('error', 'No KTP sudah terdaftar!');
            } else {
                if ($this->Penghuni_model->tambah_penghuni($data)) {
                    $this->session->set_flashdata('success', 'Data penghuni berhasil ditambahkan!');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan data penghuni!');
                }
            }
            redirect('admin/penghuni');
        }

        $data['title'] = 'Tambah Penghuni';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/penghuni/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function edit_penghuni($id) {
        if ($this->input->post()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'no_ktp' => $this->input->post('no_ktp'),
                'no_hp' => $this->input->post('no_hp'),
                'tgl_masuk' => $this->input->post('tgl_masuk')
            ];

            if ($this->Penghuni_model->cek_no_ktp($data['no_ktp'], $id)) {
                $this->session->set_flashdata('error', 'No KTP sudah terdaftar!');
            } else {
                if ($this->Penghuni_model->update_penghuni($id, $data)) {
                    $this->session->set_flashdata('success', 'Data penghuni berhasil diupdate!');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupdate data penghuni!');
                }
            }
            redirect('admin/penghuni');
        }

        $data['title'] = 'Edit Penghuni';
        $data['penghuni'] = $this->Penghuni_model->get_penghuni_by_id($id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/penghuni/edit', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_penghuni($id) {
        if ($this->Penghuni_model->hapus_penghuni($id)) {
            $this->session->set_flashdata('success', 'Data penghuni berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data penghuni!');
        }
        redirect('admin/penghuni');
    }

    // ========== KAMAR ==========
    public function kamar() {
        $data['title'] = 'Data Kamar';
        $data['kamar'] = $this->Kamar_model->get_all_kamar();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kamar/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_kamar() {
        if ($this->input->post()) {
            $data = [
                'nomor' => $this->input->post('nomor'),
                'harga' => $this->input->post('harga')
            ];

            if ($this->Kamar_model->cek_nomor_kamar($data['nomor'])) {
                $this->session->set_flashdata('error', 'Nomor kamar sudah ada!');
            } else {
                if ($this->Kamar_model->tambah_kamar($data)) {
                    $this->session->set_flashdata('success', 'Data kamar berhasil ditambahkan!');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan data kamar!');
                }
            }
            redirect('admin/kamar');
        }

        $data['title'] = 'Tambah Kamar';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kamar/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function edit_kamar($id) {
        if ($this->input->post()) {
            $data = [
                'nomor' => $this->input->post('nomor'),
                'harga' => $this->input->post('harga')
            ];

            if ($this->Kamar_model->cek_nomor_kamar($data['nomor'], $id)) {
                $this->session->set_flashdata('error', 'Nomor kamar sudah ada!');
            } else {
                if ($this->Kamar_model->update_kamar($id, $data)) {
                    $this->session->set_flashdata('success', 'Data kamar berhasil diupdate!');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupdate data kamar!');
                }
            }
            redirect('admin/kamar');
        }

        $data['title'] = 'Edit Kamar';
        $data['kamar'] = $this->Kamar_model->get_kamar_by_id($id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kamar/edit', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_kamar($id) {
        if ($this->Kamar_model->hapus_kamar($id)) {
            $this->session->set_flashdata('success', 'Data kamar berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data kamar!');
        }
        redirect('admin/kamar');
    }

    // ========== BARANG ==========
    public function barang() {
        $data['title'] = 'Data Barang';
        $data['barang'] = $this->Barang_model->get_all_barang();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/barang/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_barang() {
        if ($this->input->post()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga')
            ];

            if ($this->Barang_model->tambah_barang($data)) {
                $this->session->set_flashdata('success', 'Data barang berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data barang!');
            }
            redirect('admin/barang');
        }

        $data['title'] = 'Tambah Barang';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/barang/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function edit_barang($id) {
        if ($this->input->post()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga')
            ];

            if ($this->Barang_model->update_barang($id, $data)) {
                $this->session->set_flashdata('success', 'Data barang berhasil diupdate!');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data barang!');
            }
            redirect('admin/barang');
        }

        $data['title'] = 'Edit Barang';
        $data['barang'] = $this->Barang_model->get_barang_by_id($id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/barang/edit', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_barang($id) {
        if ($this->Barang_model->hapus_barang($id)) {
            $this->session->set_flashdata('success', 'Data barang berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data barang!');
        }
        redirect('admin/barang');
    }

    // ========== KAMAR PENGHUNI ==========
    public function kamar_penghuni() {
        $data['title'] = 'Data Kamar Penghuni';
        $data['kmr_penghuni'] = $this->Kmr_penghuni_model->get_all_kmr_penghuni();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kmr_penghuni/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_kmr_penghuni() {
        if ($this->input->post()) {
            $id_kamar = $this->input->post('id_kamar');
            $id_penghuni = $this->input->post('id_penghuni');
            $tgl_masuk = $this->input->post('tgl_masuk');

            // Cek apakah kamar sudah terisi
            if ($this->Kmr_penghuni_model->cek_kamar_terisi($id_kamar)) {
                $this->session->set_flashdata('error', 'Kamar sudah terisi!');
            } elseif ($this->Kmr_penghuni_model->cek_penghuni_aktif($id_penghuni)) {
                $this->session->set_flashdata('error', 'Penghuni sudah menempati kamar!');
            } else {
                $data = [
                    'id_kamar' => $id_kamar,
                    'id_penghuni' => $id_penghuni,
                    'tgl_masuk' => $tgl_masuk,
                    'tgl_keluar' => NULL
                ];

                if ($this->Kmr_penghuni_model->tambah_kmr_penghuni($data)) {
                    $this->session->set_flashdata('success', 'Data kamar penghuni berhasil ditambahkan!');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan data kamar penghuni!');
                }
            }
            redirect('admin/kamar_penghuni');
        }

        $data['title'] = 'Tambah Kamar Penghuni';
        $data['kamar'] = $this->Kamar_model->get_kamar_kosong();
        $data['penghuni'] = $this->Penghuni_model->get_aktif_penghuni();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kmr_penghuni/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function keluar_kamar($id) {
        if ($this->input->post()) {
            $tgl_keluar = $this->input->post('tgl_keluar');
            
            if ($this->Kmr_penghuni_model->keluar_kamar($id, $tgl_keluar)) {
                $this->session->set_flashdata('success', 'Penghuni berhasil keluar dari kamar!');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data keluar kamar!');
            }
            redirect('admin/kamar_penghuni');
        }

        $data['title'] = 'Keluar Kamar';
        $data['kmr_penghuni'] = $this->Kmr_penghuni_model->get_kmr_penghuni_by_id($id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kmr_penghuni/keluar', $data);
        $this->load->view('templates/footer');
    }

    // ========== TAGIHAN ==========
    public function tagihan() {
        $data['title'] = 'Data Tagihan';
        $data['tagihan'] = $this->Tagihan_model->get_all_tagihan();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/tagihan/index', $data);
        $this->load->view('templates/footer');
    }

    public function generate_tagihan() {
        if ($this->input->post()) {
            $bulan = $this->input->post('bulan');
            $tagihan_dibuat = $this->Tagihan_model->generate_tagihan($bulan);
            
            if ($tagihan_dibuat > 0) {
                $this->session->set_flashdata('success', $tagihan_dibuat . ' tagihan berhasil dibuat!');
            } else {
                $this->session->set_flashdata('info', 'Tidak ada tagihan baru yang dibuat.');
            }
            redirect('admin/tagihan');
        }

        $data['title'] = 'Generate Tagihan';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/tagihan/generate', $data);
        $this->load->view('templates/footer');
    }

    public function detail_tagihan($id) {
        $data['title'] = 'Detail Tagihan';
        $data['tagihan'] = $this->Tagihan_model->get_tagihan_by_id($id);
        $data['pembayaran'] = $this->Tagihan_model->get_pembayaran_by_tagihan($id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/tagihan/detail', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_pembayaran($id_tagihan) {
        if ($this->input->post()) {
            $data = [
                'id_tagihan' => $id_tagihan,
                'jml_bayar' => $this->input->post('jml_bayar'),
                'status' => $this->input->post('status')
            ];

            if ($this->Tagihan_model->tambah_pembayaran($data)) {
                $this->Tagihan_model->update_status_pembayaran($id_tagihan);
                $this->session->set_flashdata('success', 'Pembayaran berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan pembayaran!');
            }
            redirect('admin/detail_tagihan/' . $id_tagihan);
        }

        $data['title'] = 'Tambah Pembayaran';
        $data['tagihan'] = $this->Tagihan_model->get_tagihan_by_id($id_tagihan);
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/tagihan/tambah_pembayaran', $data);
        $this->load->view('templates/footer');
    }
} 