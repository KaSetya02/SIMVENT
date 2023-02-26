<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kondisi extends CI_Controller
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
        $data['title'] = "Kondisi Aset";
        $data['kondisi'] = $this->admin->get('kondisi');
        $data['kondisi'] = $this->admin->getKondisi();
        $this->template->load('templates/dashboard', 'kondisi/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('aset_id', 'Nama Aset', 'required|is_unique[kondisi.aset_id]');
        // $this->form_validation->set_rules('kondisi_barang', 'Kondisi Aset', 'required|trim');
        // $this->form_validation->set_rules('ruang_id', 'Lokasi Aset', 'required|trim');
   
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Kondisi Aset";
            $data['induk_inventaris'] = $this->admin->get('induk_inventaris');
            // $data['ruang'] = $this->admin->get('ruang');
            // $kode_terakhir = $this->admin->getMax('kondisi', 'id_kondisi');
            // $kode_tambah = substr($kode_terakhir, -6, 6);
            // $kode_tambah++;
            // $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            // $data['id_kondisi'] = 'KLS' . $number;
            $this->template->load('templates/dashboard', 'kondisi/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('kondisi', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('kondisi');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('kondisi/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Kondisi Aset";
            $data['induk_inventaris'] = $this->admin->get('induk_inventaris');
            // $data['ruang'] = $this->admin->get('ruang');
            $data['kondisi'] = $this->admin->get('kondisi', ['id_kondisi' => $id]);
            $this->template->load('templates/dashboard', 'kondisi/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('kondisi', 'id_kondisi', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('kondisi');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('kondisi/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('kondisi', 'id_kondisi', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('kondisi');
    }
}
