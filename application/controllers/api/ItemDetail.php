<?php

use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';



class ItemDetail extends REST_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Item_detail_model', 'itemDetail');
        // $this->methods['index_get']['limit'] = 1000;

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, itemId, variandetail");
    }


    public function index_get()
    {
        $idItem = $this->get('itemId');
        $varian = $this->get('variandetail');

        if($varian !== null){
            $itemDetail = $this->itemDetail->getitemDetail($idItem, $varian);
        }else{
            $itemDetail = $this->itemDetail->getitemDetail($idItem);
        }

        if ($itemDetail) {

            $this->response([
                'status' => true,
                'data' => $itemDetail
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data Tidak Ditemukan.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }


}