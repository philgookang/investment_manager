<?php

class P2pReturnsBM extends BusinessModel {

    // data model for this bm
    private $dm                     = null;

    // public variables
    public $idx                     = 0;
    public $product_idx             = 0;
    public $date                    = 0;
    public $profit                = 0;
    public $profit_late                = 0;
    public $tax                     = 0;
    public $susuro                  = 0;

    public $term                    = 0;

    public $search_month            = '';

    public $marker                  = 0;

    public $type                    = 0;

    public $created_date_time       = null;

    // init function
    public function __construct() {
        $this->dm = new P2pReturnsDM();
    }

    // help to create quick objects
    public static function new( $data = array() ) {
        // create new object
        $new = new P2pReturnsBM();
        $new->extend($data);
        return $new;
    }

    //// ------------------------------ create setter & getters

    public function setIdx( $idx ) {
        $this->idx = $idx; return $this;
    }

    public function getIdx() {
        return $this->idx;
    }

    public function setProductIdx( $product_idx ) {
        $this->product_idx = $product_idx; return $this;
    }

    public function getProductIdx() {
        return $this->product_idx;
    }

    public function setDate( $date ) {
        $this->date = $date; return $this;
    }

    public function getDate() {
        return $this->date;
    }

    public function setProfit( $profit ) {
        $this->profit = $profit; return $this;
    }

    public function getProfit() {
        return $this->profit;
    }

    public function setProfitLate( $profit_late ) {
        $this->profit_late = $profit_late; return $this;
    }

    public function getProfitLate() {
        return $this->profit_late;
    }

    public function setTax( $tax ) {
        $this->tax = $tax; return $this;
    }

    public function getTax() {
        return $this->tax;
    }

    public function setTerm( $term ) {
        $this->term = $term; return $this;
    }

    public function getTerm() {
        return $this->term;
    }

    public function setSusuro( $susuro ) {
        $this->susuro = $susuro; return $this;
    }

    public function getSusuro() {
        return $this->susuro;
    }

    public function setMarker( $marker ) {
        $this->marker = $marker; return $this;
    }

    public function getMarker() {
         return $this->marker;
    }

    public function setType($type) {
        $this->type = $type; return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function setCreatedDateTime( $created_date_time ) {
        $this->created_date_time = $created_date_time; return $this;
    }

    public function getCreatedDateTime($format = 'Y-m-d H:i:s') {
        $d = new DateTime($this->created_date_time);
        return $d->format($format);
    }

    public function setSearchMonth($search_month) {
        $this->search_month = $search_month; return $this;
    }

    //// ------------------------------ action function

    public function create() {
        return $this->dm->create( $this->product_idx, $this->profit, $this->profit_late, $this->tax, $this->susuro, $this->date, $this->term, $this->marker, $this->type );
    }

    public function update() {
        return $this->dm->update($this->idx, $this->product_idx, $this->profit, $this->profit_late, $this->tax, $this->susuro, $this->date, $this->term, $this->marker, $this->type );
    }

    public function updateMarker() {
        return $this->dm->updateMarker($this->idx, $this->marker );
    }

    public function getList( $sortBy, $sortDirection, $limit, $offset, $select = 'idx,product_idx,profit,profit_late,tax,term,susuro,date,marker,type ' ) {

        $return_list = array();
        $list = $this->dm->getList( $this->search_month, $this->product_idx, $this->type, $sortBy, $sortDirection, $limit, $offset, false, $select);

        foreach($list as $item) {
            array_push($return_list, P2pReturnsBM::new($item) );
        }

        return $return_list;
    }

    public function getTotal( $sortBy = 'idx', $sortDirection = 'desc', $select = 'count(*) as cnt ' ) {
        $total = $this->dm->getList( $this->search_month, $this->product_idx, $this->type, $sortBy, $sortDirection, '0', '0', true, $select );
        return (isset($total->cnt)) ? $total->cnt : $total ;
    }

    public function get($select = '*') {
        return P2pReturnsBM::new(
            $this->dm->get( $this->idx, $select )
        );
    }

    public function removeAll() {
        $this->dm->removeAll ( $this->product_idx );
    }

    public function remove() {
        $this->dm->remove ( 'p2p_returns', $this->idx );
    }
}
