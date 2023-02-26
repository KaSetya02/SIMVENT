<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Ruangan
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
                          <th>ID</th>
                          <th>No Ruangan</th>
                          <th>Nama Ruangan</th>
                          <th>Kondisi Ruangan</th>
                          <th>Pinjam</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($ruang as $i) { ?>
                        <tr>
                            <td><?= $i['id_ruang']; ?></td>
                            <td><?= $i['no_ruang']; ?></td>
                            <td><?= $i['nama_ruang']; ?></td>
                            <td><?= $i['kondisi_ruang']; ?></td>
                          <td class="text-center">
                             <?php if($i['kondisi_ruang'] == 'Isi Atau Sedang Digunakan' or $i['kondisi_ruang'] == 'Dalam Perbaikan' or $i['kondisi_ruang'] == 'Rusak' or $i['kondisi_ruang'] == 'Rusak Berat'){ ?>
                                  N/A
                         <?php }else{ ?>
                          
                            <?= form_open_multipart('pinjam4/ruangan_pinjam'); ?>
                                                  <input type="hidden" name="id" value="<?= $i['id_ruang']; ?>">
                                                  <button class="btn btn-danger btn-xs btn-delete" type="submit" data-original-title="delete" data-placement="top" data-toggle="tooltip"><i class="fa fa-book"></i> Pinjam</button>
                         <?= form_close(); ?>
                          <?php } ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
    </div>
</div>