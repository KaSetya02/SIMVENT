<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['induk_inventaris'] = $this->admin->count('induk_inventaris');
        $data['inventaris'] = $this->admin->count('inventaris');
        $data['jenis'] = $this->admin->count('jenis');
        $data['ruang'] = $this->admin->count('ruang');
        $data['barang_masuk'] = $this->admin->count('barang_masuk');
        $data['barang_keluar'] = $this->admin->count('barang_keluar');
        $data['supplier'] = $this->admin->count('supplier');
        $data['user'] = $this->admin->count('user');
        $data['tbl_riwayat'] = $this->admin->count('tbl_riwayat');
        $data['tbl_riwayat1'] = $this->admin->count('tbl_riwayat1');
      
        $data['transaksi'] = [
            'barang_keluar' => $this->admin->getBarangKeluar(5)
        ];

        // Line Chart
        $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $data['cbm'] = [];
        $data['cbk'] = [];

        foreach ($bln as $b) {
            $data['cbm'][] = $this->admin->chartBarangMasuk($b);
            $data['cbk'][] = $this->admin->chartBarangKeluar($b);
        }

        $this->template->load('templates/dashboard', 'dashboard', $data);
    }
}
