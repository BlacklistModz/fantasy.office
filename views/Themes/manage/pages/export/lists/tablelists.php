<?php
//print_r($this->results['lists']); die;
$tr = "";
$tr_total = "";
if( !empty($this->results['lists']) ){
    //print_r($this->results); die;

    $seq = 0;
    foreach ($this->results['lists'] as $i => $item) {

        $cls = $i%2 ? 'even' : "odd";

        $tr .= '<tr class="'.$cls.'" data-id="'.$item['id'].'"">'.

            '<td class="date">'.date("d/m/Y", strtotime( $item["date"] )).'</td>'.

            '<td class="name">'.
                '<div class="ellipsis"><a title="" class="fwb" href="'.URL.'export/set/'.$item["id"].'"></a></div>'.
            '</td>'.

            '<td class="status"></td>'.
            '<td class="price"></td>'.
            '<td class="action"></td>'.

        '</tr>';
    }
}

$table = '<table><tbody>'. $tr. '</tbody>'.$tr_total.'</table>';
