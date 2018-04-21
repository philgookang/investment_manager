<?php

class P2pProductDM extends DataModel  {

    public function create($company_idx, $name, $interest, $amount, $total_time, $heartbeat, $heartbeat_complete ) {

        $data   = array($company_idx, $name, $interest, $amount, $total_time, $heartbeat, $heartbeat_complete );
        $field  = array('company_idx', 'name', 'interest', 'amount', 'total_time', 'heartbeat', 'heartbeat_complete' );
        $fmt    = 'issiiis';

        return $this->create_omr('p2p_product', $field, $data, $fmt);
    }

    public function update($idx, $company_idx, $name, $interest, $amount, $total_time, $heartbeat, $heartbeat_complete ) {

        $query	= "UPDATE ";
		$query .=   "`p2p_product` ";
		$query .= "SET ";
        $query .=	"`company_idx`=?, ";
        $query .=	"`name`=?, ";
        $query .=	"`interest`=?, ";
        $query .=	"`amount`=?, ";
        $query .=	"`total_time`=?, ";
        $query .=	"`heartbeat`=?, ";
        $query .=	"`heartbeat_complete`=? ";
        $query .= "WHERE ";
        $query .=	"`idx`=? ";

        $this->postman->execute($query, array(
            'issiiisi', &$company_idx, &$name, &$interest, &$amount, &$total_time, &$heartbeat, &$heartbeat_complete, &$idx
        ));
    }

    public function getList( $company_idx, $heartbeat, $heartbeat_complete, $sortBy, $sortDirection, $limit, $offset, $total_count = false, $select ) {

        $query	= "SELECT ";
        $query .=   $select;
		$query .= "FROM ";
        $query .=   "`p2p_product` ";
		$query .= "WHERE ";
        if ( $company_idx != '0') {
            $query .= "`company_idx`=? AND ";
        }
        if ( $heartbeat != '0') {
            $query .= "`heartbeat`=? AND ";
        }
        if ( $heartbeat_complete != '0000-00-00') {
            $query .= "`heartbeat_complete` LIKE ? AND ";
        }
		$query .=	"`status`=? ";
		$query .=	"ORDER BY $sortBy $sortDirection ";
        if ( !$total_count && $limit != 0 )  {
            $query .= "limit ? offset ? ";
        }

        $status = 'A';

		$fmt = "";
        if ( $company_idx != '0') {
            $fmt .= "i";
        }
        if ( $heartbeat != '0') {
            $fmt .= "s";
        }
        if ( $heartbeat_complete != '0000-00-00') {
            $fmt .= "s";
        }
        $fmt .= "s"; // (s)status
        if ( !$total_count && $limit != 0 )  {
            $fmt .= "ii";
        }

		$params = array($fmt);
        if ( $company_idx != '0') {
            $params[] = &$company_idx;
        }
        if ( $heartbeat != '0') {
            $params[] = &$heartbeat;
        }
        if ( $heartbeat_complete != '0000-00-00') {
            $heartbeat_complete = '%'.$heartbeat_complete.'%';
            $params[] = &$heartbeat_complete;
        }
		$params[] = &$status;

		if ( $total_count ) {
            return $this->postman->returnDataObject( $query, $params );
        } else {
            if ( !$total_count && $limit != 0 )  {
                $params[] = &$limit;
    			$params[] = &$offset;
            }
            return $this->postman->returnDataList( $query, $params );
		}
    }

    public function get( $idx, $select = '*' ) {

        $query	= "SELECT ";
		$query .=   "$select ";
		$query .= "FROM ";
        $query .=   "`p2p_product` ";
		$query .= "WHERE ";
        $query .=   "`idx`=? AND ";
		$query .=	"`status`=? ";

        $status = 'A';

		return $this->postman->returnDataObject($query, array(
            'is', &$idx, &$status
        ));
    }
}
