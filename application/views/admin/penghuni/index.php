<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-users text-primary"></i> 
        Data Penghuni
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('admin/tambah_penghuni') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Penghuni
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No KTP</th>
                        <th>No HP</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($penghuni)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                <i class="fas fa-info-circle"></i> Tidak ada data penghuni
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach($penghuni as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><strong><?= $p->nama ?></strong></td>
                                <td><?= $p->no_ktp ?></td>
                                <td><?= $p->no_hp ?></td>
                                <td><?= date('d/m/Y', strtotime($p->tgl_masuk)) ?></td>
                                <td>
                                    <?= $p->tgl_keluar ? date('d/m/Y', strtotime($p->tgl_keluar)) : '-' ?>
                                </td>
                                <td>
                                    <?php if($p->tgl_keluar): ?>
                                        <span class="badge bg-secondary">Keluar</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/edit_penghuni/' . $p->id) ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="confirmDelete('<?= base_url('admin/hapus_penghuni/' . $p->id) ?>')" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 