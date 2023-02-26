<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Laporan2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }

    public function index()
    {
        $this->form_validation->set_rules('transaksi', 'Transaksi', 'required|in_list[tbl_riwayat,tbl_riwayat1,inventaris,hapus]');
        $this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Transaction Report";
            $this->template->load('templates/dashboard', 'laporan/form2', $data);
        } else {
            $input = $this->input->post(null, true);
            $table = $input['transaksi'];
            $tanggal = $input['tanggal'];
            $pecah = explode(' - ', $tanggal);
            $mulai = date('Y-m-d', strtotime($pecah[0]));
            $akhir = date('Y-m-d', strtotime(end($pecah)));

            $query = '';
            if ($table == 'tbl_riwayat') {
                $query = $this->admin->getPinjamAset(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } elseif ($table == 'tbl_riwayat1') {
                 $query = $this->admin->getPinjamRuang(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            }elseif  ($table == 'inventaris') {
                $query = $this->admin->getBarang1(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            }else{
                $query = $this->admin->getHapusAset(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            }
            $this->_cetak($query, $table, $tanggal);
        }
    }

    private function _cetak($data, $table_, $tanggal)
    {
        $this->load->library('CustomPDF');
        $table = $table_ == 'inventaris'? 'Data Aset' : 'Data Pengajuan Penghapusan Aset' ;

        $pdf = new FPDF();
        $pdf->AddPage('L', 'Letter');
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Image('./assets/img/logo1.png',10,12,17,16);
        $pdf->Image('./assets/img/2.png',255,12,16,17);
        $pdf->Cell(260, 7, 'POLITEKNIK TEDC BANDUNG' , 0, 1,'C');
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(260,7,'Jl. Politeknik - Pasantren Km. 2 Cibabat - Cimahi Utara 40513 Telp/ Fax. (022) 6645951',0,1,'C');
        $pdf->Cell(260,7,'Email : info@poltektedc.ac.id Website : http://www.poltektedc.ac.id',0,1,'C');
        $pdf->SetFont('Times', '', 10);
      
        $pdf->Line(10,32,270,32);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(260, 7, 'Laporan ' . $table , 0, 1,'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(260, 4, 'Tanggal : ' . $tanggal, 0, 1,'C');
         $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);

        if ($table_ == 'tbl_riwayat') :
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(25, 7, 'NIM/NIP', 1, 0, 'C');
            $pdf->Cell(45, 7, 'Nama Peminjam', 1, 0, 'L');
            $pdf->Cell(45, 7, 'Nama Barang', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Tujuan Peminjaman', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Tanggal Pinjam', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Tanggal Kembali', 1, 0, 'C');
            $pdf->Cell(15, 7, 'Status', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, $d['no_induk'], 1, 0, 'C');
                $pdf->Cell(45, 7, $d['nama'], 1, 0, 'L');
                $pdf->Cell(45, 7, $d['nama_aset'], 1, 0, 'L');
                $pdf->Cell(40, 7, $d['tujuan'], 1, 0, 'L');
                $pdf->Cell(40, 7, $d['tgl_pinjam'], 1, 0, 'C');
                $pdf->Cell(40, 7, $d['tgl_kembali'], 1, 0, 'C');
                $pdf->Cell(15, 7, $d['status'], 1, 0, 'C');
                $pdf->Ln();
            }
             $pdf->Ln(30);
                $pdf->Cell(75);
                $pdf->Cell(270,7,'Bandung, '.date('d-m-y'),0,1,'C');
                $pdf->Cell(75);
                $pdf->Cell(270,7,'Penanggung Jawab,',0,1,'C');    
                $pdf->Ln(20);
                $pdf->Cell(75);
                $pdf->SetFont('Times','B',12);
                $pdf->Cell(270,7,userdata('nama'),0,1,'C');
                // $pdf->Line(192,188,248,188);
                $pdf->SetFont('Times','',12);
                $pdf->Cell(75);
                $pdf->Cell(270,7,'NIP.'.userdata('no_induk'),0,1,'C'); 
            elseif ($table_ == 'inventaris') :
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Kode Aset', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Nama Aset', 1, 0, 'L');
            $pdf->Cell(40, 7, 'Merk', 1, 0, 'C');
            $pdf->Cell(40, 7, 'No Seri Pabrik', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Harga Beli', 1, 0, 'C');
            $pdf->Cell(37, 7, 'Tgl Pembelian', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Sumber Dana', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(30, 7, $d['aset_id'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['nama_aset'], 1, 0, 'L');
                $pdf->Cell(40, 7, $d['merk'], 1, 0, 'L');
                $pdf->Cell(40, 7, $d['no_seri'], 1, 0, 'L');
                $pdf->Cell(35, 7, 'Rp '.number_format($d['harga_bel']), 1, 0, 'L');
                $pdf->Cell(37, 7, format_indo($d['tgl_pemb']), 1, 0, 'C');
                $pdf->Cell(35, 7, $d['sumber_dana'], 1, 0, 'C');
                $pdf->Ln();
            }
               $pdf->Ln(30);
                $pdf->Cell(75);
                $pdf->Cell(270,7,'Bandung, '.date('d-m-y'),0,1,'C');
                $pdf->Cell(75);
                $pdf->Cell(270,7,'Penanggung Jawab,',0,1,'C');    
                $pdf->Ln(20);
                $pdf->Cell(75);
                $pdf->SetFont('Times','B',12);
                $pdf->Cell(270,7,userdata('nama'),0,1,'C');
                // $pdf->Line(192,188,248,188);
                $pdf->SetFont('Times','',12);
                $pdf->Cell(75);
                $pdf->Cell(270,7,'NIP.'.userdata('no_induk'),0,1,'C');
            else:
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(40, 7, 'NIM/NIP', 1, 0, 'C');
            $pdf->Cell(45, 7, 'Nama Pengaju', 1, 0, 'L');
            $pdf->Cell(40, 7, 'Kode Aset', 1, 0, 'C');
            $pdf->Cell(45, 7, 'Nama Aset', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Tanggal Pengajuan', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Alasan', 1, 0, 'C');
            // $pdf->Cell(30, 7, 'Tgl Pembelian', 1, 0, 'C');
            // $pdf->Cell(35, 7, 'Sumber Dana', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(40, 7, $d['no_induk'], 1, 0, 'C');
                $pdf->Cell(45, 7, $d['nama'], 1, 0, 'L');
                $pdf->Cell(40, 7, $d['id_aset'], 1, 0, 'C');
                $pdf->Cell(45, 7, $d['nama_aset'], 1, 0, 'L');
                $pdf->Cell(40, 7, format_indo($d['tgl_pengajuan']), 1, 0, 'C');
                $pdf->Cell(40, 7, $d['alasan'], 1, 0, 'C');
                // $pdf->Cell(30, 7, $d['tgl_pemb'], 1, 0, 'C');
                // $pdf->Cell(35, 7, $d['sumber_dana'], 1, 0, 'C');
                $pdf->Ln();
            }
               $pdf->Ln(30);
                $pdf->Cell(75);
                $pdf->Cell(270,7,'Bandung, '.date('d-m-y'),0,1,'C');
                $pdf->Cell(75);
                $pdf->Cell(270,7,'Penanggung Jawab,',0,1,'C');    
                $pdf->Ln(20);
                $pdf->Cell(75);
                $pdf->SetFont('Times','B',12);
                $pdf->Cell(270,7,userdata('nama'),0,1,'C');
                // $pdf->Line(192,188,248,188);
                $pdf->SetFont('Times','',12);
                $pdf->Cell(75);
                $pdf->Cell(270,7,'NIP.'.userdata('no_induk'),0,1,'C');


    
  
      
        endif;
        ob_end_clean();
        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
    }
     function report_user(){
        $this->load->library('pdf');
        $pdf = new FPDF();
        $pdf->AddPage('L', 'Letter');
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Image('./assets/img/logo1.png',10,12,17,16);
        $pdf->Image('./assets/img/2.png',255,12,16,17);
        $pdf->Cell(260, 7, 'POLITEKNIK TEDC BANDUNG' , 0, 1,'C');
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(260,7,'Jl. Politeknik - Pasantren Km. 2 Cibabat - Cimahi Utara 40513 Telp/ Fax. (022) 6645951',0,1,'C');
        $pdf->Cell(260,7,'Email : info@poltektedc.ac.id Website : http://www.poltektedc.ac.id',0,1,'C');
        $pdf->SetFont('Times', '', 10);
      
        $pdf->Line(10,32,270,32);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(260, 7, 'LAPORAN DATA USER' , 0, 1,'C');
        $pdf->Cell(260,7,' '.format_indo(date('Y-m-d')),0,1,'C');
         $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);


     
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(35, 7, 'NIM/NIP', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Nama User', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Username', 1, 0, 'C');
            $pdf->Cell(58, 7, 'Email', 1, 0, 'C');
            $pdf->Cell(35, 7, 'No.Telp', 1, 0, 'C');
            $pdf->Cell(42, 7, 'Role', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
         $data = $this->db->get('user')->result();
        foreach ($data as $d){
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(35, 7, $d->no_induk, 1, 0, 'L');
                $pdf->Cell(40, 7, $d->nama, 1, 0, 'L');
                $pdf->Cell(40, 7, $d->username, 1, 0, 'L');
                $pdf->Cell(58, 7, $d->email, 1, 0, 'L');
                $pdf->Cell(35, 7, $d->no_telp, 1, 0, 'L');
                $pdf->Cell(42, 7, $d->role, 1, 0, 'L');
                $pdf->Ln();
            }
            $pdf->Ln(30);
                $pdf->Cell(75);
                $pdf->Cell(270,7,'Bandung, '.date('d-m-y'),0,1,'C');
                $pdf->Cell(75);
                $pdf->Cell(270,7,'Penanggung Jawab,',0,1,'C');    
                $pdf->Ln(20);
                $pdf->Cell(75);
                $pdf->SetFont('Times','B',12);
                $pdf->Cell(270,7,userdata('nama'),0,1,'C');
                // $pdf->Line(192,188,248,188);
                $pdf->SetFont('Times','',12);
                $pdf->Cell(75);
                $pdf->Cell(270,7,'NIP.'.userdata('no_induk'),0,1,'C'); 
         
       
                 ob_end_clean();
        $file_name = $data;
        $pdf->Output('I', $file_name);

    }
}
