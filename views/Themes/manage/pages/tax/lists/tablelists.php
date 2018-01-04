<?php
//print_r($this->results['lists']); die;
$tr = "";
$tr_total = "";

if( !empty($this->results['lists']) ){
    //print_r($this->results); die;

    $seq = 0;
    foreach ($this->results['lists'] as $i => $item) {

        $cls = $i%2 ? 'even' : "odd";

        $date = date("d", strtotime($item['date']));
        $month = $this->fn->q('time')->month( date("n", strtotime($item['date'])) );
        $year = date("y", strtotime($item['date']))+43;
        $dateStr = "{$date}-{$month}-{$year}";

        $tr .= '<tr class="'.$cls.'" data-id="'.$item['id'].'"">'.

            '<td class="phone">'.$item['slipt'].'</td>'.

            '<td class="date">'.$dateStr.'</td>'.

            '<td class="ID">'.$item['sup_code'].'</td>'.

            '<td class="name">'.
                '<div class="ellipsis"><a data-plugins="dialog" title="'.$item['sup_name'].'" class="fwb" href="'.URL.'tax/edit/'.$item['id'].'">'.(!empty($item['sup_name']) ? $item['sup_name'] : "-").'</a></div>'.
                // '<div class="date-float fsm fcg">Add on: '. ( $item['created'] != '0000-00-00 00:00:00' ? $this->fn->q('time')->live( $item['created'] ):'-' ) .'</div>'.

                // '<div class="date-float fsm fcg">Recent changes: '. ( $item['updated'] != '0000-00-00 00:00:00' ? $this->fn->q('time')->live( $item['updated'] ):'-' ) .'</div>'.

            '</td>'.

            '<td class="price">'.(!empty($item['total']) ? number_format($item['total'], 2) : "-").'</td>'.

            '<td class="price">'.(!empty($item['vat']) ? number_format($item['vat'], 2) : "-").'</td>'.

            '<td class="actions">
                <div class="group-btn whitespace">'.
                    '<a data-plugins="dialog" class="btn btn-no-padding btn-orange" href="'.URL.'tax/edit/'.$item['id'].'"><i class="icon-pencil"></i></a>'.
                    '<a class="btn btn-no-padding btn-red" data-plugins="dialog" href="'.URL.'tax/del/'.$item['id'].'"><i class="icon-trash"></i></a>'.
                '</div>
            </td>';

        '</tr>';
    }
}

$table = '<table><tbody>'. $tr. '</tbody>'.$tr_total.'</table>';
