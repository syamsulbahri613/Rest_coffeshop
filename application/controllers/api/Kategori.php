<?php

use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';



class Kategori extends REST_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model', 'kategori');
        // $this->methods['index_get']['limit'] = 1000;

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, idKatItem");
    }


    public function index_get()
    {
        $id = $this->get('idKatItem');
        if($id === null){
            $kategori = $this->kategori->getKategori();
        }else{
            $kategori = $this->kategori->getKategori($id);
        }

        if ($kategori) {
            // // Tambahkan URL gambar ke dalam data kategori
            // foreach ($kategori as $kategoris) {
            //     $kategori['idImgkategori'] = base_url('assets/kategori_image/' . $kategori['srcImgkategori']);
            // }

            $this->response([
                'status' => true,
                'data' => $kategori
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "Data Tidak Ditemukan."
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // public function index_post()
    // {

    //     $data = [
    //         'kodeItemKatId' => $this->post('kodeItemKatId'),
    //         'kodeItemType' => $this->post('kodeItemType'),
    //         'statusItem' => $this->post('statusItem'),
    //         'kodeItem' => $this->post('kodeItem'),
    //         'namaItem' => $this->post('namaItem'),
    //         'desItem' => $this->post('desItem'),
    //         'varianItem' => $this->post('varianItem')

    //     ];

    //     if($this->item->createItem($data) > 0) {
    //         $this->response([
    //                     'status' => true,
    //                     'message' => 'created'
    //                 ], REST_Controller::HTTP_CREATED);
    //     }else {
    //         $this->response([
    //                     'status' => false,
    //                     'message' => 'failed to created data'
    //                 ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }


}