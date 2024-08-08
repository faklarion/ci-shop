<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Penghasilan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #penghasilanChart {
            width: 100% !important;
            height: auto !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">PT. Sinar Kencana Inti Perkasa</h2>
        <h4 class="text-center">Grafik Penghasilan Bulanan</h4>
        <p class="text-center">Tahun <?php echo $tahun ?></p>
        
        <canvas id="penghasilanChart"></canvas>

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
            var ctx = document.getElementById('penghasilanChart').getContext('2d');

            var penghasilanChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        <?php
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
                        foreach ($bulan as $name) {
                            echo "'$name',";
                        }
                        ?>
                    ],
                    datasets: [{
                        label: 'Total Penghasilan',
                        data: [
                            <?php
                            $penghasilan_bulanan = array_fill(1, 12, 0);
                            foreach ($penghasilan as $data) {
                                $penghasilan_bulanan[$data->bulan] = $data->total_penghasilan;
                            }
                            foreach ($penghasilan_bulanan as $total) {
                                echo ''.($total).',';
                            }
                            ?>
                        ],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
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
</body>
</html>
