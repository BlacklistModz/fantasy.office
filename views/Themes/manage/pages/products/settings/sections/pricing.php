<?php

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	// ->url( URL.'products/update/' . $this->section )
    // ->method('post')
	->addClass('js-submit-form');

$form 	->field("frontend")
		->label("Exclude Price")
		->addClass('inputtext')
		->autocomplete('off')
		->value( !empty($this->item['pricing']['frontend']) ? round($this->item['pricing']['frontend']) : '' );

/* $form 	->field("member")
		->label("ราคาสมาชิก")
		->addClass('inputtext')
		->autocomplete('off')
		->value( !empty($this->item['pricing']['member']) ? $this->item['pricing']['member'] : '' ); */

$form 	->field("vat")
		->label("VAT")
		->addClass('inputtext')
		->autocomplete('off')
		->value( !empty($this->item['pricing']['vat']) ? round($this->item['pricing']['vat']) : '' );

echo $form->html();
