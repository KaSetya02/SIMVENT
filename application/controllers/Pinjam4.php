<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam4 extends CI_Controller
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
        $data['title'] = "Permintaan Peminjaman Ruangan";
        $data['pinjamruang'] = $this->admin->get('pinjamruang');
        $data['ruang'] = $this->admin->get('ruang');
        $this->template->load('templates/dashboard', 'pinjam4/ruangan', $data);
    }

    public function ruangan(){
       if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Ruangan";
            $data['data'] = $this->Model_basic->select_where('ruang','status','tampilkan')->result();
            $this->template->load('templates/dashboard', 'pinjam4/ruangan', $data);
        } 
    }

    public function ruangan_pinjam(){
        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Ruangan";
            $id = $this->input->post('id');
            $data['data'] = $this->Model_basic->select_where('ruang','id_ruang',$id)->row();
            $this->template->load('templates/dashboard', 'pinjam4/ruangan_pinjam', $data);
        } 
    }

    public function ruangan_pinjam_act(){
        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Peminjaman Ruangan";

            $data['ruang'] = $this->admin->get('ruang');
            $table_field = $this->db->list_fields('pinjamruang');
            $insert = array();
            foreach ($table_field as $field) {
                $insert[$field] = $this->input->post($field);
            }
            $limit = array(
                'id_user' => $this->session->userdata('id_user'),
                'id_ruang' => $insert['id_ruang']
            );

            $check = $this->Model_basic->select_where('ruang','id_ruang',$insert['id_ruang'])->row();
            // $this->Model_basic->select_where('pinjamruang',$limit)->result();
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
                            $update['kondisi_ruang'] = 'Isi Atau Sedang Digunakan';
                            $do_update = $this->Model_basic->update('ruang',$update,'id_ruang',$insert['id_ruang']);
                            $do_insert = $this->Model_basic->insert_all('pinjamruang',$insert);
                              set_pesan('Pinjam Ruangan Berhasil');
                              redirect('pinjam4');
                            // $this->returnJson(array('status' => 'ok','msg' => 'Pinjam Ruangan Berhasil', 'redirect' => 'ruangan'));
                    }else{
                        set_pesan('Periksa kembali form', false);
                        redirect('pinjam4/ruangan_pinjam');
                        // $this->returnJson(array('status' => 'error','msg' => 'Periksa kembali form'));
                    }
            //     }
            // }
        }
  }

    public function pinjam(){
        if ($this->form_validation->run() == false) {
            $data['title'] = "Ruangan Dipinjam";
            $data['pinjamruang'] = $this->admin->getPinjam2();
            $this->template->load('templates/dashboard', 'pinjam4/pinjam', $data);
        } 
    }

    public function pinjam_kembali(){
        if ($this->form_validation->run() == false) {
            $id = $this->input->post('id');
            $tgl_kembali = $this->input->post('tgl_kembali');
            $update['status'] = '2';
            $update['tgl_kembali'] = $tgl_kembali;

            if($update){
                $do_update = $this->Model_basic->update('pinjamruang',$update,'id_pinjam',$id);
                if($do_update){
                    redirect('pinjam4/pinjam');
                }
            }
        } 
    }

    public function riwayat(){
        if ($this->form_validation->run() == false) {
            $data['title'] = "Riwayat Peminjaman Ruangan";
            $data['data'] = $this->Model_basic->select_all_join_2('tbl_riwayat1','tbl_riwayat1.*,ruang.nama_ruang as name_ruang,user.nama as name_peminjam,user.no_induk as nim','ruang','tbl_riwayat1.id_ruang','ruang.id_ruang','user','tbl_riwayat1.id_user','user.id_user');
            $this->template->load('templates/dashboard', 'pinjam4/riwayat', $data);
        } 
    }

    // function riwayat(){
    //     $this->check_login_peminjam();
    //     $data['userdata'] = $this->session_peminjam;
    //     $data['data'] = $this->Model_basic->select_where_join_2('tbl_riwayat1','tbl_riwayat1.*,ruang.name as name_ruang,tbl_peminjam.name as name_peminjam','tbl_riwayat1.id_user',$this->session_peminjam['id_user'],'ruang','tbl_riwayat1.id_ruang','ruang.id_ruang','tbl_peminjam','tbl_riwayat1.id_user','tbl_peminjam.id_user')->result();
    //     $data['content'] = $this->load->view('frontend/member_system/riwayat',$data,true);
    //     $this->load->view('frontend/index',$data);
    // }

   

    
}
