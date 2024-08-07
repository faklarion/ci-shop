<?php

/**
 * Fungsi untuk memuat data dengan format option (Drowdown)
 * Param table   : table mana yang akan dimuat
 * Param columns : berupa key column apa saja yang diambil
 */
function getDropdownList($table, $columns)
{
    $CI =& get_instance();  // Memanggil core system dari CI, agar kita dapat memanggil class2 dari CI
    $query = $CI->db->select($columns)->from($table)->get();

    if ($query->num_rows() >= 1) {
        // '' sebagai value dari option select & select akan muncul di browser
        $option1 = ['' => '- Select -'];
        $option2 = array_column($query->result_array(), $columns[1], $columns[0]);   // Param 2 & 3 adalah key
        $options = $option1 + $option2;

        return $options;
    }

    return $options = ['' => '- Select -'];
}

/**
 * Untuk meload kategori dari table kategori
 */
function getCategories()
{
    $CI =& get_instance();
    $query = $CI->db->get('category')->result();
    return $query;
}

/**
 * Menghitung jumlah cart (pada navbar) sesuai dengan id user yang login
 */
function getCart()
{
    $CI =& get_instance();
    $userId = $CI->session->userdata('id');

    if ($userId) {
        // Hitung banyak cart suatu user
        $query = $CI->db->where('id_user', $userId)->count_all_results('cart');
        return $query;
    }

    return false;
}

/**
 * Mengenkripsi input
 */
function hashEncrypt($input)
{
    $hash = password_hash($input, PASSWORD_DEFAULT);
    return $hash;
}

/**
 * Mendecrypt hash password dari table user
 * Mengembalikan true jika plain-text sama
 */
function hashEncryptVerify($input, $hash)
{
    if (password_verify($input, $hash)) {
        return true;
    } else {
        return false;
    }
}

function formatRupiah($number) {
    return 'Rp ' . number_format($number, 0, ',', '.');
}

function tanggalIndonesia($date){
    setlocale(LC_TIME, 'id_ID.UTF-8');
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
    $split = explode('-', $date);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

function angkaKeNamaBulan($angka) {
    // Daftar nama bulan dalam bahasa Indonesia
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    // Cek apakah angka valid dan ada dalam array
    if (array_key_exists($angka, $bulan)) {
        return $bulan[$angka];
    } else {
        return 'Bulan tidak valid'; // Atau bisa return null atau string kosong jika lebih diinginkan
    }
}