<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }

    public function getUsers($id)
    {
        /**
         * ID disini adalah untuk data yang tidak ingin ditampilkan. 
         * Maksud saya disini adalah 
         * tidak ingin menampilkan data user yang digunakan, 
         * pada managemen data user
         */
        $this->db->where('id_user !=', $id);
        $this->db->order_by('id_user', 'DESC');
        return $this->db->get('user')->result_array();
    }

    public function getIndukInventaris()
    {
        $this->db->join('jenis j', 'i.klasifikasi_barang = j.id_jenis');
        $this->db->order_by('id_aset', 'DESC');
        return $this->db->get('induk_inventaris i')->result_array();
    }

    public function getBarang()
    {   
        $this->db->join('induk_inventaris i', 'b.aset_id = i.id_aset');
        $this->db->join('ruang r', 'b.ruang_id = r.id_ruang');
        $this->db->order_by('id_barang', 'DESC');
        return $this->db->get('inventaris b')->result_array();
    }

    public function getKondisi()
    {   
        $this->db->join('induk_inventaris i', 'k.aset_id = i.id_aset');
        // // $this->db->join('ruang r', 'k.ruang_id = r.id_ruang');
        // $this->db->join('inventaris b', 'k.id_barang = b.id_barang');
        $this->db->order_by('id_kondisi');
        return $this->db->get('kondisi k')->result_array();
    }

     public function getPinjam()
    {   
        $this->db->join('induk_inventaris i', 'd1.id_aset = i.id_aset');
         $this->db->join('user u', 'd1.id_user = u.id_user');
        $this->db->order_by('id_pinjam');
        return $this->db->get('pinjam d1')->result_array();
    }

     public function getPinjam2()
    {   
       $this->db->join('ruang r', 'd1.id_ruang = r.id_ruang');
         $this->db->join('user u', 'd1.id_user = u.id_user');
        $this->db->order_by('id_pinjam');
        return $this->db->get('pinjamruang d1')->result_array();
    }

    public function proses_tampil(){
 
        $sql = $this->db->get('inventaris');
 
        return $sql;
 
        
    }

    public function getHapusAset()
    {   
        $this->db->join('induk_inventaris i', 'h.id_aset = i.id_aset');
        $this->db->join('user u', 'h.id_user = u.id_user');
        $this->db->order_by('id_hapus');
        return $this->db->get('hapus h')->result_array();
    }
 
    public function get_detail($id = NULL){
        
        $this->db->join('induk_inventaris i', 'b.aset_id = i.id_aset');
        $this->db->join('ruang r', 'b.ruang_id = r.id_ruang');
        $this->db->order_by('id_barang');
        $query = $this->db->get_where('inventaris b', array('id_barang' => $id))->row();
         return $query;
    }

     public function getBarang1($limit = null, $id_aset = null, $range = null)
    {   
        $this->db->join('induk_inventaris i', 'b.aset_id = i.id_aset');
        $this->db->join('ruang r', 'b.ruang_id = r.id_ruang');
         if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($id_aset != null) {
            $this->db->where('id_aset', $id_aset);
        }
        if ($range != null) {
            $this->db->where('tgl_pemb' . ' >=', $range['mulai']);
            $this->db->where('tgl_pemb' . ' <=', $range['akhir']);
        }
        $this->db->order_by('id_barang');
        return $this->db->get('inventaris b')->result_array();
      
    }
    public function getBarangKeluar($limit = null, $id_barang = null, $range = null)
    {
        $this->db->select('*');
        $this->db->join('user u', 'bk.user_id = u.id_user');
        $this->db->join('inventaris b', 'bk.barang_id = b.id_barang');
       
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($id_barang != null) {
            $this->db->where('id_barang', $id_barang);
        }
        if ($range != null) {
            $this->db->where('tanggal_keluar' . ' >=', $range['mulai']);
            $this->db->where('tanggal_keluar' . ' <=', $range['akhir']);
        }
        $this->db->order_by('id_barang_keluar', 'DESC');
        return $this->db->get('barang_keluar bk')->result_array();
    }

    public function getPinjamAset($limit = null, $id_aset = null, $range = null)
    {
        $this->db->select('*');
        $this->db->join('user u', 'p.id_user = u.id_user');
        $this->db->join('induk_inventaris i', 'p.id_aset = i.id_aset');
       
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($id_aset != null) {
            $this->db->where('id_aset', $id_aset);
        }
        if ($range != null) {
            $this->db->where('tgl_pinjam' . ' >=', $range['mulai']);
            $this->db->where('tgl_pinjam' . ' <=', $range['akhir']);
        }
        $this->db->order_by('id_pinjam', 'DESC');
        return $this->db->get('tbl_riwayat p')->result_array();
    }

     public function getPinjamRuang($limit = null, $id_ruang = null, $range = null)
    {
        $this->db->select('*');
        $this->db->join('user u', 'p.id_user = u.id_user');
        $this->db->join('ruang r', 'p.id_ruang = r.id_ruang');
       
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($id_ruang != null) {
            $this->db->where('id_ruang', $id_ruang);
        }
        if ($range != null) {
            $this->db->where('tgl_pinjam' . ' >=', $range['mulai']);
            $this->db->where('tgl_pinjam' . ' <=', $range['akhir']);
        }
        $this->db->order_by('id_pinjam', 'DESC');
        return $this->db->get('tbl_riwayat1 p')->result_array();
    }

    //  public function getPinjam($limit = null, $id_aset = null)
    // {
    //     $this->db->select('*');
    //     $this->db->join('user u', 'bk.user_id = u.id_user');
    //     $this->db->join('induk_inventaris i', 'p.id_aset = i.id_aset');
       
    //     if ($limit != null) {
    //         $this->db->limit($limit);
    //     }
    //     if ($id_aset != null) {
    //         $this->db->where('id_aset', $id_aset);
    //     }
    //     // if ($range != null) {
    //     //     $this->db->where('tanggal_keluar' . ' >=', $range['mulai']);
    //     //     $this->db->where('tanggal_keluar' . ' <=', $range['akhir']);
    //     // }
    //     $this->db->order_by('id_pinjam', 'DESC');
    //     return $this->db->get('pinjam p')->result_array();
    // }
    function select_where_join($table,$select,$column,$where,$table_join,$join1,$join2){
        $this->load->database('default',TRUE);
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table_join, $join1.' = '.$join2);
        $this->db->where($column,$where);
        $data = $this->db->get();
        return $data;
    }
    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    public function sum($table, $field)
    {
        $this->db->select_sum($field);
        return $this->db->get($table)->row_array()[$field];
    }

    public function min($table, $field, $min)
    {
        $field = $field . ' <=';
        $this->db->where($field, $min);
        return $this->db->get($table)->result_array();
    }

    public function chartBarangMasuk($bulan)
    {
        $like = 'T-BM-' . date('y') . $bulan;
        $this->db->like('id_barang_masuk', $like, 'after');
        return count($this->db->get('barang_masuk')->result_array());
    }

    public function chartBarangKeluar($bulan)
    {
        $like = 'T-BK-' . date('y') . $bulan;
        $this->db->like('id_barang_keluar', $like, 'after');
        return count($this->db->get('barang_keluar')->result_array());
    }

    public function laporan($table, $mulai, $akhir)
    {
        $tgl = $table == 'tbl_riwayat' ? 'tgl_pinjam' : 'tgl_pinjam';
        $this->db->where($tgl . ' >=', $mulai);
        $this->db->where($tgl . ' <=', $akhir);
        return $this->db->get($table)->result_array();
    }

    public function cekStok($id)
    {
        $this->db->join('satuan s', 'b.satuan_id=s.id_satuan');
        return $this->db->get_where('inventaris b', ['id_barang' => $id])->row_array();
    }
}
