<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
        $this->load->model('Model_basic');
    }

    public function index()
    {
        $data['title'] = "Permintaan Peminjaman Barang";
        $data['pinjam'] = $this->Model_basic->select_where('pinjam','status','0');
         $data['pinjam'] = $this->Model_basic->select_where_join_2('pinjam','pinjam.*,induk_inventaris.nama_aset as name_barang,user.nama as name_peminjam,user.no_induk as nim','pinjam.status','0','induk_inventaris','pinjam.id_aset','induk_inventaris.id_aset','user','pinjam.id_user','user.id_user')->result();
        $this->template->load('templates/dashboard', 'pinjam/pinjam', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_pinjam', 'Nama  Klasifikasi Aset', 'required|trim');
    }

    public function pinjam()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Barang";
            $data['data'] = $this->Model_basic->select_where_join_2('pinjam','pinjam.*,induk_inventaris.nama_aset as name_barang,user.nama as name_peminjam,user.no_induk as nim','pinjam.status','0','induk_inventaris','pinjam.id_aset','induk_inventaris.id_aset','user','pinjam.id_user','user.id_user')->result();
            $this->template->load('templates/dashboard', 'pinjam/pinjam', $data,true);
        } 
    }

    public function kembali()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Pengembalian Barang";
              $data['pinjam'] = $this->admin->get('pinjam');
            $data['data'] = $this->Model_basic->select_where_join_2('pinjam','pinjam.*,induk_inventaris.nama_aset as name_barang,user.nama as name_peminjam,user.no_induk as nim','pinjam.status','2','induk_inventaris','pinjam.id_aset','induk_inventaris.id_aset','user','pinjam.id_user','user.id_user')->result();
            $this->template->load('templates/dashboard', 'pinjam/kembali', $data);
        } 
    }

    public function pinjam_setujui()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Barang";
            $id = $this->input->post('id');
            $update['status'] = '1';

            if($update){
                $do_update = $this->Model_basic->update('pinjam',$update,'id_pinjam',$id);
                if($do_update){
                    set_pesan('Pinjam Aset Berhasil Disetujui');
                    redirect('pinjam');
                }
            }
        } 
    }

    public function pinjam_tolak()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Barang";
            $table_field = $this->db->list_fields('tbl_riwayat');
            $insert = array();
            foreach ($table_field as $field) {
                $insert[$field] = $this->input->post($field);
            }

            $check = $this->Model_basic->select_where('induk_inventaris','id_aset',$insert['id_aset'])->row();
            if($insert){
               $update['keterangan'] = 'Tersedia';
                $do_insert = $this->Model_basic->insert_all('tbl_riwayat',$insert);
                $do_update = $this->Model_basic->update('induk_inventaris',$update,'id_aset',$insert['id_aset']);
                $do_delete = $this->Model_basic->delete('pinjam','id_pinjam',$insert['id_pinjam']);
                if($do_insert && $do_delete && $do_update){
                    set_pesan('Pinjam Aset Berhasil Ditolak');
                    redirect('pinjam');
                }
            }
        } 
    }



    public function kembali_setujui()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Pengembalian Barang";
            $table_field = $this->db->list_fields('tbl_riwayat');
            $insert = array();
            foreach ($table_field as $field) {
                $insert[$field] = $this->input->post($field);
            }

            $check = $this->Model_basic->select_where('induk_inventaris','id_aset',$insert['id_aset'])->row();
            if($insert){
                $update['keterangan'] = 'Tersedia';
                $do_insert = $this->Model_basic->insert_all('tbl_riwayat',$insert);
                $do_update = $this->Model_basic->update('induk_inventaris',$update,'id_aset',$insert['id_aset']);
                $do_delete = $this->Model_basic->delete('pinjam','id_pinjam',$insert['id_pinjam']);
                if($do_insert && $do_delete && $do_update){
                    set_pesan('Pengembalian Aset Berhasil Disetujui');
                    redirect('pinjam/kembali');
                }
            }
        } 
    }

    public function riwayat()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Riwayat Peminjaman Barang";
           $data['data'] = $this->Model_basic->select_all_join_2('tbl_riwayat','tbl_riwayat.*,induk_inventaris.nama_aset as name_barang,user.nama as name_peminjam,user.no_induk as nim','induk_inventaris','tbl_riwayat.id_aset','induk_inventaris.id_aset','user','tbl_riwayat.id_user','user.id_user');
            $this->template->load('templates/dashboard', 'pinjam/riwayat', $data);
        } 
    }

    public function riwayat_clear()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Riwayat Peminjaman Barang";
             $this->db->empty_table('tbl_riwayat');
              set_pesan('Riwayat Peminjaman Berhasil Dihapus');
            redirect('pinjam/riwayat');
        } 
    }

    public function laporan_pinjam()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Laporan Peminjaman Barang";
            $data['data'] = $this->Model_basic->select_where_join_2('pinjam','pinjam.*,induk_inventaris.nama_aset as name_barang,user.nama as name_peminjam,user.no_induk as nim','pinjam.status','1','induk_inventaris','pinjam.id_aset','induk_inventaris.id_aset','user','pinjam.id_user','user.id_user')->result();
            $this->template->load('templates/dashboard', 'pinjam/laporan_pinjam', $data);
        } 
    }

   

    
}
