<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-home text-primary"></i> 
                    Selamat Datang di Sistem Informasi Kost
                </h1>
            </div>
        </div>
    </div>

    <!-- Kamar Kosong -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bed"></i> Kamar yang Tersedia
                    </h5>
                </div>
                <div class="card-body">
                    <?php if(empty($kamar_kosong)): ?>
                        <div class="text-center text-muted">
                            <i class="fas fa-info-circle fa-3x mb-3"></i>
                            <p>Tidak ada kamar yang tersedia saat ini.</p>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach($kamar_kosong as $kamar): ?>
                                <div class="col-md-4 col-lg-3 mb-3">
                                    <div class="card border-success">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-success">
                                                <i class="fas fa-bed"></i> Kamar <?= $kamar->nomor ?>
                                            </h5>
                                            <p class="card-text">
                                                <strong>Rp <?= number_format($kamar->harga, 0, ',', '.') ?></strong> / bulan
                                            </p>
                                            <span class="badge bg-success">Tersedia</span>
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

    <!-- Tagihan Jatuh Tempo -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock"></i> Tagihan Jatuh Tempo Bulan Ini
                    </h5>
                </div>
                <div class="card-body">
                    <?php if(empty($tagihan_jatuh_tempo)): ?>
                        <div class="text-center text-muted">
                            <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                            <p>Tidak ada tagihan yang jatuh tempo bulan ini.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kamar</th>
                                        <th>Penghuni</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($tagihan_jatuh_tempo as $tagihan): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <span class="badge bg-primary">Kamar <?= $tagihan->nomor_kamar ?></span>
                                            </td>
                                            <td><?= $tagihan->nama_penghuni ?></td>
                                            <td>
                                                <strong>Rp <?= number_format($tagihan->jml_tagihan, 0, ',', '.') ?></strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning">Jatuh Tempo</span>
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
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-exclamation-triangle"></i> Tagihan Terlambat Bayar
                    </h5>
                </div>
                <div class="card-body">
                    <?php if(empty($tagihan_terlambat)): ?>
                        <div class="text-center text-muted">
                            <i class="fas fa-thumbs-up fa-3x mb-3 text-success"></i>
                            <p>Tidak ada tagihan yang terlambat bayar.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kamar</th>
                                        <th>Penghuni</th>
                                        <th>Bulan Tagihan</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($tagihan_terlambat as $tagihan): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <span class="badge bg-primary">Kamar <?= $tagihan->nomor_kamar ?></span>
                                            </td>
                                            <td><?= $tagihan->nama_penghuni ?></td>
                                            <td><?= date('F Y', strtotime($tagihan->bulan . '-01')) ?></td>
                                            <td>
                                                <strong>Rp <?= number_format($tagihan->jml_tagihan, 0, ',', '.') ?></strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger">Terlambat</span>
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

    <!-- Kamar yang Terisi -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users"></i> Kamar yang Terisi
                    </h5>
                </div>
                <div class="card-body">
                    <?php if(empty($kamar_terisi)): ?>
                        <div class="text-center text-muted">
                            <i class="fas fa-info-circle fa-3x mb-3"></i>
                            <p>Tidak ada kamar yang terisi saat ini.</p>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach($kamar_terisi as $kamar): ?>
                                <div class="col-md-4 col-lg-3 mb-3">
                                    <div class="card border-info">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-info">
                                                <i class="fas fa-bed"></i> Kamar <?= $kamar->nomor ?>
                                            </h5>
                                            <p class="card-text">
                                                <strong><?= $kamar->nama_penghuni ?></strong><br>
                                                <small class="text-muted"><?= $kamar->no_hp ?></small><br>
                                                <strong>Rp <?= number_format($kamar->harga, 0, ',', '.') ?></strong> / bulan
                                            </p>
                                            <span class="badge bg-info">Terisi</span>
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
</div> 