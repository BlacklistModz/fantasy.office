<?php 
$title = "ส่วนลด";
if( !empty($this->item) ){
	$title = "แก้ไข{$title}";
}
else{
	$title = "เพิ่ม{$title}";
}

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
	->addClass('form-insert');

$form 	->field("dis_name")
		->label("ชื่อส่วนลด")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['name']) ? $this->item['name'] : '' );

$form 	->field("dis_price_1")
		->label("ส่วนลด <br/>6-11 ชิ้น")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['price_1']) ? $this->item['price_1'] : '' );

$form 	->field("dis_price_2")
		->label("ส่วนลด <br/>12-23 ชิ้น")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['price_2']) ? $this->item['price_2'] : '' );

$form 	->field("dis_price_3")
		->label("ส่วนลด <br/>24-35 ชิ้น")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['price_3']) ? $this->item['price_3'] : '' );

$form 	->field("dis_price_4")
		->label("ส่วนลด <br/>36-47 ชิ้น")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['price_4']) ? $this->item['price_4'] : '' );

$form 	->field("dis_price_5")
		->label("ส่วนลด <br/>48-71 ชิ้น")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['price_5']) ? $this->item['price_5'] : '' );

$form 	->field("dis_price_6")
		->label("ส่วนลด <br/>72 ชิ้นขึ้นไป")
		->autocomplete('off')
		->addClass('inputtext')
		->value( !empty($this->item['price_6']) ? $this->item['price_6'] : '' );

$products = array();
foreach ($this->products['lists'] as $key => $value) {

	$checked = false;
    if( !empty($this->item['items']) ){
        foreach ($this->item['items'] as $i => $val) {
            if( $val['parent_id']==$value['id'] ){
                $checked = true;
                break;
            }
        }
    }

    $products[] = array(
        'text' => $value['pds_name'], //.'('.$value['code'].')', 
        'value' => $value['id'],
        'checked' => $checked
    );
}
$form   ->field("items")
        ->label('เลือกสินค้า')
        ->text('<div data-plugins="selectmany" data-options="'.
        $this->fn->stringify( array( 
            'lists' => $products,
            // 'insert_url' => URL.'countries/add/',
            'name' => 'items[]',
            'class' => 'inputtext'
        ) ).'"></div>');

$form 	->field("dis_note")
		->label("หมายเหตุ")
		->autocomplete('off')
		->addClass('inputtext')
		->type('textarea')
		->attr('data-plugins', 'autosize')
		->value( !empty($this->item['note']) ? $this->item['note'] : '' );

if( !empty($this->item) ){
	$form 	->field("id")
			->text('<input type="hidden" name="id" value="'.$this->item['id'].'">');
}
?>
<div id="mainContainer" class="Setting clearfix" data-plugins="main">
	<div role="main">
		<div class="clearfix">
			<h2 class="pal fwb"><i class="icon-cart-arrow-down"></i> <?=$title?></h2>
		</div>
		<div class="clearfix">
			<form class="js-submit-form" method="POST" action="<?=URL?>discounts/save"> 
				<div class="pll mbl" style="width: 720px;">
					<div class="uiBoxWhite pam">
						<?=$form->html()?>
					</div>
					<div class="clearfix uiBoxWhite pam">
						<div class="lfloat">
							<a href="<?=URL?>discounts/" class="btn btn-red">ยกเลิก</a>
						</div>
						<div class="rfloat">
							<button type="submit" class="btn btn-primary btn-submit">
								<span class="btn-text">บันทึก</span>
							</button>
						</div>
					</div>
				</div>
				<!-- <div class="span4">
					<div class="uiBoxWhite pam">
						<?php //echo $form2->html(); ?>
					</div>
				</div> -->
			</form>
		</div>
	</div>
</div>