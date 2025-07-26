<!-- Hero Dashboard -->
<div class="hero-dashboard text-center text-white mb-5" data-aos="fade-up">
    <div class="container">
        <h1 class="display-5 fw-bold mb-3 typing-animation">
            <i class="fas fa-tachometer-alt text-warning"></i> 
            Dashboard Admin
        </h1>
        <p class="lead mb-0">Kelola sistem kost Anda dengan mudah dan efisien</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-5" data-aos="fade-up" data-aos-delay="100">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card success h-100" data-aos="zoom-in" data-aos-delay="100">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="stats-icon bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold mb-1"><?= $total_penghuni ?></h3>
                    <p class="text-muted mb-0">Total Penghuni Aktif</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card h-100" data-aos="zoom-in" data-aos-delay="200">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="stats-icon bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-bed fa-2x text-primary"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold mb-1"><?= $kamar_kosong ?></h3>
                    <p class="text-muted mb-0">Kamar Kosong</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card warning h-100" data-aos="zoom-in" data-aos-delay="300">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="stats-icon bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-file-invoice fa-2x text-warning"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold mb-1"><?= $tagihan_belum_lunas ?></h3>
                    <p class="text-muted mb-0">Tagihan Belum Lunas</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card danger h-100" data-aos="zoom-in" data-aos-delay="400">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="stats-icon bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold mb-1"><?= $tagihan_terlambat ?></h3>
                    <p class="text-muted mb-0">Tagihan Terlambat</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt"></i> Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="<?= base_url('admin/tambah_penghuni') ?>" class="btn btn-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4">
                            <i class="fas fa-user-plus fa-3x mb-3"></i>
                            <span class="fw-bold">Tambah Penghuni</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="<?= base_url('admin/tambah_kmr_penghuni') ?>" class="btn btn-success w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4">
                            <i class="fas fa-user-check fa-3x mb-3"></i>
                            <span class="fw-bold">Assign Kamar</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="<?= base_url('admin/generate_tagihan') ?>" class="btn btn-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4">
                            <i class="fas fa-file-invoice-dollar fa-3x mb-3"></i>
                            <span class="fw-bold">Generate Tagihan</span>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="<?= base_url('admin/tagihan') ?>" class="btn btn-info w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4">
                            <i class="fas fa-list fa-3x mb-3"></i>
                            <span class="fw-bold">Lihat Tagihan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kamar Kosong -->
<div class="row mb-5" data-aos="fade-up" data-aos-delay="300">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bed"></i> Kamar yang Tersedia
                </h5>
            </div>
            <div class="card-body">
                <?php if(empty($kamar_kosong_list)): ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-info-circle fa-4x mb-3 text-muted"></i>
                        <h5>Tidak ada kamar yang tersedia saat ini.</h5>
                        <p class="text-muted">Semua kamar sudah terisi oleh penghuni.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Kamar</th>
                                    <th>Harga Sewa</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($kamar_kosong_list as $kamar): ?>
                                    <tr data-aos="fade-left" data-aos-delay="<?= $no * 50 ?>">
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <span class="badge bg-primary fs-6">
                                                <i class="fas fa-bed"></i> Kamar <?= $kamar->nomor ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success fs-6">
                                                Rp <?= number_format($kamar->harga, 0, ',', '.') ?>
                                            </span>
                                            <small class="text-muted d-block">per bulan</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-success fs-6">
                                                <i class="fas fa-check-circle"></i> Tersedia
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/tambah_kmr_penghuni') ?>" 
                                               class="btn btn-sm btn-success" 
                                               data-bs-toggle="tooltip" 
                                               title="Assign Penghuni">
                                                <i class="fas fa-user-plus"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Tagihan Terlambat -->
<div class="row" data-aos="fade-up" data-aos-delay="400">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-exclamation-triangle"></i> Tagihan Terlambat Bayar
                </h5>
            </div>
            <div class="card-body">
                <?php if(empty($tagihan_terlambat_list)): ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-thumbs-up fa-4x mb-3 text-success"></i>
                        <h5>Tidak ada tagihan yang terlambat bayar.</h5>
                        <p class="text-muted">Semua penghuni membayar tepat waktu.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kamar</th>
                                    <th>Penghuni</th>
                                    <th>Bulan Tagihan</th>
                                    <th>Jumlah Tagihan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($tagihan_terlambat_list as $tagihan): ?>
                                    <tr data-aos="fade-left" data-aos-delay="<?= $no * 50 ?>">
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <span class="badge bg-primary fs-6">
                                                <i class="fas fa-bed"></i> Kamar <?= $tagihan->nomor_kamar ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <i class="fas fa-user-circle fa-2x text-primary"></i>
                                                </div>
                                                <div>
                                                    <strong><?= $tagihan->nama_penghuni ?></strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary fs-6">
                                                <?= date('F Y', strtotime($tagihan->bulan . '-01')) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-danger fs-6">
                                                Rp <?= number_format($tagihan->jml_tagihan, 0, ',', '.') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger fs-6">
                                                <i class="fas fa-exclamation-triangle"></i> Terlambat
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/detail_tagihan/' . $tagihan->id) ?>" 
                                               class="btn btn-sm btn-danger" 
                                               data-bs-toggle="tooltip" 
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="row mt-5" data-aos="fade-up" data-aos-delay="500">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-line"></i> Ringkasan Aktivitas
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="activity-item d-flex align-items-center mb-3">
                            <div class="activity-icon bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-users text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Total Penghuni</h6>
                                <p class="text-muted mb-0"><?= $total_penghuni ?> penghuni aktif</p>
                            </div>
                        </div>
                        <div class="activity-item d-flex align-items-center mb-3">
                            <div class="activity-icon bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-bed text-success"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Kamar Kosong</h6>
                                <p class="text-muted mb-0"><?= $kamar_kosong ?> kamar tersedia</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="activity-item d-flex align-items-center mb-3">
                            <div class="activity-icon bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-file-invoice text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Tagihan Belum Lunas</h6>
                                <p class="text-muted mb-0"><?= $tagihan_belum_lunas ?> tagihan</p>
                            </div>
                        </div>
                        <div class="activity-item d-flex align-items-center mb-3">
                            <div class="activity-icon bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-exclamation-triangle text-danger"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Tagihan Terlambat</h6>
                                <p class="text-muted mb-0"><?= $tagihan_terlambat ?> tagihan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 