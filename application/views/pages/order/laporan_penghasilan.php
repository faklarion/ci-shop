<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penghasilan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">PT. Sinar Kencana Inti Perkasa</h2>
        <h4 class="text-center">Laporan Penghasilan Bulanan</h4>
        <p class="text-center">Tahun <?php echo $tahun ?></p>
        
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Bulan</th>
                    <th>Total Penghasilan</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                // Array bulan untuk menampilkan nama bulan
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

                // Inisialisasi array untuk menyimpan hasil penghasilan
                $penghasilan_bulanan = array_fill(1, 12, 0);

                // Populate data penghasilan
                foreach ($penghasilan as $data) {
                    $penghasilan_bulanan[$data->bulan] = $data->total_penghasilan;
                }

                // Tampilkan data penghasilan
                foreach ($bulan as $num => $name) {
                    echo "<tr>
                            <td>$name</td>
                            <td>" . formatRupiah($penghasilan_bulanan[$num]) . "</td>
                          </tr>";
                }
                ?>
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