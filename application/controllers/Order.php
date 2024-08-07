<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller order admin
 */
class Order extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $role = $this->session->userdata('role');

        if ($role != 'admin') {
            redirect(base_url('/'));
            return;
        }

        $this->load->model('Order_model');
    }

    public function index($page = null)
    {
        $data['title']      = 'Admin: Order';
        $data['content']    = $this->order->orderBy('date', 'DESC')->paginate($page)->get();
        $data['total_rows'] = $this->order->count();
        $data['pagination'] = $this->order->makePagination(
            base_url('order'), 2, $data['total_rows']
        );
        $data['page']       = 'pages/order/index';

        $this->view($data);
    }

    /**
     * Menampilkan detail dari order user yang masuk
     */
    public function detail($id)
    {
        $data['order']  = $this->order->where('id', $id)->first();

        if (!$data['order']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan');
            redirect(base_url('order'));
        }

        $this->order->table   = 'order_detail';
        $data['order_detail']   = $this->order->select([
                'order_detail.id_orders', 'order_detail.id_product', 'order_detail.qty', 'order_detail.subtotal', 'product.title', 'product.image', 'product.price'
            ])
            ->join('product')
            ->where('order_detail.id_orders', $id)
            ->get();

        if ($data['order']->status !== 'waiting') {     // Jika status sudah tidak waiting (sudah konfirmasi)
            // Ambil order yang sudah dikonfirmasi dari tabel orders_confirm
            // Informasi ini untuk ditampilkan di footer
            $this->order->table   = 'orders_confirm';
            $data['order_confirm']  = $this->order->where('id_orders', $id)->first();
        }

        $data['page']   = 'pages/order/detail';

        $this->view($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('order'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']      = 'Admin: Order';
        $data['content']    = $this->order->like('invoice', $keyword)
                                ->orderBy('date', 'DESC')   // Urutkan tanggal terbaru
                                ->paginate($page)->get();
        $data['total_rows'] = $this->order->like('invoice', $keyword)->count();
        $data['pagination'] = $this->order->makePagination(base_url('order/search'), 3, $data['total_rows']);
        $data['page']       = 'pages/order/index';

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('order'));
    }

    /**
     * Mengubah status order
     */
    public function update($id)
    {
        if (!$_POST) {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
            redirect(base_url("order/detail/$id"));
        }

        if ($this->order->where('id', $id)->update(['status' => $this->input->post('status')])) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
        }

        redirect(base_url("order/detail/$id"));
    }

    public function laporan() {
        $bulan  = $this->input->get("bulan");
        $tahun  = $this->input->get("tahun");
        $status = $this->input->get("status");

        $data['data_order'] = $this->Order_model->get_orders_history($bulan, $tahun, $status);

        $this->load->view('pages/order/laporan', $data);
    }

    public function laporan_penghasilan() {
        $tahun  = $this->input->get("tahun");

        $data['tahun'] = $tahun;
        $data['penghasilan'] = $this->Order_model->ambilPenghasilan($tahun);

        $this->load->view('pages/order/laporan_penghasilan', $data);
    }

    public function laporan_penghasilan_barang() {
        $tahun  = $this->input->get("tahun");
        $bulan  = $this->input->get("bulan");

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['penghasilan'] = $this->Order_model->get_barang_bulanan($bulan,$tahun);

        $this->load->view('pages/order/laporan_penghasilan_barang', $data);
    }
}

/* End of file Order.php */
