<?php 

$arr["title"] = "Print vat buy";

$form = new Form();
$form = $form->create()
			 ->elem('div')
			 ->addClass("form-insert");

$month = '';
for($i=1;$i<=12;$i++){
	$month .= '<option value="'.$i.'">'.$this->fn->q('time')->month($i, true).'</option>';
}
$month = '<select class="inputtext" name="month">'.$month.'</select>';

$form 	->field("month")
		->label("Select Month")
		->text( $month );

$arr['form'] = '<form class="" action="'.URL. 'pdf/vat_buy" target="_blank"></form>';
$arr["body"] = $form->html();
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">'.$this->lang->translate('Save').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" role="dialog-close"><span class="btn-text">'.$this->lang->translate('Cancel').'</span></a>';

echo json_encode($arr);