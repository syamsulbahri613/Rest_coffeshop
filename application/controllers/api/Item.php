<?php

use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';



class Item extends REST_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Item_model', 'item');
        // $this->methods['index_get']['limit'] = 1000;

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, idItem, search");
    }


    public function index_get()
    {
        $id = $this->get('idItem');
        $idKat = $this->get('idKatItem');
        $search = $this->get('search');

        if ($search !== null) {
            // Jika ada parameter pencarian, gunakan metode pencarian
            $item = $this->item->getItemBySearch($search);
        } else {
            // Jika tidak, gunakan logika yang sudah ada sebelumnya
            if ($idKat === null) {
                if ($id === null) {
                    $item = $this->item->getItem();
                } else {
                    $item = $this->item->getItem($id);
                }
            } else {
                $item = $this->item->getItemByKategori($idKat);
            }
        }

        if ($item) {

            $this->response([
                'status' => true,
                'data' => $item
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data Tidak Ditemukan.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_post()
    {

        $data = [
            'kodeItemKatId' => $this->post('kodeItemKatId'),
            'kodeItemType' => $this->post('kodeItemType'),
            'statusItem' => $this->post('statusItem'),
            'kodeItem' => $this->post('kodeItem'),
            'namaItem' => $this->post('namaItem'),
            'desItem' => $this->post('desItem'),
            'varianItem' => $this->post('varianItem')

        ];

        if($this->item->createItem($data) > 0) {
            $this->response([
                        'status' => true,
                        'message' => 'created'
                    ], REST_Controller::HTTP_CREATED);
        }else {
            $this->response([
                        'status' => false,
                        'message' => 'failed to created data'
                    ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }


}