<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "<h1>Test Database Connection</h1>";
        
        // Test database connection
        try {
            $this->load->database();
            echo "<p style='color: green;'>✓ Database library loaded successfully</p>";
            
            // Test query
            $query = $this->db->query("SELECT COUNT(*) as total FROM tb_kamar");
            $result = $query->row();
            echo "<p style='color: green;'>✓ Database query successful. Total kamar: " . $result->total . "</p>";
            
            // Test model
            $this->load->model('Kamar_model');
            $kamar = $this->Kamar_model->get_all_kamar();
            echo "<p style='color: green;'>✓ Model loaded successfully. Total kamar from model: " . count($kamar) . "</p>";
            
            echo "<br><a href='" . base_url() . "'>Kembali ke Home</a>";
            
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
        }
    }
} 