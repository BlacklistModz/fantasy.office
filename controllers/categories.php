<?php

class Categories extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    	
    	$this->view->setPage('on', 'categories');
    	$this->view->setPage('title', 'จัดการหมวดหมู่สินค้า');

    	$this->view->js('jquery/jquery-ui.min');

    	$this->view->setData('results', $this->model->lists( array('sort'=>'seq', 'dir'=>'ASC') ));
    	$this->view->render('categories/lists');
    }

    public function add(){
    	if( empty($this->me) || $this->format!='json' ) $this->error();

        $this->view->setData('category', $this->model->lists());
    	$this->view->setData('status', $this->model->status());
    	$this->view->setPage('path', 'Themes/manage/forms/categories');
    	$this->view->render('add');
    }
    public function edit($id=null){
    	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;
    	if( empty($id) || empty($this->me) || $this->format!='json' ) $this->error();

    	$item = $this->model->get($id);
    	if( empty($item) ) $this->error();

    	$this->view->setData('item', $item);
        $this->view->setData('category', $this->model->lists( array('not'=>$item['id']) ));
    	$this->view->setData('status', $this->model->status());
    	$this->view->setPage('path', 'Themes/manage/forms/categories');
    	$this->view->render('add');
    }
    public function save(){
    	if( empty($_POST) ) $this->error();

    	$id = isset($_POST["id"]) ? $_POST["id"] : null;
    	if( !empty($id) ){
    		$item = $this->model->get($id);
    		if( empty($item) ) $this->error();
    	}

    	try{
    		$form = new Form();
    		$form 	->post('firstCode')
    				->post('name_th')->val('is_empty')
    				->post('name_en')->val('is_empty')
    				->post('status')
                    ->post('cate_id');
    		$form->submit();
    		$postData = $form->fetch();

    		$has_th = true;
    		$has_en = true;
    		if( !empty($item) ){
    			if( $item['name_th'] == $postData['name_th'] ) $has_th = false;
    			if( $item['name_en'] == $postData['name_en'] ) $has_en = false;
    		}
    		if( $this->model->is_name_th($postData['name_th']) && $has_th ){
    			$arr['error']['name_th'] = 'ตรวจพบชื่อนี้ในระบบ';
    		}
    		if( $this->model->is_name_en($postData['name_en']) && $has_en ){
    			$arr['error']['name_en'] = 'ตรวจพบชื่อนี้ในระบบ';
    		}

            $postData['name_th'] = trim($postData['name_th']);
            $postData['name_en'] = trim($postData['name_en']);

            $postData['is_sub'] = !empty($_POST["is_sub"]) ? $_POST["is_sub"] : 0;
            if( !empty($postData['is_sub']) ){
                if( empty($postData['cate_id']) ) $arr['error']['cate_id'] = 'กรุณาเลือกหมวดหมู่ที่ต้องการให้เป็นเมนูหลัก';
            }else{
                $postData['cate_id'] = 0;
            }

    		if( empty($arr['error']) ){
    			if( !empty($id) ){
    				$this->model->update($id, $postData);
    			}
    			else{
    				$this->model->insert($postData);
    			}

    			$arr['message'] = 'บันทึกเรียบร้อย';
    			$arr['url'] = 'refresh';
    		}

    	} catch (Exception $e) {
    		$arr['error'] = $this->_getError($e->getMessage());
    	}
    	echo json_encode($arr);
    }
    public function del($id=null){
    	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;
    	if( empty($id) || empty($this->me) || $this->format!='json' ) $this->error();

    	$item = $this->model->get($id);
    	if( empty($item) ) $this->error();

    	if( !empty($_POST) ){
    		if( !empty($item['permit']['del']) ){
    			$this->model->delete($id);
    			$arr['message'] = 'ลบข้อมูลเรียบร้อย';
    			$arr['url'] = 'refresh';
    		}
    		else{
    			$arr['message'] = 'ไม่สามารถลบข้อมูลได้';
    		}
    		echo json_encode($arr);
    	}
    	else{
    		$this->view->setData('item', $item);
    		$this->view->setPage('path', 'Themes/manage/forms/categories');
    		$this->view->render('del');
    	}
    }

    public function sort()
    {
        $ids = isset($_REQUEST['ids']) ? $_REQUEST['ids']: '';
        if( empty($ids) || empty($this->me) ) $this->error();

        $seq = 0;
        foreach ($ids as $id) {
            $seq++;
            $this->model->update($id, array('seq'=>$seq));
        }

        $arr['message'] = 'บันทึกเรียบร้อย';
    }
}