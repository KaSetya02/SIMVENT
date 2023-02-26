<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Report Form
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="transaksi">Laporan</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-radio">
                            <input value="tbl_riwayat" type="radio" id="tbl_riwayat" name="transaksi" class="custom-control-input">
                            <label class="custom-control-label" for="tbl_riwayat">Peminjaman Aset</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="tbl_riwayat1" type="radio" id="tbl_riwayat1" name="transaksi" class="custom-control-input">
                            <label class="custom-control-label" for="tbl_riwayat1">Peminjaman Ruang</label>
                        </div>
                       <!--  <div class="custom-control custom-radio">
                            <input value="inventaris" type="radio" id="inventaris" name="transaksi" class="custom-control-input">
                            <label class="custom-control-label" for="inventaris">Data Aset</label>
                        </div> -->
                        <?= form_error('transaksi', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-left" for="tanggal">Tanggal</label>
                    <div class="col-lg-9">
                        <div class="input-group">
                            <input value="<?= set_value('tanggal'); ?>" name="tanggal" id="tanggal" type="text" class="form-control" placeholder="Periode Tanggal">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                        </div>
                        <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-9 offset-lg-3">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-print"></i>
                            </span>
                            <span class="text">
                                Print
                            </span>
                        </button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>