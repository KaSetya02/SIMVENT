<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Induk extends CI_Controller
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
        $data['title'] = "Induk Inventaris";
        $data['induk_inventaris'] = $this->admin->getIndukInventaris();
        $this->template->load('templates/dashboard', 'induk/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_aset', 'Nama Aset', 'required|trim');
        $this->form_validation->set_rules('merk', 'Merk', 'required|trim');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required|trim');
        $this->form_validation->set_rules('klasifikasi_barang', 'Klasifikasi Barang', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
    }
    //   private function _config()
    // {
    //     $config['upload_path']      = "./assets/img/avatar";
    //     $config['allowed_types']    = 'gif|jpg|jpeg|png';
    //     $config['max_size']         = '2048';
    //     $config['file_name']         = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
    //     $this->load->library('upload', $config);
    // }
    public function add()
    {
        $this->_validasi();
        // $this->_config();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Induk Inventaris";
            $data['jenis'] = $this->admin->get('jenis');
            $kode_terakhir = $this->admin->getMax('induk_inventaris', 'id_aset');
            $kode_tambah = substr($kode_terakhir, -6, 6);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            $data['id_aset'] = 'AS' . $number;
            $this->template->load('templates/dashboard', 'induk/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('induk_inventaris', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('induk');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('induk/add');
            }
        }
    }




    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Induk Inventaris";
             $data['jenis'] = $this->admin->get('jenis');
            $data['induk'] = $this->admin->get('induk_inventaris', ['id_aset' => $id]);
            $this->template->load('templates/dashboard', 'induk/edit', $data);
        } else {
            $input = $this->input->post(null, true);
        if (empty($_FILES['foto']['name'])) {
                    $update = $this->admin->update('induk_inventaris', 'id_aset', $id, $input);
                    if ($update) {
                        set_pesan('perubahan berhasil disimpan.');
                        redirect('induk');
                    }else{
                        set_pesan('perubahan tidak disimpan.');
                    }
                    redirect('induk/edit'.$id);
                } else {
                    if ($this->upload->do_upload('foto') == false) {
                        echo $this->upload->display_errors();
                        die;
                    } else {
                        if ($data['foto'] != null) {
                            $old_image = 'assets/img/avatar/' . $data['foto'];
                           unlink($old_image);
                        }

                        $input['foto'] = $this->upload->data('file_name');
                       $update = $this->admin->update('induk_inventaris', 'id_aset', $id, $input);
                        if ($update) {
                            set_pesan('perubahan berhasil disimpan.');
                            redirect('induk');
                        } 
                        else {
                            set_pesan('gagal menyimpan perubahan');
                        }
                        redirect('induk/edit'.$id);
                    }
                }
            }
        }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('induk_inventaris', 'id_aset', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('induk');
    }
}
