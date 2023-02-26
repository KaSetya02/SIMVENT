
<div class="content">

    <table class="table table-striped w-100 dt-responsive " id="dataTable">
    	<tr></tr>
    	<img style="border: 1px solid #333333;width: 150px;height: 160px;position: relative;margin-left: 450px;" class="img-circle" src="<?= base_url() ?>assets/img/avatar/<?php echo $detail->foto ?>" alt="<?php echo $detail->nama_aset ?>" class="img-thumbnail rounded-circle">
    	</tr>
        <tr>
            <td width="20%">ID Barang</td>
            <td width="1%">:</td>
            <td><?php echo $detail->id_barang ?></td>
        </tr>
        <tr>
            <td>Nama Barang</td>
            <td width="1%">:</td>
            <td><?php echo $detail->nama_aset ?></td>
        </tr>
        <tr> 
            <td>Merk</td>
            <td width="1%">:</td>
            <td><?php echo $detail->merk ?></td>
        </tr>
        <tr>
            <td>No. Seri Pabrik</td>
            <td width="1%">:</td>
            <td><?php echo $detail->no_seri ?></td>
        </tr>
        <tr>
            <td>Ukuran</td>
            <td width="1%">:</td>
            <td><?php echo $detail->ukuran ?></td>
        </tr>
        <tr> 
            <td>Bahan</td>
            <td width="1%">:</td>
            <td><?php echo $detail->bahan ?></td>
        </tr>
        <tr>
            <td>Tanggal Pembelian</td>
            <td width="1%">:</td>
           <td><?php echo format_indo($detail->tgl_pemb) ?> </td>
        </tr>
        <tr>
            <td>Harga Beli</td>
            <td width="1%">:</td>
           <td>Rp <?php echo number_format($detail->harga_bel)  ?></td>
        </tr>
        <tr>
            <td>Sumber Dana</td>
            <td width="1%">:</td>
           <td><?php echo $detail->sumber_dana ?></</td>
        </tr>
        <tr>
            <td>Kondisi Barang</td>
            <td width="1%">:</td>
           <td><?php echo $detail->keterangan ?></</td>
        </tr>
         <tr>
            <td>Ruangan</td>
            <td width="1%">:</td>
           <td><?php echo $detail->nama_ruang ?><//td>
        </tr>
     
     </table>
</div>
<a href="<?= base_url('inventaris') ?>" class="btn btn-primary">Kembali</a>
