<?php

$title[] = array('key'=>'date', 'text'=>'Payment Date', 'sort'=>'date');
$title[] = array('key'=>'date', 'text'=>'Check Date', 'sort'=>'up_date');
$title[] = array('key'=>'name', 'text'=>'Check Number', 'sort'=>'number');
$title[] = array('key'=>'price', 'text'=>'Amount', 'sort'=>'price');
$title[] = array('key'=>'contact', 'text'=>'SupplierName');
$title[] = array('key'=>'contact', 'text'=>'ContactName');
$title[] = array('key'=>'phone_str', 'text'=>'Telephone Number');
$title[] = array('key'=>'actions', 'text'=>'Actions');

$this->tabletitle = $title;
$this->getURL =  URL.'paycheck/';
