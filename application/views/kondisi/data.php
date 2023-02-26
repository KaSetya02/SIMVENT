<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Kondisi Aset
                </h4>
            </div>
                <?php if (is_sarpras()) : ?>
            <div class="col-auto">
                <a href="<?= base_url('kondisi/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Data Kondisi Aset
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
                    <th>Kode Aset </th>
                    <th>Nama Aset</th>
                    <th>Kondisi Aset</th>
                    <!-- <th>Lokasi</th> -->
                     <?php if (is_sarpras()) : ?>
                    <th>Aksi</th>
                     <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($kondisi) :
                    foreach ($kondisi as $k) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $k['aset_id']; ?></td>
                            <td><?= $k['nama_aset']; ?></td>
                            <td><?= $k['keterangan']; ?></td>
                            <!-- <td><?= $k['nama_ruang']; ?></td> -->
                                <?php if (is_sarpras()) : ?>
                            <td>
                                <!-- <a href="<?= base_url('kondisi/edit/') . $k['id_kondisi'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a> -->
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('kondisi/delete/') . $k['id_kondisi'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
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