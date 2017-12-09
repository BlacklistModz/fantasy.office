<?php

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	// ->url( URL.'products/update/' . $this->section )
    // ->method('post')
	->addClass('form-insert');

$form   ->field("pds_categories_id")
        ->label("หมวดหมู่สินค้า")
        ->addClass('inputtext')
        ->autocomplete('off')
        ->select( $this->category, 'id', 'name_th' )
        ->value( !empty($this->item['pds_categories_id']) ? $this->item['pds_categories_id'] : '' );

$form   ->field("pds_code")
        ->label("รหัสสินค้า")
        ->addClass('inputtext')
        ->autocomplete('off')
        ->value( !empty($this->item['pds_code']) ? $this->item['pds_code'] : '' );

$form   ->field("pds_name")
        ->label("ชื่อสินค้า")
        ->addClass('inputtext')
        ->autocomplete('off')
        ->value( !empty($this->item['pds_name']) ? $this->item['pds_name'] : '' );

$form   ->field("pds_detail")
        ->label("รายละเอียด")
        ->addClass('inputtext')
        ->type('textarea')
        ->attr('data-plugins', 'editor')
        ->attr('data-options', $this->fn->stringify(array(
            'image_upload_url' => URL .'media/set',
            'album_obj_type'=>'products',
            'album_obj_id'=>'2'
        )))
        ->autocomplete('off')
        ->value( !empty($this->item['pds_detail']) ?$this->fn->q('text')->strip_tags_editor(  $this->item['pds_detail']): '' );

$form   ->field("pds_barcode")
        ->label("บาร์โค้ด")
        ->addClass('inputtext')
        ->autocomplete('off')
        ->value( !empty($this->item['pds_barcode']) ? $this->item['pds_barcode'] : '' );

// $form   ->submit()
//         ->addClass('btn btn-blue btn-submit')
//         ->value('บันทึก');


echo $form->html();