<?php
$style = "
<style>
    @page { margin: 10px 10px 0px 10px; }
    .page-break {page-break-after: always;}
    div.breakNow { page-break-inside:avoid; page-break-after:always; }
    body { margin: 0px; font-size: 10pt; }
    body {font-family: 'THSarabunNew';}
    .font-kanit {font-family:'Kanit-Light';}
    .box_customers {padding:5px 10px;}
    .box_customers_ii {border:1px solid #000000;margin-top:15px;display:block;padding:5px 4px 5px 8px;text-align:center;}
    .box_customers_iii {border:1px solid #000000;margin-top:15px;display:block;padding:10px 4px 10px 8px;text-align:center;}
    table.table_main_user {}
    .font_b {font-weight: bold;display: block;}
    .font_company {margin-bottom: -5px;margin-top: 5px;}
    table.items {border: 0.1mm solid #000;}
    td { vertical-align: top; }
    .items td {border-left: 0.1mm solid #000000;border-right: 0.1mm solid #000000;}
    table thead td { background-color: #FFF;text-align: center;border: 0.1mm solid #000000;font-weight:600;padding-bottom: 3px;padding-top: 2px;}
    table tbody td {padding-bottom: 2px;padding-top: 2px;}
    /*table tbody td {}*/
    .items td.blanktotal {background-color: #FFFFFF;border: 0mm none #000000;border-top: 0.1mm solid #000000;border-right: 0.1mm solid #000000;}
    .items td.totals {text-align: right;border-top: 0.1mm solid #000000;}
    .items td.cost {text-align: right;padding-right:5px;}
    .items td.txt_left {text-align: left;padding-left:8px;}
    .box_sig2 {text-align:center;width:300px;display:block;margin:1em;}
    .box_sig3 {text-align:center;width:200px;display:block;margin:1em;}
    .txt_hidden {content: ;display: none;}
    div.footer
    {
        right           : 0;
        bottom          : 0;
        margin-bottom   : 0mm;
        height          : 50mm;
        text-align      : right;
    }
  </style>
";

$tr = '';
foreach ($this->item['items'] as $key => $value) {
  for($i=0;$i<25;$i++){
  $tr .= '<tr>
      <td width="3%" style="padding: 5px;">&nbsp;'.($key+1).'&nbsp;</td>
      <td width="30%" style="padding: 5px;">&nbsp;'.$value['pro_name'].'&nbsp;</td>
      <td width="6%" style="padding: 5px;">&nbsp;'.$value['qty'].'&nbsp;</td>
      <td width="5%" style="padding: 5px;">&nbsp;'.$value['unit'].'&nbsp;</td>
      <td width="7%" style="padding: 5px;">&nbsp;'.$value['sales'].'&nbsp;</td>
      <td width="7%" style="padding: 5px;">&nbsp;'.$value['amount'].'&nbsp;</td>
      <td width="10%" style="padding: 5px;">&nbsp;'.$value['remark'].'&nbsp;</td>
    </tr>';
  }
}

$html = '
<table width="100%">
  <tr>
    <td align="center" valign="top">
    <h3>
      <span class="font_b" style="">โมเดิร์นแฟนตาซี จำกัด</span><br>
      <span class="font_b">Modern Fantasy Co., Ltd.</span>
    </h3>
    </td>
  </tr>
</table>
<table width="100%" style="margin-top: 0px;" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" style="border:0.5px solid #000;padding: 5px 0px 10px 10px;">
      <span class="f-18">
        66 ถนนราษร์ฏพัฒนา ซอย 1 แขวงสะพานสูง &nbsp;
        เขตสะพานสูง กรุงเทพมหานคร 10240 <br>เบอร์โทรศัพท์ 02-9171941-2
      </span>
    </td>
    <td valign="top" style="border:0.5px solid #000;padding: 15px 10px 10px 10px;" align="center">
      <h3 style="">ใบส่งสินค้า/ใบเสร็จรับเงิน(เงินสด)</h3>
      <span style=""></span>
    </td>
    <td width="33%" style="border:0.5px solid #000;padding: 5px 10px 0px 10px;">
      Inv. No. : '.$this->item['id'].'<br>
      Date : '.date('d/m/Y', strtotime($this->item['created'])).'<br>
      Time : '.date('H:i:s', strtotime($this->item['created'])).'
    </td>
  </tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" style="padding:0px 0px;">
    <tr>
      <td valign="top" style="padding: 0px 5px 7px 7px;border:0.5px solid #000;border-top: none;border-right: 0.5px solid #000;">
        <table width="100%">
          <tr>
            <td style="" ><b>Customer No. : </b></td>
            <td style="">'.$this->item['sub_code'].'</td>
          </tr>
          <tr>
            <td style="" ><b>Customer Name : </b></td>
            <td style="">'.$this->item['name_store'].'</td>
          </tr>
          <tr>
            <td style="" ></td>
            <td style="padding-top: -5px;">'.$this->item['address'].' '.$this->item['road'].' '.$this->item['area'].' '.$this->item['district'].' '.$this->item['province'].' '.$this->item['post_code'].' '.$this->item['country'].'</td>
          </tr>
        </table>
      </td>
      <td width="40%" style="border:0.5px solid #000;border-top: none;padding: 1px 5px 7px 7px;">
        <table width="100%">
          <tr>
            <td style="">เลขที่อ้างอิง : </td>
            <td style="">'.$this->item['term_of_payment'].'</td>
          </tr>
          <tr>
            <td style="">วันครบกำหนดชำระเงิน : </td>
            <td style="">'.$this->item['submit_date'].'</td>
          </tr>

        </table>
      </td>
  </tr>
</table>

<div style="height:5px;"></div>
<table class="items" width="100%" style="border-collapse: collapse;" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <td width="3%" style="">ลำดับ<br>Item.</td>
      <td width="30%" style="">สินค้า<br>Description</td>
      <td width="6%" style="">จำนวน<br>Quantity</td>
      <td width="5%" style="">หน่วย<br>Unit</td>
      <td width="7%" style="">ราคา/หน่วย<br>Unit/Price</td>
      <td width="7%" style="">รวม<br>Total</td>
      <td width="10%" style="">หมายเหตุ<br>Remark</td>
    </tr>
  </thead>
  <tbody>
    '.$tr.'
  </tbody>
</table>

<div class="footer" style="padding-top: 5px;">
  <table class="items" width="100%" style="border-collapse: collapse;border-top: none;" cellpadding="0" cellspacing="0">
    <tr>
      <td class="blanktotal" rowspan="4" align="left" valign="top" width="48.53%" style="padding-left: 5px;padding-top: 5px;">
        <font style="display: block;">ได้รับสินค้าดังรายการข้างบนนี้เรียบร้อยแล้ว</font>
        <font style="display: block;">Received the above mentioned goods in good order and condition.</font>
        <font style="display: block;">การชำระเงินด้วยเช็คจะสมบูรณ์ต่อเมื่อบริษัทฯ ได้รับเงินตามเช็คเรียบร้อยแล้ว</font>
        <font style="display: block;">Payment by cheque not valid till the cheque has been honoured</font>
      </td>
      <td class="totals" style="padding: 5px;">รวมเงิน</td>
      <td class="totals cost" width="14.7%" style="padding: 5px;">'.$this->itme['total'].'</td>
    </tr>
    <tr>
      <td class="totals" style="padding: 5px;">หักส่วนลดพิเศษ</td>
      <td class="totals cost" style="padding: 5px;">'.$this->itme['total'].'</td>
    </tr>
    <tr>
      <td class="totals" style="padding: 5px;">ยอดสุทธิ</td>
      <td class="totals cost" style="padding: 5px;">'.$this->itme['total'].'</td>
    </tr>
    <tr>
      <td class="totals" style="padding: 5px;">ภาษีมูลค่าเพิ่ม&nbsp;7.00%</b></td>
      <td class="totals cost" style="padding: 5px;">'.$this->itme['vat_persent'].'</td>
    </tr>
    <tr>
      <td class="blanktotal" style="padding: 5px;" align="center" width="48.53%">
        (xxxxx)
      </td>
      <td class="totals" style="padding: 5px;">จำนวนเงินรวมทั้งสิ้น</td>
      <td class="totals cost" style="padding: 5px;"><b>'.$this->itme['total'].'</b></td>
    </tr>
  </table>
  <table width="100%" style="border-collapse: collapse;border-top: none;border:0.5px solid #000;border-top: none;" cellpadding="0" cellspacing="0">
    <tr>
      <td style="height: 80px;" align="center">
        <p>&nbsp;</p>
        <p>...............................</p>
        <div style="margin-top: 3px;">ผู้รับสินค้า</div>
        <div style="">Receiver</div>
      </td>
      <td style="height: 80px;border-right: none;border-right:0.5px solid #000;" align="center">
        <p>&nbsp;</p>
        <p>...............................</p>
        <div style="margin-top: 3px;">วันที่รับ</div>
        <div style="">Received Date</div>
      </td>
      <td style="height: 80px;border-right:0.5px solid #000;" align="center">
        <p>&nbsp;</p>
        <p>...............................</p>
        <div style="margin-top: 3px;">ผู้ส่งสินค้า</div>
        <div style="">Deliverer</div>
      </td>
      <td style="height: 80px;" align="center">
        <p>&nbsp;</p>
        <p>...............................</p>
        <div style="margin-top: 3px;">ผู้รับเงิน</div>
        <div style="">Collector</div>
      </td>
      <td style="height: 80px;" align="center">
        <p>&nbsp;</p>
        <p>...............................</p>
        <div style="margin-top: 3px;">ผู้อนุมัติ</div>
        <div style="">Authorized</div>
      </td>
    </tr>
  </table>
</div>
';

$content = '<!doctype html><html lang="th"><head><title id="pageTitle">plate</title><meta charset="utf-8" />'.$style.'</head><body>'.$html.'</body></html>';

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
$mpdf->SetTitle('Oral-Invitation');
$mpdf->WriteHTML( $content );
$mpdf->Output('vat_sale_report.pdf','I');
