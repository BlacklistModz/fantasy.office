<?php

class Bills_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    private $_objName = "bills";
    private $_table = "bills b LEFT JOIN customers c ON b.bill_cus_id=c.id";
    private $_field = "b.*, c.sub_code";
    private $_cutNamefield = "bill_";

    public function insert(&$data){
    	$data["{$this->_cutNamefield}created"] = date("c");
    	$data["{$this->_cutNamefield}updated"] = date("c");
    	$this->db->insert($this->_objName, $data);
        $data['id'] = $this->db->lastInsertId();
    }
    public function update($id, $data){
    	$data["{$this->_cutNamefield}updated"] = date("c");
    	$this->db->update($this->_objName, $data, "{$this->_cutNamefield}id={$id}");
    }
    public function delete($id){
    	$this->db->delete($this->_objName, "{$this->_cutNamefield}id={$id}");
    	$this->deleteItems($id);
    }
    public function deleteItems($id){
    	$this->db->delete("bills_item", "item_bill_id={$id}", $this->db->count("bills_item", "item_bill_id={$id}"));
    }
    public function lists($options=array()){
        $options = array_merge(array(
            'pager' => isset($_REQUEST['pager'])? $_REQUEST['pager']:1,
            'limit' => isset($_REQUEST['limit'])? $_REQUEST['limit']:50,
            'more' => true,

            'sort' => isset($_REQUEST['sort'])? $_REQUEST['sort']: 'created',
            'dir' => isset($_REQUEST['dir'])? $_REQUEST['dir']: 'DESC',
            
            'time'=> isset($_REQUEST['time'])? $_REQUEST['time']:time(),
            
            'q' => isset($_REQUEST['q'])? $_REQUEST['q']:null,

        ), $options);

        $date = date('Y-m-d H:i:s', $options['time']);

        $where_str = "";
        $where_arr = array();

        if( isset($_REQUEST["term_of_payment"]) ){
            $options["term_of_payment"] = $_REQUEST["term_of_payment"];
        }
        if( !empty($options["term_of_payment"]) ){
            $where_str .= !empty($where_str) ? " AND " : "";
            $where_str .= "{$this->_cutNamefield}term_of_payment=:term_of_payment";
            $where_arr[":term_of_payment"] = $options["term_of_payment"];
        }

        // if( !empty($options["q"]) ){
        //     $where_str .= !empty($where_str) ? " AND " : "";
        //     $where_str .= "{$this->_cutNamefield}bill =: "
        // }

        $arr['total'] = $this->db->count($this->_table, $where_str, $where_arr);

        $limit = $this->limited( $options['limit'], $options['pager'] );
        $orderby = $this->orderby( $this->_cutNamefield.$options['sort'], $options['dir'] );
        $where_str = !empty($where_str) ? "WHERE {$where_str}":'';
        if( !empty($options["unlimit"]) ) $limit = "";

        $groupby = !empty($groupby) ? "GROUP BY {$groupby}" :'';

        $arr['lists'] = $this->buildFrag( $this->db->select("SELECT {$this->_field} FROM {$this->_table} {$where_str} {$groupby} {$orderby} {$limit}", $where_arr ), $options );

        if( ($options['pager']*$options['limit']) >= $arr['total'] ) $options['more'] = false;
        $arr['options'] = $options;

        return $arr;
    }
    public function get($id, $options=array()){

        $sth = $this->db->prepare("SELECT {$this->_field} FROM {$this->_table} WHERE {$this->_cutNamefield}id=:id LIMIT 1");
        $sth->execute( array(
            ':id' => $id
        ) );

        return $sth->rowCount()==1
            ? $this->convert( $sth->fetch( PDO::FETCH_ASSOC ) , $options )
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
        $data = $this->cut($this->_cutNamefield, $data);
        $data["term_of_payment_arr"] = $this->getTerm_of_payment($data["term_of_payment"]);

        if( !empty($options['items']) ){
            $data['items'] = $this->listsItems($data['id']);
        }
        $data['permit']['del'] = true;

        return $data;
    }
    #Lists
    public function listsItems($id){
        $data = $this->db->select("SELECT * FROM bills_item WHERE item_bill_id={$id}");
        return $this->buildFragItem( $data );
    }
    public function buildFragItem($results){
        $data = array();
        foreach ($results as $key => $value) {
            if( empty($value) ) continue;
            $data[] = $this->convertItem( $value );
        }

        return $data;
    }
    public function convertItem($data){
        $data = $this->cut("item_", $data);
        return $data;
    }
    public function setItem($data){
        $data["item_updated"] = date("c");

        if( !empty($data['id']) ){
            $id = $data['id'];
            unset($data['id']);
            $this->db->update("bills_item", $data, "item_id={$id}");
        }
        else{
            $data["item_created"] = date("c");
            $this->db->insert("bills_item", $data);
        }
    }
    public function unsetItem($id){
        $this->db->delete("bills_item", "item_id={$id}");
    }

    public function listsProduct(){
        return $this->db->select("SELECT id, pds_name AS name, pds_barcode AS barcode FROM products WHERE pds_has_vat=1");
    }

    public function term_of_payment(){
        $a[] = array('id'=>1, 'name'=>'เงินสด');
        $a[] = array('id'=>2, 'name'=>'30 วัน');

        return $a;
    }
    public function getTerm_of_payment($id){
        $data = array();
        foreach ($this->term_of_payment() as $key => $value) {
            if( $id == $value["id"] ){
                $data = $value;
                break;
            }
        }
        return $data;
    }
} 