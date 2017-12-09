<?php

$title[] = array('key'=>'date', 'text'=>'วันที่', 'sort'=>'date');
$title[] = array('key'=>'name', 'text'=>'Order Code', 'sort'=>'code');
$title[] = array('key'=>'address', 'text'=>'ชื่อร้าน/ผู้สั่ง');
$title[] = array('key'=>'price', 'text'=>'ราคารวม', 'sort'=>'prices');
$title[] = array('key'=>'price', 'text'=>'ชำระไปแล้ว');
// $title[] = array('key'=>'price', 'text'=>'ยอดเงินค้าง');
$title[] = array('key'=>'status', 'text'=>'สถานะ');
$title[] = array('key'=>'status', 'text'=>'ดูประวัติ');
$title[] = array('key'=>'actions', 'text'=>'');

$this->tabletitle = $title;
$this->getURL =  URL.'payments/';