<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url() ?>">PT. Sinar Kencana Inti Perkasa</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
			aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
				</li>

				<?php if ($this->session->userdata("role") === 'admin'): ?>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="dropdown-1" , data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false">Manage</a>
						<div class="dropdown-menu" aria-labelledby="dropdown-1">
							<a href="<?= base_url('category') ?>" class="dropdown-item">Kategori</a>
							<a href="<?= base_url('product') ?>" class="dropdown-item">Produk/Barang</a>
							<a href="<?= base_url('order') ?>" class="dropdown-item">Order</a>
							<a href="<?= base_url('user') ?>" class="dropdown-item">Pengguna</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="dropdown-1" , data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false">Laporan</a>
						<div class="dropdown-menu" aria-labelledby="dropdown-1">
							<a data-toggle="modal" data-target="#laporanBarang" class="dropdown-item">Laporan Barang</a>
							<a data-toggle="modal" data-target="#laporanStok" class="dropdown-item">Laporan Penambahan Stok
								Barang</a>
							<a data-toggle="modal" data-target="#laporanOrder" class="dropdown-item">Laporan Order</a>
							<a data-toggle="modal" data-target="#laporanPenghasilan" class="dropdown-item">Laporan Penghasilan Bulanan</a>
							<a data-toggle="modal" data-target="#laporanPenjualanBarang" class="dropdown-item">Laporan Penjualan Barang Bulanan</a>
						</div>
					</li>
				<?php endif ?>

			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="<?= base_url('cart') ?>" class="nav-link"><i class="fas fa-shopping-cart"></i>
						Cart<?= '(' . getCart() . ')' ?></a>
				</li>
				<?php if (!$this->session->userdata('is_login')): ?>
					<li class="nav-item">
						<a href="<?= base_url('login') ?>" class="nav-link">Login</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('register') ?>" class="nav-link">Register</a>
					</li>
				<?php else: ?>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="dropdown-2" , data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false"><?= $this->session->userdata("name") ?></a>
						<div class="dropdown-menu" aria-labelledby="dropdown-2">
							<a href="<?= base_url('profile') ?>" class="dropdown-item">Profile</a>
							<a href="<?= base_url('myorder') ?>" class="dropdown-item">Orders</a>
							<a href="<?= base_url('logout') ?>" class="dropdown-item">Logout</a>
						</div>
					</li>
				<?php endif ?>
			</ul>
		</div>
	</div>
</nav>

<!-- Modal Lap. Barang -->
<div id="laporanBarang" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- konten modal-->
		<div class="modal-content">
			<!-- heading modal -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Laporan Barang</h4>
			</div>
			<!-- body modal -->
			<div class="modal-body">
				<form action="<?php echo base_url('product/laporan') ?>" method="get">

					<label for="field1">Berdasarkan Kategori:</label>
					<select name="category" id="category" class="form-control mb-3">
						<?php
						$category = $this->db->select('*')
							->from('category')
							->get()
							->result();
						foreach ($category as $row) {
							?>
							<option value="<?php echo $row->id ?>"><?php echo $row->title ?></option>
						<?php } ?>
					</select>

					<input type="submit" value="Cetak" class="btn btn-sm btn-info" />
					<button type="submit" name="cetakSemua" class="btn btn-sm btn-primary">Cetak Semua</button>

				</form>
			</div>
			<!-- footer modal -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL -->

<!-- Modal Lap. Stok -->
<div id="laporanStok" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- konten modal-->
		<div class="modal-content">
			<!-- heading modal -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Laporan Penambahan Stok</h4>
			</div>
			<!-- body modal -->
			<div class="modal-body">
				<form action="<?php echo base_url('product/laporanStok') ?>" method="get">

					<div class="form-group">
						<label for="bulan">Pilih Bulan:</label>
						<select name="bulan" id="bulan" class="form-control">
							<?php
							$bulan = array(
								1 => 'Januari',
								'Februari',
								'Maret',
								'April',
								'Mei',
								'Juni',
								'Juli',
								'Agustus',
								'September',
								'Oktober',
								'November',
								'Desember'
							);
							foreach ($bulan as $num => $name) {
								echo "<option value=\"$num\">$name</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="tahun">Pilih Tahun:</label>
						<select name="tahun" id="tahun" class="form-control">
							<?php
							$start_year = 2000; // Tahun awal
							$end_year = date('Y'); // Tahun akhir (tahun sekarang)
							for ($i = $end_year; $i >= $start_year; $i--) {
								echo "<option value=\"$i\">$i</option>";
							}
							?>
						</select>
					</div>

					<input type="submit" value="Cetak" class="btn btn-sm btn-info" />
					<!-- <button type="submit" name="cetakSemua" class="btn btn-sm btn-primary">Cetak Semua</button> -->

				</form>
			</div>
			<!-- footer modal -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL -->

<!-- Modal Lap. Order -->
<div id="laporanOrder" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- konten modal-->
		<div class="modal-content">
			<!-- heading modal -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Laporan Order</h4>
			</div>
			<!-- body modal -->
			<div class="modal-body">
				<form action="<?php echo base_url('order/laporan') ?>" method="get">

					<div class="form-group">
						<label for="bulan">Pilih Bulan:</label>
						<select name="bulan" id="bulan" class="form-control">
							<?php
							$bulan = array(
								1 => 'Januari',
								'Februari',
								'Maret',
								'April',
								'Mei',
								'Juni',
								'Juli',
								'Agustus',
								'September',
								'Oktober',
								'November',
								'Desember'
							);
							foreach ($bulan as $num => $name) {
								echo "<option value=\"$num\">$name</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="tahun">Pilih Tahun:</label>
						<select name="tahun" id="tahun" class="form-control">
							<?php
							$start_year = 2000; // Tahun awal
							$end_year = date('Y'); // Tahun akhir (tahun sekarang)
							for ($i = $end_year; $i >= $start_year; $i--) {
								echo "<option value=\"$i\">$i</option>";
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="tahun">Pilih Status:</label>
						<select name="status" id="status" class="form-control">
							<?php 
							$statuses = array(
								'waiting' => 'Menunggu Pembayaran',
								'paid' => 'Terbayar',
								'delivered' => 'Dikirim',
								'cancel' => 'Dibatalkan'
							);
							echo "<option value='semua'>Semua</option>";
							foreach ($statuses as $key => $value) {
								$badge_class = '';
								switch ($key) {
									case 'waiting':
										$badge_class = 'badge-primary';
										break;
									case 'paid':
										$badge_class = 'badge-secondary';
										break;
									case 'delivered':
										$badge_class = 'badge-success';
										break;
									case 'cancel':
										$badge_class = 'badge-danger';
										break;
								}
								echo "<option value=\"$key\">$value</option>";
							}
							?>
						</select>
					</div>

					<input type="submit" value="Cetak" class="btn btn-sm btn-info" />
					<!-- <button type="submit" name="cetakSemua" class="btn btn-sm btn-primary">Cetak Semua</button> -->

				</form>
			</div>
			<!-- footer modal -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL -->

<!-- Modal Lap. Penghasilan -->
<div id="laporanPenghasilan" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- konten modal-->
		<div class="modal-content">
			<!-- heading modal -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Laporan Penghasilan Bulanan</h4>
			</div>
			<!-- body modal -->
			<div class="modal-body">
				<form action="<?php echo base_url('order/laporan_penghasilan') ?>" method="get">

					<div class="form-group">
						<label for="tahun">Pilih Tahun:</label>
						<select name="tahun" id="tahun" class="form-control">
							<?php
							$start_year = 2000; // Tahun awal
							$end_year = date('Y'); // Tahun akhir (tahun sekarang)
							for ($i = $end_year; $i >= $start_year; $i--) {
								echo "<option value=\"$i\">$i</option>";
							}
							?>
						</select>
					</div>
					<input type="submit" value="Cetak" class="btn btn-sm btn-info" />
					<!-- <button type="submit" name="cetakSemua" class="btn btn-sm btn-primary">Cetak Semua</button> -->

				</form>
			</div>
			<!-- footer modal -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL -->

<!-- Modal Lap. Stok -->
<div id="laporanPenjualanBarang" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- konten modal-->
		<div class="modal-content">
			<!-- heading modal -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Laporan Penjualan Barang</h4>
			</div>
			<!-- body modal -->
			<div class="modal-body">
				<form action="<?php echo base_url('order/laporan_penghasilan_barang') ?>" method="get">

					<div class="form-group">
						<label for="bulan">Pilih Bulan:</label>
						<select name="bulan" id="bulan" class="form-control">
							<?php
							$bulan = array(
								1 => 'Januari',
								'Februari',
								'Maret',
								'April',
								'Mei',
								'Juni',
								'Juli',
								'Agustus',
								'September',
								'Oktober',
								'November',
								'Desember'
							);
							foreach ($bulan as $num => $name) {
								echo "<option value=\"$num\">$name</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="tahun">Pilih Tahun:</label>
						<select name="tahun" id="tahun" class="form-control">
							<?php
							$start_year = 2000; // Tahun awal
							$end_year = date('Y'); // Tahun akhir (tahun sekarang)
							for ($i = $end_year; $i >= $start_year; $i--) {
								echo "<option value=\"$i\">$i</option>";
							}
							?>
						</select>
					</div>

					<input type="submit" value="Cetak" class="btn btn-sm btn-info" />
					<!-- <button type="submit" name="cetakSemua" class="btn btn-sm btn-primary">Cetak Semua</button> -->

				</form>
			</div>
			<!-- footer modal -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- END MODAL -->