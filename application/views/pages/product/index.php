<main role="main" class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php $this->load->view('layouts/_alert') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span>Produk</span>
                    <a href="<?= base_url('product/create') ?>" class="btn btn-sm btn-secondary">Tambah</a>

                    <!-- <div class="float-right">
                        <form action="<?= base_url('product/search') ?>" method="POST">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control form-control-sm text-center" placeholder="Cari" value="<?= $this->session->userdata('keyword') ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-sm" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="<?= base_url('product/reset') ?>" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-eraser"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div> -->
                </div>
                <div class="card-body">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="true">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="stok-tab" data-toggle="tab" href="#stok" role="tab" aria-controls="another" aria-selected="false">Riwayat Penambahan Stok</a>
                        </li>
                        <!-- Add more tabs as needed -->
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
                            <table class="table mt-3" id="productTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Modal</th>
                                        <th scope="col">Harga Jual</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; foreach ($content as $row) : ?>
                                        <tr>
                                            <td><?= ++$no ?></td>
                                            <td>
                                                <p>
                                                    <img src="<?= $row->image ? base_url("images/product/$row->image") : base_url("images/product/default.png") ?>" alt="" height="50"> <?= $row->product_title ?>
                                                </p>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary"><i class="fas fa-tags"></i> <?= $row->category_title ?></span>
                                            </td>
                                            <td>Rp.<?= number_format($row->modal, 0, ',', '.') ?>,-</td>
                                            <td>Rp.<?= number_format($row->price, 0, ',', '.') ?>,-</td>
                                            <td><?= $row->is_available ?> 
                                                <a href="<?= base_url("product/add_stok/$row->id") ?>" class="btn btn-sm">
                                                    <i class="fa fa-plus text-success"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <?= form_open(base_url("product/delete/$row->id"), ['method' => 'POST']) ?>
                                                    <?= form_hidden('id', $row->id) ?>
                                                    
                                                    <a href="<?= base_url("product/edit/$row->id") ?>" class="btn btn-sm">
                                                        <i class="fas fa-edit text-info"></i>
                                                    </a>
                                                    <button type="submit" class="btn btn-sm" onclick="return confirm('Apakah yakin ingin menghapus?')">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                <?= form_close() ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            
                        </div>

                        <!-- Another Tab Content -->
                        <div class="tab-pane fade" id="stok" role="tabpanel" aria-labelledby="stok-tab">
                            <!-- Content for another tab -->
                            <table class="table mt-3" id="stokTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Stok Bertambah</th>
                                        <th scope="col">Supplier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; foreach ($stok as $row) : ?>
                                        <tr>
                                            <td><?= ++$no ?></td>
                                            <td><?= $row->title?></td>
                                            <td><?= tgl_indo($row->tanggal) ?></td>
                                            <td><?= $row->stok?></td>
                                            <td><?= $row->nama_supplier?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            
                        </div>
                        <!-- Add more tab content sections as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
