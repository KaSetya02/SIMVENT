<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Edit Data Ruangan
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
                <?= form_open('', [], ['id_ruang' => $ruang['id_ruang']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="no_ruang">Nomor Ruangan</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('no_ruang', $ruang['no_ruang']); ?>" name="no_ruang" id="no_ruang" type="text" class="form-control" placeholder="Nama ruang..." readonly>
                        <?= form_error('no_ruang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="nama_ruang">Nama ruang</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_ruang', $ruang['nama_ruang']); ?>" name="nama_ruang" id="nama_ruang" type="text" class="form-control" placeholder="Nama ruang...">
                        <?= form_error('nama_ruang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="role">Kondisi</label>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $ruang['kondisi_ruang'] == 'Baik' ? 'checked' : ''; ?> <?= set_radio('kondisi_ruang', 'Baik'); ?> value="Baik" type="radio" id="Baik" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Baik">Baik</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= $ruang['kondisi_ruang'] == 'Dalam Perbaikan' ? 'checked' : ''; ?> <?= set_radio('kondisi_ruang', 'Dalam Perbaikan'); ?> value="Dalam Perbaikan" type="radio" id="Dalam Perbaikan" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Dalam Perbaikan">Dalam Perbaikan</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $ruang['kondisi_ruang'] == 'Rusak' ? 'checked' : ''; ?> <?= set_radio('kondisi_ruang', 'Rusak'); ?> value="Rusak" type="radio" id="Rusak" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Rusak">Rusak</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= $ruang['kondisi_ruang'] == 'Kosong' ? 'checked' : ''; ?> <?= set_radio('kondisi_ruang', 'Kosong'); ?> value="Kosong" type="radio" id="Kosong" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Kosong">Kosong</label>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $ruang['kondisi_ruang'] == 'Rusak Berat' ? 'checked' : ''; ?> <?= set_radio('kondisi_ruang', 'Rusak Berat'); ?> value="Rusak Berat" type="radio" id="Rusak Berat" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Rusak Berat">Rusak Berat</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= $ruang['kondisi_ruang'] == 'Isi Atau Sedang Digunakan' ? 'checked' : ''; ?> <?= set_radio('kondisi_ruang', 'Isi Atau Sedang Digunakan'); ?> value="Isi Atau Sedang Digunakan" type="radio" id="Isi Atau Sedang Digunakan" name="kondisi_ruang" class="custom-control-input">
                            <label class="custom-control-label" for="Isi Atau Sedang Digunakan">Isi Atau Sedang Digunakan</label>
                        </div>
                    </div>
                        <?= form_error('kondisi_ruang', '<span class="text-danger small">', '</span>'); ?>
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
