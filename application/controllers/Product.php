<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $role = $this->session->userdata('role');

        if ($role != 'admin') {
            redirect(base_url('/'));
            return;
        }
        $this->load->model('Product_model');
    }

    public function index($page = null)
    {
        $data['title']      = 'Admin: Produk';
        $data['content']    = $this->product->select(
                [
                    'product.id', 'product.title AS product_title', 'product.image', 'product.price', 'product.is_available',
                    'category.title AS category_title'
                ]
            )
            ->join('category')     // Query untuk mencari suatu data produk beserta kategorinya
            ->paginate($page)
            ->get();
        $data['stok']    = $this->db->select('*')
            ->from('stok_product')
            ->join('product', 'product.id = stok_product.id_product')
            ->join('supplier', 'supplier.id = stok_product.supplier')
            ->get()
            ->result();
        $data['total_rows'] = $this->product->count();
        $data['pagination'] = $this->product->makePagination(base_url('product'), 2, $data['total_rows']);
        $data['page']       = 'pages/product/index';

        $this->view($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('product'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']      = 'Admin: Produk';
        $data['content']    = $this->product->select(
                [
                    'product.id', 'product.title AS product_title', 'product.image', 'product.price', 'product.is_available',
                    'category.title AS category_title'
                ]
            )
            ->join('category')
            ->like('product.title', $keyword)
            ->orLike('description', $keyword)   // Tidak hanya mencari di title melainkan di desc juga
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->product->like('product.title', $keyword)->orLike('description', $keyword)->count();
        $data['pagination'] = $this->product->makePagination(base_url('product/search'), 3, $data['total_rows']);
        $data['page']       = 'pages/product/index';

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');  // Clear dulu keyword dari session   
        redirect(base_url('product'));
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->product->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {   // Jika upload'an tidak kosong
            $imageName  = url_title($input->title, '-', true) . '-' . date('YmdHis');  // Membuat slug
            $upload     = $this->product->uploadImage('image', $imageName);    // Mulai upload
            if ($upload) {
                // Jika upload berhasil, pasang nama file yang diupload ke dalam database
                $input->image   = $upload['file_name'];
            } else {
                redirect(base_url('product/create'));
            }
        }

        if (!$this->product->validate()) {
            $data['title']          = 'Tambah Produk';
            $data['input']          = $input;
            $data['form_action']    = base_url('product/create');
            $data['page']           = 'pages/product/form';

            $this->view($data);
            return;
        }

        if ($this->product->create($input)) {   // Jika insert berhasil
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
        }

        redirect(base_url('product'));
    }

    public function edit($id)
    {
        $data['content'] = $this->product->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('product'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {   // Jika upload'an tidak kosong
            $imageName  = url_title($data['input']->title, '-', true) . '-' . date('YmdHis');  // Membuat slug
            $upload     = $this->product->uploadImage('image', $imageName);    // Mulai upload
            if ($upload) {
                if ($data['content']->image !== '') {
                    // Jika data di database ini memiliki gambar, maka hapus dulu file gambarnya
                    $this->product->deleteImage($data['content']->image);
                }
                // Jika upload berhasil, pasang nama file yang diupload ke dalam database
                $data['input']->image   = $upload['file_name'];
            } else {
                redirect(base_url("product/edit/$id"));
            }
        }

        if (!$this->product->validate()) {
            $data['title']          = 'Ubah Produk';
            $data['form_action']    = base_url("product/edit/$id");
            $data['page']           = 'pages/product/form';

            $this->view($data);
            return;
        }

        if ($this->product->where('id', $id)->update($data['input'])) {   // Update data
            $this->session->set_flashdata('success', 'Data berhasil diubah');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
        }

        redirect(base_url('product'));
    }

    public function add_stok($id)
    {
        $data['content'] = $this->product->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('product'));
        }


        if (!$this->product->validate()) {
            $data['supplier']       =  $this->db->select('*')
                                        ->from('supplier')
                                        ->get()
                                        ->result();
            $data['title']          = 'Tambah Stok Produk';
            $data['form_action']    = base_url("product/add_stok_action");
            $data['page']           = 'pages/product/form_stok';
            $data['content'] = $this->product->where('id', $id)->first();

            $this->view($data);
            return;
        }
    }

    public function add_stok_action()
    {

            $product = $this->product->where('id', $this->input->post('id'))->first();

            $stok = $product->is_available;

            $data = array(
               'is_available' => $stok + $this->input->post('is_available'),
            );

            $date = new DateTime('now', new DateTimeZone('Asia/Makassar'));
            // Format the date as needed
            $current_date = $date->format('Y-m-d H:i:s');
            
            $dataStok = array(
                'stok' => $this->input->post('is_available'),
                'tanggal'=> $current_date,
                'supplier'=> $this->input->post('supplier'),
                'id_product'=> $this->input->post('id'),
             );
            
            $this->db->insert('stok_product', $dataStok);
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('product', $data);
            $this->session->set_flashdata('success', 'Stok berhasil ditambahkan');
            redirect(site_url('product'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('product'));
        }

        $product = $this->product->where('id', $id)->first();

        if (!$product) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('product'));
        }

        if ($this->product->where('id', $id)->delete()) {   // Lakukan penghapusan di db
            $this->product->deleteImage($product->image);   // Lakukan penghapusan gambar
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan');
        }

        redirect(base_url('product'));
    }

    public function unique_slug()
    {
        $slug       = $this->input->post('slug');
        $id         = $this->input->post('id');
        $product    = $this->product->where('slug', $slug)->first(); // Akan terisi jika terdapat slug yang sama

        if ($product) {
            if ($id == $product->id) {  // Keperluan edit tidak perlu ganti slug, jadi tidak masalah
                return true;
            }

            // Jika terdapat suatu nilai pada $product, berikan pesan error pertanda slug sudah ada di db
            $this->load->library('form_validation');
            $this->form_validation->set_message('unique_slug', '%s sudah digunakan');
            return false;
        }

        return true;
    }

    public function laporan() {
        $categoryId = $this->input->get('category');
        $cetakSemua = $this->input->get('cetakSemua');

        if(isset($cetakSemua)) {
            $data['data_product'] = $this->Product_model->get_all();
        } else {
            $data['data_product'] = $this->Product_model->getByCategory($categoryId);
        }

        $this->load->view('pages/product/laporan', $data);
    }

    public function laporanStok() {
        $bulan  = $this->input->get('bulan');
        $tahun  = $this->input->get('tahun');

        $data['data_stok'] = $this->Product_model->get_riwayat_stok($bulan, $tahun);

        $this->load->view('pages/product/laporan_stok', $data);
    }

    
    public function grafik_stok() {
        $categoryId = $this->input->get('category');
        $cetakSemua = $this->input->get('cetakSemua');

        if(isset($cetakSemua)) {
            $data['data_product'] = $this->Product_model->get_all();
        } else {
            $data['data_product'] = $this->Product_model->getByCategory($categoryId);
        }

        $this->load->view('pages/product/grafik_stok', $data);
    }
}

/* End of file Product.php */
