<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Pengajuan Penghapusan
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('hapus/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Data Pengajuan Penghapusan Aset
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIM/NIP</th>
                    <th>Nama Pengaju</th>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Alasan Penghapusan Aset</th>
                    <?php if (is_sarpras()) : ?>
                    <th>Aksi</th>
                     <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($hapus) :
                    $no = 1;
                    foreach ($hapus as $i) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $i['no_induk']; ?></td>
                            <td><?= $i['nama']; ?></td>
                            <td><?= $i['id_aset']; ?></td>
                            <td><?= $i['nama_aset']; ?></td>
                            <td><?= format_indo($i['tgl_pengajuan']); ?></td>
                              <td><?= $i['alasan']; ?></td>
                          
                           <?php if (is_sarpras()) : ?>
                            <th>
                               <!--  <a href="<?= base_url('hapus_aset/edit/') . $i['id_hapus'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a> -->
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('hapus/delete/') . $i['id_hapus'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
                               <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>