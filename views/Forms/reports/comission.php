<?php 

$month = $this->fn->q('time')->month($_REQUEST["month"], true);
$year = $_REQUEST["year"];

$arr['title'] = 'ประจำเดือน '.$month.' '.$year;

$tbody = '';
if( !empty($this->item['lists']) ){
	foreach ($this->item['lists'] as $key => $value) {
		if( $value['comission_amount'] == '0.00' ) continue;
		$tbody .= '<tr>
					<td class="tac">'.
						date("d/m/Y", strtotime($value['date'])).
					'</td>
					<td class="fwb tac">
						<a href="'.URL.'payments/'.$value['order_id'].'" target="_blank">'.$value['code'].'</a>
					</td>
					<td class="fwb">('.$value["sub_code"].') '.$value["cus_name"].'</td>
					<td class="tar">'.number_format($value['ord_net_price'], 2).'</td>
					<td class="tar">'.$value['comission_amount'].'</td>
				   </tr>';
	}
}
else{
	$tbody = '<tr><td colspan="5" class="fwb" style="text-align:center; color:red;">ไม่มีคอมมิชชั่น</td></tr>';
}

$body = '<div class="clearfix">
			<h3 class="fwb">('.$this->sale['code'].') '.$this->sale['name'].'</h3>
			<div class="">
				<table class="table-bordered" width="100%">
					<thead>
						<tr>
							<th width="15%">วันที่</th>
							<th width="15%">ORDER CODE</th>
							<th width="45%">ร้านค้า</th>
							<th width="10%">ยอดรวม</th>
							<th width="10%">คอมมิชชั่น</th>
						</tr>
					</thead>
					<tbody>
						'.$tbody.'
					</tbody>
				</table>
			</div>
		</div>';

$arr['body'] = $body;

$arr['width'] = 900;
$arr['is_close_bg'] = true;

echo json_encode($arr);