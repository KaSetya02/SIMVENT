<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                     Ruangan Dipinjam
                </h4>
            </div>
            <!-- <div class="col-auto">
                <a href="<?= base_url('satuan/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Barang Dipinjam
                    </span>
                </a>
            </div> -->
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                        <tr>
                          <th>ID Pinjam</th>
                          <th>NIM</th>
                          <th>Nama Peminjam</th>
                          <th>ID Ruangan</th>
                          <th>Tujuan Peminjaman</th>
                          <th>Tanggal Pinjam</th>
                          <th>Tanggal Kembali</th>
                          <th>Status</th>
                          <th>Kembalikan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($pinjamruang as $d1) { ?>
                        <tr>
                          <td><?= $d1['id_pinjam']; ?></td>
                          <td><?= $d1['no_induk']; ?></td>
                          <td><?= $d1['nama']; ?></td>
                          <td><?= $d1['nama_ruang']; ?></td>
                          <td><?= $d1['tujuan']; ?></td>
                          <td><?= $d1['tgl_pinjam']; ?></td>
                          <td class="text-center">
                            <?php if($d1['tgl_kembali'] == "0000-00-00 00:00:00") echo "N/A"; else echo $d1['tgl_kembali'];?>
                          </td>
                          <td>
                            <?php if($d1['status'] == '0') echo "<div class='text-primary'>Menunggu Peminjaman...</div>";
                                  elseif($d1['status'] == '1') echo "<div class='bg-success'>Sedang Dipinjam</div>";
                                  elseif($d1['status'] == '2') echo "<div class='text-success'>Menunggu Pengembalian...</div>"; ?>
                          </td>
                          <td class="text-center">
                            <?php if($d1['status'] == '1' && $d1['nama'] == userdata('nama')){ ?>
                               <?= form_open_multipart('pinjam4/pinjam_kembali'); ?>
                              <input type="hidden" name="tgl_kembali" value="<?php echo  date('Y-m-d H:i:s') ?>">
                                                  <input type="hidden" name="id" value="<?= $d1['id_pinjam']; ?>">
                                                  <button class="btn btn-danger btn-xs btn-delete" type="submit" data-original-title="delete" data-placement="top" data-toggle="tooltip"><i class="fa fa-undo"></i> Kembalikan</button>
                                            <?= form_close(); ?>
                          <?php }else{ ?>
                            N/A
                          <?php } ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
    </div>
</div>