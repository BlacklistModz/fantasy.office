<?php

$arr['title'] = "ยืนยันการตั้งค่า Username & Password";

$arr['form'] = '<form class="js-submit-form" action="'.URL. 'customers/set_userpass"></form>';
$arr['hiddenInput'][] = array('name'=>'submit', 'value'=>'1');
$arr['body'] = "คุณต้องการ <span class=\"fwb\">\"ดำเนินการตั้งค่า Username และ Password ให้กับผู้ที่ล็อคอินไม่ได้\"</span> หรือไม่ ?";

$arr['button'] = '<button type="submit" class="btn btn-orange btn-submit"><span class="btn-text">'.$this->lang->translate('SET').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" role="dialog-close"><span class="btn-text">'.$this->lang->translate('Cancel').'</span></a>';


echo json_encode($arr);