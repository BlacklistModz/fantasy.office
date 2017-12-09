<?php

$arr['title'] = "ยืนยันการลบ";
if ( !empty($this->item['permit']['del']) ) {
	
	$arr['form'] = '<form class="js-submit-form" action="'.URL. 'payments/del_account"></form>';
	$arr['hiddenInput'][] = array('name'=>'id','value'=>$this->item['id']);
	if( isset($_REQUEST["next"]) ) {
		$arr['hiddenInput'][] = array('name'=>'next', 'value'=>$_REQUEST["next"]);
	}
	$arr['body'] = "คุณต้องการลบ <span class=\"fwb\">\"{$this->item['number']}\"</span> หรือไม่?";
	
	$arr['button'] = '<button type="submit" class="btn btn-danger btn-submit"><span class="btn-text">'.$this->lang->translate('Delete').'</span></button>';
	$arr['bottom_msg'] = '<a class="btn" role="dialog-close"><span class="btn-text">'.$this->lang->translate('Cancel').'</span></a>';
}
else{

	$arr['body'] = "คุณไม่สามารถลบ <span class=\"fwb\">\"{$this->item['number']}\"</span> ได้?";	
	$arr['button'] = '<a href="#" class="btn btn-cancel" role="dialog-close"><span class="btn-text">ปิด</span></a>';
}


echo json_encode($arr);