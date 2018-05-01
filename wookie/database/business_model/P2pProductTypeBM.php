<?php

class P2pProductTypeBM extends BusinessModel {

    // data model for this bm
    private $dm                     = null;

    // public variables
    public $idx                     = 0;
    public $company_idx             = 0;
    public $name                    = '';
    public $interest                = '';
    public $total_time              = 0;
    public $amount                  = 0;
    public $heartbeat               = 0;
    public $heartbeat_complete      = '0000-00-00';
    public $created_date_time       = null;

    public $new_date                = null;

    // init function
    public function __construct() {
        $this->dm = new P2pProductDM();
    }

    // help to create quick objects
    public static function new( $data = array() ) {
        // create new object
        $new = new P2pProductBM();
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

    public function setCompanyIdx( $company_idx ) {
        $this->company_idx = $company_idx; return $this;
    }

    public function getCompanyIdx($get = false) {
        if ($get) {
            return P2pCompanyBM::new()->setIdx($this->company_idx)->get();
        }
        return $this->company_idx;
    }

    public function setName( $name ) {
        $this->name = $name; return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setInterest( $interest ) {
        $this->interest = $interest; return $this;
    }

    public function getInterest() {
        return $this->interest;
    }

    public function setAmount( $amount ) {
        $this->amount = $amount; return $this;
    }

    public function getAmount($format = false) {
        if ($format) {
            return number_format($this->amount);
        }
        return $this->amount;
    }

    public function setTotalTime( $total_time ) {
        $this->total_time = $total_time; return $this;
    }

    public function getTotalTime() {
        return $this->total_time;
    }

    public function setHeartbeat($heartbeat) {
        $this->heartbeat = $heartbeat; return $this;
    }

    public function getHeartbeat() {
        return $this->heartbeat;
    }

    public function setHeartbeatComplete($heartbeat_complete) {
        $this->heartbeat_complete = $heartbeat_complete; return $this;
    }

    public function getHeartbeatComplete() {
        return $this->heartbeat_complete;
    }

    public function setCreatedDateTime( $created_date_time ) {
        $this->created_date_time = $created_date_time; return $this;
    }

    public function getCreatedDateTime($format = 'Y-m-d H:i:s') {
        $d = new DateTime($this->created_date_time);
        return $d->format($format);
    }

    public function setNewDate($new_date) {
        $this->new_date = $new_date; return $this;
    }

    //// ------------------------------ action function

    public function create() {
        return $this->dm->create( $this->company_idx, $this->name, $this->interest, $this->amount, $this->total_time, $this->heartbeat, $this->heartbeat_complete );
    }

    public function update() {
        return $this->dm->update($this->idx, $this->company_idx, $this->name, $this->interest, $this->amount, $this->total_time, $this->heartbeat, $this->heartbeat_complete );
    }

    public function getList( $sortBy, $sortDirection, $limit, $offset, $select = 'idx,company_idx,name,interest,amount,heartbeat,heartbeat_complete,total_time ' ) {

        $return_list = array();
        $list = $this->dm->getList( $this->company_idx, $this->heartbeat, $this->heartbeat_complete, $sortBy, $sortDirection, $limit, $offset, false, $select);

        foreach($list as $item) {
            array_push($return_list, P2pProductBM::new($item) );
        }

        return $return_list;
    }

    public function getNewList() {
        return $this->dm->getNewList( $this->new_date );
    }

    public function getTotal( $sortBy = 'idx', $sortDirection = 'desc', $select = 'count(*) as cnt ' ) {
        $total = $this->dm->getList( $this->company_idx, $this->heartbeat, $this->heartbeat_complete, $sortBy, $sortDirection, '0', '0', true, $select );
        return (isset($total->cnt)) ? $total->cnt : $total ;
    }

    public function get($select = '*') {
        return P2pProductBM::new(
            $this->dm->get( $this->idx, $select )
        );
    }

    public function remove() {
        $this->dm->remove ( 'p2p_product', $this->idx );
    }
}
