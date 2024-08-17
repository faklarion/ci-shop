<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
        .chart-container {
            width: 100% !important;
            height: auto !important;
        }
    </style>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">PT. Wahana Inti Selaras</h2>
        <h4 class="text-center mb-4">Laporan Produk</h4>
        
        <div class="d-flex justify-content-center">
            <div class="chart-container">
                <canvas id="produkChart"></canvas>
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        window.print();
    </script>
</body>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('produkChart').getContext('2d');

            var produkChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        <?php
                        if(!empty($data_product)) {
                            foreach ($data_product as $product) {
                                echo "'" . $product->titleProduct . "',";
                            }
                        }
                        ?>
                    ],
                    datasets: [{
                        label: 'Stok',
                        data: [
                            <?php
                            if(!empty($data_product)) {
                                foreach ($data_product as $product) {
                                    echo $product->is_available . ",";
                                }
                            }
                            ?>
                        ],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: true,
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            window.print();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</html>