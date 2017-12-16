<?php

class Admins extends Controller {

    public function __construct() {
        parent::__construct();
    }
    public function index(){
    	$this->error();
    }
    public function add(){
    	if( empty($this->me) || $this->format!='json' ) $this->error();

    	$this->view->setPage('path', 'Themes/manage/forms/admins');
    	$this->view->render('add');
    }
    public function edit($id=null){
    	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;
    	if( empty($id) || empty($this->me) || $this->format!='json' ) $this->error();

    	$item = $this->model->get($id);
    	if( empty($item) ) $this->error();

    	$this->view->item = $item;
    	$this->view->setPage('path', 'Themes/manage/forms/admins');
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
    		$form 	->post('name')->val('is_empty')
    				->post('username')->val('is_empty')
    				->post('email');
    		$form->submit();
    		$postData = $form->fetch();

    		if( empty($item) ){
    			if( empty($_POST["password"]) ) {
    				$arr['error']['password'] = 'Please enter the password.';
    			}
    			elseif( strlen($_POST['password']) < 4 ){
    				$arr['error']['password'] = 'Please enter 4 or more characters.';
    			}
    			else{
    				$postData['password'] = $this->fn->q('password')->encryptPasswordLaravel($_POST["password"]);
    			}
    		}

    		$has_user = true;
    		if( !empty($item) ){
    			if( $item['username'] == $postData['username'] ){
    				$has_user = false;
    			}
    		}
    		if( $this->model->is_user($postData['username']) && $has_user ){
    			$arr['error']['username'] = 'This username has already been entered.';
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
    		$this->view->item = $item;
    		$this->view->setPage('path', 'Themes/manage/forms/admins');
    		$this->view->render('del');
    	}
    }
    public function change_password($id=null){
    	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;
    	if( empty($id) || empty($this->me) || $this->format!='json' ) $this->error();

    	$item = $this->model->get($id);
    	if( empty($item) ) $this->error();

    	if( !empty($_POST) ){
    		if( strlen($_POST["password"]) < 4 ){
    			$arr['error']['password'] = 'Please enter more than 4 characters.';
    		}
    		if( $_POST["password"] != $_POST["password2"] ){
    			$arr['error']['password2'] = 'Passwords do not match.';
    		}

    		if( empty($arr['error']) ){
    			$password = $this->fn->q('password')->PasswordHash($_POST["password"]);
    			$this->model->update($id, array('password'=>$password));

    			$arr['message'] = 'Save new passwords successfully.';
    			$arr['url'] = 'refresh';
    		}

    		echo json_encode($arr);
    	}
    	else{
    		$this->view->item = $item;
    		$this->view->setPage('path', 'Themes/manage/forms/admins');
    		$this->view->render('password');
    	}
    }
}
