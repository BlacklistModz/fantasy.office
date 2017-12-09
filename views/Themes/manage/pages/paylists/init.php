<?php

$title[] = array('key'=>'date', 'text'=>'วันที่', 'sort'=>'date');
$title[] = array('key'=>'name', 'text'=>'ORDER CODE');
$title[] = array('key'=>'status', 'text'=>'หลักฐานการชำระ');
$title[] = array('key'=>'contact', 'text'=>'วิธีชำระเงิน');
$title[] = array('key'=>'price', 'text'=>'จำนวนเงิน');

$this->tabletitle = $title;
$this->getURL =  URL.'payments/lists/'.$this->type['id'];