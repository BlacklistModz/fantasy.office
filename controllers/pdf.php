<?php

class Pdf extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    	$this->error();
    }

    public function reports(){
    	$type = isset($_REQUEST["type"]) ? $_REQUEST["type"] : 'revenue';
    	$start = isset($_REQUEST["period_start"]) ? $_REQUEST["period_start"] : date("Y-m-d");
        $end = isset($_REQUEST["period_end"]) ? $_REQUEST["period_end"] : date("Y-m-d");

        $this->view->setData('start', $start);
        $this->view->setData('end', $end);
        $this->view->setData("section", 'reports/'.$type);

        $this->view->setData('periodStr', $this->fn->q('time')->str_event_date($start, $end).' '.date("Y", strtotime($end)));

    	if( $type == 'revenue' ){

    		$options = array(
    			'period_start'=>$start,
    			'period_end'=>$end,
    			'not_status'=>7,
    			'unlimit'=>true
    		);
    		$results = $this->model->query('orders')->lists( $options );
    		$this->view->setData('results', $results);
    	}
    	else{
    		$this->error();
    	}

        $this->view->render("display");
    }

// เขียนใหม่ สำหรับ vat sale
    public function vat_sale($id=null) {
      $item = $this->model->query('bills')->get($id, array("items"=>true));
      // print_r($item);die;
      if( empty($item) ) $this->error();

      $this->view->setData('item', $item);
      $this->view->render("vatsale");
    }
}
