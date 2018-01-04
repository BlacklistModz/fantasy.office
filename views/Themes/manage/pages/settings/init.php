<?php

$this->count_nav = 0;

/* System */
$sub = array();
$sub[] = array('text' => $this->lang->translate('Company'),'key' => 'company','url' => URL.'settings/company');
// $sub[] = array('text'=>'Dealer','key'=>'dealer','url'=>URL.'settings/dealer');
$sub[] = array('text' => 'Profile','key' => 'my','url' => URL.'settings/my');

/*foreach ($sub as $key => $value) {
	if( empty($this->permit[$value['key']]['view']) ) unset($sub[$key]);
}*/
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text' => '', 'url' => URL.'settings/company', 'sub' => $sub);
}

$sub = array();
$sub[] = array('text'=>'Manage Administrator', 'key'=>'admins', 'url'=>URL.'settings/accounts/admins');
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text'=>'Accounts', 'url'=>URL.'settings/accounts/admins', 'sub'=>$sub);
}

$sub = array();
// $sub[] = array('text' => 'ธนาคาร', 'key'=>'bank', 'url' => URL.'settings/payments/bank');
$sub[] = array('text' => 'Bank account', 'key'=>'account', 'url' => URL.'settings/payments/account');
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text' => 'Payments', 'url' => URL.'settings/payments/account', 'sub' => $sub);
}

$sub = array();
$sub[] = array('text' => 'Supplier categories', 'key'=>'type', 'url' => URL.'settings/suppliers/type');
$sub[] = array('text' => 'Tax categories', 'key'=>'category', 'url' => URL.'settings/suppliers/category');
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text' => 'Suppliers', 'url' => URL.'settings/suppliers', 'sub' => $sub);
}
