<?php

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	->addClass('form-insert');

$form 	->field("pds_howtouse")
		->label("วิธีใช้งาน")
		->addClass('inputtext')
		->type('textarea')
		->autocomplete('off')
		->attr('data-plugins', 'editor')
		->attr('data-options', $this->fn->stringify(array(
            'image_upload_url' => URL .'media/set',
            'album_obj_type'=>'products',
            'album_obj_id'=>'2'
        )))
        ->value( !empty($this->item['pds_howtouse']) ?$this->fn->q('text')->strip_tags_editor(  $this->item['pds_howtouse']): '' );

$form 	->field("pds_capacity")
		->label("ขนาดสินค้า")
		->addClass('inputtext')
		->autocomplete('off')
		->value( !empty($this->item['pds_capacity']) ? $this->item['pds_capacity'] : '' );

// $form   ->submit()
//         ->addClass('btn btn-green btn-submit')
//         ->value('บันทึก');

echo $form->html();