<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-user-plus text-primary"></i> 
        Tambah Penghuni
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('admin/penghuni') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Form Tambah Penghuni</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/tambah_penghuni') ?>" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="no_ktp" class="form-label">Nomor KTP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_ktp" name="no_ktp" maxlength="16" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor Handphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tgl_masuk" class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" required>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('admin/penghuni') ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Informasi</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-info-circle"></i> Petunjuk:</h6>
                    <ul class="mb-0">
                        <li>Semua field wajib diisi</li>
                        <li>Nomor KTP harus unik</li>
                        <li>Tanggal masuk adalah tanggal penghuni mulai menempati kost</li>
                        <li>Tanggal keluar akan diisi otomatis saat penghuni keluar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> 