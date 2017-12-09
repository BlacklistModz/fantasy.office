<?php

$title[] = array('key'=>'status_str', 'text'=>'ประเภทสินค้า');
$title[] = array('key'=>'image', 'text'=>'');
$title[] = array('key'=>'name', 'text'=>'ชื่อสินค้า', 'sort'=>'pds_name');
$title[] = array('key'=>'status', 'text'=>'ค่าคอม (%)', 'sort'=>'pds_comission');
$title[] = array('key'=>'status_str', 'text'=>'สถานะ');
$title[] = array('key'=>'actions', 'text'=>'จัดการ');

$this->tabletitle = $title;
$this->getURL =  URL.'products/';