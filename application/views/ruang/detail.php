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
                    <th>ID Barang</th>
                     <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Merk</th>
                   
                    <th>Nomor Seri Pabrik</th>
                    <th>Ukuran</th>

                    
                  
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
               
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?php echo $detail->id_ruang ?></td>
                             <td>
                                <img style="border: 1px solid #333333;width: 150px;height: 160px;position: relative;margin-left: 450px;" class="img-circle" src="<?= base_url() ?>assets/img/avatar/<?php echo $detail->foto ?>" alt="<?php echo $detail->nama_aset ?>" class="img-thumbnail rounded-circle">
                            </td>
                            <td><?= $b['nama_aset']; ?></td>
                             <td><?= $b['merk']; ?></td>
                            
                            <td><?= $b['no_seri']; ?></td>
                            <td><?= $b['ukuran']; ?></td>
                           
                       
                            
                             
                        </tr>
                        
            </tbody>
        </table>
    </div>
</div>