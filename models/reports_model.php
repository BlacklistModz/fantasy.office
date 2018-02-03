<?php 
class Reports_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function summaryComission($start=null, $end=null){

    	$data = array();

    	$sales = $this->db->select("SELECT id, sale_code, sale_name , sale_fullname FROM sales ORDER BY sale_code ASC");
    	foreach ($sales as $key => $value) {

    		$where_arr[':id'] = $value['id'];
    		$where_arr[':s'] = $start;
    		$where_arr[':e'] = $end;

    		$results = $this->db->select("SELECT SUM(pay_comission_amount) AS total_comission FROM payments WHERE pay_sale_id=:id AND (pay_date BETWEEN :s AND :e)", $where_arr);

    		$data[$key] = $value;
    		$data[$key]['comission'] = !empty($results[0]['total_comission']) 
    								   ? $results[0]['total_comission'] 
    								   : 0;
    	}

    	return $data;
    }

    public function summaryRevenu($start, $end){

        $start = date("Y-m-d 00:00:00", strtotime($start));
        $end = date("Y-m-d 00:00:00", strtotime($end));

        $_data['total'] = 0;
        $_data['price'] = 0;

        $field = "SUM(ord_net_price) AS total_price, COUNT(*) AS total_order";
        $table = "orders";

        $where = "ord_dateCreate BETWEEN :s AND :e";
        $where_arr[":s"] = $start;
        $where_arr[":e"] = $end;

        $data = $this->db->select("SELECT {$field} FROM {$table} WHERE {$where}", $where_arr);
        if( !empty($data) ){
            $_data['total'] = $data[0]['total_order'];
            $_data['price'] = $data[0]['total_price'];
        }

        return $_data;
    }

    public function sale_due($options=array()){
        $data = array();
        $_data = array();
        $w = '';
        $w_arr = array();

        if( !empty($options['sale']) ){
            $w .= !empty($w) ? " AND " : "";
            $w .= "ord_sale_code=:sale";
            $w_arr[':sale'] = $options['sale']; 
        }

        if( !empty($options["month"]) && !empty($options["year"]) ){
            $w .= !empty($w) ? " AND " : "";
            $w .= "ord_dateCreate LIKE :month";
            $w_arr[":month"] = "{$options["year"]}-{$options["month"]}%";
        }

        if( !empty($options["process"]) ){
            $w .= !empty($w) ? " AND " : "";
            $w .= "ord_process=:process";
            $w_arr[":process"] = $options["process"];
        }

        $w = !empty($w) ? "WHERE {$w}" : "";
        $results = $this->db->select("SELECT * FROM orders {$w}", $w_arr);
        foreach ($results as $key => $value) {
            $data[$key] = $value;
            $data[$key]['pay'] = 0;
            $data[$key]['total_get_comission'] = 0;
            $data[$key]['balance'] = 0;

            $payment = $this->query('orders')->listsPayment($value['id']);
            foreach ($payment as $i => $val) {
                $data[$key]['pay'] += $val['amount'];
                $data[$key]['total_get_comission'] += $val['comission_amount'];
            }
            $data[$key]['balance'] = $data[$key]['ord_net_price'] - $data[$key]['pay'];
        }

        foreach ($data as $key => $value) {
            if( empty($value['balance']) ) continue;
            $_data[] = $value;
        }

        return $_data;
    }
}