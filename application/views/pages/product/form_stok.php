<main role="main" class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <span>Tambah Stok Produk</span>
                </div>
                <div class="card-body">
                    <form action="<?php echo $form_action; ?>" method="post" enctype='multipart/form-data'>

                        <table class='table table-bordered'>

                            <tr>
                                <td width='200'>Nama Barang/Produk</td>
                                <td><input type="text" class="form-control" name="title" id="title"
                                        placeholder="Nama Barang" value="<?php echo $content->title; ?>" readonly/></td>
                            </tr>
                            <tr>
                                <td width='200'>Pembambahan Stok</td>
                                <td><input type="number" class="form-control" name="is_available" id="is_available"
                                        placeholder="Tambah Stok" required /></td>
                            </tr>

                            <tr>
                                <td width='200'>Supplier</td>
                                <td><input type="text" class="form-control" name="supplier" id="supplier"
                                        placeholder="Nama Supploer" required /></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $content->id; ?>" />
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-floppy-o"></i>
                                        Simpan</button>
                                    <a href="<?php echo site_url('product') ?>" class="btn btn-info"><i
                                            class="fas fa-sign-out"></i> Kembali</a>
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>