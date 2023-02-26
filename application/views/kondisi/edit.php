<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Edit Kondisi Aset
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('kondisi') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['id_kondisi' => $kondisi['id_kondisi']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="aset_id">Kode Aset</label>
                    <div class="col-md-9">
                        <input readonly value="<?= set_value('aset_id', $kondisi['aset_id']); ?>" name="aset_id" id="aset_id" type="text" class="form-control" placeholder="Nama ruang...">
                        <?= form_error('aset_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="aset_id">Nama Barang</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa fa-cube"></i></span>
                            </div>
                            <select name="aset_id" id="aset_id" class="custom-select">
                                <option value="" selected disabled>Pilih Barang</option>
                                <?php foreach ($induk_inventaris as $i) : ?>
                                    <option <?= $kondisi['aset_id'] == $i['id_aset'] ? 'selected' : ''; ?> <?= set_select('aset_id', $i['id_aset']) ?> value="<?= $i['id_aset'] ?>"><?= $i['nama_aset'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('induk/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('aset_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="keterangan">Kondisi</label>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $kondisi['kondisi_barang'] == 'Baik' ? 'checked' : ''; ?> <?= set_radio('kondisi_barang', 'Baik'); ?> value="Baik" type="radio" id="Baik" name="kondisi_barang" class="custom-control-input">
                            <label class="custom-control-label" for="Baik">Baik</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $kondisi['kondisi_barang'] == 'Rusak' ? 'checked' : ''; ?> <?= set_radio('kondisi_barang', 'Rusak'); ?> value="Rusak" type="radio" id="Rusak" name="kondisi_barang" class="custom-control-input">
                            <label class="custom-control-label" for="Rusak">Rusak</label>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $kondisi['kondisi_barang'] == 'Rusak Berat' ? 'checked' : ''; ?> <?= set_radio('kondisi_barang', 'Rusak Berat'); ?> value="Rusak Berat" type="radio" id="Rusak Berat" name="kondisi_barang" class="custom-control-input">
                            <label class="custom-control-label" for="Rusak Berat">Rusak Berat</label>
                        </div>
                    </div>
                        <?= form_error('kondisi_barang', '<span class="text-danger small">', '</span>'); ?>
                </div>
               <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="ruang_id">Lokasi</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa fa-cube"></i></span>
                            </div>
                            <select name="ruang_id" id="ruang_id" class="custom-select">
                                <option value="" selected disabled>Pilih Lokasi</option>
                                <?php foreach ($ruang as $r) : ?>
                                    <option <?= $kondisi['ruang_id'] == $r['id_ruang'] ? 'selected' : ''; ?> <?= set_select('ruang_id', $r['id_ruang']) ?> value="<?= $r['id_ruang'] ?>"><?= $r['nama_ruang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('induk/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('ruang_id', '<small class="text-danger">', '</small>'); ?>
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