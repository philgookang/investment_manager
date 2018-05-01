<?php

class COMPANY_TYPE {
    const FUNDING = 1;
    const STOCK   = 2;
    const LEASE   = 3;
}

class CompanyM extends BusinessModel {

    // public variables
    public $idx                     = null;
    public $name                    = null;
    public $type                    = null;
    public $created_date_time       = null;
    public $status                  = 1;

    // help to create quick objects
    public static function new( $data = array() ) { return (new CompanyM())->extend($data); }

    //// ------------------------------ create setter & getters

    public function setIdx( $idx ) { $this->idx = $idx; return $this; }
    public function getIdx() { return $this->idx; }

    public function setName( $name ) { $this->name = $name; return $this; }
    public function getName() { return $this->name; }

    public function setType( $type ) { $this->type = $type; return $this; }
    public function getType() { return $this->type; }

    public function setCreatedDateTime( $created_date_time ) { $this->created_date_time = $created_date_time; return $this; }
    public function getCreatedDateTime($format = 'Y-m-d H:i:s') { $d = new DateTime($this->created_date_time); return $d->format($format); }

    //// ------------------------------ action function

    public function getList($sortBy = 'name', $sortDirection = 'asc') {

        $query	= "SELECT ";
        $query .=   " idx,name,type ";
        $query .= "FROM ";
        $query .=   "`company` ";
        $query .= "WHERE ";
        if ($this->type!=null) { $query .= "`type`=? AND "; }
        $query .=	"`status`=? ";
        $query .=	"ORDER BY $sortBy $sortDirection ";

        $fmt = "";
        if ($this->type!=null) { $fmt .= "i"; }

        $params = array($fmt."i");
        if ($this->type!=null) { $params[] = &$this->type; }
        $params[] = &$this->status;

        return array_map(function($item) {
            return CompanyM::new($item);
        }, $this->postman->returnDataList( $query, $params ));
    }

    public function get($select = '*') {
        return P2pCompanyBM::new(
            $this->dm->get( $this->idx, $select )
        );
    }
}
