<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Pengajuan Peminjaman Ruangan
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?php echo base_url('pinjam4'); ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                	<?= form_open_multipart('pinjam4/ruangan_pinjam_act'); ?>
             <!--   <form class="form-horizontal" method="POST" id="ruangan_pinjam" action="<?php echo base_url('pinjam4/ruangan_pinjam_act'); ?>"> -->
					<input type="hidden" name="id_user" value="<?= userdata('id_user'); ?>">
					<input type="hidden" name="id_ruang" value="<?php echo $data->id_ruang; ?>">
					<input type="hidden" name="tgl_kembali" value="0">
					<input type="hidden" name="status" value="0">
				 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="no_induk">NIM</label>
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
                    <label class="col-md-3 text-md-left" for="no_ruang">No Ruangan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-code"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?php echo $data->no_ruang; ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="nama_ruang">Nama Ruangan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-university"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?php echo $data->nama_ruang; ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="tgl_pinjam">Waktu Pinjam</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                            <input type="datetime" name="tgl_pinjam" class="form-control" value="<?php echo date('Y-m-d H:i:s') ?>" readonly>
                        </div>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="tujuan">Tujuan</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-upload"></i></span>
                            </div>
                           <input type="text" name="tujuan" class="form-control" value="">
                        </div>
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

		