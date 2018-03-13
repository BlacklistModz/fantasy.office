<?php 

$head = '<style>
			@page{ margin : 10px 10px 10px 10px }
			table, th, td {
   				border: 1px solid #000;
   				border-collapse:collapse;
			}
			th, td{
				padding-top:5px;
			}
		</style>';

$html = '<div>
			<h3 style="text-align:center;">รายงาน Vat ขาย <br/>ประจำเดือน '.$this->fn->q('time')->month( sprintf("%01d", $this->month), true ).' '.($this->year+543).'</h3>
		</div>
		<div>
			<table width="100%">
				<thead>
					<tr style="background-color:Violet;">
						<th width="10%">เลขที่ใบส่งของ</th>
						<th width="10%">รหัส</th>
						<th width="20%">ชื่อร้าน</th>
						<th width="10%">เงื่อนไข</th>
						<th width="15%">ยอดรวม</th>
						<th width="15%">VAT</th>
						<th width="15%">ยอดสุทธิ</th>
					</tr>
				</thead>
				<tbody>';

// $total_list = 0;
$total = 0;
$vat = 0;
$amount = 0;
$total_list = $this->results["total"];

foreach ($this->results['lists'] as $key => $value) {
	$html .= '<tr>
				<td align="center">IN'.sprintf("%05d", $value["id"]).'</td>
				<td align="center">'.$value["sub_code"].'</td>
				<td style="padding-left:1mm;">'.$value["name_store"].'</td>
				<td align="center">'.$value["term_of_payment_arr"]["name"].'</td>
				<td align="right">'.number_format($value["total"], 2).'</td>
				<td align="right">'.number_format($value["vat"], 2).'</td>
				<td align="right">'.number_format($value["amount"], 2).'</td>
			</tr>';

	if( !empty($total_list) ){
		$total_list--;
	}
	$total += $value["total"];
	$vat += $value["vat"];
	$amount += $value["amount"];
}
$html .=	'</tbody>';

if( $total_list < 45 ){
$html .= 	'<tfoor>
				<tr style="background-color:Violet;">
					<th colspan="4">รวม</th>
					<th align="right">'.number_format($total, 2).'</th>
					<th align="right">'.number_format($vat, 2).'</th>
					<th align="right">'.number_format($amount, 2).'</th>
				</tr>		
		  	</tfoot>';
}

$html .= '</table>
		</div>';

$content = '<!doctype html><html lang="th"><head><title id="pageTitle">plate</title><meta charset="utf-8" />'.$head.'</head><body>'.$html.'</body></html>';

// echo $content;

$mpdf = new mPDF('th', 'A4', '0');

$mpdf->debug = true;
$mpdf->allow_output_buffering = true;

$mpdf->charset_in='UTF-8';
$mpdf->allow_charset_conversion = true;

$mpdf->list_indent_first_level = 0;

// $stylesheet = file_get_contents(CSS . 'bootstrap.css');
// $mpdf->WriteHTML($stylesheet,1);

// $stylesheet2 = file_get_contents(VIEW.'Themes/plate/assess/css/main.css');
// $mpdf->WriteHTML($stylesheet2,1);

// $content = iconv('UTF-8', 'windows-1252', $content);
// $content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');

ob_clean();
$mpdf->SetTitle('VAT SALE M-'.$this->month.' Y-'.$this->year);
$mpdf->WriteHTML( $content );
$mpdf->setFooter('{PAGENO}');
$mpdf->Output('vat_sale.pdf','I');