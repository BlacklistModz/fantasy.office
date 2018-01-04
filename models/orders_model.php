<?php

class Orders_model extends Model{

    public function __construct() {
        parent::__construct();
    }

    private $_objName = "orders";
    private $_table = "orders o LEFT JOIN sales s ON o.ord_sale_code=s.sale_code";
    private $_field = "o.id
                       , ord_code AS code
    				   , ord_dateCreate AS date
    				   , ord_type_commission AS commission
                       , ord_customer_id AS customer_id
                       , ord_sale_code AS sale_code
    				   , user_name
    				   , user_code
    				   , term_of_payment AS payment
                       , ord_net_price AS net_price
                       , ord_process AS process
    				   , ord_status AS status
                       , o.created_at
                       , o.updated_at

                       , s.sale_name";

    public function lists( $options=array() ){

    	$options = array_merge(array(
            'pager' => isset($_REQUEST['pager'])? $_REQUEST['pager']:1,
            'limit' => isset($_REQUEST['limit'])? $_REQUEST['limit']:50,
            'more' => true,

            'sort' => isset($_REQUEST['sort'])? $_REQUEST['sort']: 'created_at',
            'dir' => isset($_REQUEST['dir'])? $_REQUEST['dir']: 'DESC',

            'time'=> isset($_REQUEST['time'])? $_REQUEST['time']:time(),

            'q' => isset($_REQUEST['q'])? $_REQUEST['q']:null,

        ), $options);

        $date = date('Y-m-d H:i:s', $options['time']);

        $where_str = "";
        $where_arr = array();

        if( isset($_REQUEST["period_start"]) && isset($_REQUEST["period_end"]) ){
            $options["period_start"] = $_REQUEST["period_start"];
            $options["period_end"] = $_REQUEST["period_end"];
        }
        if( !empty($options["period_start"]) && !empty($options["period_end"]) ){
        	$where_str .= !empty($where_str) ? " AND " : "";
        	$where_str .= "(ord_dateCreate BETWEEN :s AND :e)";
        	$where_arr[":s"] = $options["period_start"];
        	$where_arr[":e"] = $options["period_end"];
        }

        if( !empty($options['q']) ){
            $arrQ = explode(' ', $options['q']);
            $wq = '';
            foreach ($arrQ as $key => $value) {
                $wq .= !empty( $wq ) ? " OR ":'';
                $wq .= "ord_code LIKE :q{$key}
                        OR user_code LIKE :q{$key}
                        OR user_name LIKE :q{$key}
                        OR ord_sale_code LIKE :q{$key}";
                $where_arr[":q{$key}"] = "%{$value}%";
                $where_arr[":s{$key}"] = "{$value}%";
                $where_arr[":f{$key}"] = $value;
            }

            if( !empty($wq) ){
                $where_str .= !empty( $where_str ) ? " AND ":'';
                $where_str .= "($wq)";
            }
        }

        if( isset($_REQUEST["sale"]) ){
            $options["sale"] = $_REQUEST["sale"];
        }
        if( !empty($options["sale"]) ){
            $where_str .= !empty($where_str) ? " AND " : "";
            $where_str .= "ord_sale_code=:sale";
            $where_arr[":sale"] = $options["sale"];
        }

        if( isset($_REQUEST["term_of_payment"]) ){
            $options["term_of_payment"] = $_REQUEST["term_of_payment"];
        }
        if( !empty($options["term_of_payment"]) ){
            $where_str .= !empty($where_str) ? " AND " : "";
            $where_str .= "term_of_payment=:term_of_payment";
            $where_arr[":term_of_payment"] = $options["term_of_payment"];
        }

        if( !empty($options["customer"]) ){
            $where_str .= !empty($where_str) ? " AND " : "";
            $where_str .= "ord_customer_id=:customer";
            $where_arr[":customer"] = $options["customer"];
        }

        if( !empty($options['cut']) ){
            $where_str .= !empty($where_str) ? " AND " : "";
            $where_str .= "id!=:cut";
            $where_arr[":cut"] = $options["cut"];
        }

        if( !empty($options['not_status']) ){
            $where_str .= !empty($where_str) ? " AND " : "";
            $where_str .= "ord_status!=:not_status";
            $where_arr[":not_status"] = $options["not_status"];
        }

        $arr['total'] = $this->db->count($this->_table, $where_str, $where_arr);

        $limit = $this->limited( $options['limit'], $options['pager'] );
        $orderby = $this->orderby( $options['sort'], $options['dir'] );
        $where_str = !empty($where_str) ? "WHERE {$where_str}":'';
        if( !empty($options["unlimit"]) ) $limit = "";

        $arr['lists'] = $this->buildFrag( $this->db->select("SELECT {$this->_field} FROM {$this->_table} {$where_str} {$orderby} {$limit}", $where_arr ), $options );

        if( ($options['pager']*$options['limit']) >= $arr['total'] ) $options['more'] = false;
        $arr['options'] = $options;

        return $arr;
    }
    public function get($id, $options=array() ){

        $sth = $this->db->prepare("SELECT {$this->_field} FROM {$this->_table} WHERE o.id=:id LIMIT 1");
        $sth->execute( array(':id'=>$id) );

        return $sth->rowCount()==1
            ? $this->convert( $sth->fetch( PDO::FETCH_ASSOC ), $options )
            : array();
    }
    public function getCode($code, $options=array() ){

        $sth = $this->db->prepare("SELECT {$this->_field} FROM {$this->_table} WHERE ord_code=:code LIMIT 1");
        $sth->execute( array(':code'=>$code) );

        return $sth->rowCount()==1
            ? $this->convert( $sth->fetch( PDO::FETCH_ASSOC ), $options )
            : array();
    }
    public function buildFrag($results, $options=array()) {
        $data = array();
        foreach ($results as $key => $value) {
            if( empty($value) ) continue;
            $data[] = $this->convert( $value, $options );
        }

        return $data;
    }
    public function convert($data, $options=array()){

        $data['term_of_payment'] = $this->getTerm_of_payment($data['payment']);
        $data['type_commission'] = $this->getType_Comission($data['commission']);

    	if( !empty($options['items']) ){
    		$data['items'] = $this->listsItems($data['id']);
            $data['prices'] = 0;
            $data['total_qty'] = 0;
            $data['total_discount'] = 0;
            $data['total_comission'] = 0;
            foreach ($data['items'] as $item) {
                // $data['total_price'] += $item['price'];
                $data['total_qty'] += $item['qty'];
                $data['total_discount'] += $item['discount'];
                $data['prices'] += $item['balance'];
                $data['total_comission'] += ($item['balance'] * $item['pds_comission']) / 100;
            }
    	}

        $data['pay'] = 0;
        $data['balance'] = 0;
        $data['total_get_comission'] = 0;

        if( !empty($options['payment']) ){
            $data['payment_lists'] = $this->listsPayment($data['id']);
            foreach ($data['payment_lists'] as $key => $value) {
                $data['pay'] += $value['amount'];
                $data['total_get_comission'] += $value['comission_amount'];
            }
            $data['balance'] = $data['net_price'] - $data['pay'];
        }

        $data['process'] = $this->getProcess($data['process']);

    	return $data;
    }
    public function insert($data){
        $this->db->insert($this->_objName, $data);
    }
    public function update($id, $data){
        $this->db->update($this->_objName, $data, "id={$id}");
    }

    #Items
    public function listsItems( $id ){
    	return $this->db->select("SELECT ord_code AS code, itm_name AS name, itm_qty AS qty, itm_price AS price, itm_discount AS discount, itm_prices AS balance, itm_status AS status, p.pds_comission FROM orders_item oi LEFT JOIN products p ON oi.itm_id=p.id WHERE ord_id=:id  ORDER BY oi.id ASC", array(":id"=>$id));
    }

    #Payment
    private $p_select = "pay_type_id AS type_id
                         , pay_id AS id
                         , pay_bank_id AS bank_id
                         , pay_account_id AS account_id
                         , pay_amount AS amount
                         , pay_note AS note
                         , pay_check_number AS check_number
                         , pay_date AS date
                         , pay_time AS time
                         , pay_image_id AS image_id
                         , pay_type AS type
                         , pay_comission AS comission
                         , pay_comission_amount AS comission_amount
                         , t.type_name
                         , t.type_is_cash
                         , t.type_is_bank
                         , t.type_is_check
                         , b.bank_name
                         , b.bank_code
                         , a.account_number
                         , a.account_name
                         , a.account_branch";
    private $p_table = "payments p
                        LEFT JOIN payments_type t ON p.pay_type_id=t.type_id
                        LEFT JOIN payments_bank b ON p.pay_bank_id=b.bank_id
                        LEFT JOIN payments_account a ON p.pay_account_id=a.account_id";
    public function listsPayment( $id ){
        $data = array();
        $results = $this->db->select("SELECT {$this->p_select} FROM {$this->p_table} WHERE pay_order_id=:id", array(":id"=>$id));
        foreach ($results as $key => $value) {
            $data[$key] = $value;
            if( !empty($value['image_id']) ){
                $image = $this->query('media')->get($value['image_id']);
                if( !empty($image) ){
                    $data[$key]['image_url'] = $image['url'];
                    $data[$key]['image_arr'] = $image;
                }
            }
        }

        return $data;
    }

    #TYPE OF PAYMENTS
    public function term_of_payment(){

        $a[] = array('id'=>1, 'name'=>'Cash');
        $a[] = array('id'=>2, 'name'=>'30 day credit');
        $a[] = array('id'=>3, 'name'=>'Credit Cards');
        $a[] = array('id'=>4, 'name'=>'transfer money');
        $a[] = array('id'=>5, 'name'=>'sperately pay');

        return $a;
    }
    public function getTerm_of_payment($id){
        $data = array();

        foreach ($this->term_of_payment() as $key => $value) {
            if( $value['id'] == $id ){
                $data = $value;
                break;
            }
        }

        return $data;
    }

    #Comission
    public function type_Comission(){
        $a[] = array('id'=>'sales', 'Sales');
        $a[] = array('id'=>'extra', 'พิเศษ');

        return $a;
    }
    public function getType_Comission($id){
        $data = array();

        foreach ($this->type_Comission() as $key => $value) {
            if( $value['id'] == $id ){
                $data = $value;
                break;
            }
        }
        return $data;
    }

    #PROCESS
    public function process(){
        $a[] = array('id'=>0, 'name'=>'รอการตรวจสอบ', 'color'=>'#757575', 't_color'=>'#000');
        $a[] = array('id'=>1, 'name'=>'สินค้ามีบางส่วน', 'color'=>'' , 't_color'=>'#000');
        $a[] = array('id'=>2, 'name'=>'สินค้ามีทั้งหมด', 'color'=>'' , 't_color'=>'#000');
        $a[] = array('id'=>3, 'name'=>'อนุมัติจัดส่ง', 'color'=>'#00796B' , 't_color'=>'#fff');
        $a[] = array('id'=>4, 'name'=>'ส่งสินค้าแล้ว', 'color'=>'' , 't_color'=>'#000');
        $a[] = array('id'=>5, 'name'=>'เก็บเงินมาบางส่วน', 'color'=>'' , 't_color'=>'#000');
        $a[] = array('id'=>6, 'name'=>'เก็บเงินทั้งหมดแล้ว', 'color'=>'' , 't_color'=>'#000');
        $a[] = array('id'=>7, 'name'=>'ยกเลิก', 'color'=>'#C62828' , 't_color'=>'#fff');

        return $a;
    }
    public function getProcess($id){
        $data = array();
        foreach ($this->process() as $key => $value) {
            if( $id == $value['id'] ){
                $data = $value;
            }
        }
        return $data;
    }
}
