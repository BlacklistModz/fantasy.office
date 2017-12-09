<?php 
class Products extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    	if( empty($this->me) ) $this->error();

    	$this->view->setPage('title', 'รายการสินค้า');
    	$this->view->setPage('on', 'products');

    	if( $this->format=='json' ){
    		$this->view->setData('results', $this->model->lists());
    		$render = 'products/lists/json';
    	}
    	else{
    		$this->view->setData('categories', $this->model->query('categories')->lists());
    		$render = 'products/lists/display';
    	}
    	$this->view->render($render);
    }

    public function set_comission($id=null){
    	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;
    	if( empty($id) || empty($this->me) || $this->format!='json' ) $this->error();

    	$item = $this->model->get($id);
    	if( empty($item) ) $this->error();

    	if( !empty($_POST) ){
    		try{
    			$form = new Form();
    			$form 	->post('pds_comission')->val('is_empty');
    			$form->submit();
    			$postData = $form->fetch();

    			if( !is_numeric($postData['pds_comission']) ) {
    				$arr['error']['pds_comission'] = 'กรอกได้เฉพาะตัวเลขเท่านั้น';
    			}
    			if( $postData['pds_comission'] > 100 ){
    				$arr['error']['pds_comission'] = 'ไม่สามารถกรอกคอมมิชชั่นเกิน 100% ได้';
    			}

    			if( empty($arr['error']) ){
    				$this->model->update($id, $postData);

    				$arr['message'] = 'บันทึกเรียบร้อย';
    				$arr['url'] = 'refresh';
    			}

    		} catch (Exception $e) {
    			$arr['error'] = $this->_getError($e->getMessage());
    		}
    		echo json_encode($arr);
    	}
    	else{
    		$this->view->setData('item', $item);
    		$this->view->setPage('path', 'Themes/manage/forms/products');
    		$this->view->render('add_comission');
    	}
    }
}