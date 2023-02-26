<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_basic extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	function get_all_row($table){
		$this->db->select($table.'.*');
		$this->db->from($table);
		return $this->db->get()->row();
	}
	function get_galeri_content(){
		$this->db->select('parent_menu.*,'.$this->tbl_galeri.'.title as parent');
		$this->db->from($this->tbl_galeri);
		$this->db->join($this->tbl_galeri_content.' as parent_menu','parent_menu.id_parent = '.$this->tbl_galeri.'.id','left');
		return $this->db->get()->result();
	}
	function get_galeri_content_where($id){
		$this->db->select('parent_menu.*,'.$this->tbl_galeri.'.title as parent');
		$this->db->from($this->tbl_galeri);
		$this->db->join($this->tbl_galeri_content.' as parent_menu','parent_menu.id_parent = '.$this->tbl_galeri.'.id','left');
		$this->db->where('parent_menu.id',$id);
		return $this->db->get();
	}
	function get_count($table){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		return $this->db->get()->num_rows();
	}
	function select_all($table){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$data = $this->db->get();
		return $data->result();
	}
	function select_all_join_2($table,$select,$table_join1,$join1,$join2,$table_join2,$join3,$join4){
		$this->load->database('default',TRUE);
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table_join1, $join1.' = '.$join2);
		$this->db->join($table_join2, $join3.' = '.$join4);
		$data = $this->db->get();
		return $data->result();
	}
	function select_where($table,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$where);
		$data = $this->db->get();
		return $data;
	}
	function select_where_join($table,$select,$column,$where,$table_join,$join1,$join2){
		$this->load->database('default',TRUE);
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table_join, $join1.' = '.$join2);
		$this->db->where($column,$where);
		$data = $this->db->get();
		return $data;
	}
	function select_where_join_2($table,$select,$column,$where,$table_join1,$join1,$join2,$table_join2,$join3,$join4){
		$this->load->database('default',TRUE);
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table_join1, $join1.' = '.$join2);
		$this->db->join($table_join2, $join3.' = '.$join4);
		$this->db->where($column,$where);
		$data = $this->db->get();
		return $data;
	}
	function select_where_order($table,$column,$where,$order_by,$order_type){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column,$where);
        $this->db->order_by($order_by, $order_type);
		$data = $this->db->get();
		return $data;
	}
	function select_where_array($table,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$data = $this->db->get();
		return $data;
	}
	function select_where_array_order($table,$where,$order_by,$order_type){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
        $this->db->order_by($order_by, $order_type);
		$data = $this->db->get();
		return $data;
	}
	function select_where_array_order_limit($table,$where,$order_by,$order_type,$limit){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
        $this->db->order_by($order_by, $order_type);
        $this->db->limit($limit);
		$data = $this->db->get();
		return $data;
	}
	function insert_all($table,$data) {
		$this->load->database('default',TRUE);
		if(!$this->db->insert($table,$data))
			return FALSE;
		$data["id"] = $this->db->insert_id();
		return (object)$data;
	}
	function insert_all_batch($table,$data) {
		$this->load->database('default',TRUE);
		if(!$this->db->insert_batch($table,$data))
			return FALSE;
		$data["id"] = $this->db->insert_id();
		return (object)$data;
	}
	function update($table,$data,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->where($column,$where);
		return $this->db->update($table,$data);
	}
	function update_one($table,$column,$where,$target,$action){
		$this->db->set($target, $target.$action, FALSE);
		$this->db->where($column, $where);
		return $this->db->update($table);
	}
	function delete($table,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->where($column,$where);
		return $this->db->delete($table);
	}
    function select_all_limit($table, $limit){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$data = $this->db->get($table, $limit);
		return $data;
	}
    function select_where_limit($table,$column,$where,$limit){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->where($column,$where);
		$data = $this->db->get($table, $limit);
		return $data;
	}
	function count($table){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
		return $this->db->count_all_results();
	}
	function count_where($table,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->where($column,$where);
		$this->db->from($table);
		return $this->db->count_all_results();
	}
	function count_like($table,$column,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->like($column,$where);
		$this->db->from($table);
		return $this->db->count_all_results();
	}
	function count_where_array($table,$where){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->from($table);
		return $this->db->count_all_results();
	}
    function select_all_order($table, $order_by, $order){
		$this->load->database('default',TRUE);
		$this->db->select('*');
		$this->db->from($table);
        $this->db->order_by($order_by, $order);
		$data = $this->db->get();
		return $data->result();
	}
	function get_paging($table,$limit,$from,$order,$type) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->limit($limit,$from);
		$this->db->order_by($order,$type);
		return $this->db->get()->result();
	}
	function get_paging_where($table,$limit,$from,$order,$type,$column,$where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->limit($limit,$from);
		$this->db->where($column,$where);
		$this->db->order_by($order,$type);
		return $this->db->get()->result();
	}
	function get_paging_where_like($table,$limit,$from,$order,$type,$column,$where,$column_like,$keyword) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->limit($limit,$from);
		$this->db->where($column,$where);
		$this->db->like($column_like,$keyword);
		$this->db->order_by($order,$type);
		return $this->db->get()->result();
	}
	function get_paging_where_array($table,$limit,$from,$order,$type,$where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->limit($limit,$from);
		$this->db->where($where);
		$this->db->order_by($order,$type);
		return $this->db->get()->result();
	}

	function upload(){
    $config['upload_path'] = './images/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size']  = '2048';
    $config['remove_space'] = TRUE;

    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('input_gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }
	// Fungsi untuk menyimpan data ke database
	public function save($upload){
    $data = array(
      'deskripsi'=>$this->input->post('input_deskripsi'),
      'nama_file' => $upload['file']['file_name'],
      'ukuran_file' => $upload['file']['file_size'],
      'tipe_file' => $upload['file']['file_type']
    );

    $this->db->insert('gambar', $data);
  }

}
