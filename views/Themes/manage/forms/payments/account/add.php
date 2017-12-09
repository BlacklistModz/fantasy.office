<?php

$title = "ธนาคาร";

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	->addClass('form-insert');

$form 	->field("account_bank_id")
		->label("ธนาคาร*")
		->autocomplete('off')
		->addClass('inputtext')
		->select( $this->bank )
		->value( !empty($this->item['bank_id']) ? $this->item['bank_id'] : '' );

$form 	->field("account_number")
		->label("เลขบัญชี")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['number']) ? $this->item['number'] : '' );

$form 	->field("account_name")
		->label("ชื่อบัญชี")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['name']) ? $this->item['name'] : '' );

$form 	->field("account_branch")
		->label("สาขา")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['branch']) ? $this->item['branch'] : '' );

# set form
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL. 'payments/save_account"></form>';

# body
$arr['body'] = $form->html();

# title
if( !empty($this->item) ){
    $arr['title']= "แก้ไข{$title}";
    $arr['hiddenInput'][] = array('name'=>'id','value'=>$this->item['id']);
}
else{
    $arr['title']= "เพิ่ม{$title}";
}

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">'.$this->lang->translate('Save').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" role="dialog-close"><span class="btn-text">'.$this->lang->translate('Cancel').'</span></a>';

// $arr['width'] = 782;

echo json_encode($arr);