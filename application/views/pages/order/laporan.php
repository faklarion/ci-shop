<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">PT. Sinar Kencana Inti Perkasa</h2>
        <h4 class="text-center mb-4">Laporan Order</h4>
        
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($data_order)) {
                    $no = 1;
                    foreach ($data_order as $order) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $order->invoice; ?></td>
                    <td><?php echo tanggalIndonesia($order->date); ?></td>
                    <td><?php echo $order->name; ?></td>
                    <td><?php echo $order->address; ?></td>
                    <td><?php echo $order->phone; ?></td>
                    <td>
                        <?php $this->load->view('layouts/_status', ['status' => $order->status]) ?>
                    </td>
                    <td><?php echo formatRupiah($order->total); ?></td>
                </tr>
                <?php 
                    } 
                } else {
                ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
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