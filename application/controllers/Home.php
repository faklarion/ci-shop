<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function index($page = null)
    {
        $data['title'] = 'Homepage';
        $data['content']    = $this->home->select(
                [
                    'product.id', 'product.title AS product_title', 'product.description', 'product.image', 'product.price', 'product.is_available',
                    'category.title AS category_title', 'category.slug AS category_slug'
                ]
            )
            ->join('category')                  // Query untuk mencari suatu data produk beserta kategorinya
            ->where('product.is_available >', 0)  // Pilih yang stok tersedia
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->home->where('product.is_available >', 0)->count();
        $data['pagination'] = $this->home->makePagination(base_url('home'), 2, $data['total_rows']);
        $data['page'] = 'pages/home/index';     // Mengarahkan halaman

        $this->view($data);
    }

    public function dashboard() {
        // Ambil ID pengguna yang sedang login
        $user_id = $this->session->userdata('id');

        // Query untuk menghitung jumlah pesanan yang dilakukan oleh pengguna
        $total_orders = $this->db->where('id_user', $user_id)
                                 ->count_all_results('orders');

        // Query untuk mengambil jumlah poin pengguna
        $user_points = $this->db->select('point')
                                ->where('id', $user_id)
                                ->get('user')
                                ->row()
                                ->point;

        // Siapkan data untuk dikirim ke view
        $data = [
            'total_orders' => $total_orders,
            'user_points'  => $user_points
        ];

        // Muat halaman dashboard
        $data['title'] = 'Dashboard';
        $data['page'] = 'pages/home/dashboard';     // Mengarahkan halaman

        $this->view($data);
    }
}

/* End of file Home.php */
