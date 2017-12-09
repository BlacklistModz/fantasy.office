<?php

$title[] = array('key'=>'date', 'text'=>'วันที่จ่ายเช็ค', 'sort'=>'date');
$title[] = array('key'=>'date', 'text'=>'วันที่ในเช็ค', 'sort'=>'up_date');
$title[] = array('key'=>'name', 'text'=>'เลขที่เช็ค / Check Number', 'sort'=>'number');
$title[] = array('key'=>'price', 'text'=>'จำนวนเงิน', 'sort'=>'price');
$title[] = array('key'=>'contact', 'text'=>'SupplierName');
$title[] = array('key'=>'contact', 'text'=>'ContactName');
$title[] = array('key'=>'phone_str', 'text'=>'เบอร์โทรศัพท์');
$title[] = array('key'=>'actions', 'text'=>'จัดการ');

$this->tabletitle = $title;
$this->getURL =  URL.'paycheck/';