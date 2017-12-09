<?php

$title[] = array('key'=>'ID', 'text'=>'รหัสลูกค้า', 'sort'=>'sub_code');
$title[] = array('key'=>'name', 'text'=>'ชื่อร้านค้า / ลูกค้า', 'sort'=>'name_store');
$title[] = array('key'=>'contact', 'text'=>'เซลล์', 'sort'=>'sale_code');
$title[] = array('key'=>'email', 'text'=>'จังหวัด', 'sort'=>'province');
$title[] = array('key'=>'phone', 'text'=>'หมายเลขโทรศัพท์', 'sort'=>'phone');
$title[] = array('key'=>'status', 'text'=>'สถานะ');
$title[] = array('key'=>'actions', 'text'=>'จัดการ');

$this->tabletitle = $title;
$this->getURL =  URL.'customers/';