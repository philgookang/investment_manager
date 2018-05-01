<?php

class PRODUCT_INVESTMENT_TYPE {
    const STOCK       = 1;
    const P2PFUND     = 2;
    const LEASE       = 3;
}

class PRODUCT_INVESTMENT_STATUS {
    const REDEEM        = 1;
    const OVERDUE       = 2;
    const COMPLETE      = 3;
}

class ProductM extends BusinessModel {

    // public variables
    public $idx                     = null;
    public $company_idx             = null;
    public $name                    = null;
    public $interest                = null;
    public $total_term              = null;
    public $amount                  = null;
    public $late_start_date         = null;
    public $late_end_date           = null;
    public $investment_status       = null;
    public $investment_complete_date= null;
    public $investment_type         = null;
    public $created_date_time       = null;
    public $status                  = 1;

    public $search_term             = null;
    public $search_month            = null;
    public $search_type             = null;

    // help to create quick objects
    public static function new( $data = array() ) {
        return (new ProductM())->extend($data);
    }

    //// ------------------------------ create setter & getters

    public function setIdx( $idx ) { $this->idx = $idx; return $this; }
    public function getIdx() { return $this->idx; }

    public function setCompanyIdx( $company_idx ) { $this->company_idx = $company_idx; return $this; }
    public function getCompanyIdx() { return $this->company_idx; }

    public function setName( $name ) { $this->name = $name; return $this; }
    public function getName() { return $this->name; }

    public function setInterest( $interest ) { $this->interest = $interest; return $this; }
    public function getInterest() { return $this->interest; }

    public function setAmount( $amount ) {$this->amount = $amount; return $this; }
    public function getAmount($format = false) { return ($format) ? number_format($this->amount) : $this->amount; }

    public function setTotalTerm( $total_term ) { $this->total_term = $total_term; return $this; }
    public function getTotalTerm() { return $this->total_term; }

    public function setLateStartDate( $late_start_date ) { $this->late_start_date = $late_start_date; return $this; }
    public function getLateStartDate() { return $this->late_start_date; }

    public function setLateEndDate( $late_end_date ) { $this->late_end_date = $late_end_date; return $this; }
    public function getLateEndDate() { return $this->late_end_date; }

    public function setInvestmentStatus($investment_status) { $this->investment_status = $investment_status; return $this; }
    public function getInvestmentStatus() { return $this->investment_status; }

    public function setInvestmentCompleteDate($investment_complete_date) { $this->investment_complete_date = $investment_complete_date; return $this; }
    public function getInvestmentCompleteDate() { return $this->investment_complete_date; }

    public function setInvestmentType($investment_type) { $this->investment_type = $investment_type; return $this; }
    public function getInvestmentType() { return $this->investment_type; }

    public function setCreatedDateTime( $created_date_time ) { $this->created_date_time = $created_date_time; return $this; }
    public function getCreatedDateTime($format = 'Y-m-d H:i:s') { $d = new DateTime($this->created_date_time); return $d->format($format); }

    public function setSearchMonth($search_month) { $this->search_month = $search_month; return $this; }
    public function setSearchTerm($search_term) { $this->search_term = $search_term; return $this; }

    //// ------------------------------ action function

    public function create() {
        $data   = array($this->company_idx, $this->name, $this->interest, $this->amount, $this->total_term, $this->late_start_date, $this->late_end_date, $this->investment_status, $this->investment_complete_date, $this->investment_type);
        $field  = array('company_idx', 'name', 'interest', 'amount', 'total_term', 'late_start_date', 'late_end_date', 'investment_status', 'investment_complete_date', 'investment_type');
        $fmt    = 'issiissisi';
        return $this->create_omr( 'product', $field, $data, $fmt );
    }

    public function update() {

        $query	= "UPDATE ";
		$query .=   "`product` ";
		$query .= "SET ";
        $query .=	"`company_idx`=?, ";
        $query .=	"`name`=?, ";
        $query .=	"`interest`=?, ";
        $query .=	"`amount`=?, ";
        $query .=	"`total_term`=?, ";
        $query .=	"`late_start_date`=?, ";
        $query .=	"`late_end_date`=?, ";
        $query .=	"`investment_status`=?, ";
        $query .=	"`investment_complete_date`=?, ";
        $query .=	"`investment_type`=? ";
        $query .= "WHERE ";
        $query .=	"`idx`=? ";

        $this->postman->execute($query, array(
            'issiissisii', &$this->company_idx, &$this->name, &$this->interest, &$this->amount, &$this->total_term, &$this->late_start_date, &$this->late_end_date, &$this->investment_status, &$this->investment_complete_date, &$this->investment_type, &$this->idx
        ));
    }

    public function getList() {

        $query	= "SELECT ";
        $query .=   " `p`.`idx`,`c`.`name` as company_name,`p`.`name` as product_name, `p`.`amount`, `p`.`interest`,`p`.`total_term`,`p`.`investment_status`,`p`.`investment_complete_date` ";
		$query .= "FROM ";
        $query .=   "`product` as `p`, ";
        $query .=   "`company` as `c` ";
		$query .= "WHERE ";
        $query .=   "`p`.`company_idx`=`c`.`idx` AND ";
        if ($this->investment_status!=null) { $query .=	"`p`.`investment_status`=? "; }
        $query .=	"`p`.`status`=? ";
		$query .=	"ORDER BY `p`.`idx` desc ";

        $fmt = "";
        if ($this->investment_status!=null) { $fmt .= "i"; }

		$params = array($fmt."i");
        if ($this->investment_status!=null) { $params[] = &$this->investment_status; }
        $params[] = &$this->status;

        return $this->postman->returnDataList( $query, $params );
    }

    public function get($select = '*') {

        $query	= "SELECT ";
		$query .=   "$select ";
		$query .= "FROM ";
        $query .=   "`product` ";
		$query .= "WHERE ";
        $query .=   "`idx`=? AND ";
		$query .=	"`status`=? ";

		return ProductM::new($this->postman->returnDataObject($query, array(
            'is', &$this->idx, &$this->status
        )));
    }

    public function remove() {
        $this->dm->remove_omr ( 'p2p_product', $this->idx );
    }
}
