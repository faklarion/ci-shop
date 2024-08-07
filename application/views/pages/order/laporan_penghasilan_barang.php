<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">PT. Sinar Kencana Inti Perkasa</h2>
        <h4 class="text-center">Laporan Penjualan Barang Bulanan</h4>
        <p class="text-center">Bulan <?php echo angkaKeNamaBulan($bulan); ?> Tahun <?php echo $tahun ?></p>
        
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Total Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                    $no = 1;
                    foreach ($penghasilan as $row): ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row->title ?></td>
                        <td><?php echo $row->totalqty ?></td>
                        <td><?php echo formatRupiah($row->total) ?></td>
                    </tr>
                <?php endforeach; ?>
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