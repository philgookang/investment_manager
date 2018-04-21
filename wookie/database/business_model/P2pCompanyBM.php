<?php

class P2pCompanyBM extends BusinessModel {

    // data model for this bm
    private $dm                     = null;

    // public variables
    public $idx                     = 0;
    public $name                    = '';
    public $created_date_time       = null;

    // init function
    public function __construct() {
        $this->dm = new P2pCompanyDM();
    }

    // help to create quick objects
    public static function new( $data = array() ) {
        // create new object
        $new = new P2pCompanyBM();
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

    public function setName( $name ) {
        $this->name = $name; return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setCreatedDateTime( $created_date_time ) {
        $this->created_date_time = $created_date_time; return $this;
    }

    public function getCreatedDateTime($format = 'Y-m-d H:i:s') {
        $d = new DateTime($this->created_date_time);
        return $d->format($format);
    }

    //// ------------------------------ action function

    public function getList( $sortBy, $sortDirection, $limit, $offset, $select = 'idx,name ' ) {

        $return_list = array();
        $list = $this->dm->getList( $sortBy, $sortDirection, $limit, $offset, false, $select);

        foreach($list as $item) {
            array_push($return_list, P2pCompanyBM::new($item) );
        }

        return $return_list;
    }

    public function get($select = '*') {
        return P2pCompanyBM::new(
            $this->dm->get( $this->idx, $select )
        );
    }
}
