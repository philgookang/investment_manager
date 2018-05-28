<?php

class COMPANY_TYPE {
    const FUNDING = 1;
    const STOCK   = 2;
    const LEASE   = 3;
    const LOAN    = 4;
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

    public function summary($company_list) {

        $total_process 	= 0;
		$total_late 	= 0;
		$total_finish 	= 0;
		$grand_total 	= 0;

		$sublist 		= array();

		foreach($company_list as $company) {

			$process = 0;
			$late = 0;
			$finish = 0;
			$total = 0;

			$product_list = ProductM::new()->setCompanyIdx($company->getIdx())->getList();

			foreach($product_list as $product) {
				switch($product->investment_status) {
					case 1:
						$process += $product->amount;
						break;
					case 2:
						$late += $product->amount;
						break;
					case 3:
						$finish += $product->amount;
						break;
				}
				$total += $product->amount;
			}

			array_push($sublist, array(
                'idx'       => $company->getIdx(),
				'process' 	=> $process,
				'late' 		=> $late,
				'finish' 	=> $finish,
				'total' 	=> $total,
				'name'		=> $company->getName()
			));

			$total_process 	+= $process;
			$total_late 	+= $late;
			$total_finish 	+= $finish;
			$grand_total 	+= $total;
		}

        return array(
            'total_process'     => $total_process,
			'total_late' 	    => $total_late,
			'total_finish' 	    => $total_finish,
			'grand_total' 	    => $grand_total,
            'list'              => $sublist
        );
    }

    //// ------------------------------ action function

    public function create() {
        $data   = array($this->name, $this->type);
        $field  = array('name', 'type');
        $fmt    = 'si';
        return $this->create_omr('company', $field, $data, $fmt );
    }

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

        $query	= "SELECT ";
        $query .=   "$select ";
        $query .= "FROM ";
        $query .=   "`company` ";
        $query .= "WHERE ";
        $query .=   "`idx`=? AND ";
        $query .=	"`status`=? ";

        return CompanyM::new($this->postman->returnDataObject($query, array(
            'ii', &$this->idx, &$this->status
        )));
    }
}
