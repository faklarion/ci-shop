<main role="main" class="container">

    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php $this->load->view('layouts/_alert') ?>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto">
            <div class="card">
                <div class="card-header">
                    <span>Order History</span>

                    <!-- <div class="float-right">
                        <?= form_open(base_url('order/search'), ['method' => 'POST']) ?>
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control form-control-sm text-center" placeholder="Cari" value="<?= $this->session->userdata('keyword') ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-sm" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="<?= base_url('order/reset') ?>" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-eraser"></i>
                                    </a>
                                </div>
                            </div>
                        <?= form_close() ?>
                    </div> -->
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tableHistory">
                        <thead>
                            <tr>
                                <th>Tanggal Update</th>
                                <th>Nomor</th>
                                <th>Tanggal Order</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($content as $row) : ?>
                                <tr>
                                    <td><?= str_replace('-', '/', date('d-m-Y h:m:s', strtotime($row->date_update))) ?></td>
                                    <td>
                                        <a href="<?= base_url("order/detail/$row->id") ?>"><strong>#<?= $row->invoice ?></strong></a>
                                    </td>
                                    <td><?= str_replace('-', '/', date('d-m-Y', strtotime($row->date))) ?></td>
                                    <td><?= $row->name ?></td>
                                    <td><?= $row->address ?></td>
                                    <td><?= $row->phone ?></td>
                                    <td>Rp.<?= number_format($row->total, 0, ',', '.') ?>,-</td>
                                    <td>
                                        <?php $this->load->view('layouts/_status', ['status' => $row->status]) ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</main>