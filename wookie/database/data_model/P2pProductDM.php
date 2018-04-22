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

    public function getNewList( $new_date ) {

        $query	= "SELECT ";
        $query .=   " `p2p_p`.`idx`,`p2p_c`.`name` as company_name,`p2p_p`.`name` as product_name, `p2p_p`.`amount`, `p2p_p`.`interest`,`p2p_p`.`total_time` ";
		$query .= "FROM ";
        $query .=   "`p2p_product` as `p2p_p`, ";
        $query .=   "`p2p_company` as `p2p_c`, ";
        $query .=   "`p2p_returns` as `p2p_r` ";
		$query .= "WHERE ";
        $query .=   "`p2p_p`.`company_idx`=`p2p_c`.`idx` AND ";
        $query .=   "`p2p_p`.`idx`=`p2p_r`.`product_idx` AND ";
        $query .=   "`p2p_r`.`term`=? AND ";
        $query .=   "`p2p_r`.`date` LIKE ? AND ";
        $query .=	"`p2p_r`.`type`=? AND ";
		$query .=	"`p2p_r`.`status`=? AND ";
        $query .=	"`p2p_p`.`status`=? ";
		$query .=	"ORDER BY `p2p_r`.`idx` asc ";

        $term       = 1;
        $type       = 1;
        $status     = 'A';
        $new_date   = $new_date.'%';

		$fmt = "isiss";

		$params = array($fmt);
        $params[] = &$term;
        $params[] = &$new_date;
        $params[] = &$type;
		$params[] = &$status;
        $params[] = &$status;

        return $this->postman->returnDataList( $query, $params );
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
