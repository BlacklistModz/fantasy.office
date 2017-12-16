<?php

class Me extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        // print_r($this->me); die;
        $this->error();
        // header('location:'.URL.'manage/products');
    }

    public function navTrigger() {
        if( $this->format!='json' ) $this->error();


        if( isset($_REQUEST['status']) ){

            Session::init();
            Session::set('isPushedLeft', $_REQUEST['status']);
        }
    }

    /* updated */
    /**/
    public function updated($avtive='') {

        if( empty($_POST) || empty($this->me) || $this->format!='json' || $avtive=="" ) $this->error();

        /**/
        /* account */
        if( $avtive=='account' ){
            try {
                $form = new Form();
                $form   ->post('username')->val('username');

                $form->submit();
                $dataPost = $form->fetch();

                if( $this->model->query('admins')->is_user( $dataPost['username'] ) && $this->me['username']!=$dataPost['username'] ){
                    $arr['error']['username'] = 'This username has already been used.';
                }

                // Your username must be longer than 4 characters.

                if( empty($arr['error']) ){

                    $this->model->query('admins')->update( $this->me['id'], $dataPost );

                    $arr['url'] = 'refresh';
                    $arr['message'] = 'Save successfully.';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }

            echo json_encode($arr);
            exit;
        }
        /**/
        /* basic */
        else if( $avtive=='basic' ){

            try {
                $form = new Form();
                $form   ->post('name')->val('is_empty')
                        ->post('email');

                $form->submit();
                $dataPost = $form->fetch();

                if( empty($arr['error']) ){

                    $this->model->query('admins')->update( $this->me['id'], $dataPost );

                    $arr['url'] = 'refresh';
                    $arr['message'] = 'Save successfully.';
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }

            echo json_encode($arr);
            exit;
        }

        /**/
        /* password */
        if( $avtive=='password' ){

            $data = $_POST;
            $arr = array();
            if( !$this->model->query('admins')->loginLaravel($this->me['username'], $data['password_old']) ){
                $arr['error']['password_old'] = "Password is incorrect.";
            } elseif ( strlen($data['password_new']) < 4 ){
                $arr['error']['password_new'] = "Passwords are too short for at least 4 characters.";

            } elseif ($data['password_new'] == $data['password_old']){
                $arr['error']['password_new'] = "Passwords must be different from old passwords.";

            } elseif ($data['password_new'] != $data['password_confirm']){
                $arr['error']['password_confirm'] = "You must enter the same password twice to confirm.";
            }

            if( !empty($arr['error']) ){
                $this->view->error = $arr['error'];
            }
            else{
                $this->model->query('admins')->update($this->me['id'], array(
                    'password' => $this->fn->q('password')->encryptPasswordLaravel($_POST['password_new'])
                ));

                $arr['url'] = 'refresh';
                $arr['message'] = 'Save completed.';
            }

            echo json_encode($arr);
            exit;
        }

        $this->error();
    }
    /*public function change_password() {

        if( empty($this->me) || $this->format!='json' ) $this->error();

        if( !empty($_POST) ){
            try {
                $form = new Form();
                $form   ->post('password_old')->val('password')
                        ->post('password_new')->val('password')
                        ->post('password_confirm')->val('password');

                $form->submit();
                $dataPost = $form->fetch();

                $old_pass = Hash::create('sha256', $dataPost['password_old'], HASH_PASSWORD_KEY );
                if( !$this->model->query('employees')->is_checkpass($this->me['id'], $old_pass) ) {
                    $arr['error']['password_old'] = 'รหัสผ่านเดิมผิด !';
                }

                if( $dataPost['password_new']!=$dataPost['password_confirm'] ){
                    $arr['error']['password_confirm'] = 'รหัสผ่านไม่ตรงกัน';
                }

                if( empty($arr['error']) ){

                    // update
                    $this->model->query('employees')->update($this->me['id'], array(
                        'emp_password' => Hash::create('sha256', $dataPost['password_new'], HASH_PASSWORD_KEY )
                    ));

                    $arr['message'] = "แก้ไขข้อมูลเรียบร้อย";
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }

            echo json_encode($arr);
        }
        else{
            $this->view->setData('item', $this->me );
            $this->view->render("Themes/crm/forms/my/change_password");
        }
    }*/

}
