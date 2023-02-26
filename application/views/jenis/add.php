<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Tambah Data Klasifikasi Aset
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('jenis') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Back
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
               <?php echo form_open_multipart('Jenis/add');?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="id_jenis">Kode Klasifikasi</label>
                    <div class="col-md-9">
                        <input readonly value="<?= set_value('id_jenis', $id_jenis); ?>" name="id_jenis" id="id_jenis" type="text" class="form-control" placeholder="ID Jenis...">
                        <?= form_error('id_jenis', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="nama_jenis">Nama Klasifikasi Aset</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_jenis'); ?>" name="nama_jenis" id="nama_jenis" type="text" class="form-control" placeholder="Nama Kelas Aset...">
                        <?= form_error('nama_jenis', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>