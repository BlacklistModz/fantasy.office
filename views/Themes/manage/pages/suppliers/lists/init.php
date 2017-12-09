<?php

$title[] = array('key'=>'name', 'text'=>'SupplierName', 'sort'=>'name');
$title[] = array('key'=>'address', 'text'=>'ที่อยู่/ Address');
$title[] = array('key'=>'phone_str', 'text'=>'ประเทศ');
// $title[] = array('key'=>'contact', 'text'=>'ContactName', 'sort'=>'first_name');
// $title[] = array('key'=>'address', 'text'=>'สถานที่ติดต่อ');
$title[] = array('key'=>'phone_str', 'text'=>'เบอร์โทรศัพท์มือถือ');
$title[] = array('key'=>'phone_str', 'text'=>'เบอร์โทรศัพท์');
// $title[] = array('key'=>'phone_str', 'text'=>'FAX');
$title[] = array('key'=>'status_str', 'text'=>'สถานะ');
$title[] = array('key'=>'actions', 'text'=>'');

$this->tabletitle = $title;
$this->getURL =  URL.'suppliers';