<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam3 extends CI_Controller
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
        $data['title'] = "Permintaan Peminjaman Ruangan";
        $data['pinjamruang'] = $this->Model_basic->select_where('pinjamruang','status','0');
         $data['pinjamruang'] = $this->Model_basic->select_where_join_2('pinjamruang','pinjamruang.*,ruang.nama_ruang as name_ruang,user.nama as name_peminjam,user.no_induk as nim','pinjamruang.status','0','ruang','pinjamruang.id_ruang','ruang.id_ruang','user','pinjamruang.id_user','user.id_user')->result();
        $this->template->load('templates/dashboard', 'pinjam3/pinjam', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_pinjam', 'Nama  Klasifikasi Aset', 'required|trim');
    }

    public function pinjam()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Ruangan";
            $data['data'] = $this->Model_basic->select_where_join_2('pinjamruang','pinjamruang.*,ruang.nama_ruang as name_ruang,user.nama as name_peminjam,user.no_induk as nim','pinjamruang.status','0','ruang','pinjamruang.id_ruang','ruang.id_ruang','user','pinjamruang.id_user','user.id_user')->result();
            $this->template->load('templates/dashboard', 'pinjam3/pinjam', $data,true);
        } 
    }

    public function kembali()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Pengembalian Ruangan";
              $data['pinjamruang'] = $this->admin->get('pinjamruang');
            $data['data'] = $this->Model_basic->select_where_join_2('pinjamruang','pinjamruang.*,ruang.nama_ruang as name_ruang,user.nama as name_peminjam,user.no_induk as nim','pinjamruang.status','2','ruang','pinjamruang.id_ruang','ruang.id_ruang','user','pinjamruang.id_user','user.id_user')->result();
            $this->template->load('templates/dashboard', 'pinjam3/kembali', $data);
        } 
    }

    public function pinjam_setujui()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Ruangan";
            $id = $this->input->post('id');
            $update['status'] = '1';

            if($update){
                $do_update = $this->Model_basic->update('pinjamruang',$update,'id_pinjam',$id);
                if($do_update){
                    set_pesan('Pinjam Ruangan Berhasil Disetujui');
                    redirect('pinjam3');
                }
            }
        } 
    }

    public function pinjam_tolak()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Ruangan";
            $table_field = $this->db->list_fields('tbl_riwayat1');
            $insert = array();
            foreach ($table_field as $field) {
                $insert[$field] = $this->input->post($field);
            }

            $check = $this->Model_basic->select_where('ruang','id_ruang',$insert['id_ruang'])->row();
            if($insert){
                $update['kondisi_ruang'] = 'Kosong';
                $do_insert = $this->Model_basic->insert_all('tbl_riwayat1',$insert);
                $do_update = $this->Model_basic->update('ruang',$update,'id_ruang',$insert['id_ruang']);
                $do_delete = $this->Model_basic->delete('pinjamruang','id_pinjam',$insert['id_pinjam']);
                if($do_insert && $do_delete && $do_update){
                    set_pesan('Pinjam Ruangan Berhasil Ditolak');
                    redirect('pinjam3');
                }
            }
        } 
    }



    public function kembali_setujui()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Pengembalian Ruangan";
            $table_field = $this->db->list_fields('tbl_riwayat1');
            $insert = array();
            foreach ($table_field as $field) {
                $insert[$field] = $this->input->post($field);
            }

            $check = $this->Model_basic->select_where('ruang','id_ruang',$insert['id_ruang'])->row();
            if($insert){
                $update['kondisi_ruang'] = 'Kosong';
                $do_insert = $this->Model_basic->insert_all('tbl_riwayat1',$insert);
                $do_update = $this->Model_basic->update('ruang',$update,'id_ruang',$insert['id_ruang']);
                $do_delete = $this->Model_basic->delete('pinjamruang','id_pinjam',$insert['id_pinjam']);
                if($do_insert && $do_delete && $do_update){
                    set_pesan('Pengembalian Aset Berhasil Disetujui');
                    redirect('pinjam3/kembali');
                }
            }
        } 
    }

    public function riwayat()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Riwayat Peminjaman Ruangan";
           $data['data'] = $this->Model_basic->select_all_join_2('tbl_riwayat1','tbl_riwayat1.*,ruang.nama_ruang as name_ruang,user.nama as name_peminjam,user.no_induk as nim','ruang','tbl_riwayat1.id_ruang','ruang.id_ruang','user','tbl_riwayat1.id_user','user.id_user');
            $this->template->load('templates/dashboard', 'pinjam3/riwayat', $data);
        } 
    }

    public function riwayat_clear()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Riwayat Peminjaman Ruangan";
             $this->db->empty_table('tbl_riwayat1');
              set_pesan('Riwayat Peminjaman Berhasil Dihapus');
            redirect('pinjam3/riwayat');
        } 
    }

    public function laporan_pinjam()
    {
        // $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Laporan Peminjaman Ruangan";
            $data['data'] = $this->Model_basic->select_where_join_2('pinjamruang','pinjamruang.*,ruang.nama_ruang as name_ruang,user.nama as name_peminjam,user.no_induk as nim','pinjamruang.status','1','ruang','pinjamruang.id_ruang','ruang.id_ruang','user','pinjamruang.id_user','user.id_user')->result();
            $this->template->load('templates/dashboard', 'pinjam3/laporan_pinjam', $data);
        } 
    }

   

    
}
