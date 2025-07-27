<!-- Hero Section -->
<div class="hero-section text-center text-white mb-5" data-aos="fade-up">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4 typing-animation">
            <i class="fas fa-home text-warning"></i> 
            Selamat Datang di KostKu
        </h1>
        <p class="lead mb-4">Sistem Informasi Kost Modern & Terpercaya</p>
        <div class="hero-stats row justify-content-center">
            <div class="col-md-3 col-6 mb-3">
                <div class="stats-card text-center">
                    <i class="fas fa-bed fa-2x text-primary mb-2"></i>
                    <h4 class="fw-bold"><?= count($kamar_kosong) ?></h4>
                    <p class="text-muted mb-0">Kamar Tersedia</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="stats-card text-center">
                    <i class="fas fa-users fa-2x text-success mb-2"></i>
                    <h4 class="fw-bold"><?= count($kamar_terisi) ?></h4>
                    <p class="text-muted mb-0">Penghuni Aktif</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="stats-card text-center">
                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                    <h4 class="fw-bold"><?= count($tagihan_jatuh_tempo) ?></h4>
                    <p class="text-muted mb-0">Jatuh Tempo</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="stats-card text-center">
                    <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                    <h4 class="fw-bold"><?= count($tagihan_terlambat) ?></h4>
                    <p class="text-muted mb-0">Terlambat Bayar</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kamar Kosong Section -->
<div class="row mb-5" data-aos="fade-up" data-aos-delay="100">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bed"></i> Kamar yang Tersedia
                </h5>
            </div>
            <div class="card-body">
                <?php if(empty($kamar_kosong)): ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-info-circle fa-4x mb-3 text-muted"></i>
                        <h5>Tidak ada kamar yang tersedia saat ini.</h5>
                        <p class="text-muted">Semua kamar sudah terisi oleh penghuni.</p>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php $i = 0; foreach($kamar_kosong as $kamar): ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="zoom-in" data-aos-delay="<?= $i * 100 ?>">
                                <div class="card h-100 border-0 shadow-sm hover-card">
                                    <div class="card-body text-center p-4">
                                        <div class="room-icon mb-3">
                                            <i class="fas fa-bed fa-3x text-success"></i>
                                        </div>
                                        <h5 class="card-title text-success fw-bold">
                                            Kamar <?= $kamar->nomor ?>
                                        </h5>
                                        <div class="price-tag mb-3">
                                            <span class="badge bg-success fs-6 px-3 py-2">
                                                Rp <?= number_format($kamar->harga, 0, ',', '.') ?>
                                            </span>
                                            <small class="text-muted d-block mt-1">per bulan</small>
                                        </div>
                                        <div class="room-features">
                                            <span class="badge bg-light text-dark me-1">
                                                <i class="fas fa-wifi"></i> WiFi
                                            </span>
                                            <span class="badge bg-light text-dark me-1">
                                                <i class="fas fa-shower"></i> Kamar Mandi
                                            </span>
                                            <span class="badge bg-light text-dark">
                                                <i class="fas fa-parking"></i> Parkir
                                            </span>
                                        </div>
                                        <div class="mt-3">
                                            <span class="badge bg-success fs-6 px-3 py-2">
                                                <i class="fas fa-check-circle"></i> Tersedia
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $i++; endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Tagihan Jatuh Tempo Section -->
<div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock"></i> Tagihan Jatuh Tempo Bulan Ini
                </h5>
            </div>
            <div class="card-body">
                <?php if(empty($tagihan_jatuh_tempo)): ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-check-circle fa-4x mb-3 text-success"></i>
                        <h5>Tidak ada tagihan yang jatuh tempo bulan ini.</h5>
                        <p class="text-muted">Semua penghuni sudah membayar tepat waktu.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kamar</th>
                                    <th>Penghuni</th>
                                    <th>Jumlah Tagihan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($tagihan_jatuh_tempo as $tagihan): ?>
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
                                            <span class="fw-bold text-danger fs-6">
                                                Rp <?= number_format($tagihan->jml_tagihan, 0, ',', '.') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning fs-6">
                                                <i class="fas fa-clock"></i> Jatuh Tempo
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/detail_tagihan/' . $tagihan->id) ?>" 
                                               class="btn btn-sm btn-info" 
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

<!-- Tagihan Terlambat Section -->
<div class="row mb-5" data-aos="fade-up" data-aos-delay="300">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-exclamation-triangle"></i> Tagihan Terlambat Bayar
                </h5>
            </div>
            <div class="card-body">
                <?php if(empty($tagihan_terlambat)): ?>
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
                                <?php $no = 1; foreach($tagihan_terlambat as $tagihan): ?>
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

<!-- Kamar yang Terisi Section -->
<div class="row" data-aos="fade-up" data-aos-delay="400">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-users"></i> Kamar yang Terisi
                </h5>
            </div>
            <div class="card-body">
                <?php if(empty($kamar_terisi)): ?>
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-info-circle fa-4x mb-3 text-muted"></i>
                        <h5>Tidak ada kamar yang terisi saat ini.</h5>
                        <p class="text-muted">Belum ada penghuni yang menempati kost.</p>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach($kamar_terisi as $kamar): ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="zoom-in" data-aos-delay="<?= $loop->index * 100 ?>">
                                <div class="card h-100 border-0 shadow-sm hover-card">
                                    <div class="card-body text-center p-4">
                                        <div class="room-icon mb-3">
                                            <i class="fas fa-bed fa-3x text-info"></i>
                                        </div>
                                        <h5 class="card-title text-info fw-bold">
                                            Kamar <?= $kamar->nomor ?>
                                        </h5>
                                        <div class="tenant-info mb-3">
                                            <div class="avatar-sm mb-2">
                                                <i class="fas fa-user-circle fa-2x text-primary"></i>
                                            </div>
                                            <h6 class="fw-bold mb-1"><?= $kamar->nama_penghuni ?></h6>
                                            <small class="text-muted">
                                                <i class="fas fa-phone"></i> <?= $kamar->no_hp ?>
                                            </small>
                                        </div>
                                        <div class="price-tag mb-3">
                                            <span class="badge bg-info fs-6 px-3 py-2">
                                                Rp <?= number_format($kamar->harga, 0, ',', '.') ?>
                                            </span>
                                            <small class="text-muted d-block mt-1">per bulan</small>
                                        </div>
                                        <div class="mt-3">
                                            <span class="badge bg-info fs-6 px-3 py-2">
                                                <i class="fas fa-user-check"></i> Terisi
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action Section -->
<div class="row mt-5" data-aos="fade-up" data-aos-delay="500">
    <div class="col-12">
        <div class="card bg-gradient-primary text-white text-center">
            <div class="card-body py-5">
                <h3 class="fw-bold mb-3">
                    <i class="fas fa-rocket"></i> Kelola Kost Anda dengan Mudah!
                </h3>
                <p class="lead mb-4">
                    Akses panel admin untuk mengelola data penghuni, kamar, tagihan, dan pembayaran dengan sistem yang modern dan terpercaya.
                </p>
                <a href="<?= base_url('admin') ?>" class="btn btn-light btn-lg px-4">
                    <i class="fas fa-cog"></i> Akses Admin Panel
                </a>
            </div>
        </div>
    </div>
</div> 