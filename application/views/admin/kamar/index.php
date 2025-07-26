<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-bed text-primary"></i> 
        Data Kamar
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('admin/tambah_kamar') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kamar
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
                        <th>Nomor Kamar</th>
                        <th>Harga Sewa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($kamar)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                <i class="fas fa-info-circle"></i> Tidak ada data kamar
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach($kamar as $k): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <span class="badge bg-primary fs-6">Kamar <?= $k->nomor ?></span>
                                </td>
                                <td>
                                    <strong>Rp <?= number_format($k->harga, 0, ',', '.') ?></strong> / bulan
                                </td>
                                <td>
                                    <?php 
                                    // Cek status kamar
                                    $this->load->model('Kmr_penghuni_model');
                                    $status = $this->Kmr_penghuni_model->get_status_kamar($k->id);
                                    if($status): ?>
                                        <span class="badge bg-danger">Terisi</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Kosong</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/edit_kamar/' . $k->id) ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="confirmDelete('<?= base_url('admin/hapus_kamar/' . $k->id) ?>')" class="btn btn-sm btn-danger">
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