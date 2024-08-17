<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 80% !important;
            height: auto !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">PT. Wahana Inti Selaras</h2>
        <h4 class="text-center">Laporan Penjualan Barang Bulanan</h4>
        <p class="text-center">Bulan <?php echo angkaKeNamaBulan($bulan); ?> Tahun <?php echo $tahun ?></p>
    
        <div class="row d-flex justify-content-center">
            <div class="chart-container">
                <canvas id="penjualanChart"></canvas>
            </div>
        </div>

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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('penjualanChart').getContext('2d');

            var penjualanChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [
                        <?php
                        foreach ($penghasilan as $row) {
                            echo "'" . $row->title . "',";
                        }
                        ?>
                    ],
                    datasets: [{
                        label: 'Total',
                        data: [
                            <?php
                            foreach ($penghasilan as $row) {
                                echo $row->total . ",";
                            }
                            ?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: true,
                    responsive: true,
                }
            });

            window.print();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
