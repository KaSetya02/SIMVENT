<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Ruangan
                </h4>
            </div>
               <?php if (is_sarpras()) : ?>
            <div class="col-auto">
                <a href="<?= base_url('ruang/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Data Ruangan
                    </span>
                </a>
            </div>
              <?php endif; ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
               <!--      <th>ID Ruang </th> -->
                    <th>Nomor Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Kondisi Ruangan</th>
                    <?php if (is_sarpras()) : ?>
                    <th>Aksi</th>
                     <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($ruang) :
                    foreach ($ruang as $r) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                          <!--   <td><?= $r['id_ruang']; ?></td> -->
                            <td><?= $r['no_ruang']; ?></td>
                            <td><?= $r['nama_ruang']; ?></td>
                            <td><?= $r['kondisi_ruang']; ?></td>
                             <?php if (is_sarpras()) : ?>
                            <td>
                                <!-- <a href="<?= base_url('ruang/detail/') . $r['id_ruang'] ?>" class="btn btn-info btn-circle btn-sm"><i class="fa fa-info"></i></a>   -->
                                <a href="<?= base_url('ruang/edit/') . $r['id_ruang'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('ruang/delete/') . $r['id_ruang'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                                  <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
