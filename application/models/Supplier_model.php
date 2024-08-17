<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends MY_Model
{
    // Tidak perlu definisi (override) nama table secara manual karena nama model = nama table

    public function getDefaultValues()
    {
        return [
            'id'             => '',
            'nama_supplier'  => '',
            'alamat'         => '',
            'no_hp'          => '',
            'email'          => '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_supplier',
                'label' => 'Nama Supplier',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'no_hp',
                'label' => 'Nomer HP',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required'
            ]
        ];
        
        return $validationRules;
    }

    public function get_all() {
        $this->db->select("*");
        return $this->db->get('supplier')->result();
    }
}

/* End of file supplier_model.php */
