<?php

class P2pProductTypeDM extends DataModel  {

    public function create($product_idx, $profit, $profit_late, $tax, $susuro, $date, $term, $marker, $type) {

        $data   = array($product_idx, $profit, $profit_late, $tax, $susuro, $date, $term, $marker, $type);
        $field  = array('product_idx', 'profit', 'profit_late', 'tax', 'susuro', 'date', 'term', 'marker', 'type');
        $fmt    = 'sssssssii';

        return $this->create_omr('p2p_returns', $field, $data, $fmt);
    }

    public function updateMarker($idx, $marker ) {

        $query	= "UPDATE ";
		$query .=   "`p2p_returns` ";
		$query .= "SET ";
        $query .=	"`marker`=? ";
        $query .= "WHERE ";
        $query .=	"`idx`=? ";

        $this->postman->execute($query, array(
            'ii', &$marker, &$idx
        ));
    }

    public function update($idx, $product_idx, $profit, $profit_late, $tax, $susuro, $date, $term, $marker, $type) {

        $status = 'A';

        $query	= "UPDATE ";
		$query .=   "`p2p_returns` ";
		$query .= "SET ";
        $query .=	"`product_idx`=?, ";
        $query .=	"`profit`=?, ";
        $query .=	"`profit_late`=?, ";
        $query .=	"`tax`=?, ";
        $query .=	"`susuro`=?, ";
        $query .=	"`date`=?, ";
        $query .=	"`status`=?, ";
        $query .=	"`term`=?, ";
        $query .=	"`marker`=?, ";
        $query .=	"`type`=? ";
        $query .= "WHERE ";
        $query .=	"`idx`=? ";

        $this->postman->execute($query, array(
            'iiiiissiiii', &$product_idx, &$profit, &$profit_late, &$tax, &$susuro, &$date, &$status, &$term, &$marker, &$type, &$idx
        ));
    }

    public function removeAll($product_idx) {

        $status = 'D';

        $query	= "UPDATE ";
		$query .=   "`p2p_returns` ";
		$query .= "SET ";
        $query .=	"`status`=? ";
        $query .= "WHERE ";
        $query .=	"`product_idx`=? ";

        $this->postman->execute($query, array(
            'si', &$status, &$product_idx
        ));
    }

    public function getListJoin( $search_month ) {

        $search_month =  $search_month . '%';

        $query	= "SELECT ";
        $query .=   "  `p2p_c`.`idx` as company_idx, ";
        $query .=   "  `p2p_c`.`name` as company_name, ";
        $query .=   "  `p2p_p`.`idx` as product_idx, ";
        $query .=   "  `p2p_p`.`name` as product_name, ";
        $query .=   "  `p2p_p`.`interest` as interest_rate, ";
        $query .=   "  `p2p_p`.`amount` as investment_amount, ";
        $query .=   "  `p2p_p`.`total_time` as investment_total_term, ";
        $query .=   "  `p2p_p`.`heartbeat` as investment_status, ";
        $query .=   "  `p2p_p`.`heartbeat_complete` as investment_status_complete, ";
        $query .=   "  `p2p_r`.`profit` as profit, ";
        $query .=   "  `p2p_r`.`profit_late` as profit_late, ";
        $query .=   "  `p2p_r`.`tax` as tax, ";
        $query .=   "  `p2p_r`.`susuro` as fee, ";
        $query .=   "  `p2p_r`.`date` as date, ";
        $query .=   "  `p2p_r`.`term` as current_term, ";
        $query .=   "  `p2p_r`.`marker` as term_marker, ";
        $query .=   "  `p2p_r`.`type` as type ";
		$query .= "FROM ";
        $query .=   "`p2p_returns` `p2p_r`, ";
        $query .=   "`p2p_product` `p2p_p`, ";
        $query .=   "`p2p_company` `p2p_c` ";
		$query .= "WHERE ";
        $query .=	"`p2p_r`.`product_idx` = `p2p_p`.`idx` AND ";
        $query .=	"`p2p_p`.`company_idx` = `p2p_c`.`idx` AND ";
        $query .=	"`p2p_r`.`date` LIKE ? AND ";
		$query .=	"`p2p_r`.`status`=? ";
		$query .=	"ORDER BY `p2p_r`.`date` asc ";

        $status = 'A';

		$fmt = "ss";

		$params = array($fmt);
        $params[] = &$search_month;
		$params[] = &$status;

        return $this->postman->returnDataList( $query, $params );
    }

    public function getList( $search_month, $product_idx, $type, $sortBy, $sortDirection, $limit, $offset, $total_count = false, $select ) {

        $query	= "SELECT ";
        $query .=   $select;
		$query .= "FROM ";
        $query .=   "`p2p_returns` ";
		$query .= "WHERE ";
        if ($search_month != "") { $query .=	"`date` LIKE ? AND "; }
        if ($product_idx != 0) { $query .=	"`product_idx`=? AND "; }
        if ($type != 0) { $query .=	"`type`=? AND "; }
		$query .=	"`status`=? ";
		$query .=	"ORDER BY $sortBy $sortDirection ";
        if ( !$total_count && $limit != 0 && $offset != 0 )  {
            $query .= "limit ? offset ? ";
        }

        $status = 'A';

		$fmt = "";
        if ($search_month != "") { $fmt .= "s"; }
        if ($product_idx != 0) { $fmt .= "s"; }
        if ($type != 0) { $fmt .= "s"; }
        $fmt .= "s"; // (s)status
        if ( !$total_count && $limit != 0 && $offset != 0 )  {
            $fmt .= "ii";
        }

		$params = array($fmt);
        if ($search_month != "") {
            $search_month = '%' . $search_month . '%';
            $params[] = &$search_month;
        }
        if ($product_idx != 0) { $params[] = &$product_idx; }
        if ($type != 0) { $params[] = &$type; }
		$params[] = &$status;

		if ( $total_count ) {
            return $this->postman->returnDataObject( $query, $params );
        } else {
            if ( !$total_count && $limit != 0 && $offset != 0 )  {
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
        $query .=   "`p2p_returns` ";
		$query .= "WHERE ";
        $query .=   "`idx`=? AND ";
		$query .=	"`status`=? ";

        $status = 'A';

		return $this->postman->returnDataObject($query, array(
            'is', &$idx, &$status
        ));
    }
}
