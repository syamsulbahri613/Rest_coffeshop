<?php

class Item_detail_model extends CI_Model
{

    public function getitemDetail($id, $varian = null)
    {
        if($varian === null){
            $this->db->from('TblDetailItem');
            $this->db->where('TblDetailItem.idDetailItemRef', $id);
            $query = $this->db->get();
            return $query->result_array();
        }else{
            $this->db->from('TblDetailItem');
            $this->db->where('TblDetailItem.idDetailItemRef', $id);
            $this->db->where('TblDetailItem.varianDetailItem', $varian);
            $query = $this->db->get();
            return $query->result_array();
        };
    }
}