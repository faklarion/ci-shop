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
                    <span>Supplier</span>
                    <a href="<?= base_url('supplier/create') ?>" class="btn btn-sm btn-secondary">Tambah</a>

                    <div class="float-right">
                        <?= form_open(base_url('supplier/search'), ['method' => 'POST']) ?>
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control form-control-sm text-center" placeholder="Cari" value="<?= $this->session->userdata('keyword') ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-sm" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="<?= base_url('supplier/reset') ?>" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-eraser"></i>
                                    </a>
                                </div>
                            </div>
                        <?= form_close() ?>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Email</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach ($content as $row) : ?>
                                <tr>
                                    <td><?= ++$no ?></td>
                                    <td><?= $row->nama_supplier ?></td>
                                    <td><?= $row->alamat ?></td>
                                    <td><?= $row->no_hp ?></td>
                                    <td><?= $row->email ?></td>
                                    <td>
                                        <?= form_open("supplier/delete/$row->id", ['method' => 'POST']) ?>
                                            <?= form_hidden('id', $row->id) ?>
                                            <a href="<?= base_url("supplier/edit/$row->id") ?>" class="btn btn-sm">
                                                <i class="fas fa-edit text-info"></i>
                                            </a>
                                            <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        <?= form_close() ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation example">
                        <?= $pagination ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</main>