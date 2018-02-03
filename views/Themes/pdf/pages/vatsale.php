<?php
$tr = '';
foreach ($this->item['items'] as $key => $value) {
  $tr .= '<tr>
      <td style="border: 1px solid black; padding: 3px; text-align: center;">'.($key+1).'</td>
      <td style="border: 1px solid black; padding: 3px; text-align: left;">'.$value['pro_name'].'</td>
      <td style="border: 1px solid black; padding: 3px; text-align: center;">'.$value['qty'].'</td>
      <td style="border: 1px solid black; padding: 3px; text-align: right;">'.$value['unit'].'</td>
      <td style="border: 1px solid black; padding: 3px; text-align: right;">'.$value['sales'].'</td>
      <td style="border: 1px solid black; padding: 3px; text-align: right;">'.$value['amount'].'</td>
      <td style="border: 1px solid black; padding: 3px; text-align: right;">'.$value['remark'].'</td>
    </tr>';
}

$html = '
<div style="width: 100%; width: 100%; text-align: center; margin: 0px;">
<h3>
โมเดิร์นแฟนตาซี จำกัด<br>
Modern Fantasy Co., Ltd
</h3>
</div>

  <table style="
  width: 100%;
  border: 1px solid black;
  border-collapse: collapse;
  cellspacing: 0px;
  cellpadding: 0px;
  ">

    <tr>
      <td style="width: 33.33%; border: 1px solid black;">
      1
      </td>
      <td style="width: 33.33%; border: 1px solid black; text-align: center;">
      <b>ใบส่งสินค้า/ใบเสร็จรับเงิน(เงินสด)</b>
      </td>
      <td style="width: 33.33%; border: 1px solid black;">
      Inv. No. : '.$this->item['id'].'<br>
      Date : '.date('d/m/Y', strtotime($this->item['created'])).'<br>
      Time : '.date('H:i:s', strtotime($this->item['created'])).'<br>
      </td>
    </tr>
  </table>

  <table style="
  width: 100%;
  border: 1px solid black;
  border-collapse: collapse;
  cellspacing: 0px;
  cellpadding: 0px;
  margin-top: -1px;
  ">
    <tr>
      <td style="border: 1px solid black; padding: 3px;">
        2
      </td>
      <td style="border: 1px solid black; padding: 3px;">
        2
      </td>
    </tr>
  </table>

  <table style="
  width: 100%;
  border: 1px solid black;
  border-collapse: collapse;
  cellspacing: 0px;
  cellpadding: 0px;
  margin-top: 2px;
  ">
    <tr>
      <td style="border: 1px solid black; padding: 3px;">
        #
      </td>
      <td style="border: 1px solid black; padding: 3px;">
        สินค้า
      </td>
      <td style="border: 1px solid black; padding: 3px;">
        จำนวน
      </td>
      <td style="border: 1px solid black; padding: 3px;">
        หน่วย
      </td>
      <td style="border: 1px solid black; padding: 3px;">
        ราคา/หน่วย
      </td>
      <td style="border: 1px solid black; padding: 3px;">
        รวม
      </td>
      <td style="border: 1px solid black; padding: 3px;">
        หมายเหตุ
      </td>
    </tr>
    '.$tr.'

  </table>

  <table style="
  width: 100%;
  border: 1px solid black;
  border-collapse: collapse;
  cellspacing: 0px;
  cellpadding: 0px;
  margin-top: 2px;
  ">
    <tr>
      <td style="width: 50%; border: 1px solid black; padding: 10px;" rowspan="4">
        ได้รับสินค้าดังรายการข้างบนนี้เรียบร้อยแล้ว<br>
        Received the above mentioned goods in good order and condition.<br>
        การชำระเงินด้วยเช็คจะสมบูรณ์ต่อเมื่อบริษัทฯ ได้รับเงินตามเช็คเรียบร้อยแล้ว<br>
        Payment by cheque not valid till the cheque has been honoured
      </td>
      <td style="width: 40%; border: 1px solid black; text-align: left; padding: 3px;">
        รวมเงิน
      </td>
      <td style="width: 20%; border: 1px solid black; text-align: left; padding: 3px;">
        2
      </td>
    </tr>

    <tr>
      <td style="border: 1px solid black; text-align: left; padding: 3px;">
        หักส่วนลดพิเศษ
      </td>
      <td style="border: 1px solid black; text-align: left; padding: 3px;">
        2
      </td>
    </tr>

    <tr>
      <td style="border: 1px solid black; text-align: left; padding: 3px;">
        ยอดสุทธิ
      </td>
      <td style="border: 1px solid black; text-align: left; padding: 3px;">
        2
      </td>
    </tr>

    <tr>
      <td style="border: 1px solid black; text-align: left; padding: 3px;">
        ภาษีมูลค่าเพิ่ม 7.00%
      </td>
      <td style="border: 1px solid black; text-align: left; padding: 3px;">
        2
      </td>
    </tr>

    <tr>
      <td style="width: 50%; border: 1px solid black; text-align: center; padding: 3px;">
        (ห้าพันบาทถ้วน)
      </td>
      <td style="width: 40%; border: 1px solid black; text-align: left; padding: 3px;">
        จำนวนเงินรวมทั้งสิ้น
      </td>
      <td style="width: 20%; border: 1px solid black; text-align: left; padding: 3px;">
        2
      </td>
    </tr>

  </table>

  <table style="
  width: 100%;
  border: 1px solid black;
  border-collapse: collapse;
  cellspacing: 0px;
  cellpadding: 0px;
  margin-top: 2px;
  ">
    <tr>
      <td style="border: 1px solid black; text-align: center; padding: 3px;">
        1
      </td>
      <td style="border: 1px solid black; text-align: center; padding: 3px;">
        2
      </td>
      <td style="border: 1px solid black; text-align: center; padding: 3px;">
        3
      </td>
    </tr>
  </table>

';

$content = '<!doctype html><html lang="th"><head><title id="pageTitle">plate</title><meta charset="utf-8" /></head><body>'.$html.'</body></html>';

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
