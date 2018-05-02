<?php

class ReturnsM extends BusinessModel {

    // public variables
    public $idx                     = null;
    public $product_idx             = null;
    public $date                    = null;
    public $investment              = null;
    public $profit                  = null;
    public $profit_late             = null;
    public $tax                     = null;
    public $fee                     = null;
    public $term                    = null;
    public $payment_status          = null;
    public $bond                    = null;
    public $created_date_time       = null;
    public $status                  = 1;

    public $search_month            = null;
    public $search_product_investment_type = null;

    // help to create quick objects
    public static function new( $data = array() ) { return (new ReturnsM())->extend($data); }

    public function summary( $investment_list ) {

        if (count($investment_list) <= 0) {
            return array();
        }

        $total_profit               = 0;
        $total_profit_late          = 0;
        $total_return_investment    = 0;
        $total_bond                 = 0;
        $total_fee                  = 0;
        $total_tax                  = 0;
        $total_value                = 0;
        $total_investment           = 0;

        foreach($investment_list as $investment) {
            $total_profit               += $investment->profit;
            $total_return_investment    += $investment->investment;
            $total_bond                 += $investment->bond;
            $total_profit_late          += $investment->profit_late;
            $total_tax                  += $investment->tax;
            $total_fee                  += $investment->fee;
            $investment->total          = ($investment->profit + $investment->bond + $investment->profit_late) - ($investment->tax + $investment->fee);
            $total_value                += $investment->total;
        }

        return array(
            'total_profit_late'         => $total_profit_late,
            'total_fee'                 => $total_fee,
            'total_tax'                 => $total_tax,
            'total_profit'              => $total_profit,
            'total_return_investment'   => $total_return_investment,
            'total_value'               => $total_value,
            'total_investment'          => $total_investment,
            'total_bond'                => $total_bond,
            'list'                      => $investment_list
        );
    }

    public function analyse() {

        $date              = new DateTime('2017-03-01');
        $summary_list      = array();
		$total_investment  = 0;

		for($i = 0; $i < 40; $i++) {
			$date->modify('+1 month');
            $this->setSearchMonth($date->format('Y-m'));
			$summary = $this->getDetailList();
			if (count($summary) > 0) {
				$summary_list[$date->format('Y-m')] = $summary;
			}
            $date = new DateTime($date->format('Y-m-d'));
            if ($date->format('Y-m') == date('Y-md')) {
                break;
            }
		}

		$analytics = array();
		foreach($summary_list as $key=>$summary) {
			array_push($analytics, array(
				'month' 		=> $key,
				'investment' 	=> $summary['total_investment'],
				'profit' 		=> $summary['total_value'],
                'summary'       => $summary
			));
		}

		return $analytics;
    }

    //// ------------------------------ create setter & getters

    public function setIdx( $idx ) { $this->idx = $idx; return $this; }
    public function getIdx() { return $this->idx; }

    public function setProductIdx( $product_idx ) { $this->product_idx = $product_idx; return $this; }
    public function getProductIdx() { return $this->product_idx; }

    public function setDate( $date ) { $this->date = $date; return $this; }
    public function getDate() { return $this->date; }

    public function setInvestment( $investment ) { $this->investment = $investment; return $this; }
    public function getInvestment() { return $this->investment; }

    public function setProfit( $profit ) { $this->profit = $profit; return $this; }
    public function getProfit() { return $this->profit; }

    public function setProfitLate( $profit_late ) { $this->profit_late = $profit_late; return $this; }
    public function getProfitLate() { return $this->profit_late; }

    public function setTax( $tax ) { $this->tax = $tax; return $this; }
    public function getTax() { return $this->tax; }

    public function setTerm( $term ) { $this->term = $term; return $this; }
    public function getTerm() { return $this->term; }

    public function setFee( $fee ) { $this->fee = $fee; return $this; }
    public function getFee() { return $this->fee; }

    public function setBond( $bond ) { $this->bond = $bond; return $this; }
    public function getBond() { return $this->bond; }

    public function setPaymentStatus( $payment_status ) { $this->payment_status = $payment_status; return $this; }
    public function getPaymentStatus() { return $this->payment_status; }

    public function setCreatedDateTime( $created_date_time ) { $this->created_date_time = $created_date_time; return $this; }
    public function getCreatedDateTime($format = 'Y-m-d H:i:s') { $d = new DateTime($this->created_date_time); return $d->format($format); }

    public function setStatus( $status ) { $this->status = $status; return $this; }
    public function getStatus() { return $this->status; }

    public function setSearchMonth($search_month) { $this->search_month = $search_month; return $this; }
    public function setSearchProductInvestmentType($search_product_investment_type) { $this->search_product_investment_type = $search_product_investment_type; return $this; }

    //// ------------------------------ action function

    public function create() {

        $data   = array($this->product_idx, $this->date, $this->investment, $this->profit, $this->bond, $this->profit_late, $this->tax, $this->term, $this->fee, $this->payment_status);
        $field  = array('product_idx', 'date', 'investment', 'profit', 'bond', 'profit_late', 'tax', 'term', 'fee', 'payment_status');
        $fmt    = 'isiiiiiiii';

        return $this->create_omr('returns', $field, $data, $fmt);
    }

    public function update() {

        $query	= "UPDATE ";
		$query .=   "`returns` ";
		$query .= "SET ";
        $query .=	"`product_idx`=?, ";
        $query .=	"`date`=?, ";
        $query .=	"`investment`=?, ";
        $query .=	"`profit`=?, ";
        $query .=	"`bond`=?, ";
        $query .=	"`profit_late`=?, ";
        $query .=	"`tax`=?, ";
        $query .=	"`term`=?, ";
        $query .=	"`fee`=?, ";
        $query .=	"`payment_status`=?, ";
        $query .=	"`status`=? ";
        $query .= "WHERE ";
        $query .=	"`idx`=? ";

        $this->postman->execute($query, array(
            'isiiiiiiiiii', &$this->product_idx, &$this->date, &$this->investment, &$this->profit,
            &$this->bond, &$this->profit_late, &$this->tax, &$this->term, &$this->fee, &$this->payment_status, &$this->status, &$this->idx
        ));
    }

    public function updatePaymentStatus() {

        $query	= "UPDATE ";
		$query .=   "`returns` ";
		$query .= "SET ";
        $query .=	"`payment_status`=? ";
        $query .= "WHERE ";
        $query .=	"`idx`=? ";

        $this->postman->execute($query, array(
            'ii', &$this->payment_status, &$this->idx
        ));
    }

    public function getList($sort_by = "`r`.`date`", $sort_direction ="asc") {

        $query	= "SELECT ";
        $query .=   "  `r`.`idx` as idx, ";
        $query .=   "  `r`.`term` as term, ";
        $query .=   "  `r`.`investment` as investment, ";
        $query .=   "  `r`.`profit` as profit, ";
        $query .=   "  `r`.`bond` as bond, ";
        $query .=   "  `r`.`profit_late` as profit_late, ";
        $query .=   "  `r`.`tax` as tax, ";
        $query .=   "  `r`.`fee` as fee, ";
        $query .=   "  `r`.`date` as date, ";
        $query .=   "  `r`.`payment_status` as payment_status ";
		$query .= "FROM ";
        $query .=   "`returns` `r` ";
		$query .= "WHERE ";
        if ($this->product_idx!=null){ $query .= "`r`.`product_idx`=? AND "; }
		$query .=	"`r`.`status`=? ";
		$query .=	"ORDER BY $sort_by $sort_direction ";

        $fmt = "";
        if ($this->product_idx!=null){ $fmt .= "i"; }

		$params = array($fmt.'i');
        if ($this->product_idx!=null){ $params[] = &$this->product_idx; }
		$params[] = &$this->status;

        return array_map(function($item) {
            return ReturnsM::new($item);
        }, $this->postman->returnDataList( $query, $params ));
    }

    public function getDetailList() {

        $query	= "SELECT ";
        $query .=   "  `c`.`idx` as company_idx, ";
        $query .=   "  `c`.`name` as company_name, ";
        $query .=   "  `p`.`idx` as product_idx, ";
        $query .=   "  `p`.`name` as product_name, ";
        $query .=   "  `p`.`interest` as interest_rate, ";
        $query .=   "  `p`.`amount` as investment_amount, ";
        $query .=   "  `p`.`total_term` as investment_total_term, ";
        $query .=   "  `p`.`investment_status` as investment_status, ";
        $query .=   "  `p`.`investment_complete_date` as investment_complete_date, ";
        $query .=   "  `p`.`investment_type` as product_type, ";
        $query .=   "  `r`.`investment` as investment, ";
        $query .=   "  `r`.`profit` as profit, ";
        $query .=   "  `r`.`bond` as bond, ";
        $query .=   "  `r`.`profit_late` as profit_late, ";
        $query .=   "  `r`.`tax` as tax, ";
        $query .=   "  `r`.`fee` as fee, ";
        $query .=   "  `r`.`date` as date, ";
        $query .=   "  `r`.`term` as current_term, ";
        $query .=   "  `r`.`payment_status` as payment_status ";
		$query .= "FROM ";
        $query .=   "`returns` `r`, ";
        $query .=   "`product` `p`, ";
        $query .=   "`company` `c` ";
		$query .= "WHERE ";
        $query .=	"`r`.`product_idx` = `p`.`idx` AND ";
        $query .=	"`p`.`company_idx` = `c`.`idx` AND ";
        if ($this->search_month!=null) { $query .= "`r`.`date` LIKE ? AND "; }
        if ($this->search_product_investment_type!=null) { $query .= "`p`.`investment_type` = ? AND "; }
		$query .=	"`r`.`status`=? ";
		$query .=	"ORDER BY `r`.`date` asc ";

        $fmt = "";
        if ($this->search_month!=null) { $fmt .= "s"; }
        if ($this->search_product_investment_type!=null) { $fmt .= "i"; }

		$params = array($fmt.'i');
        if ($this->search_month!=null) { $s =  $this->search_month.'%'; $params[] = &$s; }
        if ($this->search_product_investment_type!=null) { $params[] = &$this->search_product_investment_type; }
		$params[] = &$this->status;

        $list = $this->postman->returnDataList( $query, $params );
        return $this->summary($list);
    }

    public function removeAll() {

        $query	= "UPDATE ";
		$query .=   "`returns` ";
		$query .= "SET ";
        $query .=	"`status`=? ";
        $query .= "WHERE ";
        $query .=	"`product_idx`=? AND ";
        $query .=	"`status`=? ";

        $newstatus  = 0;

        $this->postman->execute($query, array(
            'iii', &$newstatus, &$this->product_idx, &$this->status
        ));
    }
}
