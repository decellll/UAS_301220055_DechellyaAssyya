<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-file-invoice text-primary"></i> 
        Data Tagihan
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('admin/generate_tagihan') ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Generate Tagihan
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
                        <th>Bulan</th>
                        <th>Kamar</th>
                        <th>Penghuni</th>
                        <th>Jumlah Tagihan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($tagihan)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <i class="fas fa-info-circle"></i> Tidak ada data tagihan
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach($tagihan as $t): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= date('F Y', strtotime($t->bulan . '-01')) ?></strong>
                                </td>
                                <td>
                                    <span class="badge bg-primary">Kamar <?= $t->nomor_kamar ?></span>
                                </td>
                                <td><?= $t->nama_penghuni ?></td>
                                <td>
                                    <strong>Rp <?= number_format($t->jml_tagihan, 0, ',', '.') ?></strong>
                                </td>
                                <td>
                                    <?php 
                                    // Cek status pembayaran
                                    $this->load->model('Tagihan_model');
                                    $pembayaran = $this->Tagihan_model->get_pembayaran_by_tagihan($t->id);
                                    $total_bayar = 0;
                                    foreach($pembayaran as $p) {
                                        $total_bayar += $p->jml_bayar;
                                    }
                                    
                                    if($total_bayar >= $t->jml_tagihan): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php elseif($total_bayar > 0): ?>
                                        <span class="badge bg-warning">Cicil</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/detail_tagihan/' . $t->id) ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 