<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Riwayat Peminjaman Barang
                </h4>
            </div>
            <div class="col-auto">
                 <a class="btn btn-danger btn-add" href="<?php echo base_url('pinjam/riwayat_clear') ?>"><i class="fa fa-times"></i> Clear History</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
       <table class="table table-striped w-100 dt-responsive " id="dataTable">
                      <thead>
                        <tr>
                          <th>ID Pinjam</th>
                          <th>NIM/NIP</th>
                          <th>Nama Peminjam</th>
                          <th>Nama Barang</th>
                          <th>Tujuan Peminjaman</th>
                          <th>Tanggal Pinjam</th>
                          <th>Tanggal Kembali</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data as $d1) { ?>
                        <tr>
                          <td><?php echo $d1->id_pinjam ?></td>
                          <td><?php echo $d1->nim ?></td>
                          <td><?php echo $d1->name_peminjam ?></td>
                          <td><?php echo $d1->name_barang ?></td>
                          <td><?php echo $d1->tujuan ?></td>
                          <td><?php echo $d1->tgl_pinjam ?></td>
                          <td class="text-center"><?php if($d1->tgl_kembali == '0000-00-00 00:00:00')echo 'N/A'; else echo $d1->tgl_kembali; ?></td>
                          <td>
                            <?php if($d1->status == '0') echo "<div class='text-danger'>Pinjam Ditolak</div>";
                                  elseif($d1->status == '1') echo "<div class='text-success'>Dikembalikan</div>"; ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
    </div>
</div>