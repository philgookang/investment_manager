<?php defined('BASEPATH') OR exit('No direct script access allowed');

class P2p extends CI_Controller {

	public function index() {

        $limit      = ($this->input->get('limit')) ? $this->input->get('limit') : '100';
        $sort_dir   = ($this->input->get('sort_direction')) ? $this->input->get('sort_direction') : 'desc';
        $sort_by    = ($this->input->get('sort_by')) ? $this->input->get('sort_by') : 'idx';
        $offset     = ($this->input->get('per_page')) ? $this->input->get('per_page') : '0';

		$product = P2pProductBM::new();

		if ($this->input->get('heartbeat') != '') {
			$product->setHeartbeat($this->input->get('heartbeat'));
		}

        $list = $product->getList( $sort_by, $sort_dir, $limit, $offset );
        $total_count = $product->getTotal();

        $pagination = pagination('/admin/p2p/?', $limit, $total_count);

        $data = array();
        $data['list']           = $list;
        $data['pagination']     = $pagination;
        $data['total_count']    = $total_count;

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/p2p', $data);
        $this->load->view('admin/template/foot');
	}

    public function manage($idx = '-1') {

        $product = P2pProductBM::new()->setIdx($idx)->get();
		$return_list = P2pReturnsBM::new()->setProductIdx($idx)->getList( 'idx', 'asc', '0', '0');
		$company_list = P2pCompanyBM::new()->getList('idx', 'asc', '0', '0');

        $data = array();
        $data['product'] = $product;
		$data['return_list'] = $return_list;
		$data['company_list'] = $company_list;

        $this->load->view('admin/template/head');
        $this->load->view('admin/page/p2p_manage', $data);
        $this->load->view('admin/template/foot');
	}
}
