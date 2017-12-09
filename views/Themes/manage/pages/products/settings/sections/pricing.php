<?php

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	// ->url( URL.'products/update/' . $this->section )
    // ->method('post')
	->addClass('js-submit-form');

$form 	->field("frontend")
		->label("ราคาสมาชิก")
		->addClass('inputtext')
		->autocomplete('off')
		->value( !empty($this->item['pricing']['frontend']) ? $this->item['pricing']['frontend'] : '' );

/* $form 	->field("member")
		->label("ราคาสมาชิก")
		->addClass('inputtext')
		->autocomplete('off')
		->value( !empty($this->item['pricing']['member']) ? $this->item['pricing']['member'] : '' ); */

$form 	->field("vat")
		->label("ราคา VAT")
		->addClass('inputtext')
		->autocomplete('off')
		->value( !empty($this->item['pricing']['vat']) ? $this->item['pricing']['vat'] : '' );

echo $form->html();