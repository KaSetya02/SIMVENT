<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Edit Data Induk Inventaris
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('induk') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open_multipart('', [], ['id_aset' => $induk['id_aset']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="nama_aset">Nama Aset</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-cube"></i></span>
                            </div>
                            <input value="<?= set_value('nama_aset', $induk['nama_aset']); ?>" name="nama_aset" id="nama_aset" type="text" class="form-control" placeholder="Nama Aset...">
                        </div>
                        <?= form_error('nama_aset', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="merk">Merk</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-clipboard"></i></span>
                            </div>
                            <input value="<?= set_value('merk', $induk['merk']); ?>" name="merk" id="merk" type="text" class="form-control" placeholder="Merk...">
                        </div>
                        <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="tipe">Tipe</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-list-alt"></i></span>
                            </div>
                            <input value="<?= set_value('tipe', $induk['tipe']); ?>" name="tipe" id="tipe" type="text" class="form-control" placeholder="Tipe...">
                        </div>
                        <?= form_error('tipe', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="klasifikasi_barang">Klasifikasi Barang</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="klasifikasi_barang" id="klasifikasi_barang" class="custom-select">
                                <option value="" >Pilih Kelas Barang</option>
                                <?php foreach ($jenis as $j) : ?>
                                    <option <?= $induk['klasifikasi_barang'] == $j['id_jenis'] ? 'selected' : ''; ?> <?= set_select('klasifikasi_barang', $j['id_jenis']) ?> value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('jenis/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('klasifikasi_barang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>


                 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="keterangan">Keterangan</label>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $induk['keterangan'] == 'Tersedia' ? 'checked' : ''; ?> <?= set_radio('keterangan', 'Tersedia'); ?> value="Tersedia" type="radio" id="Tersedia" name="keterangan" class="custom-control-input">
                            <label class="custom-control-label" for="Tersedia">Tersedia</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= $induk['keterangan'] == 'Rusak' ? 'checked' : ''; ?> <?= set_radio('keterangan', 'Rusak'); ?> value="Rusak" type="radio" id="Rusak" name="keterangan" class="custom-control-input">
                            <label class="custom-control-label" for="Rusak">Rusak</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $induk['keterangan'] == 'Sedang Dipinjam' ? 'checked' : ''; ?> <?= set_radio('keterangan', 'Sedang Dipinjam'); ?> value="Sedang Dipinjam" type="radio" id="Sedang Dipinjam" name="keterangan" class="custom-control-input">
                            <label class="custom-control-label" for="Sedang Dipinjam">Sedang Dipinjam</label>
                        </div>
                          <div class="custom-control custom-radio">
                            <input <?= $induk['keterangan'] == 'Rusak Berat' ? 'checked' : ''; ?> <?= set_radio('keterangan', 'Rusak Berat'); ?> value="Rusak Berat" type="radio" id="Rusak Berat" name="keterangan" class="custom-control-input">
                            <label class="custom-control-label" for="Rusak Berat">Rusak Berat</label>
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $induk['keterangan'] == 'Baik' ? 'checked' : ''; ?> <?= set_radio('keterangan', 'Baik'); ?> value="Baik" type="radio" id="Baik" name="keterangan" class="custom-control-input">
                            <label class="custom-control-label" for="Baik">Baik</label>
                        </div>
                    </div>
                    
        
                        <?= form_error('keterangan', '<span class="text-danger small">', '</span>'); ?>
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