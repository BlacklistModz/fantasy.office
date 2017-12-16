<?php

class Sales extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($id=null){

    	$this->view->setPage('on', 'sales');
    	$this->view->setPage('title', 'Saller Management');

    	if( !empty($id) ){
    		$item = $this->model->get($id);
    		if( empty($item) ) $this->error();

            $orders = $this->model->query('orders')->lists( array('sale'=>$item['sale_code']) );

            $this->view->setData('orders', $orders);
            $this->view->setData('item', $item);
    		$render = 'sales/profile/display';
    	}
    	else{
    		if( $this->format=='json' ){
    			$this->view->setData('results', $this->model->lists());
    			$render = 'sales/lists/json';
    		}
    		else{
                $this->view->setData('status', $this->model->status());
    			$render = 'sales/lists/display';
    		}
    	}
    	$this->view->render( $render );
    }

    public function add(){
    	if( empty($this->me) || $this->format!='json' ) $this->error();

    	$this->view->setData('region', $this->model->region());
      $this->view->setData('status', $this->model->status());
    	$this->view->setPage('path', 'Themes/manage/forms/sales');
    	$this->view->render('add');
    }

    public function edit($id=null) {
    	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;
    	if( empty($id) || empty($this->me) || $this->format!='json' ) $this->error();

    	$item = $this->model->get($id);
    	if( empty($item) ) $this->error();

      $this->view->setData('region', $this->model->region());
      $this->view->setData('status', $this->model->status());
    	$this->view->setData('item', $item);
    	$this->view->setPage('path', 'Themes/manage/forms/sales');
    	$this->view->render('add');
    }

    public function save() {
    	if ( empty($_POST) ) $this->error();

    	$id = isset($_POST["id"]) ? $_POST["id"] : null;
    	if ( !empty($id) ) {
    		$item = $this->model->get($id);
    		if( empty($item) ) $this->error();
    	}

    	try{
    		$form = new Form();
    		$form 	->post('sale_code')->val('is_empty')
    				->post('sale_name')->val('is_empty')
    				->post('sale_fullname')
                    ->post('username')->val('is_empty')
                    ->post('region')
                    ->post('status')->val('is_empty');
    		$form->submit();
    		$postData = $form->fetch();

        $has_username = true;
        if( !empty($item) ){
          if( $item['username'] == $postData['username'] ) $has_username = false;
        }
        if( $this->model->is_username($postData['username']) && $has_username ){
    			$arr['error']['username'] = 'This user has been detected in the system.';
    		}


    		if (empty($item)) {
          if (empty($_POST['password'])) {
            $arr['error']['password'] = 'This field is blank.';
          } elseif (strlen($_POST['password']) < 4) {
            $arr['error']['password'] = 'Please enter more than 4 passwords.';
          } else {
            $postData['password'] = $this->fn->q('password')->encryptPasswordLaravel($_POST['password']);
          }
        }

    		if( empty($arr['error']) ){
    			if( !empty($id) ){
    				$this->model->update($id, $postData);
    			}
    			else{
    				$this->model->insert($postData);
    			}

    			$arr['message'] = 'Save successfully.';
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
    			$arr['message'] = 'Delete data successfully.';
    			$arr['url'] = 'refresh';
    		}
    		else{
    			$arr['message'] = 'Data can not be deleted.';
    		}
    		echo json_encode($arr);
    	}
    	else{
    		$this->view->setData('item', $item);
    		$this->view->setPage('path', 'Themes/manage/forms/sales');
    		$this->view->render('del');
    	}
    }

    public function sort() {
        $ids = isset($_REQUEST['ids']) ? $_REQUEST['ids']: '';
        if( empty($ids) || empty($this->me) ) $this->error();

        $seq = 0;
        foreach ($ids as $id) {
            $seq++;
            $this->model->update($id, array('seq'=>$seq));
        }

        $arr['message'] = 'Save successfully.';
    }

    //ฟักชั่นเปลี่ยนรหัสผ่าน
    public function change_password($id=null) {
      $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;
      if( empty($id) || empty($this->me) || $this->format!='json' ) $this->error();

      $item = $this->model->get($id);
      if( empty($item) ) $this->error();

    	if ( !empty($_POST) ) {
        if (strlen($_POST['password_1']) < 4) {
          $arr['error']['password_1'] = 'Password must be longer than 4 characters.';
        }
        if ($_POST['password_1'] != $_POST['password_2']) {
          $arr['error']['password_2'] = 'Passwords do not match.';
        }

        if (empty($arr['error'])) {
          $password = $this->fn->q('password')->encryptPasswordLaravel($_POST["password_1"]);
          $this->model->update($id, array('password_1'=>$password));
          $arr['message'] = 'Save new passwords successfully.';
          $arr['url'] = 'refresh';
        }
        echo json_encode($arr);
    	}
    	else {

    		$this->view->setData('item', $item);
    		$this->view->setPage('path', 'Themes/manage/forms/sales');
    		$this->view->render('password');
    	}
    }

}
