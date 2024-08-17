<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $role = $this->session->userdata('role');

        if ($role != 'admin') {
            redirect(base_url('/'));
            return;
        }
    }

    public function index($page = null)
    {
        $data['title']      = 'Admin: Supplier';
        $data['content']    = $this->supplier->paginate($page)->get();  // Mengambil data-data dalam bentuk objek
        $data['total_rows'] = $this->supplier->count();
        $data['pagination'] = $this->supplier->makePagination(          // Generate pagination link
            base_url('supplier'),
            2,                      // Offset ada pada url segment ke-2 (udah diatur di route)
            $data['total_rows']
        );
        $data['page']       = 'pages/supplier/index';

        $this->view($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('supplier'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']      = 'Admin: Supplier';
        $data['content']    = $this->supplier->like('nama_supplier', $keyword)->paginate($page)->get();
        $data['total_rows'] = $this->supplier->like('nama_supplier', $keyword)->count();
        $data['pagination'] = $this->supplier->makePagination(base_url('supplier/search'), 3, $data['total_rows']);
        $data['page']       = 'pages/supplier/index';

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');  // Clear dulu keyword dari session   
        redirect(base_url('supplier'));
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->supplier->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->supplier->validate()) {
            $data['title']          = 'Tambah Supplier';
            $data['input']          = $input;
            $data['form_action']    = base_url('supplier/create');
            $data['page']           = 'pages/supplier/form';

            $this->view($data);
            return;
        }

        if ($this->supplier->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
        }

        redirect(base_url('supplier'));
    }

    public function edit($id)
    {
        $data['content'] = $this->supplier->where('id', $id)->first();  // Ambil data dari id yang terpilih

        if (!$data['content']) {    // Jika data tidak ada di db
            $this->session->set_flashdata('warning', 'Maaf, data tidak ditemukan');
            redirect(base_url('supplier'));
        }

        if (!$_POST) {  // Jika tidak ada post berati user baru mulai edit
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->supplier->validate()) { // Jika tidak ada post ini tidak akan dieksekusi
            $data['title']          = 'Ubah Supplier';
            $data['form_action']    = base_url("supplier/edit/$id");
            $data['page']           = 'pages/supplier/form';

            $this->view($data);             // Lanjutkan ke form edit
            return;
        }

        if ($this->supplier->where('id', $id)->update($data['input'])) {    // Lakukan input & Jika input berhasil
            $this->session->set_flashdata('success', 'Data berhasil diperbaharui');
        } else {
            $this->session->set_flashdata('error', 'Oops, terjadi suatu kesalahan');
        }

        redirect(base_url('supplier'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            // Jika diakses tidak dengan menggunakan method post, kembalikan ke home (forbidden)
            redirect(base_url('supplier'));
        }

        if (!$this->supplier->where('id', $id)->first()) {  // Jika data tidak ditemukan
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan');
            redirect(base_url('supplier'));
        }

        if ($this->supplier->where('id', $id)->delete()) {  // // Lakukan delete & Jika delete berhasil
            $this->session->set_flashdata('success', 'Data sudah berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Oops, terjadi suatu kesalahan');
        }

        redirect(base_url('supplier'));
    }

    public function unique_slug()
    {
        $slug       = $this->input->post('slug');
        $id         = $this->input->post('id');
        $supplier   = $this->supplier->where('slug', $slug)->first(); // Akan terisi jika terdapat slug yang sama

        if ($supplier) {
            if ($id == $supplier->id) {  // Keperluan edit tidak perlu ganti slug, jadi tidak masalah
                return true;
            }

            // Jika terdapat suatu nilai pada $supplier, berikan pesan error pertanda slug sudah ada di db
            $this->load->library('form_validation');
            $this->form_validation->set_message('unique_slug', '%s sudah digunakan');
            return false;
        }

        return true;
    }
}

/* End of file supplier.php */
