<?php

class P2pCompanyDM extends DataModel  {

    public function getList( $sortBy, $sortDirection, $limit, $offset, $total_count = false, $select ) {

        $query	= "SELECT ";
        $query .=   $select;
		$query .= "FROM ";
        $query .=   "`p2p_company` ";
		$query .= "WHERE ";
		$query .=	"`status`=? ";
		$query .=	"ORDER BY $sortBy $sortDirection ";
        if ( !$total_count && $limit != 0 && $offset != 0 )  {
            $query .= "limit ? offset ? ";
        }

        $status = 'A';

		$fmt = "";
        $fmt .= "s"; // (s)status
        if ( !$total_count && $limit != 0 && $offset != 0 )  {
            $fmt .= "ii";
        }

		$params = array($fmt);
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
        $query .=   "`p2p_company` ";
		$query .= "WHERE ";
        $query .=   "`idx`=? AND ";
		$query .=	"`status`=? ";

        $status = 'A';

		return $this->postman->returnDataObject($query, array(
            'is', &$idx, &$status
        ));
    }
}
