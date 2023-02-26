<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Permintaan Pengembalian Barang
                </h4>
            </div>
            <!-- <div class="col-auto">
                <a href="<?= base_url('jenis/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tamabah Data Kelas Aset
                    </span>
                </a>
            </div> -->
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
                          <th>Setujui</th>
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
                          <td><?php echo $d1->tgl_kembali ?></td>
                          <td class="text-center">
                              <?= form_open_multipart('pinjam/kembali_setujui'); ?>
                         
                              <input type="hidden" name="id_pinjam" value="<?php echo $d1->id_pinjam ?>">
                              <input type="hidden" name="id_user" value="<?php echo $d1->id_user ?>">
                              <input type="hidden" name="id_aset" value="<?php echo $d1->id_aset ?>">
                              <input type="hidden" name="tujuan" value="<?php echo $d1->tujuan ?>">
                              <input type="hidden" name="tgl_pinjam" value="<?php echo $d1->tgl_pinjam ?>">
                              <input type="hidden" name="tgl_kembali" value="<?php echo $d1->tgl_kembali ?>">
                                                  <input type="hidden" name="status" value="1">
                                                  <button class="btn btn-success btn-xs btn-edit" type="submit" data-original-title="Ubah" data-placement="top" data-toggle="tooltip"><i class="fa fa-check"></i> Setujui</button>
                                              <?= form_close(); ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
    </div>
</div>