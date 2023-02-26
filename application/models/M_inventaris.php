<?php 
class M_inventaris extends CI_Model{

	public function getBarang()
    {   
        $this->db->join('induk_inventaris i', 'b.aset_id = i.id_aset');
        $this->db->join('ruang r', 'b.ruang_id = r.id_ruang');
        $this->db->order_by('id_barang');
        return $this->db->get('inventaris b')->result_array();
    }


	function simpan_inventaris($id_barang,$aset_id,$no_seri,$ukuran,$bahan,$tgl_pemb,$harga_bel,$sumber_dana,$ruang_id,$foto){
		$hsl=$this->db->query("INSERT INTO inventaris (id_barang,aset_id,no_seri,ukuran,bahan,tgl_pemb,harga_bel,sumber_dana,ruang_id,foto) VALUES ('$id_barang','$aset_id','$no_seri','$ukuran','$bahan','$tgl_pemb','$harga_bel','$sumber_dana','ruang_id','$foto')");
		return $hsl;
	}
	function simpan_inventaris_tanpa_img($id_barang,$aset_id,$no_seri,$ukuran,$bahan,$tgl_pemb,$harga_bel,$sumber_dana,$ruang_id){
		$hsl=$this->db->query("INSERT INTO inventaris (id_barang, aset_id,no_seri,ukuran,bahan,tgl_pemb,harga_bel,sumber_dana,ruang_id) VALUES ('$id_barang','$aset_id','$no_seri','$ukuran','$bahan','$tgl_pemb','$harga_bel','$sumber_dana','ruang_id')");
		return $hsl;
	}

	//front-end
	function inventaris(){
		$hsl=$this->db->query("SELECT * FROM inventaris");
		return $hsl;
	}
	function inventaris_perpage($offset,$limit){
		$hsl=$this->db->query("SELECT * FROM inventaris limit $offset,$limit");
		return $hsl;
	}

}