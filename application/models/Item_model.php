<?php

class Item_model extends CI_Model
{

    public function getItem($id = null)
    {
        if($id === null){
            $this->db->from('TblItem');
            $this->db->join('TblKategoriItem', 'TblKategoriItem.idKatItem = TblItem.kodeItemKatId', 'left');
            $this->db->join('TblTypeItem', 'TblTypeItem.idTypeItem = TblItem.kodeItemType', 'left');
            $this->db->join('TblImgItem', 'TblImgItem.idItemRef = TblItem.idItem', 'left');
            $query = $this->db->get();
            return $query->result_array();
        }else {
            $this->db->from('TblItem');
            $this->db->join('TblKategoriItem', 'TblKategoriItem.idKatItem = TblItem.kodeItemKatId', 'left');
            $this->db->join('TblTypeItem', 'TblTypeItem.idTypeItem = TblItem.kodeItemType', 'left');
            $this->db->join('TblImgItem', 'TblImgItem.idItemRef = TblItem.idItem', 'left');
            $this->db->where('TblItem.idItem', $id);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function getItemBySearch($search)
    {
        $this->db->from('TblItem');
        $this->db->join('TblKategoriItem', 'TblKategoriItem.idKatItem = TblItem.kodeItemKatId', 'left');
        $this->db->join('TblTypeItem', 'TblTypeItem.idTypeItem = TblItem.kodeItemType', 'left');
        $this->db->join('TblImgItem', 'TblImgItem.idItemRef = TblItem.idItem', 'left');
        
        if ($search !== null) {
            $this->db->like('TblItem.namaItem', $search);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getItemByKategori($idKat)
    {
        $this->db->from('TblItem');
        $this->db->join('TblKategoriItem', 'TblKategoriItem.idKatItem = TblItem.kodeItemKatId', 'left');
        $this->db->join('TblTypeItem', 'TblTypeItem.idTypeItem = TblItem.kodeItemType', 'left');
        $this->db->join('TblImgItem', 'TblImgItem.idItemRef = TblItem.idItem', 'left');
        $this->db->where('TblItem.kodeItemKatId', $idKat);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function createItem($data)
    {
        $this->db->insert('TblItem',$data);
        return $this->db->affected_rows();
    }

    // public function getMahasiswa($id = null)
    // {
    //     if($id === null){
    //         return $this->db->get('mahasiswa')->result_array();
    //     }else {
    //         return $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
    //     }
    // }

    // public function deleteMahasiswa($id)
    // {
    //     $this->db->delete('mahasiswa', ['id' => $id]);
    //     return $this->db->affected_rows();
    // }

    // public function createMahasiswa($data)
    // {
    //     $this->db->insert('mahasiswa',$data);
    //     return $this->db->affected_rows();
    // }

    // public function updateMahasiswa($data, $id)
    // {
    //     $this->db->update('mahasiswa', $data, ['id' => $id]);
    //     return $this->db->affected_rows();
    // }
}