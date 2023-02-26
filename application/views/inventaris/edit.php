<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Item Edit Form
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('inventaris') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open_multipart('', [], [ 'id_barang' => $inventaris['id_barang']]); ?>
                  <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="foto">Foto</label>
                    <div class="col-md-9">
                      <?php
                        if($inventaris['foto'] !== null) { ?>
                            <div style="margin-bottom: 10px;">
                                 <img src="<?= base_url() ?>assets/img/avatar/<?= $inventaris['foto']; ?>" width="100px">
                            </div>
                        <?php } ?>
                        <input name="foto" id="foto" type="file" class="input-group">
                        <small>(Biarkan Kosong Jika Tidak <?= $inventaris['foto'] ? 'Diganti' : 'Ada' ?>)</small>
                        <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="aset_id">Kode Aset</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa fa fa-code"></i></span>
                            </div>
                            <input readonly value="<?= set_value('aset_id', $inventaris['aset_id']); ?>" name="aset_id" id="aset_id" type="text" class="form-control" placeholder="Kode Aset...">
                        </div>
                        <?= form_error('aset_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
               <!--  <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="aset_id">Nama Barang</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa fa-cube"></i></span>
                            </div>
                            <select name="aset_id" id="aset_id" class="custom-select">
                                <option value="" selected disabled>Pilih Barang</option>
                                <?php foreach ($induk_inventaris as $i) : ?>
                                    <option <?= $inventaris['aset_id'] == $i['id_aset'] ? 'selected' : ''; ?> <?= set_select('aset_id', $i['id_aset']) ?> value="<?= $i['id_aset'] ?>"><?= $i['nama_aset'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('induk/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('aset_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div> -->
                 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="no_seri">Nomor Seri Pabrik</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa fa fa-barcode"></i></span>
                            </div>
                            <input value="<?= set_value('no_seri', $inventaris['no_seri']); ?>" name="no_seri" id="no_seri" type="text" class="form-control" placeholder="No Seri...">
                        </div>
                        <?= form_error('no_seri', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="ukuran">Ukuran</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa fa-arrows-alt"></i></span>
                            </div>
                            <input value="<?= set_value('ukuran', $inventaris['ukuran']); ?>" name="ukuran" id="ukuran" type="text" class="form-control" placeholder="Ukuran...">
                        </div>
                        <?= form_error('ukuran', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="bahan">Bahan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa fa-bars"></i></span>
                            </div>
                            <input value="<?= set_value('bahan', $inventaris['bahan']); ?>" name="bahan" id="bahan" type="text" class="form-control" placeholder="Bahan...">
                        </div>
                        <?= form_error('bahan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="tgl_pemb">Tanggal Pembelian</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                            <input value="<?= set_value('tgl_pemb', $inventaris['tgl_pemb']); ?>" name="tgl_pemb" id="tgl_pemb" type="date" class="form-control" placeholder="Tanggal Pembelian...">
                        </div>
                        <?= form_error('tgl_pemb', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="harga_bel">Harga Beli</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-credit-card" aria-hidden="true"></i></span>
                            </div>
                            <input value="<?= set_value('harga_bel', $inventaris['harga_bel']); ?>" name="harga_bel" id="harga_bel" type="number" class="form-control" placeholder="Harga Beli...">
                        </div>
                        <?= form_error('harga_bel', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="sumber_dana">Sumber Dana</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa fa-reply" aria-hidden="true"></i></span>
                            </div>
                            <input value="<?= set_value('sumber_dana', $inventaris['sumber_dana']); ?>" name="sumber_dana" id="sumber_dana" type="text" class="form-control" placeholder="Sumber Dana...">
                        </div>
                        <?= form_error('sumber_dana', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <!-- <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="role">Kondisi</label>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $inventaris['kondisi_barang'] == 'Baik' ? 'checked' : ''; ?> <?= set_radio('kondisi_barang', 'Baik'); ?> value="Baik" type="radio" id="Baik" name="kondisi_barang" class="custom-control-input">
                            <label class="custom-control-label" for="Baik">Baik</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $inventaris['kondisi_barang'] == 'Kurang Baik' ? 'checked' : ''; ?> <?= set_radio('kondisi_barang', 'Kurang Baik'); ?> value="Kurang Baik" type="radio" id="Kurang Baik" name="kondisi_barang" class="custom-control-input">
                            <label class="custom-control-label" for="Kurang Baik">Rusak</label>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="custom-control custom-radio">
                            <input <?= $inventaris['kondisi_barang'] == 'Rusak Berat' ? 'checked' : ''; ?> <?= set_radio('kondisi_barang', 'Rusak Berat'); ?> value="Rusak Berat" type="radio" id="Rusak Berat" name="kondisi_barang" class="custom-control-input">
                            <label class="custom-control-label" for="Rusak Berat">Rusak Berat</label>
                        </div>
                    </div>
                        <?= form_error('kondisi_barang', '<span class="text-danger small">', '</span>'); ?>
                </div> -->
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
                                    <option <?= $inventaris['ruang_id'] == $r['id_ruang'] ? 'selected' : ''; ?> <?= set_select('ruang_id', $r['id_ruang']) ?> value="<?= $r['id_ruang'] ?>"><?= $r['nama_ruang'] ?></option>
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
                        <button type="reset" class="btn btn-secondary">Reset</bu>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>