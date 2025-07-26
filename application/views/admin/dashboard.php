<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-tachometer-alt text-primary"></i> 
        Dashboard Admin
    </h1>
</div>

<!-- Statistik Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Penghuni Aktif
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_penghuni ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Kamar Kosong
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kamar_kosong ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bed fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Tagihan Belum Lunas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tagihan_belum_lunas ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-stats border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Tagihan Terlambat
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tagihan_terlambat ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt"></i> Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="<?= base_url('admin/tambah_penghuni') ?>" class="btn btn-primary btn-block w-100">
                            <i class="fas fa-user-plus"></i> Tambah Penghuni
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="<?= base_url('admin/tambah_kmr_penghuni') ?>" class="btn btn-success btn-block w-100">
                            <i class="fas fa-user-check"></i> Assign Kamar
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="<?= base_url('admin/generate_tagihan') ?>" class="btn btn-warning btn-block w-100">
                            <i class="fas fa-file-invoice-dollar"></i> Generate Tagihan
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="<?= base_url('admin/tagihan') ?>" class="btn btn-info btn-block w-100">
                            <i class="fas fa-list"></i> Lihat Tagihan
                        </a>
                    </div>
                </div>
            </div>
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
                <?php if(empty($kamar_kosong_list)): ?>
                    <div class="text-center text-muted">
                        <i class="fas fa-info-circle fa-3x mb-3"></i>
                        <p>Tidak ada kamar yang tersedia saat ini.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Kamar</th>
                                    <th>Harga Sewa</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($kamar_kosong_list as $kamar): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <span class="badge bg-primary">Kamar <?= $kamar->nomor ?></span>
                                        </td>
                                        <td>
                                            <strong>Rp <?= number_format($kamar->harga, 0, ',', '.') ?></strong> / bulan
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Tersedia</span>
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-exclamation-triangle"></i> Tagihan Terlambat Bayar
                </h5>
            </div>
            <div class="card-body">
                <?php if(empty($tagihan_terlambat_list)): ?>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($tagihan_terlambat_list as $tagihan): ?>
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
                                            <a href="<?= base_url('admin/detail_tagihan/' . $tagihan->id) ?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail
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