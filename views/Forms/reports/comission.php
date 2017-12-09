<?php 

$month = $this->fn->q('time')->month($_REQUEST["month"], true);
$year = $_REQUEST["year"];

$arr['title'] = 'ประจำเดือน '.$month.' '.$year;

$tbody = '';
if( !empty($this->item['lists']) ){
	foreach ($this->item['lists'] as $key => $value) {
		if( $value['comission_amount'] == '0.00' ) continue;
		$tbody .= '<tr>
					<td class="date" style="text-align:center;">'.
						date("d/m/Y", strtotime($value['date'])).
					'</td>
					<td class="name fwb">
						<a href="'.URL.'payments/'.$value['order_id'].'" target="_blank">'.$value['code'].'</a>
					</td>
					<td class="price">'.number_format($value['ord_net_price'], 2).'</td>
					<td class="price">'.$value['comission_amount'].'</td>
				   </tr>';
	}
}
else{
	$tbody = '<tr><td colspan="5" class="fwb" style="text-align:center; color:red;">ไม่มีคอมมิชชั่น</td></tr>';
}

$body = '<div class="clearfix">
			<h3 class="fwb">('.$this->sale['code'].') '.$this->sale['name'].'</h3>
			<div class="listpage2-table mtm">
				<table class="table-bordered">
					<thead>
						<tr>
							<th class="date">วันที่</th>
							<th class="name">ORDER CODE</th>
							<th class="price">ยอดเงินทั้งหมด</th>
							<th class="status">คอมมิชชั่น</th>
						</tr>
					</thead>
					<tbody>
						'.$tbody.'
					</tbody>
				</table>
			</div>
		</div>';

$arr['body'] = $body;

$arr['width'] = 750;
$arr['is_close_bg'] = true;

echo json_encode($arr);