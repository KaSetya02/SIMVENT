<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Buat Pengajuan Penghapusan Aset
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('hapus') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
               <?php echo form_open_multipart('hapus/add');?>
                <input type="hidden" name="id_user" value="<?= userdata('id_user'); ?>">
                 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="no_induk">NIM/NIP</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-credit-card"></i></span>
                            </div>
                            <input type="text" class="form-control"  class="form-control" value="<?= userdata('no_induk'); ?>" disabled>
                        </div>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="nama">Nama Peminjam</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control"  class="form-control" value="<?= userdata('nama'); ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="id_aset">Nama Aset</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="id_aset" id="id_aset" class="custom-select">
                                <option value="" selected disabled>Pilih Aset</option>
                                <?php foreach ($induk_inventaris as $i) : ?>
                                    <option <?= $this->uri->segment(3) == $i['id_aset'] ? 'selected' : '';  ?> <?= set_select('id_aset', $i['id_aset']) ?> value="<?= $i['id_aset'] ?>"><?= $i['id_aset'] . ' | ' . $i['nama_aset'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('induk/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('id_aset', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="tgl_pengajuan">Tanggal Pengajuan</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('tgl_pengajuan', date('Y-m-d')); ?>" name="tgl_pengajuan" id="tgl_pengajuan" type="text" class="form-control date" placeholder="Tanggal Pembelian...">
                        <?= form_error('tgl_pengajuan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="alasan">Alasan Penghapusan Aset</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-list-alt"></i></span>
                            </div>
                            <input value="<?= set_value('alasan'); ?>" name="alasan" id="alasan" type="text" class="form-control" placeholder="Alasan">
                        </div>
                        <?= form_error('alasan', '<small class="text-danger">', '</small>'); ?>
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