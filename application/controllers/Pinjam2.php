<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
        $this->load->model('Model_basic');
        $this->load->library('session');

    }

    public function index()
    {
        $data['title'] = "Permintaan Peminjaman Barang";
        $data['pinjam'] = $this->admin->get('pinjam');
        $data['induk_inventaris'] = $this->admin->get('induk_inventaris');
        $this->template->load('templates/dashboard', 'pinjam2/barang', $data);
    }

    public function barang(){
       if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Barang";
            $data['data'] = $this->Model_basic->select_where('induk_inventaris','status','tampilkan')->result();
            $this->template->load('templates/dashboard', 'pinjam2/barang', $data);
        } 
    }

    public function barang_pinjam(){
        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Barang";
            $id = $this->input->post('id');
            $data['data'] = $this->Model_basic->select_where('induk_inventaris','id_aset',$id)->row();
            $this->template->load('templates/dashboard', 'pinjam2/barang_pinjam', $data);
        } 
    }

    public function barang_pinjam_act(){
        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Barang";

            $data['induk_inventaris'] = $this->admin->get('induk_inventaris');
            $table_field = $this->db->list_fields('pinjam');
            $insert = array();
            foreach ($table_field as $field) {
                $insert[$field] = $this->input->post($field);
            }
            $limit = array(
                'id_user' => $this->session->userdata('id_user'),
                'id_aset' => $insert['id_aset']
            );

            $check = $this->Model_basic->select_where('induk_inventaris','id_aset',$insert['id_aset'])->row();
            // $this->Model_basic->select_where('pinjam',$limit)->result();
            // $check_limit = 0;
            // foreach ($limits as $limit){
            //     $check_limit += $limit->jml;
            // }
            // if($check_limit + $insert['jml'] > '5'){
            //     $this->returnJson(array('status' => 'error','msg' => 'Jumlah Pinjam Maksimal Adalah 5!'));
            // }else{
            //     if($check->stock < $insert['jml']){
            //         $this->returnJson(array('status' => 'error','msg' => 'Stock Kurang!'));
            //     }elseif($insert['jml'] <= '0'){
            //         $this->returnJson(array('status' => 'error','msg' => 'Jumlah Pinjam Tidak Boleh Nol!'));
            //     }else{
                    if($insert){
                            $update['keterangan'] = 'Sedang Dipinjam';
                            $do_update = $this->Model_basic->update('induk_inventaris',$update,'id_aset',$insert['id_aset']);
                            $do_insert = $this->Model_basic->insert_all('pinjam',$insert);
                              set_pesan('Pinjam Barang Berhasil');
                              redirect('pinjam2');
                            // $this->returnJson(array('status' => 'ok','msg' => 'Pinjam Barang Berhasil', 'redirect' => 'barang'));
                    }else{
                        set_pesan('Periksa kembali form', false);
                        redirect('pinjam2/barang_pinjam');
                        // $this->returnJson(array('status' => 'error','msg' => 'Periksa kembali form'));
                    }
            //     }
            // }
        }
  }

    public function pinjam(){
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Dipinjam";
            $data['pinjam'] = $this->admin->getPinjam();
            
           
            $this->template->load('templates/dashboard', 'pinjam2/pinjam', $data);
        } 
    }

    public function pinjam_kembali(){
        if ($this->form_validation->run() == false) {
            $id = $this->input->post('id');
            $tgl_kembali = $this->input->post('tgl_kembali');
            $update['status'] = '2';
            $update['tgl_kembali'] = $tgl_kembali;

            if($update){
                $do_update = $this->Model_basic->update('pinjam',$update,'id_pinjam',$id);
                if($do_update){
                    redirect('pinjam2/pinjam');
                }
            }
        } 
    }

     public function riwayat(){
        if ($this->form_validation->run() == false) {
            $data['title'] = "Riwayat Peminjaman Barang";
          
            $data['data'] = $this->Model_basic->select_all_join_2('tbl_riwayat','tbl_riwayat.*,induk_inventaris.nama_aset as name_barang,user.nama as name_peminjam,user.no_induk as nim','induk_inventaris','tbl_riwayat.id_aset','induk_inventaris.id_aset','user','tbl_riwayat.id_user','user.id_user');
            $this->template->load('templates/dashboard', 'pinjam2/riwayat', $data);
        } 
    }

    // function riwayat(){
    //     $this->check_login_peminjam();
    //     $data['userdata'] = $this->session_peminjam;
    //     $data['data'] = $this->Model_basic->select_where_join_2('tbl_riwayat','tbl_riwayat.*,induk_inventaris.name as name_barang,tbl_peminjam.name as name_peminjam','tbl_riwayat.id_user',$this->session_peminjam['id_user'],'induk_inventaris','tbl_riwayat.id_aset','induk_inventaris.id_aset','tbl_peminjam','tbl_riwayat.id_user','tbl_peminjam.id_user')->result();
    //     $data['content'] = $this->load->view('frontend/member_system/riwayat',$data,true);
    //     $this->load->view('frontend/index',$data);
    // }

   

    
}
