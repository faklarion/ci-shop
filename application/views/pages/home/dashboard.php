<!-- dashboard/index.php -->
<main role="main" class="container">
<div class="container">
    <h1 class="my-4">Dashboard</h1>
    <div class="row">
        <!-- Box untuk menampilkan jumlah pesanan -->
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Jumlah Pesanan</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $total_orders ?> Pesanan</h5>
                    <p class="card-text">Jumlah pesanan yang sudah Anda lakukan.</p>
                    <a href="<?= base_url('myorder') ?>" class="btn btn-light">Lihat Pesanan</a>
                </div>
            </div>
        </div>

        <!-- Box untuk menampilkan jumlah poin -->
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Poin Anda</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $user_points ?> Poin</h5>
                    <p class="card-text">Total poin yang Anda miliki. Poin ini dapat digunakan untuk keuntungan lebih lanjut.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
