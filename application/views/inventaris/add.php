<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card shadow-sm border-bottom-primary">
			<div class="card-header bg-white py-3">
				<div class="row">
					<div class="col">
						<h4 class="h5 align-middle m-0 font-weight-bold text-primary">
							Add Item Form
						</h4>
					</div>
					<div class="col-auto">
						<a href="<?= base_url('inventaris') ?>" class="btn btn-sm btn-secondary btn-icon-split">
							<span class="icon">
								<i class="fa fa-arrow-left"></i>
							</span>
							<span class="text">
								Back
							</span>
						</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<?= $this->session->flashdata('pesan'); ?>
				<?= form_open_multipart('inventaris/add'); ?>

				<!-- <div class="row form-group">
					<label class="col-md-3 text-md-left" for="id_barang">ID Barang</label>
					<div class="col-md-9">
						<input readonly value="<?= set_value('id_barang', $id_barang); ?>" name="id_barang" id="id_barang" type="text" class="form-control" placeholder="ID Barang...">
						<?= form_error('id_barang', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div> -->
				<div class="row form-group">
					<label class="col-md-3 text-md-left" for="aset_id">Barang</label>
					<div class="col-md-9">
						<div class="input-group">
							<select name="aset_id" id="aset_id" class="custom-select">
								<option value="" selected disabled>Pilih Aset</option>
								<?php foreach ($induk_inventaris as $i) : ?>
									<option <?= $this->uri->segment(3) == $i['id_aset'] ? 'selected' : '';  ?> <?= set_select('aset_id', $i['id_aset']) ?> value="<?= $i['id_aset'] ?>"><?= $i['id_aset'] . ' | ' . $i['nama_aset'] ?></option>
								<?php endforeach; ?>
							</select>
							<div class="input-group-append">
								<a class="btn btn-primary" href="<?= base_url('induk/add'); ?>"><i class="fa fa-plus"></i></a>
							</div>
						</div>
						<?= form_error('aset_id', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-left" for="foto">Gambar Barang</label>
					<div class="col-md-9">
						<input name="foto" id="foto" type="file"> <br>
						<small>Biarkan Kosong Jika Tidak Ada</small>
						<?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-3 text-md-left" for="no_seri">No. Seri Pabrik</label>
					<div class="col-md-9">
						<input value="<?= set_value('no_seri'); ?>" name="no_seri" id="no_seri" type="text" class="form-control">
						<?= form_error('no_seri', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-left" for="ukuran">Ukuran</label>
					<div class="col-md-9">
						<input value="<?= set_value('ukuran'); ?>" name="ukuran" id="ukuran" type="text" class="form-control">
						<?= form_error('ukuran', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-left" for="bahan">Bahan</label>
					<div class="col-md-9">
						<input value="<?= set_value('bahan'); ?>" name="bahan" id="bahan" type="text" class="form-control">
						<?= form_error('bahan', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-left" for="tgl_pemb">Tanggal Pembelian</label>
					<div class="col-md-9">
						<input value="<?= set_value('tgl_pemb', date('Y-m-d')); ?>" name="tgl_pemb" id="tgl_pemb" type="text" class="form-control date" placeholder="Tanggal Pembelian...">
						<?= form_error('tgl_pemb', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-left" for="harga_bel">Harga Beli</label>
					<div class="col-md-9">
						<input value="<?= set_value('harga_bel'); ?>" name="harga_bel" id="harga_bel" type="number" class="form-control" placeholder="Rp...">
						<?= form_error('harga_bel', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-left" for="sumber_dana">Sumber Dana</label>
					<div class="col-md-9">
						<input value="<?= set_value('sumber_dana'); ?>" name="sumber_dana" id="sumber_dana" type="text" class="form-control">
						<?= form_error('sumber_dana', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-left" for="kondisi_barang">Kondisi Barang</label>
					<div class="col-md-3">
						<div class="custom-control custom-radio">
							<input <?= set_radio('kondisi_barang', 'Baik'); ?> value="Baik" type="radio" id="Baik" name="kondisi_barang" class="custom-control-input">
							<label class="custom-control-label" for="Baik">Baik</label>
						</div>

						<?= form_error('kondisi_barang', '<span class="text-danger small">', '</span>'); ?>
					</div>
					<div class="col-md-3">
						<div class="custom-control custom-radio">
							<input <?= set_radio('kondisi_barang', 'Kurang Baik'); ?> value="Kurang Baik" type="radio" id="Kurang Baik" name="kondisi_barang" class="custom-control-input">
							<label class="custom-control-label" for="Kurang Baik">Rusak</label>
						</div>
						<?= form_error('kondisi_barang', '<span class="text-danger small">', '</span>'); ?>
					</div>
					<div class="col-md-3">
						<div class="custom-control custom-radio">
							<input <?= set_radio('kondisi_barang', 'Rusak Berat'); ?> value="Rusak Berat" type="radio" id="Rusak Berat" name="kondisi_barang" class="custom-control-input">
							<label class="custom-control-label" for="Rusak Berat">Rusak Berat</label>
						</div>
						<?= form_error('kondisi_barang', '<span class="text-danger small">', '</span>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-md-3 text-md-left" for="ruang_id">Lokasi</label>
					<div class="col-md-9">
						<div class="input-group">
							<select name="ruang_id" id="ruang_id" class="custom-select">
								<option value="" selected disabled>Pilih Ruang</option>
								<?php foreach ($ruang as $r) : ?>
									<option <?= set_select('ruang_id', $r['id_ruang']) ?> value="<?= $r['id_ruang'] ?>"><?= $r['nama_ruang'] ?></option>
								<?php endforeach; ?>
							</select>
							<div class="input-group-append">
								<a class="btn btn-primary" href="<?= base_url('ruang/add'); ?>"><i class="fa fa-plus"></i></a>
							</div>
						</div>
						<?= form_error('ruang_id', '<small class="text-danger">', '</small>'); ?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-9 offset-md-3">
						<button type="submit" class="btn btn-primary">Save</button>
						<button type="reset" class="btn btn-secondary">Reset</bu>
					</div>
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
