<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Ruang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Data Ruangan";
        $data['ruang'] = $this->admin->get('ruang');
        $this->template->load('templates/dashboard', 'ruang/data', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Data Inventaris';

        //menampilkan data berdasarkan id
        // $data['data'] = $this->inventaris_model->detail_join($id, 'inventaris')->result();
        // $this->load->model('tampil_m');
 
        $detail = $this->admin->getRuang($id);
        $data['detail'] = $detail;

        $this->template->load('templates/dashboard', 'ruang/detail', $data);
    }

    private function _validasi1()
    {
        $this->form_validation->set_rules('no_ruang', 'Kode Ruangan', 'required|trim|is_unique[ruang.no_ruang]');
        $this->form_validation->set_rules('nama_ruang', 'Nama Ruangan', 'required|trim');
        $this->form_validation->set_rules('kondisi_ruang', 'Kondisi Ruangan', 'required|trim');
    }
     private function _validasi()
    {
        $this->form_validation->set_rules('no_ruang', 'Kode Ruangan', 'required|trim');
        $this->form_validation->set_rules('nama_ruang', 'Nama Ruangan', 'required|trim');
        $this->form_validation->set_rules('kondisi_ruang', 'Kondisi Ruangan', 'required|trim');
    }

    public function add()
    {
        $this->_validasi1();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Ruangan";
            // $kode_terakhir = $this->admin->getMax('ruang', 'id_ruang');
            // $kode_tambah = substr($kode_terakhir, -6, 6);
            // $kode_tambah++;
            // $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            // $data['id_ruang'] = 'RU' . $number;
            $this->template->load('templates/dashboard', 'ruang/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('ruang', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('ruang');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('ruang/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Ruangan";
            $data['ruang'] = $this->admin->get('ruang', ['id_ruang' => $id]);
            $this->template->load('templates/dashboard', 'ruang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('ruang', 'id_ruang', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('ruang');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('ruang/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('ruang', 'id_ruang', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('ruang');
    }
}
