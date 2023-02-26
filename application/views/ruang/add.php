<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                           Input Data Ruangan
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('ruang') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?php echo form_open_multipart('Ruang/add');?>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="nama_ruang">Nomor Ruangan</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('no_ruang'); ?>" name="no_ruang" id="no_ruang" type="text" class="form-control" placeholder="Kode Ruangan (Misal: R-10)">
                        <?= form_error('no_ruang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="nama_ruang">Nama Ruangan</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_ruang'); ?>" name="nama_ruang" id="nama_ruang" type="text" class="form-control" placeholder="Nama ruang...">
                        <?= form_error('nama_ruang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="kondisi_ruang">Kondisi Ruangan</label>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= set_radio('kondisi_ruang', 'Baik'); ?> value="Baik" type="radio" id="Baik" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Baik">Baik</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= set_radio('kondisi_ruang', 'Dalam Perbaikan'); ?> value="Dalam Perbaikan" type="radio" id="Dalam Perbaikan" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Dalam Perbaikan">Dalam Perbaikan</label>
                        </div>

                        <?= form_error('kondisi_ruang', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= set_radio('kondisi_ruang', 'Rusak'); ?> value="Rusak" type="radio" id="Rusak" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Rusak">Rusak</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= set_radio('kondisi_ruang', 'Kosong'); ?> value="Kosong" type="radio" id="Kosong" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Kosong">Kosong</label>
                        </div>
                        <?= form_error('kondisi_ruang', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= set_radio('kondisi_ruang', 'Rusak Berat'); ?> value="Rusak Berat" type="radio" id="Rusak Berat" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Rusak Berat">Rusak Berat</label>
                        </div>
                         <div class="custom-control custom-radio">
                            <input <?= set_radio('kondisi_ruang', 'Isi Atau Sedang Digunakan'); ?> value="Isi Atau Sedang Digunakan" type="radio" id="Isi Atau Sedang Digunakan" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Isi Atau Sedang Digunakan">Isi Atau Sedang Digunakan</label>
                        </div>
                        <?= form_error('kondisi_ruang', '<span class="text-danger small">', '</span>'); ?>
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
