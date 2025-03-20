<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    function array_to_csv($array, $download = "")
    {
        if ($download != "") {
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="' . $download . '"');
            header('Pragma: no-cache');
        }

        $output = fopen('php://output', 'w');
        fputcsv($output, array_keys(reset($array)));

        foreach ($array as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
    }

function format_rupiah($angka){
    return "Rp " . number_format($angka, 0, ',', '.');
}
function pembulatan_rupiah($angka) {
    // Dapatkan sisa bagi dari 100
    $sisa = $angka % 100;
    
    // Jika sisa >= 50, bulatkan ke atas
    if ($sisa >= 50) {
        return $angka + (100 - $sisa);
    } else {
        // Jika sisa < 50, bulatkan ke bawah
        return $angka - $sisa;
    }
}
function cek_login() {
    $ci = get_instance();
    if(!$ci->session->userdata('username')) {
        redirect('auth');
    } 
}


function cek_akses_menu() {
    $id_jabatan    = get_instance()->session->userdata('id_jabatan');
    $url1       = get_instance()->uri->segment(1);
    $url2       = get_instance()->uri->segment(2);
    $url        = $url1 . '/' . $url2;
    $query  = get_instance()->db->get_where('tbl_menu',['url_menu' => $url])->row_array();

    $queryAkses = get_instance()->db->get_where('tbl_akses_menu',['id_jabatan' => $id_jabatan, 'id_menu' => $query['id_menu']]);
    if($queryAkses->row_array() < 1) {
        redirect('auth/error404');
    }
}
    function cek_halaman_utama() {
        $id_jabatan     = get_instance()->session->userdata('id_jabatan');
        $url       = get_instance()->uri->segment(1);
        $query  =get_instance()->db->get_where('tbl_main_page',['url_main_page' => $url])->row_array();

        $queryAkses = get_instance()->db->get_where('tbl_akses_main_page',['id_jabatan' => $id_jabatan, 'id_main_page' => $query['id_main_page']]);

        if($queryAkses->num_rows() < 1) {
            redirect('auth/error404');
    }
}
?>
