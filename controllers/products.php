<?php
class Products extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    	if( empty($this->me) ) $this->error();

    	$this->view->setPage('title', 'Products');
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
    public function settings($section='basic', $id=null){
        $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;

        if( !empty($id) ){
            $item = $this->model->get($id);
            if( empty($item) ) $this->error();

            $this->view->setData('item', $item);
        }

        $this->view
            ->js( 'plugins/loadImage')
            ->js( 'plugins/lightbox')
            ->js( 'plugins/mediaGallery')
            ->js( 'tinymce/jquery.tinymce.min')
            ->js( 'tinymce/tinymce.min');

        $this->view->setPage('title', 'Product Management');
        $this->view->setPage('on', 'products');

        if( $section != 'basic' && empty($item) ){
            header('location:'.URL.'products/settings/basic');
        }

        if( $section == 'basic' ){
            $this->view->setData('category', $this->model->category());
        }

        $this->view->setData('section', $section);
        $this->view->render('products/settings/display');
    }
    public function update($section='basic', $id=null){
        $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;

        

        if( !empty($id) ){
            $item = $this->model->get($id);
            if( empty($item) ) $this->error();
        }

        if( $section == 'basic' ){
            try{
                $form = new Form();
                $form   ->post('pds_categories_id')->val('is_empty')
                        ->post('pds_code')
                        ->post('pds_name')->val('is_empty')
                        ->post('pds_detail')
                        ->post('pds_barcode');
                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){
                    if( !empty($id) ){
                        $this->model->update($id, $postData);
                    }
                    else{
                        $this->model->insert($postData);
                        $id = $postData['id'];
                    }

                    $arr['message'] = 'Saved !';
                    $arr['url'] = URL.'products/settings/howtouse/'.$id;
                }

            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        elseif( $section == 'howtouse' ){
            if( empty($item) ) $this->error();

            try{
                $form = new Form();
                $form   ->post('pds_howtouse')
                        ->post('pds_capacity');
                $form->submit();
                $postData = $form->fetch();

                if( empty($arr['error']) ){
                    $this->model->update($id, $postData);

                    $this->model->update($id, $postData);

                    $arr['message'] = 'Saved !';
                    $arr['url'] = URL.'products/settings/pricing/'.$id;
                }
            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        elseif( $section == 'pricing' ){

            try{
                $form = new Form();
                $form   ->post('frontend')
                        ->post('vat');
                $form->submit();
                $postData = $form->fetch();

                if( !empty($item['pricing']) ) $postData['id'] = $item['pricing']['id'];

                if( empty($arr['error']) ){
                    $this->model->setPrice($postData);

                    $arr['message'] = 'Saved !';
                    $arr['url'] = URL.'products/settings/photos/'.$id;
                }
            } catch (Exception $e) {
                $arr['error'] = $this->_getError($e->getMessage());
            }
        }
        /* elseif( $section == 'photos' ){
            for($i=1;$i<=3;$i++){
                if( !empty($_FILES["image_cover"]['name'][$i]) ){
                    $userfile = array(
                        'name' => $_FILES['image_cover']['name'][$i],
                        'type' => $_FILES['image_cover']['type'][$i],
                        'tmp_name' => $_FILES['image_cover']['tmp_name'][$i],
                        'error' => $_FILES['image_cover']['error'][$i],
                        'size' => $_FILES['image_cover']['size'][$i]
                    );
                    $album_options = array(
                        'album_obj_type' => 'products',
                        'album_obj_id' => 2,
                    );
                    $album = $this->model->query('media')->searchAlbum( $album_options );

                    if( empty($album) ){

                        $this->model->query('media')->setAlbum( $album_options );
                        $album = $album_options;
                    }

                    // set Media
                    $media = array(
                        'media_album_id' => $album['album_id'],
                        'media_type' => isset($_REQUEST['media_type']) ? $_REQUEST['media_type']: strtolower(substr(strrchr($userfile['name'],"."),1))
                    );
                    $media_options = array(
                        'folder' => $album['album_id'],
                    );

                    $this->model->query('media')->set( $userfile, $media , $media_options);

                    // update id image to Model
                    if( !empty($media['media_id']) ){

                            // remove delete image old
                        if( !empty($item['pds_image_'.$i.'_id']) ){
                            $this->model->query('media')->del($item['pds_image_'.$i.'_id']);
                        }

                        $this->model->update( $id, array('pds_image_'.$i.'_id'=>$media['media_id'] ) );
                        $item['pds_image_'.$i.'_id'] = $media['media_id'];
                    }
                }

                #RESIZE
                if( !empty($_POST['cropimage']) && !empty($item['pds_image_'.$i.'_id']) ){
                    $this->model->query('media')->resize($item['pds_image_'.$i.'_id'], $_POST['cropimage']);
                }
            }

            $arr['message'] = 'Saved !';
            $arr['url'] = URL.'products/settings/photos/'.$id;
        } */
        elseif( $section == 'photos' ){
            
            for ($i=1; $i <= 3 ; $i++) { 
                if( !empty($_FILES['image']['name'][$i]) ){
                    $userfile = array(
                        'name' => $_FILES['image']['name'][$i],
                        'type' => $_FILES['image']['type'][$i],
                        'tmp_name' => $_FILES['image']['tmp_name'][$i],
                        'error' => $_FILES['image']['error'][$i],
                        'size' => $_FILES['image']['size'][$i]
                    );

                    $album_options = array(
                        'album_obj_type' => 'products',
                        'album_obj_id' => 2,
                    );
                    $album = $this->model->query('media')->searchAlbum( $album_options );
                    if( empty($album) ){
                        $this->model->query('media')->setAlbum( $album_options );
                        $album = $album_options;
                    }

                    // set Media
                    $media = array(
                        'media_album_id' => $album['album_id'],
                        'media_type' => isset($_REQUEST['media_type']) ? $_REQUEST['media_type']: strtolower(substr(strrchr($userfile['name'],"."),1))
                    );
                    $media_options = array(
                        'folder' => $album['album_id'],
                    );

                    $this->model->query('media')->set( $userfile, $media , $media_options);

                    // update id image to Model
                    $seq = $_POST['seq'][$i];
                    if( !empty($media['media_id']) ){
                        if( !empty($item['photos'][$seq]['id']) ){
                            $this->model->query('media')->del($item['photos'][$seq]['id']);
                            $this->model->delPermitPhotos($id, $item['photos'][$seq]['id']);
                        }
                        $_image = array(
                            'pds_id' => $id,
                            'media_id' => $media['media_id'], 
                            'seq' => $seq
                        );
                        $this->model->setPermitPhotos( $_image );
                    }
                }
            }

            $arr['message'] = 'Saved !';
            $arr['url'] = 'refresh';
        }
        else{
            $this->error();
        }

        echo json_encode($arr);
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
    				$arr['error']['pds_comission'] = 'Only numbers can be entered.';
    			}
    			if( $postData['pds_comission'] > 100 ){
    				$arr['error']['pds_comission'] = 'Can not fill up 100% comissions.';
    			}

    			if( empty($arr['error']) ){
    				$this->model->update($id, $postData);

    				$arr['message'] = 'Save successfully.';
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

    public function del_image($id=null){
        $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;
        if( empty($id) || empty($this->me) || $this->format!='json' ) $this->error();

        $item = $this->model->query('media')->get($id);
        if( empty($item) ) $this->error();

        if( !empty($_POST) ){
            $this->model->query('media')->del($id);
            $arr['message'] = 'Deleted !';
            $arr['url'] = 'refresh';

            echo json_encode($arr);
        }
        else{
            $this->view->item = $item;
            $this->view->setPage('path', 'Themes/manage/forms/products');
            $this->view->render('del_image');
        }
    }
}
