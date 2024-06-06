<?php

class Kategori_model extends CI_Model
{

    public function getKategori($id = null)
    {
        if($id === null){
            $this->db->from('TblKategoriItem');
            $query = $this->db->get();
            return $query->result_array();
        }else {
            $this->db->from('TblKategoriItem');
            $this->db->where('TblKategoriItem.idKatItem', $id);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
}