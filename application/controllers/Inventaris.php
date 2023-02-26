<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventaris extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
        $this->load->model('M_inventaris');
    }

    public function index()
    {
        $data['title'] = "Data Inventaris";
        $data['inventaris'] = $this->admin->getBarang();
        $this->template->load('templates/dashboard', 'inventaris/data', $data);
    }
    public function detail($id)
    {
        $data['title'] = 'Detail Data Inventaris';

        //menampilkan data berdasarkan id
        // $data['data'] = $this->inventaris_model->detail_join($id, 'inventaris')->result();
        // $this->load->model('tampil_m');
 
        $detail = $this->admin->get_detail($id);
        $data['detail'] = $detail;

        $this->template->load('templates/dashboard', 'inventaris/detail', $data);
    }
    private function _validasi1()
    {
        $this->form_validation->set_rules('aset_id', 'ID Aset', 'required');
        $this->form_validation->set_rules('no_seri', 'Nomor Seri Pabrik', 'required');
        $this->form_validation->set_rules('ukuran', 'Ukuran', 'required');
        $this->form_validation->set_rules('bahan', 'Bahan', 'required');
        $this->form_validation->set_rules('tgl_pemb', 'Tanggal Pembelian', 'required');
        $this->form_validation->set_rules('harga_bel', 'Harga Beli', 'required');
        $this->form_validation->set_rules('sumber_dana', 'Sumber Dana', 'required');
        // $this->form_validation->set_rules('kondisi_barang', 'Kondisi Barang', 'required');
        $this->form_validation->set_rules('ruang_id', 'Ruang', 'required');
        
    }
    private function _validasi()
    {
        $this->form_validation->set_rules('aset_id', 'ID Aset', 'required|is_unique[inventaris.aset_id]');
        $this->form_validation->set_rules('no_seri', 'Nomor Seri Pabrik', 'required');
        $this->form_validation->set_rules('ukuran', 'Ukuran', 'required');
        $this->form_validation->set_rules('bahan', 'Bahan', 'required');
        $this->form_validation->set_rules('tgl_pemb', 'Tanggal Pembelian', 'required');
        $this->form_validation->set_rules('harga_bel', 'Harga Beli', 'required');
        $this->form_validation->set_rules('sumber_dana', 'Sumber Dana', 'required');
        // $this->form_validation->set_rules('kondisi_barang', 'Kondisi Barang', 'required');
        $this->form_validation->set_rules('ruang_id', 'Ruang', 'required');
    }
     private function _config()
    {
        $config['upload_path']      = "./assets/img/avatar";
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = '2048';
        $config['file_name']         = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
        $this->load->library('upload', $config);
    }
    public function add()
    {
        $this->_validasi();
        $this->_config();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Inventaris";
            $data['induk_inventaris'] = $this->admin->get('induk_inventaris');
            $data['ruang'] = $this->admin->get('ruang');
            $data['inventaris'] = $this->admin->getBarang();
            // Mengenerate ID Barang
            // $kode_terakhir = $this->admin->getMax('inventaris', 'id_barang');
            // $kode_tambah = substr($kode_terakhir, -6, 6);
            // $kode_tambah++;
            // $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            // $data['id_barang'] = 'B' . $number;

            $this->template->load('templates/dashboard', 'inventaris/add', $data);
        } else {
            $input = $this->input->post(null, true);
             if (@$_FILES['foto']['name'] != null) {
                         if ($this->upload->do_upload('foto')) {
                            $input['foto'] = $this->upload->data('file_name');
                            $save = $this->admin->insert('inventaris', $input);
                             if ($this->db->affected_rows() > 0) {
                             $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                            } 
                             redirect('inventaris');
                            }else{
                               $error = $this->upload->display_errors();
                               $this->session->set_flashdata('error', $error);
                                redirect('inventaris/add');
                            }

                      
                    }else {
                    $input = $this->input->post(null, true);
                    $input_data = [
                        'id_barang'     => $input['id_barang'],
                        'aset_id'       => $input['aset_id'],
                        'no_seri'       => $input['no_seri'],
                        'ukuran'        => $input['ukuran'],
                        'bahan'         => $input['bahan'],
                        'tgl_pemb'      => $input['tgl_pemb'],
                        'harga_bel'     => $input['harga_bel'],
                        'sumber_dana'   => $input['sumber_dana'],
                        // 'kondisi_barang'=> $input['kondisi_barang'],
                        'ruang_id'      => $input['ruang_id'],
                        'foto'          => 'as.png'
                    ];

                    if ($this->admin->insert('inventaris', $input_data)) {
                        set_pesan('data berhasil disimpan.');
                        redirect('inventaris');
                    } else {
                        set_pesan('data gagal disimpan', false);
                        redirect('inventaris/add');
                    }
                }
            }
        }


     public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi1();
        $this->_config();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Inventaris";
             $data['induk_inventaris'] = $this->admin->get('induk_inventaris');
             $data['inventaris'] = $this->admin->getBarang();
             $data['ruang'] = $this->admin->get('ruang');
             $data['inventaris'] = $this->admin->get('inventaris', ['id_barang' => $id]);
            $this->template->load('templates/dashboard', 'inventaris/edit', $data);
        } else {
            $input = $this->input->post(null, true);
        if (empty($_FILES['foto']['name'])) {
                    $update = $this->admin->update('inventaris', 'id_barang', $id, $input);
                    if ($update) {
                        set_pesan('perubahan berhasil disimpan.');
                        redirect('inventaris');
                    }else{
                        set_pesan('perubahan tidak disimpan.');
                    }
                    redirect('inventaris/edit'.$id);
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
                       $update = $this->admin->update('inventaris', 'id_barang', $id, $input);
                        if ($update) {
                            set_pesan('perubahan berhasil disimpan.');
                            redirect('inventaris');
                        } 
                        else {
                            set_pesan('gagal menyimpan perubahan');
                        }
                        redirect('inventaris/edit'.$id);
                    }
                }
            }
        }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('inventaris', 'id_barang', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('inventaris');
    }

    public function getstok($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->admin->cekStok($id);
        output_json($query);
    }
}
