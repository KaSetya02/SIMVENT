<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hapus extends CI_Controller
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
        $data['title'] = "Data Pengajuan Penghapusan";
        $data['hapus'] = $this->admin->getHapusAset();
        $this->template->load('templates/dashboard', 'hapus/data', $data);
    }

    private function _validasi()
    {
        
        $this->form_validation->set_rules('tgl_pengajuan', 'Tanggal Pengajuan', 'required|trim');
        $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim');
       
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
            $data['title'] = "Pengajuan Penghapusan Aset";
            $data['hapus'] = $this->admin->getHapusAset();
               $data['induk_inventaris'] = $this->admin->get('induk_inventaris');
            $this->template->load('templates/dashboard', 'hapus/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('hapus', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('hapus');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('hapus/add');
            }
        }
    }




    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Pengajuan Penghapusan Aset";
           $data['hapus'] = $this->admin->getHapusAset();
            $data['hapus'] = $this->admin->get('hapus', ['id_hapus' => $id]);
            $this->template->load('templates/dashboard', 'hapus/edit', $data);
        } else {
            $input = $this->input->post(null, true);
        if (empty($_FILES['foto']['name'])) {
                    $update = $this->admin->update('hapus', 'id_hapus', $id, $input);
                    if ($update) {
                        set_pesan('perubahan berhasil disimpan.');
                        redirect('induk');
                    }else{
                        set_pesan('perubahan tidak disimpan.');
                    }
                    redirect('hapus/edit'.$id);
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
                       $update = $this->admin->update('hapus', 'id_hapus', $id, $input);
                        if ($update) {
                            set_pesan('perubahan berhasil disimpan.');
                            redirect('hapus');
                        } 
                        else {
                            set_pesan('gagal menyimpan perubahan');
                        }
                        redirect('hapus/edit'.$id);
                    }
                }
            }
        }
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('hapus', 'id_hapus', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('hapus');
    }
}
