<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Induk Inventaris
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('induk/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Data Induk Inventaris
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
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Klasifikasi Barang</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($induk_inventaris) :
                    $no = 1;
                    foreach ($induk_inventaris as $i) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $i['id_aset']; ?></td>
                            <td><?= $i['nama_aset']; ?></td>
                            <td><?= $i['merk']; ?></td>
                            <td><?= $i['tipe']; ?></td>
                            <td><?= $i['nama_jenis']; ?></td>
                             <td><?=$i['keterangan']; ?></td>
                            <th>
                                <a href="<?= base_url('induk/edit/') . $i['id_aset'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('induk/delete/') . $i['id_aset'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
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