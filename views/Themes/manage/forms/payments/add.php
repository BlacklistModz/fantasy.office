<?php

$hour = '';
$min = '';
for($i=0;$i<24;$i++){
	$sel = '';
	if( !empty($this->item) ){
		if( date("H", strtotime($this->item['time'])) == $i ) $sel = ' selected="1"';
	}
	else{
		if( date("H") == $i ) $sel = ' selected="1"';
	}
	$hour .= '<option'.$sel.' value="'.sprintf("%02d", $i).'">'.sprintf("%02d", $i).'</option>';
}
for($i=0;$i<60;$i++){
	$sel = '';
	if( !empty($this->item) ){
		if( date("i", strtotime($this->item['time'])) == $i ) $sel = ' selected="1"';
	}
	else{
		if( date("i") == $i ) $sel = ' selected="1"';
	}
	$min .= '<option'.$sel.' value="'.sprintf("%02d", $i).'">'.sprintf("%02d", $i).'</option>';
}

$hour = '<select name="time[hour]" class="inputtext" style="display:inline;">'.$hour.'</select>';
$min = '<select name="time[min]" class="inputtext mrs" style="display:inline;">'.$min.'</select>';

$image = !empty($this->item['image_arr']) ? '(<a href="'.$this->item['image_arr']['original_url'].'" target="_blank"><i class="icon-eye"></i> ดูรูปภาพเดิม</a>)' : '';

$title = "การจ่ายเงิน";

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	->addClass('form-insert');

$form 	->field("pay_date")
		->label("วันที่รับเงิน")
		->autocomplete('off')
		->addClass('inputtext')
		->attr('data-plugins', 'datepicker')
		->value( !empty($this->item['date']) ? $this->item['date'] : '' );

$form 	->field("pay_hour")
		->label("นาฬิกา")
		->text( $hour );

$form 	->field("pay_min")
		->label("นาที")
		->text( $min );

$form 	->field("pay_type_id")
		->label("ประเภทการจ่ายเงิน / Payment Type*")
		->autocomplete('off')
		->addClass('inputtext')
		->attr('data-name', 'type')
		->select( $this->type )
		->value( !empty($this->item['type_id']) ? $this->item['type_id'] : '' );

$form 	->field("pay_check_date")
		->label("วันที่เช็ค")
		->autocomplete('off')
		->addClass('inputtext')
		->attr('data-plugins', 'datepicker')
		->value( !empty($this->item['check_date']) ? $this->item['check_date'] : '' );

$form 	->field("pay_check_bank")
		->label("เช็คธนาคาร / Bank Check")
		->autocomplete('off')
		->addClass('inputtext')
		->select( $this->bank )
		->value( !empty($this->item['check_bank']) ? $this->item['check_bank'] : '' );

$form 	->field("pay_check_number")
		->label("เลขที่เช็ค / Check Number")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['check_number']) ? $this->item['check_number']  : '' );

$form 	->field("pay_account_id")
		->label("เลขบัญชี / Bank Account")
		->autocomplete('off')
		->addClass('inputtext')
		->select( $this->account, 'id', 'name_str' )
		->value( !empty($this->item['account_id']) ? $this->item['account_id'] : '' );

$form 	->field("pay_amount")
		->label("จำนวนเงิน* / Cash")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['amount']) ? $this->item['amount'] : '' );

$form 	->field("pay_image_id")
		->label("รูปหลักฐาน / Upload Picture ".$image)
		->autocomplete('off')
		->addClass('inputtext')
		->type('file')
		->attr('accept', 'image/*')
		->value('');

if( empty($this->item) || empty($this->order['total_get_comission']) ){
$form 	->field("pay_comission_amount")
		->label("ค่าคอมมิสชั่น ( ไม่เกิน : ".number_format($this->order['total_comission'], 2)." บาท )")
		->autocomplete('off')
		->addClass('inputtext')
		->type('number')
		->value( !empty($this->item['comission_amount']) ? round($this->item['comission_amount']) : '' );
}

$form 	->field("pay_note")
		->label("หมายเหตุ / Note")
		->autocomplete('off')
		->addClass('inputtext')
		->type("textarea")
		->attr("data-plugins", "autosize")
		->value( !empty($this->item['note']) ? $this->item['note'] : '' );

$arr['hiddenInput'][] = array('name'=>'pay_order_id', 'value'=>$this->order['id']);
$arr['hiddenInput'][] = array('name'=>'pay_sale_id', 'value'=>$this->sales['id']);
if( !empty($this->item) ){
	$arr['hiddenInput'][] = array('name'=>'id', 'value'=>$this->item['id']);
}

# set form
$options = $this->fn->stringify( array(
		'type' => !empty($this->item['type_id']) ? $this->item['type_id'] : '',
		'account' => !empty($this->item['account']) ? $this->item['account'] : ''
	) );
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL. 'payments/save" data-plugins="formPayments" data-options="'.$options.'"></form>';

# body
$arr['body'] = $form->html();

# title
if( !empty($this->item) ){
    $arr['title']= "แก้ไข{$title}";
    $arr['hiddenInput'][] = array('name'=>'id','value'=>$this->item['id']);
}
else{
    $arr['title']= "เพิ่ม{$title}";
}

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">'.$this->lang->translate('Save').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" role="dialog-close"><span class="btn-text">'.$this->lang->translate('Cancel').'</span></a>';

$arr['width'] = 500;
$arr['height'] = 650;

$arr['is_close_bg'] = true;

echo json_encode($arr);