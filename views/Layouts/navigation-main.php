<?php

$users[] = array('key'=>'customers', 'text'=>'Customers', 'link'=>$url.'customers', 'icon'=>'users');
$users[] = array('key'=>'sales', 'text'=>'Sales', 'link'=>$url.'sales', 'icon'=>'user');
if( !empty($users) ){
	echo $this->fn->manage_nav($users, $this->getPage('on'));
}

$events[] = array('key'=>'events', 'text'=>'Calendar', 'link'=>$url.'events', 'icon'=>'calendar-check-o');
if( !empty($events) ){
	echo $this->fn->manage_nav($events, $this->getPage('on'));
}

$order[] = array('key'=>'payments', 'text'=>'Orders lists', 'link'=>$url.'payments', 'icon'=>'cube ');
if( !empty($order) ){
	echo $this->fn->manage_nav($order, $this->getPage('on'));
}

$payments[] = array('key'=>'lists1', 'text'=>'Payments cash', 'link'=>$url.'payments/cash', 'icon'=>'money');
$payments[] = array('key'=>'lists2', 'text'=>'Payments bank', 'link'=>$url.'payments/bank', 'icon'=>'cc-visa');
$payments[] = array('key'=>'lists3', 'text'=>'Payments check', 'link'=>$url.'payments/check', 'icon'=>'credit-card-alt');
if( !empty($payments) ){
	echo $this->fn->manage_nav($payments, $this->getPage('on'));
}

$paycheck[] = array('key'=>'paycheck', 'text'=>'Pay check', 'link'=>$url.'paycheck', 'icon'=>'credit-card');
if( !empty($paycheck) ){
	echo $this->fn->manage_nav($paycheck, $this->getPage('on'));
}

$suppliers[] = array('key'=>'suppliers', 'text'=>'Suppliers', 'link'=>$url.'suppliers', 'icon'=>'handshake-o');
if( !empty($suppliers) ){
	echo $this->fn->manage_nav($suppliers, $this->getPage('on'));
}

$products[] = array('key'=>'discounts', 'text'=>'Discounts', 'link'=>$url.'discounts', 'icon'=>'cart-arrow-down');
$products[] = array('key'=>'categories', 'text'=>'Categories', 'link'=>$url.'categories', 'icon'=>'database');
$products[] = array('key'=>'products', 'text'=>'Products', 'link'=>$url.'products', 'icon'=>'cart-arrow-down');
if( !empty($products) ){
	echo $this->fn->manage_nav($products, $this->getPage('on'));
}


$reports[] = array('key'=>'comission', 'text'=>'Comission reports', 'link'=>$url.'reports/comission', 'icon'=>'signal');
// $reports[] = array('key'=>'comission', 'text'=>'Commission reports', 'link'=>$url.'reports/comission', 'icon'=>'signal');
// $reports[] = array('key'=>'revenue', 'text'=>'Receipt report', 'link'=>$url.'reports/revenue', 'icon'=>'line-chart');
$reports[] = array('key'=>'revenue', 'text'=>'Receipt reports', 'link'=>$url.'reports/revenue', 'icon'=>'line-chart');

if( !empty($reports) ){
	echo $this->fn->manage_nav($reports, $this->getPage('on'));
}

$cog[] = array('key'=>'settings','text'=>$this->lang->translate('menu','Settings'),'link'=>$url.'settings','icon'=>'cog');
echo $this->fn->manage_nav($cog, $this->getPage('on'));
