<?php 

$title = 'ข้อมูลจ่ายเช็ค';

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	->addClass('form-insert');

$form 	->field("check_date")
		->label("วันที่จ่ายเช็ค / Payment Date*")
		->autocomplete('off')
		->addClass('inputtext')
		->attr('data-plugins', 'datepicker')
		->value( !empty($this->item['date']) ? $this->item['date'] : '' );

$form 	->field("check_sup_id")
		->label("Supplier")
		->autocomplete('off')
		->addClass('inputtext')
		->select( $this->suppliers['lists'] )
		->value( !empty($this->item['sup_id']) ? $this->item['sup_id'] : $this->currSup );

$form 	->field("check_up_date")
		->label("วันที่ในเช็ค / Check Date*")
		->autocomplete('off')
		->addClass('inputtext')
		->attr('data-plugins', 'datepicker')
		->value( !empty($this->item['up_date']) ? $this->item['up_date'] : '' );

$form 	->field("check_bank_id")
		->label("ธนาคาร / Bank*")
		->autocomplete('off')
		->addClass('inputtext')
		->select( $this->bank )
		->value( !empty($this->item['bank_id']) ? $this->item['bank_id'] : '' );

$form 	->field("check_number")
		->label("เลขที่เช็ค / Check Number*")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['number']) ? $this->item['number'] : '' );

$form 	->field("check_price")
		->label("จำนวนเงิน / Amount")
		->autocomplete('off')
		->addClass('inputtext')
		->type('number')
		->value( !empty($this->item['price']) ? $this->item['price'] : '' );

$image = !empty($this->item['image_arr']) ? '(<a href="'.$this->item['image_arr']['original_url'].'" target="_blank"><i class="icon-eye"></i> ดูรูปภาพเดิม</a>)' : '';

$form 	->field("check_image_id")
		->label("รูปหลักฐาน / Upload Picture ".$image)
		->autocomplete('off')
		->addClass('inputtext')
		->type('file')
		->attr('accept', 'image/*');

$form 	->field("check_note")
		->label("หมายเหตุ / note")
		->autocomplete('off')
		->addClass('inputtext')
		->type('textarea')
		->attr('data-plugins', 'autosize')
		->value( !empty($this->item['note']) ? $this->item['note'] : '' );

# title
if( !empty($this->item) ){
    $arr['title']= "แก้ไข {$title}";
    $arr['hiddenInput'][] = array('name'=>'id','value'=>$this->item['id']);
}
else{
    $arr['title']= "เพิ่ม {$title}";
}

#form
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL.'paycheck/save"></form>';

# body
$arr['body'] = $form->html();

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">'.$this->lang->translate('Save').'</span></button>';
$arr['bottom_msg'] = '<a class="btn" role="dialog-close"><span class="btn-text">'.$this->lang->translate('Cancel').'</span></a>';

$arr['width'] = 500;

$arr['is_close_bg'] = true;

echo json_encode($arr);