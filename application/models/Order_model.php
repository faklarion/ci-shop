<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends MY_Model 
{
    public $table = 'orders';

    public function get_orders_history($bulan, $tahun, $status) {
        $this->db->select("*");
        $this->db->join('user', 'user.id = orders.id_user');
        $this->db->where('MONTH(date)', $bulan);
        $this->db->where('YEAR(date)', $tahun);
        if($status != 'semua') {
            $this->db->where('status', $status);
        }
        return $this->db->get($this->table)->result();
    }

    public function ambilPenghasilan($tahun) {
        // Ambil data penghasilan berdasarkan bulan
        $this->db->select('MONTH(date) as bulan, SUM(total) as total_penghasilan');
        $this->db->from($this->table); // Ganti dengan nama tabel yang sesuai
        $this->db->where('YEAR(date)', $tahun);
        $this->db->group_by('bulan');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_barang_bulanan($bulan, $tahun) {
        // Ambil data penghasilan berdasarkan bulan
        $this->db->select('id_product, product.title,, SUM(subtotal) as total, SUM(qty) as totalqty');
        $this->db->from('order_detail'); // Ganti dengan nama tabel yang sesuai
        $this->db->join('orders', 'orders.id = order_detail.id_orders');
        $this->db->join('product', 'product.id = order_detail.id_product');
        $this->db->where('MONTH(orders.date)', $bulan);
        $this->db->where('YEAR(orders.date)', $tahun);
        $this->db->group_by('id_product');
        $query = $this->db->get();
        return $query->result();
    }

}



/* End of file Order_model.php */
