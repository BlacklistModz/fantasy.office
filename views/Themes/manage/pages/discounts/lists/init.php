<?php

$title[] = array('key'=>'date', 'text'=>'วันที่เพิ่ม', 'sort'=>'created');
$title[] = array('key'=>'name', 'text'=>'ชื่อส่วนลด', 'sort'=>'name');
$title[] = array('key'=>'status', 'text'=>'จำนวนสินค้า', 'sort'=>'item');
$title[] = array('key'=>'actions', 'text'=>'');

$this->tabletitle = $title;
$this->getURL =  URL.'discounts/';