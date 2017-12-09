<?php

$title[] = array('key'=>'date', 'text'=>'วันที่', 'sort'=>'start');
$title[] = array('key'=>'name', 'text'=>'หัวข้อนัดหมาย', 'sort'=>'title');
$title[] = array('key'=>'contact', 'text'=>'ผู้เกี่ยวข้อง');
$title[] = array('key'=>'contact', 'text'=>'สถานที่', 'sort'=>'location');
$title[] = array('key'=>'contact', 'text'=>'สร้างโดย');
$title[] = array('key'=>'actions', 'text'=>'');

$this->tabletitle = $title;
$this->getURL =  URL.'events/';