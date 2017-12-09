<?php 

$title = 'หมวดหมู่สินค้า';
if( !empty($this->item) ){
	$arr['title'] = "แก้ไข {$title}";
	$arr['hiddenInput'][] = array('name'=>'id', 'value'=>$this->item['id']);
}
else{
	$arr['title'] = "เพิ่ม {$title}";
}

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	->addClass('form-insert');

$form 	->field("firstCode")
		->label("คำขึ้นต้น *")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['fristCode']) ? $this->item['fristCode'] : '' );

$form 	->field("name_th")
		->label("ชื่อภาษาไทย *")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['name_th']) ? $this->item['name_th'] : '' );

$form 	->field("name_en")
		->label("ชื่อภาษาอังกฤษ *")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['name_en']) ? $this->item['name_en'] : '' );

$ck = '';
if( !empty($this->item) ){
	if( !empty($this->item['is_sub']) ) $ck='checked="1"';
}
$is_sub = '<label class="checkbox control-label"><input type="checkbox" '.$ck.' name="is_sub" value="1"> ทำให้เป็นเมนูย่อยของหมวดหมู่อื่น</label>';
$form 	->field("is_sub")
		->text( $is_sub );

$form 	->field("cate_id")
		->label("หมวดหมู่หลัก")
		->addClass('inputtext')
		->select( $this->category['lists'], 'id', 'name_th' )
		->value( !empty($this->item['cate_id']) ? $this->item['cate_id'] : '' );

$form 	->field('status')
		->label('สถานะ')
		->autocomplete('off')
		->addClass('inputtext')
		->select($this->status)
		->value( !empty($this->item['status']) ? $this->item['status'] : '' );

# set form
$arr['form'] = '<form class="js-submit-form" data-plugins="formCategory" method="post" action="'.URL. 'categories/save"></form>';

#BODY
$arr['body'] = $form->html();

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">'.$this->lang->translate('Save').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" role="dialog-close"><span class="btn-text">'.$this->lang->translate('Cancel').'</span></a>';

$arr['is_close_bg'] = true;

echo json_encode($arr);