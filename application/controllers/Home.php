<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load database dan session
        $this->load->database();
        $this->load->library('session');
        
        // Load models
        $this->load->model('Kamar_model');
        $this->load->model('Tagihan_model');
    }

    public function index() {
        try {
            $data['title'] = 'Sistem Informasi Kost';
            
            // Ambil kamar yang kosong
            $data['kamar_kosong'] = $this->Kamar_model->get_kamar_kosong();
            
            // Ambil tagihan yang akan jatuh tempo (bulan ini)
            $bulan_ini = date('Y-m');
            $data['tagihan_jatuh_tempo'] = $this->Tagihan_model->get_tagihan_by_bulan($bulan_ini);
            
            // Ambil tagihan yang terlambat bayar
            $data['tagihan_terlambat'] = $this->Tagihan_model->get_tagihan_terlambat();
            
            // Ambil kamar yang terisi
            $data['kamar_terisi'] = $this->Kamar_model->get_kamar_terisi();
            
            $this->load->view('templates/header', $data);
            $this->load->view('home/index', $data);
            $this->load->view('templates/footer');
            
        } catch (Exception $e) {
            // Jika ada error, tampilkan halaman error
            $data['title'] = 'Error - Sistem Informasi Kost';
            $data['error'] = $e->getMessage();
            
            $this->load->view('templates/header', $data);
            $this->load->view('errors/database_error', $data);
            $this->load->view('templates/footer');
        }
    }
} 