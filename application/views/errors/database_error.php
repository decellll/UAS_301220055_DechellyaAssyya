<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
                <div class="text-center">
                    <div class="alert alert-danger" role="alert">
                        <h1 class="alert-heading">
                            <i class="fas fa-exclamation-triangle"></i> 
                            Database Error
                        </h1>
                        <hr>
                        <p class="mb-0">
                            <strong>Error:</strong> <?= $error ?>
                        </p>
                        <hr>
                        <p class="mb-0">
                            <strong>Solusi:</strong>
                        </p>
                        <ul class="text-start">
                            <li>Pastikan MySQL/MariaDB sudah berjalan</li>
                            <li>Pastikan database 'db_kost' sudah dibuat</li>
                            <li>Pastikan semua tabel sudah ada</li>
                            <li>Cek konfigurasi database di application/config/database.php</li>
                        </ul>
                        <hr>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="<?= base_url('check_database.php') ?>" class="btn btn-primary">
                                <i class="fas fa-database"></i> Check Database
                            </a>
                            <a href="<?= base_url('setup_database.php') ?>" class="btn btn-success">
                                <i class="fas fa-cog"></i> Setup Database
                            </a>
                            <a href="<?= base_url() ?>" class="btn btn-secondary">
                                <i class="fas fa-home"></i> Kembali ke Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 