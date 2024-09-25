<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends MY_Model
{
    // protected $perPage = 5; -> Tidak perlu, sudah didefinisikan di kelas parent

    public function getDefaultValues()
    {
        return [
            'id_category'   => '',
            'slug'          => '',
            'title'         => '',
            'description'   => '',
            'price'         => '',
            'modal'         => '',
            'image'         => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'id_category',
                'label' => 'Kategory',
                'rules' => 'required'
            ],
            [
                'field' => 'slug',
                'label' => 'Slug',
                'rules' => 'trim|required|callback_unique_slug'
            ],
            [
                'field' => 'title',
                'label' => 'Nama Produk',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'description',
                'label' => 'Deskripsi',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'modal',
                'label' => 'Harga Modal',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'price',
                'label' => 'Harga Jual',
                'rules' => 'trim|required|numeric'
            ],
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'       => './images/product',
            'file_name'         => $fileName,
            'allowed_types'     => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'          => 1024,
            'max_width'         => 0,       // Tidak ada batas
            'max_height'        => 0,
            'overwrite'         => true,    // Jika nama sudah dipakai, overwrite saja
            'file_ext_tolower'  => true,    // Nama ekstensi diubah jadi lowercase
        ];

        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload($fieldName)) {
            // Jika upload berhasil, ambil nama data yang diupload untuk kemudian disimpan di db
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }

    public function deleteImage($fileName)
    {
        if (file_exists("./images/product/$fileName")) {
            unlink("./images/product/$fileName");
        }
    }

    public function getByCategory($categoryId) {
        $this->db->select("*, product.title as titleProduct,category.title as titleCategory");
        $this->db->join('category', 'category.id = product.id_category');
        $this->db->where('id_category', $categoryId);
        
        return $this->db->get('product')->result();
    }

    public function get_all() {
        $this->db->select("*, product.title as titleProduct,category.title as titleCategory");
        $this->db->join('category', 'category.id = product.id_category');
        return $this->db->get('product')->result();
    }

    public function get_riwayat_stok($bulan, $tahun) {
        $this->db->select("*");
        $this->db->join("product", 'product.id = stok_product.id_product');
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        return $this->db->get('stok_product')->result();
    }
}

/* End of file Product_model.php */
