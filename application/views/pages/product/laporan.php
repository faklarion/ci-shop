<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">PT. Wahana Inti Selaras</h2>
        <h4 class="text-center mb-4">Laporan Produk</h4>
        
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($data_product)) {
                    $no = 1;
                    foreach ($data_product as $product) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $product->titleProduct; ?></td>
                    <td><?php echo $product->titleCategory; ?></td>
                    <td><?php echo formatRupiah($product->price); ?></td>
                    <td><?php echo $product->is_available; ?></td>
                </tr>
                <?php 
                    } 
                } else {
                ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="mt-5">
            <div class="row">
                <div class="col-md-6 text-right">
                    <p><?php echo tanggalIndonesia(date('Y-m-d')); ?></p>
                    <p>Mengetahui,</p>
                    <br><br>
                    <p>(____________________)</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        window.print();
    </script>
</body>
</html>