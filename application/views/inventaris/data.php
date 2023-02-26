<?php error_reporting(0); ?>
<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Inventaris
                </h4>
            </div>
               <?php if (is_sarpras()) : ?>
            <div class="col-auto">
                <a href="<?= base_url('inventaris/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Add Item
                    </span>
                </a>
            </div>
             <?php endif; ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive " id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Kode Aset</th>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Merk</th>
                    
                    <th>Nomor Seri Pabrik</th>
                    <th>Kondisi Barang</th>
                    <th>Ruangan</th>

                    
                    <th>Aksi</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($inventaris) :
                    foreach ($inventaris as $b) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['id_aset']; ?></td>
                             <td>
                                <img width="60px" style="border: 1px solid #333333;width: 60px;height: 65px;" class="img-circle" src="<?= base_url() ?>assets/img/avatar/<?= $b['foto'] ?>" alt="<?= $b['nama_aset']; ?>" class="img-thumbnail rounded-circle">
                            </td>
                            <td><?= $b['nama_aset']; ?></td>
                             <td><?= $b['merk']; ?></td>
                            
                            <td><?= $b['no_seri']; ?></td>
                            <td><?= $b['keterangan']; ?></td>
                            <td><?= $b['nama_ruang']; ?></td>
                           
                       
                            <td>
                                <a href="<?= base_url('inventaris/detail/') . $b['id_barang'] ?>" class="btn btn-info btn-circle btn-sm"><i class="fa fa-info"></i></a>  
                                <?php if (is_sarpras()) : ?>
                                <a href="<?= base_url('inventaris/edit/') . $b['id_barang'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                 
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('inventaris/delete/') . $b['id_barang'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                                <?php endif; ?>

                            </td>
                             
                        </tr>
                        
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="14" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>