<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Permintaan Peminjaman Ruangan
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
                          <th>NIM</th>
                          <th>Nama Peminjam</th>
                          <th>Nama Ruangan</th>
                          <th>Tujuan Peminjaman</th>
                          <th>Tanggal Pinjam</th>
                          <th>Setujui</th>
                          <th>Tolak</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($pinjamruang as $d1) { ?>
                        <tr>
                          <td><?php echo $d1->id_pinjam ?></td>
                          <td><?php echo $d1->nim ?></td>
                          <td><?php echo $d1->name_peminjam ?></td>
                          <td><?php echo $d1->name_ruang ?></td>
                          <td><?php echo $d1->tujuan ?></td>
                          <td><?php echo $d1->tgl_pinjam ?></td>
                          <td class="text-center">
                             <?= form_open_multipart('pinjam3/pinjam_setujui'); ?>
                           
                                                  <input type="hidden" name="id" value="<?php echo $d1->id_pinjam ?>">
                                                  <button class="btn btn-success btn-xs btn-edit" type="submit" data-original-title="Ubah" data-placement="top" data-toggle="tooltip"><i class="fa fa-check"></i> Setujui</button>
                            <?= form_close(); ?>
                          </td>
                          <td class="text-center">
                            <?= form_open_multipart('pinjam3/pinjam_tolak'); ?>
                              <input type="hidden" name="id_pinjam" value="<?php echo $d1->id_pinjam ?>">
                              <input type="hidden" name="id_user" value="<?php echo $d1->id_user ?>">
                              <input type="hidden" name="id_ruang" value="<?php echo $d1->id_ruang ?>">
                              <input type="hidden" name="tujuan" value="<?php echo $d1->tujuan ?>">
                              <input type="hidden" name="tgl_pinjam" value="<?php echo $d1->tgl_pinjam ?>">
                              <input type="hidden" name="tgl_kembali" value="<?php echo $d1->tgl_kembali ?>">
                                                  <input type="hidden" name="status" value="0">
                                                  <button class="btn btn-danger btn-xs btn-delete" type="submit" data-original-title="delete" data-placement="top" data-toggle="tooltip"><i class="fa fa-times"></i> Tolak</button>
                                             <?= form_close(); ?>
                          </td>
                        </tr>
                         <?php } ?>
                      </tbody>
                    </table>
    </div>
</div>