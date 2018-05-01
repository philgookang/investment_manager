<?php

class P2pReturnsDM extends DataModel  {

    public function getListJoin( $search_month ) {

        
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
